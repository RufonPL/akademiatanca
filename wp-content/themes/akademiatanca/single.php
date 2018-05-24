<?php
/**
 * The Template for displaying all single posts.
 *
 * @author Rafał Puczel
 */
get_header(); ?>


<div class="container page-content">
    <div class="row">
        <?php while(have_posts()) : the_post(); ?>
            <?php get_template_part('content', 'single'); ?>
            
    <?php if(comments_open() || '0' != get_comments_number()) {
           comments_template( ); 
		}
	?>
           
        <?php endwhile; ?>
    </div><!--end row-->
    
    <?php require_template_part('see-also', 'posts') ?>
</div><!--end container-->

<?php get_footer(); ?>
