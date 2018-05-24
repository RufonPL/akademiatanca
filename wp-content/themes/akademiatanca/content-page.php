<?php
/**
 * The template used for displaying page content in page.php
 *
 * @author Rafał Puczel
 */
?>


<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
    	<?php the_content(); ?>
     </div><!--end entry-content-->
</div><!--end post-->
