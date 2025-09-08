<?php
// Define a class name
$className ='wp-block-custom-grid';
// $inlineStyles = $inlineEditorStyles = $classEditorName ='';
// manage native BLOCK ID, Classes and inline styles
include dirname(__FILE__).'/../acf-block-classes.php';


$design_grid = get_field('design_grid');
$min_width_col = get_field('min_column');
$desktop_column = get_field('desktop_column');
$tablet_column = get_field('tablet_column');
$mobile_column = get_field('mobile_column');
$width_column = get_field('width_column');
$justify_columns = get_field('justify_columns');

if($design_grid == 1){ // dinamico
        $className .= $classEditorName .= ' block-grid-dinamic';
        $inlineStyles  .= ' --wp--style--block-min-width-column:'.$min_width_col.'px;';
        $inlineEditorStyles .= ' --wp--style--block-min-width-column:'.$min_width_col.'px;';

} else if($design_grid == 2){ // responsive
        $className .= ' block-grid-responsive';
        $classEditorName .= ' block-grid-responsive';
        $inlineStyles .= ' --wp--style--block-desktop-column:'.$desktop_column.';--wp--style--block-tablet-column:'.$tablet_column.';--wp--style--block-mobile-column:'.$mobile_column.';';
        $inlineEditorStyles .= ' --wp--style--block-desktop-column:'.$desktop_column.';--wp--style--block-tablet-column:'.$tablet_column.';--wp--style--block-mobile-column:'.$mobile_column.';';
} else if($design_grid == 3){ // width fijo
        $className .= ' block-grid-fixed-width';
        $classEditorName .= ' block-grid-fixed-width';
        $inlineStyles .= ' --wp--style--block-column-width:'.$width_column.'px;';
        $inlineEditorStyles .= ' --wp--style--block-column-width:'.$width_column.'px;';

        if($justify_columns == 2) { // center
                $inlineStyles .= ' --wp--style--block-justify:center;';
                $inlineEditorStyles .= ' --wp--style--block-justify:center';
        } else if($justify_columns == 3)  { // pace-between;
                $inlineStyles .= ' --wp--style--block-justify:space-between;';
                $inlineEditorStyles .= ' --wp--style--block-justify:space-between;';
        } else if($justify_columns == 4)  { // space-evenly;
                $inlineStyles .= ' --wp--style--block-justify:space-evenly;';
                $inlineEditorStyles .= ' --wp--style--block-justify:space-evenly;';
        } else {
                $inlineStyles .= ' --wp--style--block-justify:left;';
                $inlineEditorStyles .= ' --wp--style--block-justify:left;';
        }
}



?>
<?php if($is_preview){ ?>
        <div class="<?php echo esc_attr($classEditorName); ?>"<?php if($inlineEditorStyles){ echo ' style="'.esc_attr($inlineEditorStyles).'"';}?>>
<?php } else { ?>
        <div <?php if($id){ echo ' id="'.esc_attr($id).'"';} ?>class="<?php echo esc_attr($className); ?>"<?php if($inlineStyles){ echo ' style="'.esc_attr($inlineStyles).'"';}?>>
<?php } ?>

        <?php // echo var_dump($block) ?>
        <InnerBlocks />
</div>