<?php  
/* Custom POST TYPES  - instruktorzy */
add_action( 'init', 'create_instruktorzy_post_type' );
function create_instruktorzy_post_type() {
        $args = array('publicly_queryable' => true,
  					  'query_var' => true,
					  'rewrite' => array(
					  	'slug'	=> 'instruktor',
						'with_front'=>false,
					  ));				 
	register_post_type('instruktorzy', $args);
}
add_action( 'init', 'register_instruktorzy_page_name' ); 
function register_instruktorzy_page_name() {
    $labels = array( 
  		'name'               => __('Instruktorzy', 'rfs_creations'),
		'singular_name'      => __('Instruktor', 'rfs_creations'),
		'add_new'            => __('Dodaj nowego', 'rfs_creations'),
		'add_new_item'       => __('Dodaj nowego', 'rfs_creations'),
		'edit_item'          => __('Edytuj', 'rfs_creations'),
		'new_item'           => __('Nowy', 'rfs_creations'),
		'view_item'          => __('Zobacz', 'rfs_creations'),
		'search_items'       => __('Szukaj', 'rfs_creations'),
		'not_found'          => __('Nie znaleziono instruktorów', 'rfs_creations'),
		'not_found_in_trash' => __('Brak instruktorów w koszu', 'rfs_creations'),
		'parent_item_colon'  => __('Instruktorzy:', 'rfs_creations'),
		'menu_name'          => __('Instruktorzy', 'rfs_creations'),
    );
    $args = array( 
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-groups',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'capability_type'     => 'post', 
		'supports'            => array('title', 'editor', 'page-attributes', 'revisions'),
    );
    register_post_type('instruktorzy', $args );
}

/* Custom POST TYPES  - proam */
add_action( 'init', 'create_proam_post_type' );
function create_proam_post_type() {
        $args = array('publicly_queryable' => true,
  					  'query_var' => true,
					  'rewrite' => array(
					  	'slug'	=> 'proam',
						'with_front'=>false,
					  ));				 
	register_post_type('proam', $args);
}
add_action( 'init', 'register_proam_page_name' ); 
function register_proam_page_name() {
    $labels = array( 
  		'name'               => __('ProAm', 'rfs_creations'),
		'singular_name'      => __('Wpis', 'rfs_creations'),
		'add_new'            => __('Dodaj nowy', 'rfs_creations'),
		'add_new_item'       => __('Dodaj nowy', 'rfs_creations'),
		'edit_item'          => __('Edytuj', 'rfs_creations'),
		'new_item'           => __('Nowy', 'rfs_creations'),
		'view_item'          => __('Zobacz', 'rfs_creations'),
		'search_items'       => __('Szukaj', 'rfs_creations'),
		'not_found'          => __('Nie znaleziono wpisów', 'rfs_creations'),
		'not_found_in_trash' => __('Brak wpisów w koszu', 'rfs_creations'),
		'parent_item_colon'  => __('ProAm:', 'rfs_creations'),
		'menu_name'          => __('ProAm', 'rfs_creations'),
    );
    $args = array( 
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-groups',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'capability_type'     => 'post', 
		'supports'            => array('title', 'editor', 'page-attributes', 'revisions'),
    );
    register_post_type('proam', $args );
}


/* Custom POST TYPES  - galerie */
add_action( 'init', 'create_galeria_post_type' );
function create_galeria_post_type() {
        $args = array('publicly_queryable' => true,
  					  'query_var' => true,
					  'rewrite' => array(
					  	'slug'	=> 'galeria',
						'with_front'=>false,
					  ));				 
	register_post_type('galeria', $args);
}
add_action( 'init', 'register_galeria_page_name' ); 
function register_galeria_page_name() {
    $labels = array( 
  		'name'               => __('Galerie', 'rfs_creations'),
		'singular_name'      => __('Galeria', 'rfs_creations'),
		'add_new'            => __('Dodaj nową galerię', 'rfs_creations'),
		'add_new_item'       => __('Dodaj nową galerię', 'rfs_creations'),
		'edit_item'          => __('Edytuj galerię', 'rfs_creations'),
		'new_item'           => __('Nowa galeria', 'rfs_creations'),
		'view_item'          => __('Zobacz galerię', 'rfs_creations'),
		'search_items'       => __('Szukaj galerii', 'rfs_creations'),
		'not_found'          => __('Nie znaleziono galerii', 'rfs_creations'),
		'not_found_in_trash' => __('Brak galerii w koszu', 'rfs_creations'),
		'parent_item_colon'  => __('Galerie:', 'rfs_creations'),
		'menu_name'          => __('Galerie', 'rfs_creations'),
    );
    $args = array( 
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-images-alt',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'capability_type'     => 'post', 
		'supports'            => array('title', 'editor', 'page-attributes', 'revisions'),
    );
    register_post_type('galeria', $args );
}
/* Custom POST TYPES  - tance */
add_action( 'init', 'create_tance_post_type' );
function create_tance_post_type() {
        $args = array('publicly_queryable' => true,
  					  'query_var' => true,
					  'rewrite' => array(
					  	'slug'	=> 'tance',
						'with_front'=>false,
					  ));				 
	register_post_type('tance', $args);
}
add_action( 'init', 'register_tance_page_name' ); 
function register_tance_page_name() {
    $labels = array( 
  		'name'               => __('Kurs Tańca', 'rfs_creations'),
		'singular_name'      => __('Kurs Tańca', 'rfs_creations'),
		'add_new'            => __('Dodaj nowy kurs tańca', 'rfs_creations'),
		'add_new_item'       => __('Dodaj nowy kurs tańca', 'rfs_creations'),
		'edit_item'          => __('Edytuj kurs tańca', 'rfs_creations'),
		'new_item'           => __('Nowy kurs tańca', 'rfs_creations'),
		'view_item'          => __('Zobacz kurs tańca', 'rfs_creations'),
		'search_items'       => __('Szukaj kursów tańca', 'rfs_creations'),
		'not_found'          => __('Nie znaleziono kursów tańca', 'rfs_creations'),
		'not_found_in_trash' => __('Brak kursów tańca w koszu', 'rfs_creations'),
		'parent_item_colon'  => __('Kurs Tańca:', 'rfs_creations'),
		'menu_name'          => __('Kurs Tańca', 'rfs_creations'),
    );
    $args = array( 
		'labels'              => $labels,
		'hierarchical'        => false,
		'description'         => 'description',
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-format-audio',
		'show_in_nav_menus'   => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'has_archive'         => true,
		'query_var'           => true,
		'can_export'          => true,
		'capability_type'     => 'post', 
		'supports'            => array('title', 'editor', 'page-attributes', 'revisions'),
    );
    register_post_type('tance', $args );
}
?>