<?php  
$s5_header	= get_field('_s5_header');
$s5_link	= get_field('_s5_link');
?>
<div class="history row">
	<div class="col-md-6 col-sm-6 col-xs-6 history-left text-right">
    	<a href="<?php echo esc_url($s5_link); ?>" class="btn btn-primary text-uppercase">Czytaj więcej</a>
    </div><!--end history left-->
	<div class="col-md-6 col-sm-6 col-xs-6 history-right text-left">
		<?php section_header($s5_header); ?>
    </div><!--end history right-->
</div><!--end history-->