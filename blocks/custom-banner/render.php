<?php
// Define a class name
$className ='wp-block-custom-banner';
// $inlineStyles = $inlineEditorStyles = $classEditorName ='';
// manage native BLOCK ID, Classes and inline styles
include dirname(__FILE__).'/../acf-block-classes.php';

//ACF:
$link = get_field('link_banner');
$link_url = '#';
$link_target = '_self';
if( $link ): 
    $link_url = $link['url'];
    $link_target = $link['target'] ? $link['target'] : '_self';

endif;
?>
<?php if($is_preview){ ?>
        <div class="<?php echo esc_attr($classEditorName); ?>"<?php if($inlineEditorStyles){ echo ' style="'.esc_attr($inlineEditorStyles).'"';}?>>
<?php } else { ?>
        <a href="<?php echo $link_url ?>"<?php if($id){ echo ' id="'.esc_attr($id).'"';} ?>class="<?php echo esc_attr($className); ?>" target="<?php echo $link_target ?>"<?php if($inlineStyles){ echo ' style="'.esc_attr($inlineStyles).'"';}?>>
<?php } ?>
        <InnerBlocks />
<?php if($is_preview){ ?>       
        </div>
<?php } else { ?>
        </a>
<?php } ?>