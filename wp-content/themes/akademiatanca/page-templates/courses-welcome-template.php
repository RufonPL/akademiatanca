<?php
/**
 * Template name: Kurs - Strona powitalna
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
$dancer_1_left 		= get_field('_welcome_page_dancer_1_left');
$dancer_1_right 	= get_field('_welcome_page_dancer_1_right');
$d1l_top 			= get_field('_wp1l_top');
$d1l_left 			= get_field('_wp1l_left');
$d1r_top 			= get_field('_wp1r_top');
$d1r_right 			= get_field('_wp1r_right');

$welcome_dances 	= get_field('_course_welcome_dances');
$courses_map_header = get_field('_cp_map_header', 'option');
?>

<div class="container page-content courses-page relative">
	<div class="dance-container relative">
    
        <div class="course-welcome relative">
        <?php if($welcome_dances) : ?>
            <div class="course-welcome-inner row">
            <?php foreach($welcome_dances as $welcome_dance) : ?>
                <?php  
                $wel_name = $welcome_dance['_welcome_dance_name'];
                $wel_text = $welcome_dance['_welcome_dance_text'];
				$wel_link = $welcome_dance['_welcome_dance_link'];
                ?>
                <div class="col-md-6 col-sm-6 col-xs-12 welcome-dance">
                    <div class="welcome-dance-inner">
                    <?php if($wel_name) : ?><h5><strong><?php echo esc_html($wel_name); ?></strong></h5><?php endif; ?>
                    <?php if($wel_text) : ?><p class="text-justify"><?php echo $wel_text; ?></p><?php endif; ?>
                    <?php if($wel_link) : ?>
                    <a href="<?php echo get_permalink($wel_link); ?>" class="btn btn-primary btn-md">zobacz więcej</a>
                    <?php endif; ?>
                    </div><!--end welcome dance inner-->
                </div><!--end welcome dance-->
            <?php endforeach; ?>
            </div><!--end course welcome inner-->
        <?php endif; ?>
        </div><!--end course welcome-->
        <?php if($dancer_1_left) : ?><img class="dancer dancer1left" src="<?php echo esc_url($dancer_1_left['sizes']['large']); ?>" alt="<?php echo esc_attr($dancer_1_left['alt']); ?>" style="top:<?php echo esc_html($d1l_top); ?>px; left:<?php echo esc_html($d1l_left); ?>px; z-index:0"/><?php endif; ?>
            <?php if($dancer_1_right) : ?><img class="dancer dancer1right" src="<?php echo esc_url($dancer_1_right['sizes']['large']); ?>" alt="<?php echo esc_attr($dancer_1_right['alt']); ?>" style="top:<?php echo esc_html($d1r_top); ?>px; right:<?php echo esc_html($d1r_right); ?>px;"/><?php endif; ?>
    </div><!--end dance container-->
</div><!--end courses page-->

<div class="container-fluid courses-map relative">
	<div class="container">
    <?php if($courses_map_header) : ?><h5><strong><?php echo esc_html($courses_map_header); ?></strong></h5><?php endif; ?>
    </div><!--end container-->
    <?php require_template_part('google-map', '') ?>
</div><!--end container fluid-->           

<?php get_footer(); ?>