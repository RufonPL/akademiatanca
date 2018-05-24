<?php if(is_user_logged_in()) : ?>
<?php global $current_user ?>
<div class="container" id="user-bar">
	<div class="row">
    	<div class="col-md-6 col-sm-6 col-xs-12 text-left">
        <p class="bold no-margin">Witaj <?php echo esc_html($current_user->display_name); ?></p>
        </div><!--end col-->
        <div class="col-md-6 col-sm-6 col-xs-12 text-right bold">
        	<p class="no-margin"><i class="fa fa-user"></i> <a href="<?php echo get_permalink(template_id('account')); ?>">Moje konto</a></p> 
            <p class="no-margin"><i class="fa fa-sign-out"></i> <a href="<?php echo wp_logout_url(); ?>">Wyloguj</a></p>
        </div><!--end col-->
    </div><!--end row-->
</div><!--end user bar-->
<?php endif; ?>