<?php
/**
 * @author Rafał Puczel
 */
?>

<?php  
$news_type 				= get_field('_news_type');
$news_course_name		= get_field('_news_course_name');
$news_course_type		= get_field('_news_course_type');
$news_course_level		= get_field('_news_course_level');
$news_course_no 		= get_field('_news_course_no');
$news_course_days 		= get_field('_news_course_day');
$news_course_start_time	= get_field('_news_course_start_time');
$news_course_end_time	= get_field('_news_course_end_time');
$news_course_start_date = get_field('_news_course_start_date');
$news_course_end_date 	= get_field('_news_course_end_date');
$news_course_place 		= get_field('_news_course_place');
$news_course_instructor = get_field('_news_course_instructor');
$news_course_price 		= get_field('_news_course_price');
?>

<div id="post-<?php the_ID(); ?>" <?php post_class('row'); ?>>
<?php $image = get_field('_news_image'); ?>
	<div class="post-left pull-left">
    	<div class="post-right-inner">
			<?php if($image) : ?>
            <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"/>
            <?php else : ?>
                <?php 
                if(has_post_thumbnail()) { 
                    the_post_thumbnail();
                }
                ?>
            <?php endif; ?>	
        </div><!--end post right inner-->
    </div><!--end post left-->
	<div class="post-right pull-left">
    	<div class="post-right-inner">
			<?php section_header('<p><strong>'.get_the_title().'</strong></p><p>Dodano: '.get_the_time('d.m.Y').'</p>'); ?>
            <div class="post-content">
                <?php the_content(); ?>
                <?php if($news_type == 'course' && $news_course_name && $news_course_no && $news_course_days && $news_course_start_time && $news_course_end_time && $news_course_start_date && $news_course_end_date && $news_course_place && $news_course_instructor && $news_course_price) : ?>
                <div class="st-course signup-container" data-course-name="<?php echo esc_html($news_course_name); ?>" data-course-type="<?php echo esc_html($news_course_type); ?>" data-course-level="<?php echo esc_html($news_course_level); ?>">
                	<div class="news-course-data">
                        <p class="stc-nunmber"><?php echo esc_html($news_course_no); ?></p>
                        <p class="stc-days"><?php if($news_course_days) : ?><?php foreach($news_course_days as $day) : ?><?php echo esc_html($day); ?>,<?php endforeach; ?><?php endif; ?></p>
                        <p class="stc-start-time"><?php echo esc_html($news_course_start_time); ?></p>
                        <p class="stc-end-time"><?php echo esc_html($news_course_end_time); ?></p>
                        <p class="stc-start-date"><?php echo $news_course_start_date; ?></p>
                        <p class="stc-end-date"><?php echo $news_course_end_date; ?></p>
                        <p class="stc-place"><?php echo esc_html($news_course_place); ?></p>
                        <p class="stc-instructor"><?php echo esc_html($news_course_instructor); ?></p>
                        <p class="stc-price"><?php echo esc_html($news_course_price); ?></p>
                    </div><!--end news course data-->
                    	<div class="stc-signup"><h6 class="btn btn-primary signup-btn text-uppercase">zapisz się</h6></div>
                </div><!--end st course-->
                <?php endif; ?>
            </div><!--end post content-->
        </div><!--end post right inner-->
    </div><!--end post right-->
	
</div><!--end post-->

