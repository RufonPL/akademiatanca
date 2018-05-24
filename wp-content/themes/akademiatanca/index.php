<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @author Rafał Puczel
 */

get_header(); ?>

<?php $news_header 	= get_field('_page_header', get_option('page_for_posts')); ?>

<div class="container page-content">
	<?php section_header($news_header, get_option('page_for_posts')); ?>
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
