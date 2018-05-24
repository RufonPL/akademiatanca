<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <main id="main">
 *
 * @author Rafał Puczel
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php echo esc_attr(get_bloginfo('charset')); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="google-site-verification" content="jnSsUK4WJNIaIZgQPSk6ii76D_clcwMsPUqnz7BjZsE" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php $favicon = get_field('_favicon','option'); ?>
<?php if($favicon) : ?>
<link rel="shortcut icon" href="<?php echo esc_url($favicon['url']); ?>" />
<?php endif; ?>


<?php $logo = get_field('_logo','option'); ?>

<?php wp_head(); ?>
<?php 
$page_bg_image_type = get_field('_page_bg_image_type', $post->ID);
$page_bg_image = get_field('_page_bg_image', $post->ID);  
?>
<style>
<?php if($page_bg_image_type == 'custom' && $page_bg_image) : ?>
body.page-bg {
	background-image:url(<?php echo esc_url($page_bg_image['url']); ?>);
	background-repeat:no-repeat;
	background-position:left 350px;
}
<?php endif; ?>
</style>

</head>
<?php $bg_class = is_front_page() ? '' : 'page-bg'; ?>
<body <?php body_class($bg_class); ?><?php echo courses_bg(); ?>>
<?php include_once("analyticstracking.php") ?>
	<?php do_action( 'before' ); ?>
    
    <?php require_template_part('user-bar', 'user') ?> 
    
	<header>
    	<nav class="navbar navbar-default">
			<div class="container">
				<div class="row">
					<div class="navbar-header">
                        <a href="<?php bloginfo('url'); ?>" class="navbar-brand">
                            <?php if($logo) : ?>
                            <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>"/>
                            <h2 class="site-name h1"><?php bloginfo('name'); ?></h2>
                            <?php else : ?>
                            <h2 class="h1"><?php bloginfo('name'); ?></h2>
                            <?php endif; ?>
                        </a>
                        <div class="navbar-toggle" data-toggle="collapse" data-target=".navbar-primary">
                        	<div class="pull-left">
                            	MENU
                            </div><!--end pull left-->
                        	<div class="pull-right">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </div><!--end pull right-->
                        </div><!--end navbar toggle-->
                    </div><!--end navbar header-->
                    <?php 
                    $args = array(
						'theme_location' 	=> 'primary', 
						'container_class' 	=> 'navbar-collapse collapse navbar-primary', 
						'menu_class' 		=> 'nav navbar-nav',
						'fallback_cb'		=> '',
						'menu_id' 			=> 'primary-menu',
						'walker' 			=> new Rfswp_Walker_Nav_Menu()); 
                    wp_nav_menu($args);
                    ?>
				</div><!--end row-->
			</div><!--end container-->
		</nav>
        <div class="container secondary-menu-container">
            
            <div class="secondary-menu">
            	<div class="navbar-toggle courses-toggle" data-toggle="collapse" data-target=".navbar-secondary">
                <div class="pull-left">
                    KURSY
                </div><!--end pull left-->
                <div class="pull-right">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </div><!--end pull right-->
            </div><!--end navbar toggle-->
                <h5 class="text-uppercase"><strong>Oferujemy kursy</strong></h5>
                <?php 
                $args = array(
                    'theme_location' 	=> 'secondary', 
                    'container_class' 	=> 'navbar-collapse collapse navbar-secondary', 
                    'menu_class' 		=> 'nav navbar-nav',
                    'fallback_cb'		=> '',
                    'menu_id' 			=> 'secondary-menu',
                    'walker' 			=> new Rfswp_Walker_Nav_Menu()); 
                wp_nav_menu($args);
                ?>
                <?php require_template_part('social-media', 'header') ?>
            </div><!--end secondary menu-->
        </div><!--end secondary menu container-->
	</header><!--end header-->
	<div id="content" class="site-content">
    