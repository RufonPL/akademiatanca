<?php
/**
 *
 * @author Rafał Puczel
 */

get_header(); ?>
	
<?php $blog_header 	= get_field('_page_header', template_id('blog')); ?>

<div class="container page-content">
	<?php section_header($blog_header, template_id('blog')); ?>
	
	<?php if(have_posts()) : ?>
    <div class="row">
    <?php while(have_posts()) : the_post(); ?>
        <?php get_template_part('content', get_post_format()); ?>
    <?php endwhile; ?>
    </div><!--end row-->
        <?php rfswp_content_nav('nav-below'); ?>
    <?php endif; ?>
    
</div><!--end container-->            

<?php get_footer(); ?>
