<?php 

// remove default core blocks
remove_theme_support( 'core-block-patterns' );

function blank_register_block_patterns() {

    //register blank pattern category
    register_block_pattern_category(
        'blank',
        array( 'label' => 'blank' )
    );
    
    $block_patterns = array(
        'full-media-right',
        'full-media-left',
        'full-slider-right',
        'full-slider-left',
        'depth-slider-right',
        //'depth-slider-left',
        'side-block'
    );

    //register blank patterns
    foreach ( $block_patterns as $block_pattern ) {
        register_block_pattern(
            'blank/' . $block_pattern,
            require __DIR__ . '/patterns/' . $block_pattern . '.php'
        );
    }
}
 
add_action( 'init', 'blank_register_block_patterns' );
?>