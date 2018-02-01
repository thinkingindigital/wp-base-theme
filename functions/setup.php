<?php

/**
* Disable XML-RPC
*/
add_filter('xmlrpc_enabled', '__return_false');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');


/**
* Clean up the <head>
*/
function removeHeadLinks() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');


/**
* Remove auto generated feed links
*/
function my_remove_feeds() {
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 2 );
}
add_action( 'after_setup_theme', 'my_remove_feeds' );


/**
* Add Menu Support
*/
add_theme_support( 'menus' );

function register_menus() {
	register_nav_menus(
		array(
			'main-menu' => __( 'Main Menu' )
		)
	);
}
add_action( 'init', 'register_menus' );


/**
* Thumbnail support
*/
add_theme_support( 'post-thumbnails' );


/**
* Remove all wp_menu_nav classes EXCEPT 'current-menu-item'
*/
function smartest_nav_class_filter( $var ) {
    return is_array($var) ? array_intersect($var, array('current-menu-item')) : '';
}
add_filter('nav_menu_css_class', 'smartest_nav_class_filter', 100, 1);
add_filter('nav_menu_item_id', 'smartest_nav_class_filter', 100, 1);


/**
* Re-Brand the Login Page
*/
function change_login_logo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/imglogo-login.png) !important;
            padding-bottom: 0 !important;
			width: 200px !important;
			height: 190px !important;
			background-size: contain !important;
        }
    </style>
	<?php
}
function change_login_logo_url() {
    return home_url();
}
function change_login_logo_url_title() {
    return 'Tailgater Magazine';
}
//add_action( 'login_enqueue_scripts', 'change_login_logo' );
//add_filter( 'login_headerurl', 'change_login_logo_url' );
//add_filter( 'login_headertitle', 'change_login_logo_url_title' );


/**
* Custom Admin CSS
*/
function my_custom_styles() {
    wp_enqueue_style('admin_styles' , get_template_directory_uri().'/css/admin.css');
}
//add_action('admin_head', 'my_custom_styles');


/**
* Change the Author Permalink
*/
function change_author_permalinks() {
    global $wp_rewrite;
    $wp_rewrite->author_base = 'contributor';
    $wp_rewrite->author_structure = '/' . $wp_rewrite->author_base. '/%author%';
}
//add_action('init','change_author_permalinks');


/**
* Custom Columns for post_type
*/
function post_type_columns($defaults) {
	unset($defaults["somecolumn"]);
    return array_merge($defaults,
              array('content_type' => __('Some Title')));
}
function column_post_type_template($column_name, $post_ID) {
    switch ( $column_name ) {
		case 'content_type':
			$custom_field_values = get_field('content_type', $post_ID);
			echo '<p> '. ucwords($custom_field_values) .' </p>';
			break;
	}
}
function post_type_type_column( $columns ) {
    $columns['content_type'] = 'content_type';
    //To make a column 'un-sortable' remove it from the array
    //unset($columns['date']);
    return $columns;
}
//add_filter('manage_food-and-drink_posts_columns', 'food_and_drink_columns');
//add_action('manage_posts_custom_column','column_food_and_drink_template',10,2);
//add_filter('manage_edit-food-and-drink_sortable_columns', 'food_and_drink_type_column');


/**
* Site Settings Page
*/
if( function_exists('acf_add_options_page') ) {
    /*
	acf_add_options_page(array(
		'page_title' 	=> 'Site Settings',
		'menu_title'	=> 'Site Settings',
		'menu_slug' 	=> 'site-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
    */
}


/**
* Add Admin Menu Bar Items
*/
function add_toolbar_items($admin_bar){
    $admin_bar->add_menu( array(
        'id'    => 'my-item',
        'title' => 'My Item',
        'href'  => '#',
        'meta'  => array(
            'title' => __('My Item'),
        ),
    ));
    $admin_bar->add_menu( array(
        'id'    => 'my-sub-item',
        'parent' => 'my-item',
        'title' => 'My Sub Menu Item',
        'href'  => '#',
        'meta'  => array(
            'title' => __('My Sub Menu Item'),
            'target' => '_blank',
            'class' => 'my_menu_item_class'
        ),
    ));
    $admin_bar->add_menu( array(
        'id'    => 'my-second-sub-item',
        'parent' => 'my-item',
        'title' => 'My Second Sub Menu Item',
        'href'  => '#',
        'meta'  => array(
            'title' => __('My Second Sub Menu Item'),
            'target' => '_blank',
            'class' => 'my_menu_item_class'
        ),
    ));
}
//add_action('admin_bar_menu', 'add_toolbar_items', 100);
