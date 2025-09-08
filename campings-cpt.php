<?php

function custom_post_type() {
  
	// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Campings', 'Post Type General Name', 'blankv6' ),
			'singular_name'       => _x( 'Camping', 'Post Type Singular Name', 'blankv6' ),
			'menu_name'           => __( 'Campings', 'blankv6' ),
			'parent_item_colon'   => __( 'Parent Camping', 'blankv6' ),
			'all_items'           => __( 'All Campings', 'blankv6' ),
			'view_item'           => __( 'View Camping', 'blankv6' ),
			'add_new_item'        => __( 'Add New Camping', 'blankv6' ),
			'add_new'             => __( 'Add New', 'blankv6' ),
			'edit_item'           => __( 'Edit Camping', 'blankv6' ),
			'update_item'         => __( 'Update Camping', 'blankv6' ),
			'search_items'        => __( 'Search Camping', 'blankv6' ),
			'not_found'           => __( 'Not Found', 'blankv6' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'blankv6' ),
		);
		  
	// Set other options for Custom Post Type
		  
		$args = array(
			'label'               => __( 'campings', 'blankv6' ),
			'description'         => __( 'Registered Campsites', 'blankv6' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'          => array( 'types' ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest' => true,
	  
		);
		  
		// Registering your Custom Post Type
		register_post_type( 'campings', $args );
	  
	}
	  
	/* Hook into the 'init' action so that the function
	* Containing our post type registration is not 
	* unnecessarily executed. 
	*/
	  
	add_action( 'init', 'custom_post_type', 0 );

?>