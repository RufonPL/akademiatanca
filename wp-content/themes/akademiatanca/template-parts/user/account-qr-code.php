<?php $user = wp_get_current_user(); ?>
<div class="row account-courses">
	<h4 class="medium">Twój kod QR</h4>
    <img src="http://www.akademiatanca.com.pl/prounit/nr.php?id=<?php echo $user->ID; ?>">
    
    <!--<a class="btn btn-primary" href="<?php //the_permalink(); ?>?src=http://www.akademiatanca.com.pl/prounit/nr.php?id=<?php //echo $user->ID; ?>&download=qr">Pobierz kod</a>-->
</div><!--end row-->