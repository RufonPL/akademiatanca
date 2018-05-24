<?php  
$newsletter_header = get_field('_newsletter_header', 'option');
$newsletter_id = get_field('_newsletter_form_id', 'option');
?>
<?php if($newsletter_id) : ?>
<div class="container-wide" id="newsletter">
    <div class="container">
    	<div class="row">
        <?php if($newsletter_header) : ?>
        	<div class="pull-left"><?php section_header($newsletter_header, false, 'span'); ?></div>
        <?php endif; ?>
        <div class="newsletter-form fresh-mail-container">
			<?php echo do_shortcode('[FM_form id="2"]'); ?>
        </div><!--end newsletter form-->
        </div><!--end row-->
    </div><!--end container-->
</div><!--end newsletter-->
<?php endif; ?>