<?php  
if(!function_exists('rfs_add_frontend_ajax')) {
	function rfs_add_frontend_ajax() {
		wp_enqueue_script( 'ajax_custom_script',  get_stylesheet_directory_uri() . '/js/ajax.min.js', array('jquery'),'', true );
		wp_localize_script( 'ajax_custom_script', 'frontendajax', array('ajaxurl' => admin_url( 'admin-ajax.php')));
	}
	add_action('wp_enqueue_scripts', 'rfs_add_frontend_ajax');
}
function course_signup() {
	$source				= sanitize_text_field($_POST['source']);
	$client_first_name 	= sanitize_text_field($_POST['client_first_name']);
	$client_last_name 	= sanitize_text_field($_POST['client_last_name']);
	//$client_name 		= sanitize_text_field($_POST['client_name']);
	$client_email 		= sanitize_email($_POST['client_email']);
	$client_phone 		= sanitize_text_field($_POST['client_phone']);
	$client_info 		= sanitize_text_field($_POST['client_info']);
	$course_name		= sanitize_text_field($_POST['course_name']);
	
	switch($source) {
		case 'sps_courses':
			$course_name		= sanitize_text_field($_POST['course_name']);
			$course_type		= sanitize_text_field($_POST['course_type']);
			$course_level		= sanitize_text_field($_POST['course_level']);
			$course_level_id	= sanitize_text_field($_POST['course_level_id']);
			$course_no 			= sanitize_text_field($_POST['course_no']);
			//$course_days 		= sanitize_text_field($_POST['course_days']);
			//$course_start_time 	= sanitize_text_field($_POST['course_start_time']);
			//$course_end_time 	= sanitize_text_field($_POST['course_end_time']);
			$course_start_date 	= sanitize_text_field($_POST['course_start_date']);
			$course_end_date 	= sanitize_text_field($_POST['course_end_date']);
			$course_place		= sanitize_text_field($_POST['course_place']);
			$course_instructor 	= sanitize_text_field($_POST['course_instructor']);
			$course_instructor_id= sanitize_text_field($_POST['course_instructor_id']);
			$course_price 		= sanitize_text_field($_POST['course_price']);
			$course_pricelist 	= sanitize_text_field($_POST['course_pricelist']);
			$payment_method 	= sanitize_text_field($_POST['payment_method']);
			$payment_info		= sanitize_text_field($_POST['payment_info']);
			
			$daystimes			= json_decode(stripslashes($_POST['daystimes']));
			
			if(empty($client_first_name) || empty($client_last_name) || !is_email($client_email) || empty($course_name) || empty($course_type) || empty($course_level) || empty($course_level_id) || empty($course_no) || empty($daystimes) /* || empty($course_days) || empty($course_start_time) || empty($course_end_time) */ || empty($course_start_date) || empty($course_end_date) || empty($course_place) || empty($course_instructor) || empty($course_pricelist) || empty($payment_method)) {
				wp_send_json('error1');	
			}else {	
			if($daystimes == new stdClass()) {
				wp_send_json('errorobj');	
			}
			//wp_send_json('stop');	
				global $wpdb;
				$wpdb->query('START TRANSACTION');
				
				$daystimes 	 = order_days_times($daystimes);
				$client_name = $client_first_name.' '.$client_last_name;	
				
				
				$course_number = strtolower($course_no);
				$course_match = $wpdb->get_row($wpdb->prepare("SELECT id FROM {$wpdb->prefix}cm_courses WHERE LOWER(number) = '%s'", $course_number));
				//$wpdb->query('ROLLBACK');
				//wp_send_json($course_match);	
				$instructor = $wpdb->get_row($wpdb->prepare("SELECT id FROM {$wpdb->prefix}cm_instructors WHERE post_id = '%d'", $course_instructor_id));
				
				if($course_match == NULL) {
					$wpdb->insert(
						$wpdb->prefix.'cm_courses',
						array(
							'number'		=> $course_no,
							'name'			=> $course_name,
							'for_whom'		=> $course_type,
							'level'			=> $course_level_id,
							'days_times'	=> serialize($daystimes),
							/* 'days'			=> $course_days,
							'start_time'	=> $course_start_time,
							'end_time'		=> $course_end_time, */
							'start_date'	=> $course_start_date,
							'end_date'		=> $course_end_date,
							'place'			=> $course_place,
							'instructor'	=> $instructor->id,
							'pricelist'		=> $course_pricelist,
							'total_spots'	=> 50,
							'free_spots'	=> 49,
							'self_created'	=> 1
						)
					);	
					$course_id = $wpdb->insert_id;
				}else {
					$course_id = $course_match->id;
					
					$update_free_spots = $wpdb->query($wpdb->prepare("UPDATE {$wpdb->prefix}cm_courses SET free_spots = free_spots - 1 WHERE id = '%d'", $course_id));
				}
				
				if(!email_exists($client_email)) {
					$password = wp_generate_password();
					$new_user = wp_insert_user(array(
						'user_login' 	=> $client_email,
						'user_email' 	=> $client_email,
						'user_pass'	 	=> $password,
						'display_name' 	=> $client_name,
						'first_name'	=> $client_first_name,
						'last_name'		=> $client_last_name,
					));
					if(is_wp_error($new_user)) {
						$wpdb->query('ROLLBACK');
						wp_send_json('error-reg');
					}
					$user_id 	= $new_user;
					wp_update_user(
						array(
						'ID' => $user_id, 
						'first_name'	=> $client_first_name,
						'last_name'		=> $client_last_name,
						'display_name' 	=> $client_first_name.' '.$client_last_name,
					));
					add_user_meta($user_id, 'has_to_be_activated', 'activated', true);
					//add_user_meta($user_id, 'fullname', $client_name, true);
					add_user_meta($user_id, 'phonenumber', $client_phone, true);
			
					$message 	= rfs_get_email_template('register-user', false, array(
						'login'		=> $client_email,
						'password' 	=> $password,
						'qr_id'		=> $user_id
					));
					$subject 	= esc_html(get_bloginfo('name')).' - Potwierdzenie rejestracji';
					$send_email = wp_mail($client_email, $subject, $message);
					//$fullname 	= $client_name;
					$phonenumber= $client_phone;
					$registering = true;
				}else {
					$user 		= get_user_by('email', $client_email);
					$user_id 	= $user->ID;
					//$fullname	= get_user_meta($user_id, 'fullname', true);
					$phonenumber= get_user_meta($user_id, 'phonenumber', true);
				}
				
				$is_on_course = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM {$wpdb->prefix}cm_clients WHERE user_id = '%d' AND course = '%d'", array($user_id, $course_id)));
				//wp_send_json($is_on_course);
				if($is_on_course > 0) {
					wp_send_json('is-on-course');
					$wpdb->query('ROLLBACK');	
				}
				
				$insert_client = $wpdb->insert(
					$wpdb->prefix.'cm_clients',
					array(
						'first_name'		=> $client_first_name,
						'last_name'			=> $client_last_name,
						'fullname'			=> $client_name,
						'email'				=> $client_email,
						'phone'				=> $phonenumber,
						'info'				=> $client_info,
						'course'			=> $course_id,
						'payment'			=> $payment_method,
						'payment_status'	=> 'Nie zapłacono',
						'user_id'			=> $user_id
					)
				);
				
				$email_data = array(
					'course_name'		=> $course_name,
					'course_type'		=> $course_type,
					'course_level'		=> $course_level,
					'course_number'		=> $course_no,
					'course_daystimes'	=> $daystimes,
					/* 'course_days'		=> $course_days,
					'course_start_time'	=> $course_start_time,
					'course_end_time'	=> $course_end_time, */
					'course_start_date'	=> $course_start_date,
					'course_end_date'	=> $course_end_date,
					'course_place'		=> $course_place,
					'course_instructor'	=> $course_instructor,
					'course_price'		=> $course_price,
					'payment_method'	=> $payment_method,
					'client_name'		=> $client_name,
					'client_email'		=> $client_email,
					'client_phone'		=> $phonenumber,
					'client_info'		=> $client_info
				);
				
				//$wpdb->query('ROLLBACK');
				$message = rfs_get_email_template('course-signup', false, $email_data, $payment_info);
				
				$subject = esc_html(get_bloginfo('name')).' - Zapis na kurs';
				$send_email = wp_mail($client_email, $subject, $message);
				
				$message_to_admin = rfs_get_email_template('course-signup', true, $email_data);
				$send_admin_email = wp_mail(get_option('admin_email'), $subject, $message_to_admin);
				if($insert_client && $send_email  && $send_admin_email) {
					//$wpdb->query('ROLLBACK');
					$wpdb->query('COMMIT');
					wp_send_json('success');
				}else {
					$wpdb->query('ROLLBACK');
					wp_send_json('error2');	
				}	
			}
			$wpdb->query('ROLLBACK');
			wp_send_json('courses');
			break;
		case 'sps_home':
			wp_send_json('home');
			//not implemented 
			break;
		default:
			wp_send_json('error');	
	}
	die();
}
add_action('wp_ajax_course_signup', 'course_signup');
add_action('wp_ajax_nopriv_course_signup', 'course_signup');

function get_dances_by_category() {
	$link = sanitize_text_field($_POST['url']);
	$label = sanitize_text_field($_POST['label']);
	
	if(empty($link) || empty($label)) {
		wp_send_json('error');
	}else {
		$dance_types = get_field('_hf_dance_types', 'option');
		if($dance_types) {
			$dances = array();
			foreach($dance_types as $types) {
				$type = $types['_hf_dance_type'];
				$cats = $types['_hf_dance_type_cats'];	
				if(in_array($label, $cats)) {
					$dances[] = $type;	
				}
			}
			if(empty($dances)) {
				wp_send_json('no-dances');
			}else {
				$html = '';
				foreach($dances as $dance) {
					$html .= '<option value="#!'.sanitize_title($dance).'">'.esc_html($dance).'</option>';	
				}
				$dances_by_cat = array('success', $html);
				wp_send_json($dances_by_cat);
			}
		}else {
			wp_send_json('no-dances');
		}
	}
	
	//wp_send_json(array($link, $label));
	die();
}
add_action('wp_ajax_get_dances_by_category', 'get_dances_by_category');
add_action('wp_ajax_nopriv_get_dances_by_category', 'get_dances_by_category');

function account_personal_save() {
	global $wpdb;
	global $current_user;
	$user_id 	= $current_user->ID;
	$name  		= sanitize_text_field($_POST['name']);
	$email 		= sanitize_text_field($_POST['email']);
	$phone 		= sanitize_text_field($_POST['phone']);
	
	if(empty($name) || empty($email) || empty($phone)) {
		wp_send_json('error');
	}
	
	update_user_meta($user_id, 'fullname', $name);
	update_user_meta($user_id, 'phonenumber', $phone);
	
	$update = $wpdb->update(
		$wpdb->prefix.'cm_clients',
		array(
			'fullname' 	=> $name,
			'phone' 	=> $phone
		),
		array('user_id'	=> $user_id)
	);
	if($update !== false) {
		wp_send_json('success');
	}else {
		wp_send_json('error');	
	}
}
add_action('wp_ajax_account_personal_save', 'account_personal_save');
add_action('wp_ajax_account_personal_save', 'account_personal_save');

function account_new_password() {
	global $wpdb;
	global $current_user;
	$user_id 		= $current_user->ID;
	
	$pass  			= sanitize_text_field($_POST['pass']);
	$pass_repeat 	= sanitize_text_field($_POST['pass_repeat']);
	$pass_current 	= sanitize_text_field($_POST['pass_current']);
	
	if(empty($pass) || empty($pass_repeat) || empty($pass_current)) {
		wp_send_json('error');
	}
	
	if($pass !== $pass_repeat) {
		wp_send_json('error');
	}
	
	if(wp_check_password($pass_current, $current_user->data->user_pass, $user_id)) {
		wp_set_password($pass, $user_id);
		wp_logout();
		wp_send_json('success');
	}else {
		wp_send_json('wrong-pass');
	}
	
	
	$update = $wpdb->update(
		$wpdb->prefix.'cm_clients',
		array(
			'fullname' 	=> $name,
			'phone' 	=> $phone
		),
		array('user_id'	=> $user_id)
	);
	if($update !== false) {
		wp_send_json('success');
	}else {
		wp_send_json('error');	
	}
}
add_action('wp_ajax_account_new_password', 'account_new_password');
add_action('wp_ajax_account_new_password', 'account_new_password');
?>