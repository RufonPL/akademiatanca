<?php  
function exclude_pages_from_admin($query) {
    global $pagenow, $post_type;
    if (is_admin() && $pagenow=='edit.php' && $post_type =='page') {
        $query->query_vars['post__not_in'] = array(
			4612, //registration
			4615,  //login
			4627, //account page
		);
    }
}
add_filter( 'parse_query', 'exclude_pages_from_admin' );

function hide_custom_templates() {
echo '<script>
	 jQuery(document).ready(function($) {
		$("#page_template").find(\'option[value="page-templates/login-template.php"]\').hide();
		$("#page_template").find(\'option[value="page-templates/register-template.php"]\').hide();
		$("#page_template").find(\'option[value="page-templates/account-template.php"]\').hide();
		$(".user-url-wrap").hide();
		var lock = $("<div></div>", {
			css: {
				"position" : "absolute",
				"left":0,
				"right":0,
				"top":0,
				"bottom":0,
				"background-color": "rgba(255,255,255,0.1)"
			}
		});
		$(".user-email-wrap").css("position", "relative").append(lock);
	 });
	 </script>
	 ';
}
add_action('admin_head', 'hide_custom_templates');

/**
 * Redirects wp native registration and password reset actions to login page
 */
if(!function_exists('rfs_redirect_action')) {
	function rfs_redirect_action() {
		$action = isset($_GET['action']) ? $_GET['action'] : 'login';
		if($action == 'register' || $action == 'forgot' || $action == 'resetpass') {
			wp_redirect(home_url());
			exit;	
		}
	}
	add_action('init', 'rfs_redirect_action');
}
/**
 * Redirect to the custom login page
 */
if(!function_exists('rfs_login_init')) {
	function rfs_login_init() {
		$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'login';
	
		if(isset( $_POST['wp-submit'])) {
			$action = 'post-data';
		}else if(isset($_GET['reauth'])) {
			$action = 'reauth';
		}
	
		if (
			$action == 'post-data'		||			// don't mess with POST requests
			$action == 'reauth'			||			// need to reauthorize
			$action == 'logout'						// user is logging out
		) {
			return;
		}
		
		
		wp_redirect(home_url());
		exit;
	}
	add_action('login_init', 'rfs_login_init');
}
/**
 * Redirect logged in users to the right page
 */
if(!function_exists('rfs_template_redirect')) {
	function rfs_template_redirect() {
		if((is_page(template_id('login')) || is_page(template_id('register')) || is_page(template_id('password'))) && is_user_logged_in()) {
			wp_redirect(home_url());
			exit();
		}
	
		if(is_page(template_id('account')) && !is_user_logged_in()) {
			wp_redirect(home_url());
			exit();
		}
		
	}
	//add_action('template_redirect', 'rfs_template_redirect');
}
/**
 * Prevent subscribers to access the admin
 */
/* if(!function_exists('rfs_admin_init')) {
	
} */

/**
 * Login page redirect
 */
if(!function_exists('rfs_login_redirect')) {
	function rfs_login_redirect($redirect_to, $url, $user) {
	
		//if (!isset($user->errors)) {
			return $redirect_to;
			exit;
		//}
		
		wp_redirect(home_url('/').'?wpadmin=1');
		exit;
	
	}
	add_filter('login_redirect', 'rfs_login_redirect', 10, 3);
}

function register_user_in_admin($user_id) {
	add_user_meta($user_id, 'has_to_be_activated', 'activated', true);
}
add_action('user_register', 'register_user_in_admin', 10, 1);

function add_user_activation_from_admin($user) { 
	if(is_admin() && current_user_can('administrator')) {
?>
	<h3>Status konta</h3>
    <table class="form-table">
        <tr>
            <th><label for="acc_status">Status</label></th>
            <td>
            	<input type="radio" name="has_to_be_activated" value="activated" <?php if(esc_attr(get_user_meta($user->ID, 'has_to_be_activated', true)) == 'activated') echo 'checked="checked"'; ?> class="radio" />Aktywny<br/>
                <input type="radio" name="has_to_be_activated" value="" <?php if(esc_attr(get_user_meta($user->ID, 'has_to_be_activated', true)) != 'activated') echo 'checked="checked"'; ?> class="radio" />Nieaktywny
            </td>
        </tr>
    </table>
<?php	
	}
}
add_action('show_user_profile', 'add_user_activation_from_admin');
add_action('edit_user_profile', 'add_user_activation_from_admin');

add_action('personal_options_update', 'save_user_activation_from_admin');
add_action('edit_user_profile_update', 'save_user_activation_from_admin');
function save_user_activation_from_admin($user_id) {
	global $wpdb;
	$first_name = sanitize_text_field($_POST['first_name']);
	$last_name 	= sanitize_text_field($_POST['last_name']);
	$fullname 	= $first_name.' '.$last_name;
	
	//update_user_meta($user_id, 'fullname', $fullname);
    update_user_meta($user_id, 'has_to_be_activated', sanitize_text_field($_POST['has_to_be_activated']));
	
	$wpdb->update(
		$wpdb->prefix.'cm_clients',
		array(
			'email'			=> $_POST['email'],
			'first_name' 	=> $first_name,
			'last_name' 	=> $last_name,
			'fullname' 		=> $fullname,
			'phone' 		=> sanitize_text_field($_POST['phonenumber'])
		),
		array('user_id'	=> $user_id)
	);
}

function rfs_modify_contact_methods($contactmethods) {
	//$contactmethods['fullname'] = 'Imię i nazwisko';
	$contactmethods['phonenumber'] = 'Nr telefonu';

	return $contactmethods;
}
add_filter('user_contactmethods','rfs_modify_contact_methods', 10, 1);


/* MY ACCOUNT FUNCTIONS */



/* AJAX FUNCTIONS */
function proccess_login() {
	$login 	= sanitize_text_field($_POST['login']);
	$pass	= sanitize_text_field($_POST['pass']);	
	$check	= sanitize_text_field($_POST['check']);	
	
	if($check != 'ok') {
		wp_send_json('error');	
	}
	if(!username_exists($login)) {
		wp_send_json('error-login');
	}
	$user = get_user_by('login', $login);
		
	$is_activated = get_user_meta($user->ID, 'has_to_be_activated', true);
	if($is_activated != 'activated') {
		wp_send_json('not-active');	
	}
	if(wp_check_password( $pass, $user->data->user_pass, $user->ID)) {
		$credentials = array();
		$credentials['user_login'] = $login;
		$credentials['user_password'] = $pass;
		$signon = wp_signon($credentials, false);
		if(is_wp_error($signon)) {
			wp_send_json('error');
		}else {
			wp_send_json('success');
		}
	}else {
		wp_send_json('error-login');
	}
}
add_action('wp_ajax_proccess_login', 'proccess_login');
add_action('wp_ajax_nopriv_proccess_login', 'proccess_login');

function proccess_remind() {
	$email 	= sanitize_text_field($_POST['email']);
	$check	= sanitize_text_field($_POST['check']);	
	//wp_send_json($login);
	if($check != 'ok') {
		wp_send_json('error');	
	}
	if(username_exists($email) || email_exists($email)) {
		if(username_exists($email)) {
			$user = get_user_by('login', $email);
		}
		if(email_exists($email)) {
			$user = get_user_by('email', $email);
		}
		if($user) {
			$new_pass 	= wp_generate_password();
			$user_data 	= get_userdata($user->ID);
			$send_to 	= $user_data->user_email;
			
			$message 	= rfs_get_email_template('reset-password', false, array('new_password' => $new_pass));
			$subject 	= esc_html(get_bloginfo('name')).' - Przypomnienie hasła';
			$send_email = wp_mail($send_to, $subject, $message);
			
			if($send_to) {
				wp_set_password($new_pass, $user->ID);
				wp_send_json('success');
			}
			wp_send_json('error');
		}else {
			wp_send_json('error');
		}
	}
	wp_send_json('error-user');
}
add_action('wp_ajax_proccess_remind', 'proccess_remind');
add_action('wp_ajax_nopriv_proccess_remind', 'proccess_remind');

function proccess_registration() {
	global $wpdb;
	$name 	= sanitize_text_field($_POST['name']);
	$email 	= sanitize_text_field($_POST['email']);
	$phone 	= sanitize_text_field($_POST['phone']);
	$check	= sanitize_text_field($_POST['check']);	
	//wp_send_json($login);
	if($check != 'ok') {
		wp_send_json('error');	
	}
	if(empty($name) || empty($email) || empty($phone)) {
		wp_send_json('empty-fields');	
	}
	
	if(username_exists($email) || email_exists($email)) {
		wp_send_json('user-exists');	
	}
	$wpdb->query('START TRANSACTION');
	
	$password = wp_generate_password();
	$new_user = wp_insert_user(array(
		'user_login' 	=> $email,
		'user_email' 	=> $email,
		'user_pass'	 	=> $password,
		'display_name' 	=> $name
	));
	if(is_wp_error($new_user)) {
		$wpdb->query('ROLLBACK');
		wp_send_json('error-reg');
	}
	$user_id 	= $new_user;
	add_user_meta($user_id, 'has_to_be_activated', 'activated', true);
	add_user_meta($user_id, 'fullname', $name, true);
	add_user_meta($user_id, 'phonenumber', $phone, true);

	$message 	= rfs_get_email_template('register-user', false, array(
		'login'		=> $email,
		'password' 	=> $password,
		'qr_id'		=> $user_id
	));
	$subject 	= esc_html(get_bloginfo('name')).' - Potwierdzenie rejestracji';
	$send_email = wp_mail($email, $subject, $message);
	
	if($send_email) {
		$wpdb->query('COMMIT');
		wp_send_json('success');	
	}else {
		$wpdb->query('ROLLBACK');
		wp_send_json('error');	
	}
	wp_send_json('error1');	
}
add_action('wp_ajax_proccess_registration', 'proccess_registration');
add_action('wp_ajax_nopriv_proccess_registration', 'proccess_registration');
?>