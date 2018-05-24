<?php
/**
 * The template for displaying Galleries list pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @author Rafał Puczel
 */

get_header(); ?>

<div class="container page-content">
	<?php section_header(get_field('_page_header', template_id('gallery')), template_id('gallery')); ?>
    <?php if(have_posts()) : ?>
    <div class="row galleries">
    	<?php while(have_posts()) : the_post(); ?>
        <?php 
		$image = get_field('_gallery_thumbnail'); 
		$desc  = get_field('_gallery_description');
		?>
        	<?php //if($image) : ?>
            <div class="col-md-4 col-sm-6 col-xs-12 gallery">
            	<div class="gallery-inner relative">
                	<a href="<?php the_permalink(); ?>">
                    <img src="<?php echo esc_url($image['sizes']['gallery-thumbnail']); ?>" alt="<?php echo esc_attr($image['alt']); ?>"/>
                    <div class="gallery-info">
                        <h5 class="text-uppercase"><strong><?php the_title(); ?></strong></h5>
                        <?php if($desc) : ?>
                            <h6><?php echo strip_tags($desc,'<br>'); ?></h6>
                        <?php endif; ?>
                    </div><!--end gallery info-->
                    </a>
                </div><!--end gallery inner-->
            </div><!--end gallery-->
        	<?php //endif; ?>
        <?php endwhile; ?>
    </div><!--end row-->
    <?php rfswp_content_nav('nav-below'); ?>
    <?php endif; ?>
</div><!--end container-->  

<?php get_footer(); ?>
