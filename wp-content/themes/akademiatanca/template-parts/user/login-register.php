<?php if(!is_user_logged_in() && is_front_page()) : ?>
<div id="logreg-container">
	<div id="logreg-box">
    	<div id="logreg-loader"><div id="loader"></div></div>
    	<i class="fa fa-close"></i>
    	<div class="lrb-header"><strong>Logowanie</strong></div>
    	<ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#logowanie" role="tab" data-toggle="tab">Zaloguj</a></li>
            <li><a href="#rejestracja" role="tab" data-toggle="tab">Zarejestruj</a></li>
            <li><a href="#przypomnij-haslo" role="tab" data-toggle="tab">Przypomnij hasło</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="logowanie">
            	<form action="<?php the_permalink(); ?>" name="u_login_form" id="u_login_form" method="post">
                	<div class="form-group relative">
                    	<label class="text-uppercase">Login</label>
                        <input type="text" name="u_login" id="u_login" class="form-control" placeholder="Login"/>
                    </div><!--end form group-->
                    <div class="form-group relative">
                    	<label class="text-uppercase">Hasło</label>
                        <input type="password" name="u_password" id="u_password" class="form-control" placeholder="Hasło"/>
                    </div><!--end form group-->
                    <div class="form-group fg-checkbox">
                    	<div class="checkbox-box relative">
                    	<input type="checkbox" name="u_login_check" id="u_login_check" value="ok"/>
                        <i class="fa fa-check"></i>
                        </div><!--end checkbox box--> 
                        <span>Zaznacz, aby się zalogować</span>
                    </div><!--end form group-->
                    <div class="form-group">
                    	<input type="submit" name="u_login_submit" id="u_login_submit" class="form-control submit-btn" value="Zaloguj się"/>
                	</div><!--end form group-->
                </form>
            </div><!--end logowanie-->
            <div class="tab-pane" id="rejestracja">
            	<form action="<?php the_permalink(); ?>" name="u_register_form" id="u_register_form" method="post">
               		<div class="form-group relative">
                    	<label class="text-uppercase">Imię i nazwisko</label>
                        <input type="text" name="u_register_name" id="u_register_name" class="form-control" placeholder="Imię i nazwisko"/>
                    </div><!--end form group-->
                	<div class="form-group relative">
                    	<label class="text-uppercase">Adres email</label>
                        <input type="text" name="u_register_email" id="u_register_email" class="form-control" placeholder="Adres e-mail"/>
                    </div><!--end form group-->
                    <div class="form-group relative">
                    	<label class="text-uppercase">Numer telefonu</label>
                        <input type="text" name="u_register_phone" id="u_register_phone" class="form-control" placeholder="Numer telefonu"/>
                    </div><!--end form group-->
                    <div class="form-group fg-checkbox">
                    	<div class="checkbox-box relative">
                    	<input type="checkbox" name="u_register_check" id="u_register_check" value="ok"/>
                        <i class="fa fa-check"></i>
                        </div><!--end checkbox box--> 
                        <span>Zaznacz, aby kontynuować</span>
                    </div><!--end form group-->
                    <div class="form-group">
                    	<input type="submit" name="u_register_submit" id="u_register_submit" class="form-control submit-btn" value="Załóż konto"/>
                	</div><!--end form group-->
                </form>
            </div><!--end rejestracja-->
            <div class="tab-pane" id="przypomnij-haslo">
            	<form action="<?php the_permalink(); ?>" name="remind_form" id="remind_form" method="post">
                	<div class="form-group relative">
                    	<label class="text-uppercase">Adres email</label>
                        <input type="text" name="rem_email" id="rem_email" class="form-control" placeholder="Adres e-mail"/>
                    </div><!--end form group-->
                    <div class="form-group fg-checkbox">
                    	<div class="checkbox-box relative">
                    	<input type="checkbox" name="rem_check" id="rem_check" value="ok"/>
                        <i class="fa fa-check"></i>
                        </div><!--end checkbox box--> 
                        <span>Zaznacz, aby kontynuować</span>
                    </div><!--end form group-->
                    <div class="form-group">
                    	<input type="submit" name="rem_submit" id="rem_submit" class="form-control submit-btn" value="Przypomnij"/>
                	</div><!--end form group-->
                </form>
            </div><!--end przypomnij haslo-->
            <div id="general-erorr"></div>
            <div id="general-message"></div>
        </div><!--end tab content-->
    </div><!--end logreg box-->
</div><!--end login register container-->
<?php endif; ?>