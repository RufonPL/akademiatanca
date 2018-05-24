<?php  
$contact_header = get_field('_footer_header', 'option');
$contact_phone = get_field('_phone', 'option');
$contact_mobile = get_field('_mobile_phone', 'option');
$contact_hours = get_field('_opening_hours', 'option');
$contact_email = get_field('_email', 'option');
?>
<div class="contact-details row">
	<div class="pull-left cd-header">
		<?php section_header($contact_header); ?>
    </div><!--end pull left-->
    <div class="pull-left contact-items">
    <?php if($contact_phone) : ?>
	<div class="pull-left cd-phone">
    	<i class="fa fa-phone"></i>
        <div class="cd-info">
        	<h6 class="cd-name">Telefon</h6>
        	<h6><?php echo esc_html($contact_phone); ?></h6>
        </div><!--end cd-info-->
    </div><!--end cd phone-->
    <?php endif; ?>
    <?php if($contact_mobile) : ?>
	<div class="pull-left cd-mobile">
    	<i class="fa fa-mobile"></i>
        <div class="cd-info">
        	<h6 class="cd-name">Telefon kom.</h6>
        	<h6><?php echo esc_html($contact_mobile); ?></h6>
        </div><!--end cd-info-->
    </div><!--end cd mobile-->
    <?php endif; ?>
    <?php if($contact_hours) : ?>
	<div class="pull-left cd-hours">
    	<i class="fa fa-clock-o"></i>
        <div class="cd-info">
        	<h6 class="cd-name">Godziny</h6>
            <h6><?php echo esc_html($contact_hours); ?></h6>
        </div><!--end cd-info-->
    </div><!--end cd hours-->
    <?php endif; ?>
    <?php if($contact_email) : ?>
	<div class="pull-left cd-email">
    	<i class="fa fa-envelope"></i>
        <div class="cd-info">
        	<h6 class="cd-name">Email</h6>
            <h6><?php echo antispambot(esc_html($contact_email)); ?></h6>
        </div><!--end cd-info-->
    </div><!--end cd email-->
    <?php endif; ?>
    </div><!--end contact items-->
</div><!--end contact details-->