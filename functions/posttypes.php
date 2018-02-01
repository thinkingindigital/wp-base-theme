<?php

//add_action( 'init', 'codex_careers_init' );

/**
 * Register careers post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function codex_careers_init() {
	$labels = array(
		'name'               => _x( 'Careers', 'post type general name' ),
		'singular_name'      => _x( 'Career', 'post type singular name' ),
		'menu_name'          => _x( 'Careers', 'admin menu' ),
		'name_admin_bar'     => _x( 'Career', 'add new on admin bar' ),
		'add_new'            => _x( 'Add New', 'careers' ),
		'add_new_item'       => __( 'Add New Job' ),
		'new_item'           => __( 'New Job' ),
		'edit_item'          => __( 'Edit Job' ),
		'view_item'          => __( 'View Job' ),
		'all_items'          => __( 'All Jobs' ),
		'search_items'       => __( 'Search Jobs' ),
		'parent_item_colon'  => __( 'Parent Jobs:' ),
		'not_found'          => __( 'No jobs found.' ),
		'not_found_in_trash' => __( 'No jobs found in Trash.' )
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Loft Orbital open positions.' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'careers' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
        'menu_icon'          => 'dashicons-lightbulb',
		'supports'           => array( 'title' )
	);

	register_post_type( 'careers', $args );
}
