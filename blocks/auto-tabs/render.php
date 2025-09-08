<?php
// Define a class name
$className = 'wp-block-auto-tabs';
// manage native BLOCK ID, Classes and inline styles
include dirname(__FILE__).'/../acf-block-classes.php';

// ACF
$tab_title = get_field('tab_title');
// template
$template_blocks = array(

    array('core/group', array(
        'className' => 'auto-tabs-wrapper',
        'lock' => array(
            'move'=>false, 
            'remove'=> true
            )
        ), array(
                array( 'core/paragraph', array(
                    'content' => '<strong>Aquí se mostrarán las pestañas.</strong><br> El primer <strong>botón</strong> de cada contenido se usará como título de su pestaña. Puedes cambiarlo por otro tag o una clase en el panel lateral',
                    'align' => 'center'
                )
            ),
        )
    ),

    array('core/group', array(
        'className' => 'auto-content-wrapper',
        ), array(
            array('core/group', array(), array(
                        array( 'core/button', array(
                            'text' => 'Button 1',
                            'align' => 'center',
                            'textAlign' => 'center'
                        ) ),
                        array( 'core/paragraph', array(
                            'content' => 'Contenido de la primera pestaña. ',
                            'align' => 'center'
                        )
                    ),
                )
            ),
            array('core/group', array(), array(
                        array( 'core/button', array(
                            'text' => 'Button 2',
                            'align' => 'center',
                            'textAlign' => 'center'
                        ) ),
                        array( 'core/paragraph', array(
                            'content' => 'Contenido de la segunda pestaña.',
                            'align' => 'center'
                        )
                    ),
                )
            ),
            array('core/group', array(), array(
                        array( 'core/button', array(
                            'text' => 'Button 3',
                            'align' => 'center',
                            'textAlign' => 'center'
                        ) ),
                        array( 'core/paragraph', array(
                            'content' => 'Contenido de la tercera pestaña.',
                            'align' => 'center'
                        )
                    ),
                )
            ),
        )
    ),
    
);

?>

<?php if(!$is_preview){ ?>
<div <?php if($id){ echo ' id="'.esc_attr($id).'"';} ?>class="<?php echo esc_attr($className); ?>"<?php if($inlineStyles){ echo ' style="'.esc_attr($inlineStyles).'"';}?> data-selector="<?php echo $tab_title?>">
<?php } else{ ?>
<div class="<?php echo esc_attr($classEditorName); ?>"<?php if($inlineEditorStyles){ echo ' style="'.esc_attr($inlineEditorStyles).'"';}?>>


<?php } ?>
    <?php if($is_preview){ ?><div class="editor-info"><span>Pestañas</span></div><?php } ?>
    <?php echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $template_blocks ) ) . '" />'; ?>
</div>