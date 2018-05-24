<?php
/**
 *
 * @author Rafał Puczel
 */

if (!isset($content_width)) $content_width = 770;


/**
 * Adds support for a custom header image.
 */
//require get_template_directory() . '/inc/custom-header.php';
/**
 * rsfwp_setup function.
 * 
 * @access public
 * @return void
 */
function rfswp_setup() {

	require 'inc/general/class-Rfswp_Walker_Nav_Menu.php';

	load_theme_textdomain('rfswp', get_template_directory().'/languages');

	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'Bootstrap WP Primary' ),
		'secondary' => __( 'Secondary Menu', 'Bootstrap WP Secondary' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	
}

add_action( 'after_setup_theme', 'rfswp_setup' );


// Hide WP version
function remove_version() {
  return '';
}
add_filter('the_generator', 'remove_version');

//Hide Login Error messages:
function wrong_login() {
  return 'Wrong username or password.';
}
add_filter('login_errors', 'wrong_login');



function load_jquery() {
	if (!is_admin()) {
		wp_deregister_script('jquery');
		wp_register_script( 'jquery', includes_url('/js/jquery/jquery.js'), false, NULL, true);
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'migrate', includes_url('/js/jquery/jquery-migrate.min.js'), false, NULL, true);
	}
}
//add_action('template_redirect', 'load_jquery'); 

function remove_head_scripts() {
	remove_action('wp_head', 'wp_print_scripts');
	remove_action('wp_head', 'wp_print_head_scripts', 9);
	remove_action('wp_head', 'wp_enqueue_scripts', 1);

	add_action('wp_footer', 'wp_print_scripts', 5);
	add_action('wp_footer', 'wp_enqueue_scripts', 5);
	add_action('wp_footer', 'wp_print_head_scripts', 5);
}
add_action( 'wp_enqueue_scripts', 'remove_head_scripts' );

function rfswp_scripts() {
	wp_enqueue_style('rfswp-css', get_template_directory_uri().'/css/bootstrap.min.css', array(), '1.1');
	wp_enqueue_style('rfswp-custom', get_template_directory_uri().'/css/custom.min.css', array(), '1.0');
	/* wp_enqueue_style('rfswp-custom', get_template_directory_uri().'/css/custom.css', array(), '1.0');
	wp_enqueue_style('rfswp-rwd', get_template_directory_uri().'/css/rwd.css', array(), '1.0'); */
	wp_enqueue_style('libs-css', get_template_directory_uri().'/css/libs.min.css', array(), '1.0');
/* wp_enqueue_style('owl-css', get_template_directory_uri().'/css/owl.carousel.css', array(), '2.0');
wp_enqueue_style('lightbox-css', get_template_directory_uri().'/css/lightbox.css', array(), '1.0');
wp_enqueue_style('colorbox-css', get_template_directory_uri().'/css/colorbox.css', array(), '1.6.4');
wp_enqueue_style('scrollbar-css', get_template_directory_uri().'/css/jquery.mCustomScrollbar.css', array(), '3.1.3'); */
	
	wp_enqueue_script('rfswp-basefile', get_template_directory_uri().'/js/bootstrap.min.js',array(),'1.1', true);
	
	//wp_enqueue_script('no-conflict', get_template_directory_uri().'/js/no-conflict.js',array(),'1.0', true);
	wp_enqueue_script('scripts', get_template_directory_uri().'/js/scripts.min.js',array(),'1.0', true);
	//wp_enqueue_script('scripts', get_template_directory_uri().'/js/scripts.js',array(),'1.0', true);
	//wp_enqueue_script('login-register-js', get_template_directory_uri().'/js/login-register.js',array(),'1.0', true);
	
	wp_enqueue_script('libs-js', get_template_directory_uri().'/js/libs.min.js',array(),'1.15.0', true);
	
/* wp_enqueue_script('validate-js', get_template_directory_uri().'/js/jquery.validate.min.js',array(),'1.15.0', true);
wp_enqueue_script('parallax', get_template_directory_uri().'/js/parallax.min.js',array(),'1.4.2', true);
wp_enqueue_script('owl-js', get_template_directory_uri().'/js/owl.carousel.js',array(),'2.0', true);
wp_enqueue_script('lightbox-js', get_template_directory_uri().'/js/lightbox.js',array(),'1.0', true);
wp_enqueue_script('colorbox-js', get_template_directory_uri().'/js/jquery.colorbox-min.js',array(),'1.6.4', true);
wp_enqueue_script('scrollbar-js', get_template_directory_uri().'/js/jquery.mCustomScrollbar.js',array(),'3.1.3', true);
	wp_enqueue_script('cookies-js', get_template_directory_uri().'/js/js.cookie.js',array(),'2.1.3', true); */
	
}
add_action( 'wp_enqueue_scripts', 'rfswp_scripts' );

function enqueue_footer_css() {
	$css = '<link property="stylesheet" href="'.get_template_directory_uri().'/font-awesome/css/font-awesome.min.css" rel="stylesheet">';
	//$css .= '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900,100|Lobster|Lobster+Two:400,700&subset=latin,latin-ext" type="text/css">';
	/* $css .= '<script src="https://cdn.jsdelivr.net/ga-lite/latest/ga-lite.min.js" async></script> <script> var galite = galite || {}; galite.UA = "UA-52143241-1";</script>'; */
	echo $css;
}


function rfs_remove_script_version($src){
    return remove_query_arg('ver', $src);
}
add_filter( 'script_loader_src', 'rfs_remove_script_version' );
add_filter( 'style_loader_src', 'rfs_remove_script_version' );


// REMOVE WP EMOJI
function disable_emojis() {
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
	remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
	add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}
add_action( 'init', 'disable_emojis' );
function disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}

 function wpdocs_dequeue_dashicon() {
        if (current_user_can( 'update_core' )) {
            return;
        }
        wp_deregister_style('dashicons');
    }
    add_action( 'wp_enqueue_scripts', 'wpdocs_dequeue_dashicon' );


/**
 * Custom template tags for this theme.
 */
require get_template_directory().'/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory().'/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory().'/inc/jetpack.php';

require get_template_directory().'/inc/custom-post-types.php';

// hide admin bar links
function mytheme_admin_bar_render() {
	global $wp_admin_bar;
	$wp_admin_bar->remove_menu('comments');
	$wp_admin_bar->remove_menu('customize');
	$wp_admin_bar->remove_menu('new-content');
}
add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );

// hide admin menus
function sb_remove_admin_menus(){
	global $menu;
	global $submenu;
	//remove_menu_page('edit.php?post_type=page'); 
	//remove_menu_page('edit-comments.php');
	unset($submenu['themes.php'][6]);
}
add_action('admin_menu', 'sb_remove_admin_menus');

function rfs_unregister_taxonomy(){
    register_taxonomy('post_tag', array());
	//register_taxonomy('category', array());
}
add_action('init', 'rfs_unregister_taxonomy');

// Replace Posts label as Articles in Admin Panel 
function change_post_menu_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Aktualności';
    $submenu['edit.php'][5][0] = 'Aktualności';
    echo '';
}
add_action( 'admin_menu', 'change_post_menu_label' );

add_action( 'init', 'my_remove_post_type_support', 10 );
function my_remove_post_type_support() {
    remove_post_type_support('post', 'post-formats');
	remove_post_type_support('post', 'excerpt');
	//remove_post_type_support('post', 'comments');
	remove_post_type_support('post', 'trackbacks');
	remove_post_type_support('post', 'author');
	remove_post_type_support('post', 'custom-fields');
}


add_image_size('gallery-thumbnail', 350, 250, true);
add_image_size('gallery-image', 250, 180, true);
add_image_size('medium-large', 500, 500);

function instructors_query($query){
    if( ! is_admin()
        && $query->is_post_type_archive('instruktorzy')
        && $query->is_main_query() ){
            $query->set('posts_per_page', 999);
    }
}
add_action('pre_get_posts', 'instructors_query');

function gallery_query($query){
    if( ! is_admin()
        && $query->is_post_type_archive('galeria')
        && $query->is_main_query() ){
            $query->set('posts_per_page', 999);
    }
}
add_action('pre_get_posts', 'instructors_query');

function rfs_admin_init() {
	if(!defined('DOING_AJAX') && !current_user_can('delete_others_pages')){
		wp_redirect(home_url());
		exit();
	}	 
}
add_action('admin_init', 'rfs_admin_init');

function permissions_admin_layout() {
	global $current_user;
	if(is_admin()) {
		if($current_user->roles[0] != 'administrator') {
			echo '
			<script>
				(function($) {
					$(document).ready(function() {
						$("#adminmenuwrap").find("li").hide();
					
					$("#adminmenuwrap").find("li#toplevel_page_rfs_courses_manager").show();
					$("#adminmenuwrap").find("li#toplevel_page_rfs_courses_manager ul li").show();
					$("#adminmenuwrap").find("li#toplevel_page_rfs_courses_schedule").show();
					$("#adminmenuwrap").find("li#toplevel_page_rfs_courses_schedule ul li").show();
					});
				})(jQuery)
			</script>
			';
		}
	}
}
add_action('admin_head', 'permissions_admin_layout');

function rfs_customize_admin_bar() {
	if (!current_user_can('manage_options')) {
		global $wp_admin_bar;
	  	$wp_admin_bar->remove_menu('wp-logo');
	  	$wp_admin_bar->remove_menu('edit');
	  	$wp_admin_bar->remove_menu('wpseo-menu');
		
		
		//$wp_admin_bar->remove_menu('my-account');
		//$wp_admin_bar->remove_menu('user-actions');
		$wp_admin_bar->remove_menu('user-info');
		$wp_admin_bar->remove_menu('edit-profile'); 
		//$wp_admin_bar->remove_menu('logout');
		$wp_admin_bar->remove_menu('search');
		//$wp_admin_bar->remove_menu('site-name');
		$wp_admin_bar->remove_menu('new_draft');
		$my_account = $wp_admin_bar->get_node('my-account');
		
		$wp_admin_bar->add_node( array(
			'id'	=> 'my-account',
			'href'	=> get_bloginfo('url').'/wp-admin'
		) );
	}
}
add_action('wp_before_admin_bar_render', 'rfs_customize_admin_bar');



function rfs_remove_admin_bar() {
	if (!current_user_can('delete_others_pages') && !is_admin()) {
	  add_filter('show_admin_bar', '__return_false');
	}
}
add_action('after_setup_theme', 'rfs_remove_admin_bar');

//require get_template_directory().'/inc/custom-editor-btns/custom-editor-btns.php';
require get_template_directory().'/functions/acf.php';
require get_template_directory().'/functions/email.php';
require get_template_directory().'/functions/custom.php';
require get_template_directory().'/functions/login-register.php';
require get_template_directory().'/functions/ajax.php';

?>
