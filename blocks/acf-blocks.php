<?php

/*==============================================
//  ACF Blocks
==============================================*/

function my_acf_init() {

    if(function_exists('register_block_type')){
        register_block_type( get_template_directory() . '/blocks/booking-form/block.json' );
        // wp_register_script('booking-system', get_template_directory_uri().'/blocks/booking-form/script.js');

		register_block_type( get_template_directory() . '/blocks/image-slider/block.json' );
        // wp_register_script('image-slider', get_template_directory_uri().'/blocks/image-slider/script.js');

		register_block_type( get_template_directory() . '/blocks/block-slider/block.json' );
        wp_register_script('block-slider', get_template_directory_uri().'/blocks/block-slider/script.js');

		register_block_type( get_template_directory() . '/blocks/auto-tabs/block.json' );
		wp_register_script('auto-tabs', get_template_directory_uri().'/blocks/auto-tabs/script.js');

		register_block_type( get_template_directory() . '/blocks/custom-banner/block.json' );

		register_block_type( get_template_directory() . '/blocks/popups/block.json' );
        // wp_register_script('block-popups', get_template_directory_uri().'/blocks/popups/script.js');

		register_block_type( get_template_directory() . '/blocks/page-carousel/block.json' );

		register_block_type( get_template_directory() . '/blocks/page-slider/block.json' );

		// register_block_type( get_template_directory() . '/blocks/custom-grid/block.json' );

		// register_block_type( get_template_directory() . '/blocks/api-test/block.json' );
		// wp_register_script('api-test', get_template_directory_uri().'/blocks/api-test/script.js');

		register_block_type( get_template_directory() . '/blocks/post-type-query/block.json' );

		
    }
}

add_action('acf/init', 'my_acf_init');

function block_categories( $categories ) {

	// Check to see if we already have a blank category
	$include = true;
	foreach( $categories as $category ) {
		if( 'blank' === $category['slug'] ) {
			$include = false;
		}
	}

	if( $include ) {
		$categories = array_merge(
			$categories,
			[
				[
					'slug'  => 'blank',
					'title' => 'Blank',
					'icon'  => ''
				]
			]
		);
	}

	return $categories;
}

add_filter( 'block_categories_all', __NAMESPACE__ . '\block_categories' );

?>