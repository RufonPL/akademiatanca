<?php 
$bank_details = get_field('_bank_details', 'option'); 
$user_details = current_user_signup_details();
?>
<div id="overlay"></div>
<div id="signup-popup"<?php if(is_front_page()) : ?> class="singnup-popup-home"<?php endif; ?>>
    <div class="singnup-popup-inner">
    	<i class="fa fa-close"></i>
        <h5 class="sp-header"><strong>Zapisz się na kurs</strong></h5>
        <div class="sp-top row">
            <h6 class="h5"><span class="pull-left">Wybrany kurs:</span><strong class="course-name"></strong></h6>
            <?php if(is_front_page()) : ?>
            <h6 class="h5"><span class="pull-left">Poziom zaawansowania:</span><strong class="course-level"></strong></h6>
            <h6 class="h5"><span class="pull-left">Kategoria wiekowa:</span><strong class="course-age"></strong></h6>
            <?php else : ?>
            <h6 class="h5"><span class="pull-left">Numer kursu:</span><strong class="course-number"></strong></h6>
            <h6 class="h5"><span class="pull-left">Cena kursu:</span><strong class="course-price"></strong></h6>
            <div class="h5"><span class="pull-left">Forma płatności:</span>
            <span class="payment-details">
                <span class="payment-methods">
                    <span class="p"><span class="pm-radio active"></span><span class="payment-method">Gotówka</span></span>
                    <span class="p"><span class="pm-radio"></span><span class="payment-method">Przelew</span></span>
                    <span class="p"><span class="pm-radio"></span><span class="payment-method">Multi Sport</span></span>
                </span><!--end payment methods-->
                <?php if($bank_details) : ?><span class="bank-details"><?php echo do_shortcode(strip_tags($bank_details, '<br>')); ?></span><?php endif; ?>
            </span></div>
            <?php endif; ?>
        </div><!--end sp top--> 
        
        <div id="signup-message"></div>  
        <?php //print_r($user_details); ?>
        <div class="sp-form">
            <form<?php if(is_user_logged_in()) : ?> class="signuplogged"<?php endif; ?> id="signupform2" method="post" action="<?php the_permalink(); ?>">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6 spf-left">
                   		<div class="col-md-6 col-sm-6 col-xs-6 spf-inner-left">
                            <label class="text-uppercase">Imię</label>
                            <input type="text" name="sp_first_name" id="sp_first_name" class="form-control" placeholder="Imię"<?php if(is_user_logged_in()) : ?> value="<?php echo $user_details['first_name']; ?>" disabled<?php endif; ?>/>
                        </div>
                    	<div class="col-md-6 col-sm-6 col-xs-6 spf-inner-right">
                        	<label class="text-uppercase">Nazwisko</label>
                            <input type="text" name="sp_last_name" id="sp_last_name" class="form-control" placeholder="Nazwisko"<?php if(is_user_logged_in()) : ?> value="<?php echo $user_details['last_name']; ?>" disabled<?php endif; ?>/>
                        </div>
                        <!--<label class="text-uppercase">Imię i nazwisko</label>
                        <input type="text" name="sp_fullname" id="sp_fullname" class="form-control" placeholder="Imię i Nazwisko"<?php //if(is_user_logged_in()) : ?> value="<?php //echo $user_details['name']; ?>" disabled<?php //endif; ?>/>-->
                    </div><!--end col-->
                    
                    <div class="col-md-6 col-sm-6 col-xs-6 spf-right">
                        <label class="text-uppercase">Adres email</label>
                        <input type="email" name="sp_e_mail" id="sp_e_mail" class="form-control" placeholder="Email"<?php if(is_user_logged_in()) : ?> value="<?php echo $user_details['email']; ?>" disabled<?php endif; ?>/>
                    </div><!--end col-->
                </div><!--end row-->
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6 spf-left">
                        <label class="text-uppercase">Numer telefonu</label>
                        <input type="text" name="sp_phone" id="sp_phone" class="form-control" placeholder="Telefon"/>
                    </div><!--end col-->
                    <div class="col-md-6 col-sm-6 col-xs-6 spf-right">
                        <label class="text-uppercase">Informacje dodatkowe</label>
                        <input type="text" name="sp_info" id="sp_info" class="form-control" placeholder="Inne (opcjonalnie)"/>
                    </div><!--end col-->
                </div><!--end row-->
                <div class="row rodoWrapper">
                  <div class="col-md-12">
                    <input type="checkbox" name="sp_rodo" id="sp_rodo"> <label for="sp_rodo">Akceptuję <a href="/regulamin-rodo/">regulamin</a></label>
                  </div>
                </div>
                <div class="row ">
                    <input type="hidden" name="sp_source" id="sp_source" value="<?php if(is_front_page()) : ?>sps_home<?php else : ?>sps_courses<?php endif; ?>"/>
                    <input type="submit" name="sp_submit" id="sp_submit" class="form-control" value="wyślij wiadomość"/>
                </div><!--end row-->
            </form>
        </div><!--end sp form-->
    </div><!--end signup popup inner-->
    <div id="sp-loader-container">
    	<div id="sp-loader"></div>
        <!--<div id="sp-message"></div>-->
    </div>
</div><!--end signup popup-->