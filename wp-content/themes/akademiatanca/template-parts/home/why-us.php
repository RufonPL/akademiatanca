<?php  
$s2_header 			= get_field('_s2_header');
$s2_entry 			= get_field('_s2_entry');
$successes_header 	= get_field('_successes_header');
$successes 			= get_field('_successes');
?>
<div class="why-us">
	<?php section_header($s2_header); ?>
    
	<?php if($s2_entry) : ?>
    <div class="wu-entry">
    	<?php echo $s2_entry; ?>
    </div><!--end wu entry-->
    <?php endif; ?>
    
    <?php if($successes_header) : ?><h5 class="text-center"><strong><?php echo $successes_header; ?></strong></h5><?php endif; ?>
    
    <?php if($successes) : ?>
    <div class="row" id="successes">
    	<?php $s=1; foreach($successes as $success) : ?>
        	<?php 
			$img = $success['_success_img']; 
			$text = $success['_success']; 
			?>
        	<?php if($img) : ?>
            <div class="success text-center<?php if($s==3) : ?> success-middle<?php endif; ?>">
            	<div class="success-inner">
                    <div class="trophy relative">
                        <img src="<?php echo esc_url($img['sizes']['medium-large']); ?>" alt="<?php echo esc_attr($img['alt']); ?>"/>
                    </div><!--end trophy-->
                	<h5 class="h5"><strong><?php echo $text; ?></strong></h5>
                </div><!--end success inner-->
            </div><!--end success-->
            <?php endif; ?>
        <?php $s++; endforeach; ?>
    </div><!--end successes-->	
    <?php endif; ?>
</div><!--end why us-->