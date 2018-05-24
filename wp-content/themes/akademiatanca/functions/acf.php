<?php  
add_filter('acf/settings/show_admin', '__return_false');

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Ustawienia Szablonu',
		'menu_title'	=> 'Ustawienia Szablonu',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> true,
		'icon_url'		=> 'dashicons-screenoptions',
		'position'		=> 22
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Ogólne',
		'menu_title'	=> 'Ogólne',
		'parent_slug'	=> 'theme-general-settings',
	));
	
	acf_add_options_page(array(
		'page_title' 	=> 'Formularz na stronie głównej',
		'menu_title'	=> 'Formularz na stronie głównej',
		'menu_slug' 	=> 'theme-home-form',
		'capability'	=> 'edit_posts',
		'redirect'		=> true,
		'icon_url'		=> 'dashicons-editor-justify',
		'position'		=> 21
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Ustawienia formularza',
		'menu_title'	=> 'Ustawienia formularza',
		'parent_slug'	=> 'theme-home-form',
	));
	
	acf_add_options_page(array(
		'page_title' 	=> 'Miejsca zajęć',
		'menu_title'	=> 'Miejsca zajęć',
		'menu_slug' 	=> 'theme-courses-map',
		'capability'	=> 'edit_posts',
		'redirect'		=> true,
		'icon_url'		=> 'dashicons-location-alt',
		'position'		=> 20
	));
	
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Miejsca zajęć',
		'menu_title'	=> 'Miejsca zajęć',
		'parent_slug'	=> 'theme-courses-map',
	));
	
}

function my_toolbars($toolbars) {
	/* echo '< pre >';
		print_r($toolbars);
	echo '< /pre >';
	die; */	
	$toolbars['Section_header'] = array();
	$toolbars['Section_header'][1] = array('bold');
	
	if(($key = array_search('code', $toolbars['Full' ][2])) !== false) {
	    unset($toolbars['Full'][2][$key]);
	}
	return $toolbars;
}
add_filter('acf/fields/wysiwyg/toolbars', 'my_toolbars');

function admin_styles() {
   echo '<style type="text/css">
			[data-toolbar="section_header"] iframe  {
				height:100px !important;
				min-height:100px !important;
			}
			.wyswig-header {
				height:240px;
			}
         </style>';
}

add_action('admin_head', 'admin_styles');
?>