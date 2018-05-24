<?php 
global $current_user;
$userID = $current_user->ID;

$name  	= get_user_meta($userID, 'fullname', true);
$email 	= $current_user->user_email;
$phone 	= get_user_meta($userID, 'phonenumber', true);
?>
<div class="row">
	<div class="col-md-6 col-sm-6 col-xs-12">
        <div class="personal-box">
            <h4 class="medium">Dane osobowe</h4>
            <form name="personal_form" id="personal_form" action="<?php the_permalink(); ?>" method="post">
                <div class="form-group relative">
                    <label for="personal_name">Imię i nazwisko</label>
                    <input class="form-control" type="text" name="personal_name" id="personal_name" placeholder="Imię i nazwisko" value="<?php echo $name; ?>"/>
                </div><!--end form group-->
                <div class="form-group relative">
                    <label for="personal_name">Adres email</label>
                    <input class="form-control" type="text" name="personal_email" id="personal_email" placeholder="Adres email" value="<?php echo $email; ?>" disabled/>
                </div><!--end form group-->
                 <div class="form-group relative">
                    <label for="personal_name">Nr telefonu</label>
                    <input class="form-control" type="text" name="personal_phone" id="personal_phone" placeholder="Nr telefonu" value="<?php echo $phone; ?>"/>
                </div><!--end form group-->
                 <div class="form-group relative">
                    <input type="submit" name="personal_submit" class="form-control submit-btn" id="personal_submit" value="Zapisz"/>
                </div><!--end form group-->
            </form>
        </div><!--end personal box-->
	</div><!--end col-->
	<div class="col-md-6 col-sm-6 col-xs-12">
        <div class="password-box">
            <h4 class="medium">Hasło</h4>
            <form name="password_form" id="password_form" action="<?php the_permalink(); ?>" method="post">
            	<input type="text" name="user" value="chose" style="display: none" />
                <div class="form-group relative">
                    <label for="personal_name">Nowe hasło (min. 8 znaków)</label>
                    <input class="form-control" type="password" name="personal_pass" id="personal_pass"/>
                </div><!--end form group-->
                <div class="form-group relative">
                    <label for="personal_name">Powtórz hasło</label>
                    <input class="form-control" type="password" name="personal_pass_repeat" id="personal_pass_repeat"/>
                </div><!--end form group-->
                <div class="form-group relative">
                    <label for="personal_name">Aktualne hasło</label>
                    <input class="form-control" type="password" name="personal_pass_current" id="personal_pass_current"/>
                </div><!--end form group-->
                <div class="form-group relative">
                    <input type="submit" name="personal_pass_submit" class="form-control submit-btn" id="personal_pass_submit" value="Zapisz"/>
                </div><!--end form group-->
            </form>
            <h6 class="medium text-center" id="pass-changed"></h6>
        </div><!--end password box-->
	</div><!--end col-->
</div><!--end row-->