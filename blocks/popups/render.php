<?php
// Define a class name
$className = 'wp-block-popup';
// manage native BLOCK ID, Classes and inline styles
include dirname(__FILE__).'/../acf-block-classes.php';


// template
$template_blocks = array(

);

?>

<?php if(!$is_preview){ ?>
<div <?php if($id){ echo ' id="'.esc_attr($id).'"';} ?>class="<?php echo esc_attr($className); ?>"<?php if($inlineStyles){ echo ' style="'.esc_attr($inlineStyles).'"';}?>>
<?php } else{ ?>
<div class="<?php echo esc_attr($classEditorName); ?>"<?php if($inlineEditorStyles){ echo ' style="'.esc_attr($inlineEditorStyles).'"';}?>>
<?php echo '<div class="editor-info"><span>popup: '.esc_attr($id).'</span></div>' ?>
<?php } ?>
<div class="close-popup-container">
    <a class="gtrigger-close link-ico" href="#"></a>
</div>
  <?php echo '<InnerBlocks />'; ?>
</div>




