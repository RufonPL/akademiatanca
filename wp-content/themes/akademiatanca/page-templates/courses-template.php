<?php
/**
 * Template name: Kurs
 * The template for displaying course page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @author Rafał Puczel
 */

get_header(); ?>
	
<?php  
$dancer_1_left 		= get_field('_course_dancer_1_left');
$dancer_1_right 	= get_field('_course_dancer_1_right');
$dancer_2_left 		= get_field('_course_dancer_2_left');
$dancer_2_right 	= get_field('_course_dancer_2_right');
$dances 			= get_field('_course_dances');
$payment_info		= get_field('_course_payment_info');
$payment_text		= get_field('_course_payment_extra_text');

$d1l_top 			= get_field('_cd1l_top');
$d1l_left 			= get_field('_cd1l_left');
$d1r_top 			= get_field('_cd1r_top');
$d1r_right 			= get_field('_cd1r_right');

$d2l_top 			= get_field('_cd2l_top');
$d2l_left 			= get_field('_cd2l_left');
$d2r_top 			= get_field('_cd2r_top');
$d2r_right 			= get_field('_cd2r_right');

$courses_map_header = get_field('_cp_map_header', 'option');
?>

<div class="container page-content courses-page relative">
	<div>
	<?php section_header(get_field('_page_header'), $post->ID); ?>
    </div>
    <div class="row dance-row">
        <?php if($dances) : ?>
        <ul class="nav nav-pills dances-tabs" role="tablist">
        	<?php $d=1; foreach($dances as $dance) : ?>
				<?php $name = get_field('_dance_name', $dance); ?>
                <?php if($name) : ?>
                <li<?php if($d==1) : ?> class="active"<?php endif; ?>><a href="#<?php echo sanitize_title($name); ?>" role="tab" data-toggle="tab"><strong><?php echo esc_html($name); ?></strong></a></li>
                <?php endif; ?>
            <?php $d++; endforeach; ?>
        </ul>
		<?php endif; ?>
        
        <div class="dance-container relative">
        	<?php if($dancer_1_left) : ?><img class="dancer dancer1left" src="<?php echo esc_url($dancer_1_left['sizes']['large']); ?>" alt="<?php echo esc_attr($dancer_1_left['alt']); ?>" style="top:<?php echo esc_html($d1l_top); ?>px; left:<?php echo esc_html($d1l_left); ?>px;"/><?php endif; ?>
            <?php if($dancer_1_right) : ?><img class="dancer dancer1right" src="<?php echo esc_url($dancer_1_right['sizes']['large']); ?>" alt="<?php echo esc_attr($dancer_1_right['alt']); ?>" style="top:<?php echo esc_html($d1r_top); ?>px; right:<?php echo esc_html($d1r_right); ?>px;"/><?php endif; ?>
            <?php if($dancer_2_left) : ?><img class="dancer dancer2left" src="<?php echo esc_url($dancer_2_left['sizes']['large']); ?>" alt="<?php echo esc_attr($dancer_2_left['alt']); ?>" style="top:<?php echo esc_html($d2l_top); ?>px; left:<?php echo esc_html($d2l_left); ?>px;"/><?php endif; ?>
            <?php if($dancer_2_right) : ?><img class="dancer dancer2right" src="<?php echo esc_url($dancer_2_right['sizes']['large']); ?>" alt="<?php echo esc_attr($dancer_2_right['alt']); ?>" style="top:<?php echo esc_html($d2r_top); ?>px; right:<?php echo esc_html($d2r_right); ?>px;"/><?php endif; ?>
            <div class="dance-content relative">
                <div class="tab-content">
        		<?php if($dances) : ?>
                <?php $d=1; foreach($dances as $dance) : ?>
                    <?php 
                    $name 				= get_field('_dance_name', $dance);
					$type 				= get_field('_dance_type', $dance); 
                    $entry_text 		= get_field('_dance_text_1', $dance);
                    $signup_header 		= get_field('_dance_signup_table_header', $dance);
                    $signup_table 		= get_field('_dance_signup_table', $dance);
                    $main_text 			= get_field('_dance_text_2', $dance);
                    $prices_header 		= get_field('_dance_prices_header', $dance);
                    $pricelist_header 	= get_field('_dance_pricelist_header', $dance);
                    $pricelist 			= get_field('_dance_pricelist', $dance); 
					$anchors_header		= get_field('_dance_anchors_header', $dance); 
					$anchors			= get_field('_dance_anchors', $dance); 
                    ?>
                    <?php if($name) : ?>
                    <div class="tab-pane<?php if($d==1) : ?> active<?php endif; ?>" id="<?php echo sanitize_title($name); ?>">
                    	
						<div class="course-anchors relative row">
                        <?php if($anchors) : ?>
                        	<?php if($anchors_header) : ?><h5 class="text-center"><?php echo esc_html($anchors_header); ?></h5><?php endif; ?>
                            <ul class="course-anchor-list">
                            <?php $a=1; foreach($anchors as $anchor) : ?>
                            <li><i class="fa fa-chevron-right"></i> <a href="#<?php echo sanitize_title(get_the_title($dance).$anchor['_dance_anchor']); ?>"><?php echo $anchor['_dance_anchor']; ?></a> </li> 
                            <?php $a++; endforeach; ?>
                            </ul><!--end course anchor list-->
                        <?php endif; ?>
                        </div><!--end row-->
               			<div class="dance-content-area relative">  
                        	<div class="dance-content-area-inner radius-top">       
								<?php if($entry_text) : ?>
                                <div class="dance-entry-text">
                                    <?php echo $entry_text; ?>
                                </div><!--end dance entry text-->
                                <?php endif; ?>
                                
                                <?php if($main_text) : ?>
                                <div class="dance-main-text">
                                    <?php echo $main_text; ?>
                                </div><!--end dance main text-->
                                <?php endif; ?>
                                
                                <?php if($signup_table) : ?>
                                <div class="signup-table signup-container">
                                    <?php if($signup_header) : ?><h5 class="st-header text-center"><?php echo strip_tags(break_string_by_minus($signup_header), '<strong>'); ?></h5><?php endif; ?>
                                    <?php foreach($signup_table as $row) : ?>
                                        <?php  
                                        $level = $row['_course_level'];
										$level_id = $row['_course_level_id'];
                                        $anchor = $row['_course_anchor'];
                                        $courses = $row['_courses'];
										
										$dance_courses = $row['_dance_courses'];
										$anchors_multi = explode(',',$anchor);
                                        ?>
                                        <?php if($level) : ?><h6 data-anchor="<?php if($anchor && $anchors) : ?><?php foreach($anchors_multi as $a) : ?><?php echo sanitize_title(get_the_title($dance).$anchors[$a-1]['_dance_anchor']); ?> <?php endforeach; ?><?php endif; ?>" id="<?php if($anchor && $anchors) : ?><?php echo sanitize_title(get_the_title($dance).$anchors[$anchor-1]['_dance_anchor']); ?><?php endif; ?>" class="st-level text-center"><?php echo strip_tags(string_strong_except_first($level), '<strong>'); ?></h6><?php endif; ?>
                                        
                                        <?php if($dance_courses) : ?>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Nr kursu</th>
                                                        <!--<th>Dzień</th>
                                                        <th>Godzina</th>-->
                                                        <!--NEW-->                                                        
                                                        <?php //if(is_my_ip()) : ?>
                                                        <th>Dzień</th>
                                                        <th>Godzina</th>
                                                        <?php //endif; ?>
                                                        <!--NEW--> 
                                                        <th>Data trwania</th>
                                                        <th>Miejsce kursu</th>
                                                        <th>Instruktor</th>
                                                        <th>Cena</th>
                                                        <th>Akcja</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                            <?php foreach($dance_courses as $course) : ?>
                                            <?php  
											$number 	= $course['_dc_no'];
											/* $days 		= $course['_dc_days'];
											$start_time = $course['_dc_start_time'];
											$end_time 	= $course['_dc_end_time'];*/
											$start_date = $course['_dc_start_date']; 
											$end_date 	= $course['_dc_end_date'];
											
											$places = get_field_object('field_5767ac3814614');
											$place 	= $course['_dc_place'];
											$place_label = $places['choices'][$place];
											
											$instructor = $course['_dc_instructor'];
											//$price 		= $course['_dc_price'];
											$dc_pricelist 	= $course['_dc_pricelist'];
											$dc_day_time = $course['_dc_day_time'];
											?>
                                                    <tr class="st-course" data-course-name="<?php echo esc_html($name); ?>" data-course-type="<?php echo esc_html($type); ?>" data-course-level="<?php echo esc_html($level); ?>" data-course-level-id="<?php echo esc_html($level_id); ?>">
                                                        <td class="stc-number" data-stc-number="<?php echo esc_html($number); ?>"><?php echo esc_html($number); ?></td>
                                                        <!--<td class="stc-day" data-stc-days="<?php //if($days) { foreach($days as $day) { echo esc_html($day).','; } } ?>">-->
                                                        <?php //if($days) : ?>
                                                        	<?php //foreach($days as $day) : ?>
																<!--<p class="no-margin"><?php //echo esc_html($day); ?></p>-->
                                                        	<?php //endforeach; ?>
                                                        <?php //endif; ?>
                                                        <!--</td>
                                                        <td class="stc-time" data-stc-start-time="<?php //echo esc_html($start_time); ?>" data-stc-end-time="<?php echo esc_html($end_time); ?>"><?php //echo esc_html($start_time.'-'.$end_time); ?></td>-->
     
                                                    <!--NEW-->                                                    <?php //if(is_my_ip()) : ?>
                                                        <td class="stc-daytime-days">
                                                        <?php if($dc_day_time) : ?>
                                                            <?php foreach($dc_day_time as $day_time) : ?>
                                                            <p class="no-margin stcdd"><?php echo esc_html($day_time['_day']); ?></p>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                        </td>
                                                        <td class="stc-daytime-times">
                                                        <?php if($dc_day_time) : ?>
                                                            <?php foreach($dc_day_time as $day_time) : ?>
                                                                <p class="no-margin stcdt"><?php echo esc_html($day_time['_start_time'].'-'.$day_time['_end_time']); ?></p>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                        </td>
                                                    <?php //endif; ?>
                                                    <!--NEW-->
                                                        
                                                        <td class="stc-date" data-stc-start-date="<?php echo date('d-m-Y', strtotime($start_date)); ?>" data-stc-end-date="<?php echo date('d-m-Y', strtotime($end_date)); ?>"><?php echo date('d.m', strtotime($start_date)).'-'.date('d.m', strtotime($end_date)); ?></td>
                                                        
                                                        <td class="stc-place" data-stc-place="<?php echo esc_html($place); ?>"><?php echo esc_html($place_label); ?></td>
                                                        <td class="stc-instructor" data-stc-instructor="<?php echo $instructor; ?>"><?php echo esc_html(get_the_title($instructor)); ?></td>
                                                       <!-- <td class="stc-price" data-stc-price="<?php //echo esc_html($price); ?>"><?php //echo esc_html($price); ?> zł</td>-->
                                                        <td class="stc-price" data-stc-pricelist="<?php echo esc_html($dc_pricelist); ?>"><?php echo get_pricelist_price($dc_pricelist); ?> zł</td>
                                                        <!--tutaj zamiast h6 jest div z tłem obrazkowym jako "ZAPISZ SIĘ" słownie-->
                                                         <td class="stc-signup"><div class="btn btn-primary signup-btn text-uppercase signup-div" style="background: url('http://www.akademiatanca.com.pl/wp-content/themes/akademiatanca/images/zapisz.png') no-repeat; width:84px; height:32px;"></div></td>
                                                    </tr>
                                            <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div><!--end table responsive-->
                                        <?php endif; ?>
                                        
                                    <?php endforeach; ?>
                                </div><!--signup table-->
                                <?php endif; ?>
                                
                                <?php if($pricelist) : ?>
                                <div class="dance-prices">
                                    <?php if($prices_header) : ?><h5 class="dp-header text-center"><strong><?php echo esc_html($prices_header); ?></strong></h5><?php endif; ?>
                                    <?php if($pricelist_header) : ?><h5 class="pricelist-header text-center"><strong><?php echo esc_html($pricelist_header); ?></strong></h5><?php endif; ?>
                                    <div class="row dance-pricelist">
                                    <?php $p=1; foreach($pricelist as $price) : ?>
                                        <?php $price_field = $price['_dance_price']; ?>
                                        <?php if($price_field) : ?>
                                        <div class="col-md-6 col-sm-6 col-xs-12 dance-price<?php if($p%2==0) : ?> dp-right<?php endif; ?>">
                                            <div class="dance-price-inner">
                                                <?php echo $price_field; ?>
                                            </div><!--end dance price inner-->
                                        </div><!--end dance price-->
                                        <?php endif; ?>
                                    <?php if($p%2==0 && $p!=count($pricelist)) : ?>
                                    </div><!--end row-->
                                    <div class="row">
                                    <?php endif; ?>
                                    <?php $p++; endforeach; ?>
                                    </div><!--end row-->
                                </div><!--end dance prices-->
                                <?php endif; ?>
                                <?php if($payment_info) : ?>
                                <div class="course-payment-info">
                                    <?php echo $payment_info; ?>
                                </div><!--end course payment info-->
                                <?php endif; ?>
                                
                                <?php if($payment_text) : ?>
                                <div class="course-payment-text">
                                    <?php echo $payment_text; ?>
                                </div><!--end course payment text-->
                                <?php endif; ?>
                            </div><!--end dance content area inner-->
                        </div><!--end dance content area-->
                    </div><!--end tab pane-->
                    <?php endif; ?>
                <?php $d++; endforeach; ?>
        		<?php endif; ?>
                </div><!--end tab content-->
            </div><!--end dance content-->
        </div><!--end dance container-->
    </div><!--end row-->
</div><!--end container--> 

<div class="container-fluid courses-map relative">
	<div class="container">
    <?php if($courses_map_header) : ?><h5><strong><?php echo esc_html($courses_map_header); ?></strong></h5><?php endif; ?>
    </div><!--end container-->
    <?php require_template_part('google-map', '') ?>
</div><!--end container fluid-->              

<?php get_footer(); ?>