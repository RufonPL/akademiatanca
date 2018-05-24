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
                            <div class="course-anchor">
                            <?php $a=1; foreach($anchors as $anchor) : ?>
                            <p><i class="fa fa-chevron-right"></i> <a href="#<?php echo sanitize_title($anchor['_dance_anchor']); ?>"><?php echo $anchor['_dance_anchor']; ?></a> </p>
                            <?php if($a%2==0 && $a!=count($anchors)) : ?>
                            </div><!--end col-->
                            <div class="course-anchor">
                            <?php endif; ?> 
                            <?php $a++; endforeach; ?>
                            </div><!--end col-->
                        <?php endif; ?>
                        </div><!--end row-->
               			<div class="dance-content-area relative">  
                        	<div class="dance-content-area-inner radius-top">       
								<?php if($entry_text) : ?>
                                <div class="dance-entry-text">
                                    <?php echo $entry_text; ?>
                                </div><!--end dance entry text-->
                                <?php endif; ?>
                                
                                <?php if($signup_table) : ?>
                                <div class="signup-table signup-container">
                                    <?php if($signup_header) : ?><h5 class="st-header text-center"><?php echo strip_tags(break_string_by_minus($signup_header), '<strong>'); ?></h5><?php endif; ?>
                                    <?php foreach($signup_table as $row) : ?>
                                        <?php  
                                        $level = $row['_course_level'];
                                        $anchor = $row['_course_anchor'];
                                        $courses = $row['_courses'];
										
										$anchors_multi = explode(',',$anchor);
                                        ?>
                                        <?php if($level) : ?><h6 data-anchor="<?php if($anchor && $anchors) : ?><?php foreach($anchors_multi as $a) : ?><?php echo sanitize_title($anchors[$a-1]['_dance_anchor']); ?> <?php endforeach; ?><?php endif; ?>" id="<?php if($anchor && $anchors) : ?><?php echo sanitize_title($anchors[$anchor-1]['_dance_anchor']); ?><?php endif; ?>" class="st-level text-center"><?php echo strip_tags(string_strong_except_first($level), '<strong>'); ?></h6><?php endif; ?>
                                        <?php if($courses) : ?>
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Nr kursu</th>
                                                        <th>Dzień</th>
                                                        <th>Godzina</th>
                                                        <th>Data rozpoczęcia</th>
                                                        <th>Miejsce kursu</th>
                                                        <th>Instruktor</th>
                                                        <th>Cena</th>
                                                        <th>Akcja</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                            <?php foreach($courses as $course) : ?>
                                                    <tr class="st-course" data-course-name="<?php echo esc_html($name); ?>" data-course-type="<?php echo esc_html($type); ?>" data-course-level="<?php echo esc_html($level); ?>">
                                                        <td class="stc-number"><?php echo esc_html($course['_course_no']); ?></td>
                                                        <td class="stc-day">
														<?php if($course['_course_day']) : ?>
                                                        	<?php foreach($course['_course_day'] as $day) : ?>
                                                            <p><?php echo esc_html($day['_cd_day']); ?></p>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                        </td>
                                                        <td class="stc-time"><?php echo esc_html($course['_course_time']); ?></td>
                                                        <td class="stc-date"><?php echo $course['_course_start_date']; ?></td>
                                                        <td class="stc-place"><?php echo esc_html($course['_course_place']); ?></td>
                                                        <td class="stc-instructor"><?php echo esc_html($course['_course_instructor']); ?></td>
                                                        <td class="stc-price"><?php echo esc_html($course['_course_price']); ?></td>
                                                        <td class="stc-signup"><h6 class="btn btn-primary signup-btn text-uppercase">zapisz się</h6></td>
                                                    </tr>
                                            <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div><!--end table responsive-->
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div><!--signup table-->
                                <?php endif; ?>
                                
                                <?php if($main_text) : ?>
                                <div class="dance-main-text">
                                    <?php echo $main_text; ?>
                                </div><!--end dance main text-->
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