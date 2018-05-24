<?php  
function set_time_zone() {
	date_default_timezone_set('Europe/Warsaw');	
}
add_action('init', 'set_time_zone');

function require_template_part($template_part_name, $subfolder=false) {
	$sub = $subfolder ? $subfolder.'/' : '';
	$file = get_template_directory().'/template-parts/'.$sub.$template_part_name.'.php';
	if(file_exists($file)) {
		require $file;
	}
	return;
}
function template_id($template, $multi=false) {
	global $post;
	$template_page = get_pages(array(
		'meta_key' => '_wp_page_template',
		'meta_value' => 'page-templates/'.$template.'-template.php'
	));
	
	$ids = array();
	foreach($template_page as $t_page) {
		$ids[] = $t_page->ID; 
	}
	if(count($ids)>1) {
		return $ids;
	}else {
		return $ids[0];
	}
}
function p2br($content) {
	$newcontent = preg_replace("/<p[^>]*?>/", "", $content);
	$newcontent = str_replace("</p>", "<br />", $newcontent);
	return preg_replace('#(( ){0,}<br( {0,})(/{0,1})>){1,}$#i', '', $newcontent);
}

function section_header($header, $as_page_title=false, $tag='h5') {
    $html = '';
    if($as_page_title) {
        $title = $header ? p2br(strip_tags($header, '<p>,<strong><br>')) : '<strong>'.get_the_title($as_page_title).'</strong>';
    }else {
        $title = $header ? p2br(strip_tags($header, '<p>,<strong><br>')) : '';    
    }
    if($title!='') {
        $html = '<'.$tag.' class="section-header" style="display:inline-block">'.$title.'</'.$tag.'>';
    }
    echo $html;
}


function course_number() {
	return '<span class="course-number"></span>';	
}
add_shortcode('cn', 'course_number');

function courses_bg() {
	global $post;
	if(is_page(template_id('courses', true)) || is_page(template_id('courses-welcome', true))) {
		$bg = get_field('_course_bg', $post->ID);
		if($bg) {
			echo ' style="background-image:url('.esc_url($bg['url']).'); background-position: center 80px; background-size:1920px auto"';
		}
	}
	return;
}

function break_string_by_minus($string) {
	$arr = explode('-', $string);
	$html = '';
	if(count($arr)>1) {
		$i=1; foreach($arr as $word) {
			if($i==count($arr)) {
				$html .= '<strong>'.$word.'</strong>';	
			}else {
				$html .= $word.' - ';
			}
		$i++; }
	}else {
		$html = $string;	
	}
	return $html;
}

function string_strong_except_first($string) {
	$arr = explode(' ', $string);
	$html = '';
	if(count($arr)>1) {
		$i=1; foreach($arr as $word) {
			if($i>1) {
				$html .= '<strong>'.$word.'</strong> ';	
			}else {
				$html .= $word.' ';
			}
		$i++; }
	}else {
		$html = $string;	
	}
	return $html;
}

function rfs_mce_buttons($buttons) {	
	$buttons[] = 'fontsizeselect';
	return $buttons;
}
add_filter('mce_buttons_2', 'rfs_mce_buttons');

function rfs_mce_text_sizes($initArray){
	$initArray['fontsize_formats'] = "10px 12px 13px 14px 16px 18px 21px 24px 28px 32px 36px";
	return $initArray;
}
add_filter('tiny_mce_before_init', 'rfs_mce_text_sizes');

add_filter('pre_get_posts', 'rfs_custom_ppp');
function rfs_custom_ppp($query) {
	if($query->is_main_query() && $query->is_post_type_archive('galeria') && !is_admin()) {
		$query->set('posts_per_page', get_field('_gallery_limit_ppp', 'option'));
	}
	if($query->is_main_query() && $query->is_post_type_archive('instruktorzy') && !is_admin()) {
		$query->set('posts_per_page', get_field('_instructors_limit_ppp', 'option'));
	}
	if($query->is_main_query() && $query->is_post_type_archive('proam') && !is_admin()) {
		$query->set('posts_per_page', get_field('_proam_limit_ppp', 'option'));
	}
}

function get_pricelist_price($pricelist_id) {
	global $wpdb;
	$pricelist = $wpdb->get_row($wpdb->prepare("SELECT price FROM {$wpdb->prefix}cm_pricelists WHERE id = '%d'", $pricelist_id));
	
	if($pricelist) {
		return $pricelist->price;
	}
	return false;
}

function current_user_signup_details() {
	if(is_user_logged_in()) {
		global $current_user;
		$name 		= get_user_meta($current_user->ID, 'fullname', true);
		$first_name = get_user_meta($current_user->ID, 'first_name', true);
		$last_name	= get_user_meta($current_user->ID, 'last_name', true);
		$email 		= $current_user->user_email;
		
		return array('first_name' => $first_name, 'last_name' => $last_name, 'name'=>$name, 'email'=>$email);
	}
	return array('first_name' => '', 'last_name' => '', 'name'=>'', 'email'=>'');
}

function get_user_courses($current=false, $archive=false) {
	global $wpdb;
	global $current_user;
	$userID = esc_sql($current_user->ID);
	
	$cm_courses 		= $wpdb->prefix.'cm_courses';
	$cm_clients 		= $wpdb->prefix.'cm_clients';
	$cm_instructors 	= $wpdb->prefix.'cm_instructors';
	$cm_pricelists 		= $wpdb->prefix.'cm_pricelists';
	$cm_course_levels 	= $wpdb->prefix.'cm_course_levels';
	
	$courses = $wpdb->get_results("SELECT number, $cm_courses.name as course_name, for_whom, $cm_course_levels.level as level_name, days_times, days, start_time, end_time, DATE_FORMAT(STR_TO_DATE(start_date, '%d-%m-%Y'), '%d-%m-%Y') as date_start, end_date, place, $cm_instructors.name as instructor_name, $cm_pricelists.lessons as lessons, $cm_pricelists.price as price, payment, payment_status, note, lessons_paid, amount_paid FROM $cm_courses LEFT JOIN $cm_clients ON $cm_courses.id = $cm_clients.course LEFT JOIN $cm_course_levels ON $cm_courses.level = $cm_course_levels.id LEFT JOIN $cm_instructors ON $cm_courses.instructor = $cm_instructors.id LEFT JOIN $cm_pricelists ON $cm_courses.pricelist = $cm_pricelists.id WHERE $cm_clients.user_id = '".$userID."' ORDER BY STR_TO_DATE(date_start, '%d-%m-%Y') ASC");
	
	if($courses) {
		$course_data = array();
		$today = strtotime(date('d-m-Y'));
		foreach($courses as $course) {
			$check_date = date('d-m-Y', strtotime($course->end_date));
			if($current) {
				$date = strtotime($check_date) >= $today;	
			}
			if($archive) {
				$date = strtotime($check_date) < $today;	
			}
			if($date == true) {
				switch($course->payment_status) {
					case 'Zapłacono':
						$paid = 'Tak';
						break;
					case 'Nie zapłacono':
						$paid = 'Nie';
						break;
					case 'Częściowo zapłacono':
						$paid = '<p class="no-margin no-wrap text-left">Lekcji: '.$course->lessons_paid.'</p><p class="no-margin no-wrap text-left">Kwotę: '.$course->amount_paid.' PLN</p>';
						break;	
				}
				$course_data[] = array(
					'number'		=> $course->number,
					'name'			=> '<span class="no-wrap">'.$course->course_name.'<span><br/><span class="no-wrap">'.$course->for_whom.'</span>',
					'level'			=> $course->level_name,
					'days_times'	=> $course->days_times,
					'days'			=> $course->days,
					'date'			=> date('d.m.y',strtotime($course->date_start)).'<br/>'.date('d.m.y',strtotime($course->end_date)),
					'hours'			=> $course->start_time.'<br/>'.$course->end_time,
					'place'			=> $course->place,
					'instructor'	=> $course->instructor_name,
					'lessons'		=> $course->lessons,
					'price'			=> $course->price,
					'payment'		=> $course->payment,
					'paid'			=> $paid,
					'note'			=> $course->note,
				);	
			}
		}
		if(count($course_data)>0) {
			return $course_data;	
		}
		return false;
	}
	return false;
}

function order_days_times($object) {  
	if(is_object($object)) {
		$days = array();
		foreach($object as $day => $time) {
			$days[] = $day;	
		}
		
		$days = array_filter($days);
		$days = array_unique($days);
		
		$day_numbers 	= array();
		$days_ordered 	= array();	
		$days_order 	= array('Poniedziałek'=>'0', 'Wtorek'=>'1', 'Środa'=>'2', 'Czwartek'=>'3', 'Piątek'=>'4', 'Sobota'=>'5', 'Niedziela'=>'6');
		
		foreach($days as $day) {
			$day_numbers[] = $days_order[$day];	
		}
		
		$days_order = array_flip($days_order);
		asort($day_numbers);
		foreach($day_numbers as $day_number) {
			$days_ordered[] = $days_order[$day_number];
		} 
		
		$new_days_times = new stdClass();
		foreach($days_ordered as $ordered_day) {
			$new_days_times->$ordered_day = $object->$ordered_day;
		}
		return $new_days_times;
	}
	return;
}

function is_my_ip() {
	if($_SERVER['REMOTE_ADDR'] == '79.185.33.20') {
		return true;
	}
	return false;
}

function download_qr() {
	if(isset($_GET['download']) && $_GET['download'] == 'qr') {
		
		header('Content-Description: File Transfer');
		header('Content-Type: image/png');
		header('Content-Disposition: attachment; filename=qr');
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: public');
		header('Pragma: public');
	}
}
add_action('template_redirect', 'download_qr');

function rfswp_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;  ?>

	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>
    	<div id="div-comment-<?php comment_ID(); ?>" class="comment-inner">
        	<h4 class="font1 color4 no-margin"><?php echo ucfirst(get_comment_author()); ?></h4>
            <h6 class="h6 no-margin font1 color1"><em><?php echo get_comment_date('d.m.Y').'r. '.get_comment_time(); ?></em></h6>
            <div class="comment-text color5">
            <?php comment_text(); ?>
            </div><!--end comment text-->
            <?php
			comment_reply_link(array_merge($args, array(
				'add_below' => 'div-comment',
				'depth'     => $depth,
				'max_depth' => $args['max_depth'],
				'before'    => '',
				'after'     => '',
			) ) );
			?>
        </div><!--end comment inner-->
<?php }
?>