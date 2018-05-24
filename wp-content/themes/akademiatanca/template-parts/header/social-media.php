<?php $social_icons = get_field('_social_icons', 'option'); ?>
<?php if($social_icons) : ?>
<div class="social-media">
	<?php foreach($social_icons as $icons) : ?>
    <?php 
	$icon = $icons['_social_icon'];
	$link = $icons['_social_link'];
	?>
    <a href="<?php echo esc_url($link); ?>" class="social-icon social-<?php echo esc_html($icon); ?>"><i class="fa fa-<?php echo esc_html($icon); ?>"></i></a>
    <?php endforeach ?>
</div><!--end social media-->
<?php endif; ?>