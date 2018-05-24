<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @author Rafał Puczel
 */

get_header(); ?>
	
<div class="container page-content">
	<?php section_header(get_field('_page_header'), $post->ID); ?>
    <div class="row">
        <?php while(have_posts()) : the_post(); ?>
            <?php get_template_part('content', 'page'); ?>
        <?php endwhile; ?>
    </div><!--end row-->
</div><!--end container-->               


<?php 
$show_map = get_field('_show_places_map');
$courses_map_header = get_field('_cp_map_header', 'option'); 
?>
<?php if($show_map == 'Tak') : ?>
<div class="container-fluid courses-map relative">
	<div class="container">
    <?php if($courses_map_header) : ?><h5><strong><?php echo esc_html($courses_map_header); ?></strong></h5><?php endif; ?>
    </div><!--end container-->
    <?php require_template_part('google-map', '') ?>
</div><!--end container fluid-->
<?php endif; ?>           

<?php get_footer(); ?>

