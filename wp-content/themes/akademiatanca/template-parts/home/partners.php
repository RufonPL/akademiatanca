<?php  
$s6_header	= get_field('_s6_header');
$partners	= get_field('_partners');
?>
<div class="partners">
	<?php if($s6_header) : ?><h4 class="text-center"><strong><?php echo esc_html($s6_header); ?><span></span></strong></h4><?php endif; ?>
    <?php if($partners) : ?>
    <div class="row" id="partners">
    	<?php foreach($partners as $partner) : ?>
        	<?php  
			$logo = $partner['_partner_logo'];
			$link = $partner['_partner_link'];
			?>
            <?php if($logo) : ?>
            <div class="partner relative">
            	<a href="<?php echo esc_url($link); ?>"><img src="<?php echo esc_url($logo['sizes']['medium']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>"/></a>
            </div><!--end partner-->
            <?php endif; ?>
        <?php endforeach; ?>
    </div><!--end partners-->
    <?php endif; ?>
</div><!--end partners-->