<?php 
$newsletter_header = get_field('_newsletter_popup_form_header', 'option');
$newsletter_id = get_field('_newsletter_popup_form_id', 'option');
$newsletter_bg = get_field('_newsletter_popup_form_bg', 'option'); 
?>
<?php if($newsletter_id) : ?>
<div id="newsletter__popup-overlay"<?php if($newsletter_bg) : ?> style="background-image:url(<?php echo esc_url($newsletter_bg['url']); ?>)"<?php endif; ?>>
    <div id="newsletter__popup" class="relative">
    	<i class="fa fa-close"></i>
        <?php if($newsletter_header) : ?>
    	<?php section_header('<strong>'.$newsletter_header.'</strong>'); ?>
        <?php endif; ?>
        <?php echo do_shortcode( '[FM_form id="'.$newsletter_id.'"]' ); ?>
    </div>
</div>
<?php endif; ?>