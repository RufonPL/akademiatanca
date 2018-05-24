<?php
/**
 * Template name: Strona Główna
 * The template for displaying home page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @author Rafał Puczel
 */

get_header(); ?>
	
<div class="container-fluid">
	
    <div class="container-wide section" id="section1">
    	<?php require_template_part('slider', 'home') ?>
    </div><!--end container wide-->
    
    <div class="container-fluid relative">
    	<div id="couple-in-bg"></div>
        <div class="container section" id="section2">
            <?php require_template_part('why-us', 'home') ?>
        </div><!--end container-->
        
        <div class="container-wide section relative" id="section3">
        	<div class="section3-content">
                <div class="container">
                    <?php require_template_part('sign-up', 'home') ?>
                </div><!--end container-->
            </div><!--end section 3 content-->
        </div><!--end container wide-->
    </div><!--end couple in bg-->
    
    <div class="container section" id="section4">
    	<?php require_template_part('news', 'home') ?>
    </div><!--end container-->
    
    <div class="container-wide section relative" id="section5" data-parallax="scroll" data-image-src="<?php echo esc_url(get_template_directory_uri().'/images/historybg.jpg'); ?>" data-natural-width="1650" data-natural-height="1237" data-speed="0.3" data-over-scroll-fix="true">
    	<div class="container">
    		<?php require_template_part('history', 'home') ?>
    	</div><!--end container-->
    </div><!--end container wide-->
    
    <div class="container section" id="section6">
    	<?php require_template_part('partners', 'home') ?>
    </div><!--end container-->
       
</div><!--end container fluid-->               

<?php get_footer(); ?>
