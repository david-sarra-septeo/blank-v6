<?php
// Include this file in each acf block.
// ex: include dirname(__FILE__).'/../acf-block-classes.php';

// TODO  check if 'get_block_wrapper_attributes' can simplify this file
// https://make.wordpress.org/core/2023/03/06/minimum-height-dimensions-block-support/

if (!isset($className)) { $className ='';}
$classEditorName= $className; // Back end classes
$inlineStyles = ''; // Front End inline styles
$inlineEditorStyles=''; // Back End inline styles
$id = '';

// CUSTOM ID
if( !empty($block['anchor']) ) {    $id = $block['anchor'];}
// CUSTOM CSS
if( !empty($block['className']) ) {$className .= ' ' . $block['className'];}
// ALIGN
if( !empty($block['align']) ) {$className .= ' align' . $block['align'];}
// TEXT ALIGN
if( !empty($block['align_text']) ) {
    $className .= ' has-text-align-' . $block['align_text'];
    $classEditorName .= ' has-text-align-' . $block['align_text'];
}
// ALIGN CONTENT?? TO DO REVIEW
if( !empty($block['align_content']) ) {$className .= ' align-content-' . $block['align_content'];}
// TEXT COLOR
if( !empty($block['textColor']) ) {$className .= ' has-text-color has-' . $block['textColor'] . '-color';}
// BACKGROUND COLOR
if( !empty($block['backgroundColor']) ) {$className .= ' has-background has-' . $block['backgroundColor'] . '-background-color' ;}
// LINK COLOR
if( !empty($block['style']['elements']['link']) ) {$className .= ' has-link-color' ;}
// FULL HEIGHT
if( !empty($block['full_height']) && true === $block['full_height'] ) {$inlineStyles .= 'min-height: 100vh;' ;}
// FONT SIZE
if( !empty($block['fontSize']) ) {$className .= ' has-' . $block['fontSize'] . '-font-size';}
if( !empty($block['style']['typography']['fontSize']) ) {$inlineStyles .= 'font-size:' . $block['style']['typography']['fontSize'] . ';';}
// LINE HEIGHT
if( !empty($block['style']['typography']['lineHeight']) ) {$inlineStyles .= 'line-height:' . $block['style']['typography']['lineHeight'] . ';';}
// PADDING
if( !empty($block['style']['spacing']['padding']) ) {$className .= ' has-custom-padding' ;}
if( !empty($block['style']['spacing']['padding']['top']) ) {$inlineStyles .= 'padding-top:' . $block['style']['spacing']['padding']['top'] . ';';}
if( !empty($block['style']['spacing']['padding']['right']) ) {$inlineStyles .= 'padding-right:' . $block['style']['spacing']['padding']['right'] . ';';}
if( !empty($block['style']['spacing']['padding']['bottom']) ) {$inlineStyles .= 'padding-bottom:' . $block['style']['spacing']['padding']['bottom'] . ';';}
if( !empty($block['style']['spacing']['padding']['left']) ) {$inlineStyles .= 'padding-left:' . $block['style']['spacing']['padding']['left'] . ';';}
// MARGIN
if( !empty($block['style']['spacing']['margin']) ) {$className .= ' has-custom-margin' ;}
if( !empty($block['style']['spacing']['margin']['top']) ) {$inlineStyles .= 'margin-top:' . $block['style']['spacing']['margin']['top'] . ';';}
if( !empty($block['style']['spacing']['margin']['right']) ) {$inlineStyles .= 'margin-right:' . $block['style']['spacing']['margin']['right'] . ';';}
if( !empty($block['style']['spacing']['margin']['bottom']) ) {$inlineStyles .= 'margin-bottom:' . $block['style']['spacing']['margin']['bottom'] . ';';}
if( !empty($block['style']['spacing']['margin']['left']) ) {$inlineStyles .= 'margin-left:' . $block['style']['spacing']['margin']['left'] . ';';}
// BORDER
if( !empty($block['style']['border']['radius']) ) {$inlineStyles .= 'border-radius:' . $block['style']['border']['radius'] . ';';}
if( !empty($block['style']['border']['width'])  ) {$inlineStyles .= 'border-width:' . $block['style']['border']['width'] . ';';}
if( !empty($block['style']['border']['style'])  ) {$inlineStyles .= 'border-style:' . $block['style']['border']['style'] . ';';}
if( !empty($block['borderColor']) ) {$className .= ' has-border-color has-' . $block['borderColor'] . '-border-color' ;}

// BLOCK GAP
if( !empty($block['style']['spacing']['blockGap']) ) {

    $gap = $block['style']['spacing']['blockGap'];
    $inlineStyles .= '--wp--custom--block-gap:' . $gap . ' !important;';
    // We need a different custom variable from font End
    $inlineEditorStyles .= '--wp-editor-gap:' . $gap . ';';
}
?>