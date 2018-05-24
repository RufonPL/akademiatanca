<?php
/**
 * Template name: Kontakt
 * The template for displaying contact page.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @author Rafał Puczel
 */

get_header(); ?>

<div class="container-wide">
    <?php require_template_part('google-map', '') ?>
</div><!--end container wide-->

<?php 
$contact_phone			= get_field('_phone', 'option');
$contact_mobile 		= get_field('_mobile_phone', 'option');
$contact_email 			= get_field('_email', 'option');

$cp_details_header 		= get_field('_contact_header_1');
$cp_phone 				= get_field('_contact_phone');
$cp_mobile 				= get_field('_contact_mobile');
$cp_email 				= get_field('_contact_email');
$cp_info_header 		= get_field('_contact_header_2');
$cp_info_phones 		= get_field('_phone_numbers');
$cp_hours_header 		= get_field('_contact_header_3');
$cp_hours 				= get_field('_oh_hours');

$cp_addresses_header 	= get_field('_contact_header_4');
$cp_addresses 			= get_field('_map_points');
$cp_form_header 		= get_field('_contact_header_5');
$cp_form		 		= get_field('_contact_form');

$phone 					= $cp_phone ? $cp_phone : $contact_phone;
$mobile 				= $cp_mobile ? $cp_mobile : $contact_mobile;
$email 					= $cp_email ? $cp_email : $contact_email;
?>

<div class="container page-content">
    <div class="row contact-page">
    
    	<div class="col-md-4 col-sm-6 col-xs-12">
        	<div class="row cp-details">
            	<?php if($cp_details_header) : ?><h5 class="contact-header"><strong><?php echo esc_html($cp_details_header); ?></strong></h5><?php endif; ?>
                <?php if($phone) : ?>
                <div class="cp-icon">
                	<i class="fa fa-phone pull-left"></i>
                    <div class="cpi-text">
                    	<h6><strong>Telefon</strong></h6>
                        <h6><?php echo esc_html($phone); ?></h6>
                    </div><!--end cpi text-->
                </div><!--end cp phone-->	
                <?php endif; ?>
                <?php if($mobile) : ?>
                <div class="cp-icon">
                	<i class="fa fa-mobile pull-left"></i>
                    <div class="cpi-text">
                    	<h6><strong>Telefon kom.</strong></h6>
                        <h6><?php echo esc_html($mobile); ?></h6>
                    </div><!--end cpi text-->
                </div><!--end cp phone-->	
                <?php endif; ?>
                <?php if($email) : ?>
                <div class="cp-icon">
                	<i class="fa fa-envelope pull-left"></i>
                    <div class="cpi-text">
                    	<h6><strong>Email</strong></h6>
                        <h6><?php echo antispambot(esc_html($email)); ?></h6>
                    </div><!--end cpi text-->
                </div><!--end cp phone-->	
                <?php endif; ?>
            </div><!--end cp details-->
            
            <div class="row cp-info">
            	<?php if($cp_info_header) : ?><h5 class="contact-header"><strong><?php echo esc_html($cp_info_header); ?></strong></h5><?php endif; ?>
                <?php if($cp_info_phones) : ?>
                <div class="cp-info-phones row">
                	<?php foreach($cp_info_phones as $phone) : ?>
                    <div class="col-md-6 col-sm-6 col-xs-12 cpi-icon">
                    	<i class="fa fa-mobile pull-left"></i>
                        <div class="cpi-text">
                            <h6><strong>Telefon</strong></h6>
                            <h6><?php echo esc_html($phone['_pn_phone']); ?></h6>
                        </div><!--end cpi text-->
                    </div><!--end col-->
                    <?php endforeach; ?>
                </div><!--end cp info phones-->
                <?php endif; ?>
            </div><!--end cp info-->
            
            <div class="row cp-hours">
            	<?php if($cp_hours_header) : ?><h5 class="contact-header"><strong><?php echo esc_html($cp_hours_header); ?></strong></h5><?php endif; ?>
                <?php if($cp_hours) : ?>
                <div class="cph-hours row">
                	<?php foreach($cp_hours as $hour) : ?>
                    <?php  
					$time = $hour['_ohh_hour'];
					$text = $hour['_ohh_text'];
					?>
                    <div class="col-md-5 col-sm-6 col-xs-6 cph-hour">
                    	<?php if($time) : ?>
                    	<h3 class="bold"><?php echo strip_tags(p2br($time), '<br><strong>'); ?></h3>
                        <?php endif; ?>
                    </div><!--end cph hour-->
                    <div class="col-md-7 col-sm-6 col-xs-6 cph-info">
                    	<?php if($text) : ?><?php echo strip_tags(p2br($text), '<br><strong>'); ?><?php endif; ?>
                    </div><!--end cph info-->
                    </div><!--end row-->
                    <div class="cph-hours row">
                    <?php endforeach; ?>
                </div><!--end cph hours-->
                <?php endif; ?>
            </div><!--end cp hours-->
        </div><!--end col-->
        
        <div class="col-md-4 col-sm-6 col-xs-12">
        	<div class="row cp-addresses">
            	<?php if($cp_addresses_header) : ?><h5 class="contact-header"><strong><?php echo esc_html($cp_addresses_header); ?></strong></h5><?php endif; ?>
                <?php if($cp_addresses) : ?>
                <div class="row cpa-items">
                	<?php foreach($cp_addresses as $address) : ?>
                    <?php  
					$add_name 		= $address['_map_point_header'];
					$add_address 	= $address['_map_point_address'];
					$add_phone 		= $address['_map_point_phone'];
					$add_hours 		= $address['_map_point_hours'];
					?>
                    <div class="cpa-item">
                    	<?php if($add_name) : ?><h5 class="bold"><?php echo esc_html($add_name); ?></h5><?php endif; ?>
                        <?php if($add_address) : ?><h6><?php echo strip_tags(p2br($add_address), '<br><strong>'); ?></h6><?php endif; ?>
                        <?php if($add_hours) : ?><h6><?php echo strip_tags(p2br($add_hours), '<br><strong>'); ?></h6><?php endif; ?>
                        <?php if($add_phone) : ?><h6><?php echo strip_tags($add_phone, '<br>'); ?></h6><?php endif; ?>
                    </div><!--end cpa item-->
                    <?php endforeach; ?>
                </div><!--end cpa items-->
                <?php endif; ?>
            </div><!--end cp addresses-->
        </div><!--end col-->
        
        <div class="col-md-4 col-sm-12 col-xs-12">
        	<div class="row cp-form">
            	<?php if($cp_form_header) : ?><h5 class="contact-header"><strong><?php echo esc_html($cp_form_header); ?></strong></h5><?php endif; ?>
                <?php if($cp_form) : ?>
                <div class="contact-form">
                	<?php echo do_shortcode($cp_form); ?>
                </div><!--end contact form-->	
                <?php endif; ?>
            </div><!--end cp form-->
        </div><!--end col-->
        
    </div><!--end row-->
</div><!--end container-->    






           
<!--<canvas id="flying-bubbles"></canvas>-->
<div class="container">
<?php  
//$colors = array('pink', 'yellow', 'purple', 'red', 'blue');
?>
<?php //$c=0; for($i=0; $i<10; $i++) : ?>
<?php //if($c==5) $c=0; ?>
	<!--<div class="flask <?php //echo $colors[$c]; ?>">
    	<div class="flask-liquid level-<?php //echo rand(4,9); ?> delay-<?php //echo rand(1,9); ?>">
        	<div class="fl-top">
                <div class="fl-left fl-wave"></div>
                <div class="fl-right fl-wave"></div>
            </div>
        </div>
    </div>-->
<?php //$c++; endfor; ?>
</div>   

<?php get_footer(); ?>
