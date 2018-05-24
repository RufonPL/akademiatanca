<?php 
$cat_id = get_field('_blog_cat');
wp_safe_redirect(get_category_link($cat_id)); exit();
/**
 * Template name: Blog taneczny
 * The template for displaying blog page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @author Rafał Puczel
 */

get_header(); ?>
	
<?php get_footer(); ?>
