<?php  
$s3_header 			= get_field('_s3_header');
$s3_text			= get_field('_s3_text');
$signup_form_header	= get_field('_signup_form_header');
$signup_form_text	= get_field('_signup_form_text');

$dance_categories	= get_field('_hf_dance_categories', 'option');
$dance_types		= get_field('_hf_dance_types', 'option');
?>
<div class="sign-up row">
	<div class="col-md-6 col-sm-6 col-xs-12 su-left">
    	<?php section_header($s3_header); ?>
        <?php if($s3_text) : ?>
        <div class="su-text">
        	<?php echo $s3_text; ?>
        </div><!--end su text-->
        <?php endif; ?>
        <a id="register" href="<?php echo esc_url(home_url()); ?>" class="text-uppercase btn btn-primary btn-long">Załóż konto</a>
        <!--<a id="login" href="<?php echo esc_url(home_url()); ?>" class="text-uppercase btn btn-primary">Zaloguj się</a>-->
    </div><!--end col-->
	<div class="col-md-6 col-sm-6 col-xs-12 su-right">
    	<div class="signup-form">
        	<?php if($signup_form_header) : ?><h4 class="medium"><?php echo esc_html($signup_form_header); ?></h4><?php endif; ?>
            <?php if($signup_form_text) : ?><h6><?php echo strip_tags($signup_form_text, '<br>'); ?></h6><?php endif; ?>
            <form action="<?php the_permalink(); ?>" method="post" id="signupform">
            	<div class="form-group">
                	<label class="text-uppercase">Dla kogo</label>
                    <div class="select-box relative">
                    	<i class="fa fa-caret-down"></i>
                        <?php if($dance_categories) : ?>
                        <select class="form-control" id="dance_category" name="dance_category">
                            <option value="0">-- Wybierz --</option>
                            <?php foreach($dance_categories as $category) : ?>
                            <option value="<?php echo sanitize_title($category['_hf_dance_category']); ?>"><?php echo esc_html($category['_hf_dance_category']); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php endif; ?>
                    </div><!--end select box-->
                </div><!--end form group-->
            	<div class="form-group">
                	<label class="text-uppercase">Typ tańca</label>
                    <div class="select-box relative">
                    	<i class="fa fa-caret-down"></i>
                        <select class="form-control" id="dance_type" name="dance_type">
                            <option value="0">-- Wybierz --</option>
                        </select>
                    </div><!--end select box-->
                </div><!--end form group-->
                <!--<div class="form-group">
                	<label class="text-uppercase">Poziom zaawansowania</label>
                    <div class="select-box relative">
                    	<i class="fa fa-caret-down"></i>
                        <select class="form-control" id="dance_level" name="dance_level">
                            <option value="0">-- Wybierz --</option>
                        </select>
                    </div>
                </div>-->
            	<!--<div class="form-group">
                	<label class="text-uppercase">Data rozpoczęcia kursu</label>
                	<div class="date-box relative">
                    	<i class="fa fa-calendar"></i>
                    	<input class="form-control" type="text" id="start_date" name="start_date" placeholder="-- Wybierz --"/>
                    </div>
                </div>-->
            	<div class="form-group">
                	<input type="submit" name="signup_submit" id="signup_submit" class="form-control" value="Zapisz się"/>
                </div><!--end form group-->
            </form>
        </div><!--end signup form-->
    </div><!--end col-->
</div><!--end sign up-->