<?php
// register patterns

return array(
    'title'       => 'Depth slider right',
    'description' => 'Columns block with wide text and full slider on the right',
    'categories'  =>  array( 'blank' ),
    'content'     => '<!-- wp:columns {"verticalAlignment":"center","align":"full","style":{"spacing":{"margin":{"bottom":"10vh"}}},"className":"full-slider has-slider-on-the-right"} -->
    <div class="wp-block-columns alignfull are-vertically-aligned-center full-slider has-slider-on-the-right" style="margin-bottom:10vh"><!-- wp:column {"verticalAlignment":"center","className":"wp-column-text wide-text"} -->
    <div class="wp-block-column is-vertically-aligned-center wp-column-text wide-text"><!-- wp:group {"layout":{"type":"flex","orientation":"vertical"}} -->
    <div class="wp-block-group"><!-- wp:heading {"level":3} -->
    <h3 class="wp-block-heading"><sup><strong>Custom slider text</strong><br></sup><strong>Text on the left</strong></h3>
    <!-- /wp:heading -->
    
    <!-- wp:paragraph -->
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla porta euismod justo, congue tempor eros ultricies a. Aliquam erat volutpat. Pellentesque rhoncus ac purus et vestibulum. Sed aliquet interdum quam, euismod aliquet sem finibus ac.</p>
    <!-- /wp:paragraph --></div>
    <!-- /wp:group --></div>
    <!-- /wp:column -->
    
    <!-- wp:column {"verticalAlignment":"center"} -->
    <div class="wp-block-column is-vertically-aligned-center"><!-- wp:acf/image-slider {"name":"acf/image-slider","data":{"field_60014efe6c30e":"1","field_63496532b00d8":"1","field_6349657e6861f":"1","field_634971ae6fc87":"0","field_6411b7a6528d8":"0","field_5dc27b6496fb7":"0","field_633ac70baa6b2":"3_2","field_5e3026cb5890f":"2","field_5dc18460ead6e":["114","115","113"],"field_5dc27a72310f4":"1","field_6392f9bf97309":"","field_6392fbae03bf1":"1","field_63931bdc99515":"","field_6392faf55f014":"1","field_6392fb7157673":""},"mode":"preview","alignText":"left"} /--></div>
    <!-- /wp:column --></div>
    <!-- /wp:columns -->'
);

?>