<?php
/**
 * The template for displaying Instructors list pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @author Rafał Puczel
 */

get_header(); ?>

<div class="container page-content">
	<?php section_header(get_field('_page_header', template_id('proam')), template_id('proam')); ?>
    <div class="proam-entry">
    	<?php the_field('_proam_entry', template_id('proam')); ?>
    </div><!--end proam entry-->
    <?php if(have_posts()) : ?>
    <div class="row instructors">
    	<?php while(have_posts()) : the_post(); ?>
        <?php  
		$photo   = get_field('_proam_image');
		$info    = get_field('_proam_info');
		?>
        <div class="instructor row">
        	<div class="instructor-photo pull-left">
            <?php if($photo) : ?><img src="<?php echo esc_url($photo['sizes']['medium-large']); ?>" alt="<?php esc_attr($photo['alt']); ?>"/><?php endif; ?>
            </div><!--end instructor photo-->
            <div class="instructor-info relative">
            	<h4><strong><?php the_title(); ?></strong></h4>
                <?php if($info || $courses) : ?>
                <div class="instructor-text">
                	<div class="instructor-description">
                	<?php echo $info; ?>
                    </div><!--end instructor description-->
                    <?php if($courses) : ?>
                    <div class="instructor-courses row">
                    	<p>W akademii tańca prowadzi:</p>
                    	<?php foreach($courses as $course) : ?>
							<?php if($course['_course']) : ?>
                            <h6><?php echo esc_html($course['_course']); ?></h6>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div><!--end instructor courses-->
                    <?php endif; ?>
                </div><!--end instructor text-->
                <p class="instructor-more text-uppercase"><strong>Pokaż więcej</strong> <i class="fa fa-caret-down"></i></p>
                <?php endif; ?>
            </div><!--end instructor info-->
        </div><!--end instructor-->
        <?php endwhile; ?>
    </div><!--end row-->
    <?php rfswp_content_nav('nav-below'); ?>
    <?php endif; ?>
</div><!--end container-->  

<?php get_footer(); ?>
