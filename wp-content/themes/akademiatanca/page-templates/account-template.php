<?php
if(!is_user_logged_in()) { wp_safe_redirect(home_url()); exit(); }
/**
 * Template name: Moje konto
 * The template for displaying account page.
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
    <div class="row my-account-container">
    	<ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#konto" role="tab" data-toggle="tab">Konto</a></li>
            <li><a href="#kursy" role="tab" data-toggle="tab">Moje kursy</a></li>
            <li><a href="#kursy-archiwalne" role="tab" data-toggle="tab">Kursy archiwalne</a></li>
            <li><a href="#kodqr" role="tab" data-toggle="tab">Kod QR</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="konto">
            	<?php require_template_part('account-personal-data', 'user'); ?> 
            </div>
            <div class="tab-pane" id="kursy">
            	<?php require_template_part('account-courses', 'user'); ?> 
            </div>
            <div class="tab-pane" id="kursy-archiwalne">
            	<?php require_template_part('account-courses-archive', 'user'); ?> 
            </div>
            <div class="tab-pane" id="kodqr">
            	<?php require_template_part('account-qr-code', 'user'); ?> 
            </div>
        </div>
    </div><!--end row-->
</div><!--end container-->           

<?php get_footer(); ?>
