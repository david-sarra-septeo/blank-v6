<?php
// Define a class name
$className = 'wp-block-slider';
// manage native BLOCK ID, Classes and inline styles
include dirname(__FILE__).'/../acf-block-classes.php';

// ACF
$idSlide = 'block_slide_'.rand(0, 9999);


$columns = get_field('columns_slider') ?: '3';
$columns_tablet = get_field('columns_tablet_slider') ?: '2';
$columns_mobile = get_field('columns_mobile_slider') ?: '1';

$preview_lateral = get_field('preview_lateral_slider');
$preview_lateral_tablet = get_field('preview_lateral_tablet_slider');
$preview_lateral_mobile = get_field('preview_lateral_mobile_slider');

$pagination = get_field('pagination_slider') ? 'true' : 'false';
$navigation = get_field('navigation_slider') ? 'true' : 'false';
$numeration = get_field('numeration_slider') ? 'true' : 'false';

$loop = get_field('loop_slider') ? 'loop' : 'slide';

if( !empty($block['style']['spacing']['blockGap']) ) {
    $gap = $block['style']['spacing']['blockGap'];
} else {
    $gap = 'var(--wp--style--block-gap)';
}

$template_blocks = array(


    array('core/group', array(
        'textColor' => 'theme-white',
        'backgroundColor' => 'theme-grey',
        ), array(
                array( 'core/heading', array(
                    'content' => '1',
                    'level' => 2,
                    'align' => 'center',
                    'textAlign' => 'center'
                ) ),
                array( 'core/paragraph', array(
                    'content' => 'slider 1',
                    'align' => 'center'
                )
            ),
        )
    ),
    array('core/group', array(
        'textColor' => 'theme-white',
        'backgroundColor' => 'theme-black',
        ), array(
                array( 'core/heading', array(
                    'content' => '2',
                    'level' => 2,
                    'align' => 'center',
                    'textAlign' => 'center'
                ) ),
                array( 'core/paragraph', array(
                    'content' => 'slider 2',
                    'align' => 'center'
                )
            ),
        )
    ),
    array('core/group', array(
        'textColor' => 'theme-white',
        'backgroundColor' => 'theme-grey',
        ), array(
                array( 'core/heading', array(
                    'content' => '3',
                    'level' => 2,
                    'align' => 'center',
                    'textAlign' => 'center'
                ) ),
                array( 'core/paragraph', array(
                    'content' => 'slider 3',
                    'align' => 'center'
                )
            ),
        )
    ),
    
);

?>

<?php if(!$is_preview){ ?>
<div <?php if($id){ echo ' id="'.esc_attr($id).'"';} ?>class="<?php echo esc_attr($className); ?>"<?php if($inlineStyles){ echo ' style="'.esc_attr($inlineStyles).'"';}?>>
<?php } else{ ?>
<div class="<?php echo esc_attr($classEditorName); ?>"<?php if($inlineEditorStyles){ echo ' style="'.esc_attr($inlineEditorStyles).'"';}?>>


<?php } ?>
<?php if($is_preview){ ?><div class="editor-info"><span>Block slider</span></div><?php } ?>
    <div class="block-slider-splide splide" id="<?php echo $idSlide ?>">
        <div class="splide__track">
            <?php  echo '<InnerBlocks template="' . esc_attr( wp_json_encode( $template_blocks ) ) . '" />';?>
        </div>
    </div>
</div>
<?php if(!$is_preview){ ?>
    <script>
        'use strict';

        document.addEventListener('DOMContentLoaded', function () {

            (function() {
                const blockSlide = new Splide( '#<?php echo $idSlide ?>', {
                    type : '<?php echo $loop ?>',
                    perPage: <?php echo $columns ;?>,
                    <?php if($preview_lateral){?>padding: '<?php echo 'calc('.$preview_lateral.' + '.$gap.')'; ;?>',<?php } ?>
                    
                    breakpoints: {
                        800: {
                            perPage: <?php echo $columns_tablet ;?>,
                            <?php if($preview_lateral_tablet == '0px'){?>
                                    padding: 0,
                                <?php } else if($preview_lateral_tablet){ ?>
                                    padding: '<?php echo 'calc('.$preview_lateral_tablet.' + '.$gap.')'; ;?>',
                                    <?php } ?>
                        },
                        450: {
                            perPage: <?php echo $columns_mobile ;?>,
                            <?php if($preview_lateral_mobile == '0px'){?>
                                    padding: 0,
                                <?php } else if($preview_lateral_mobile){ ?>
                                    padding: '<?php echo 'calc('.$preview_lateral_mobile.' + '.$gap.')'; ;?>',
                                    <?php } ?>

                        },
                    },
                    pagination: <?php echo $pagination ;?>,
                    arrows: <?php echo $navigation ;?>,
                    gap: '<?php echo $gap ;?>',
                    i18n: {
                        slideLabel: '%s / %s',
                    },
                } );
                
                blockSlide.mount();
                
                <?php if($numeration == 'true'){ ?>
                    
                    const idSlide = '#<?php echo $idSlide ?>';

                    const slidesContainer = document.querySelector(`${idSlide} .splide__track`);
                    const counterContainer = '<div class="slider-counter"><span>x/x</span></div>'
                    slidesContainer.insertAdjacentHTML('afterend', counterContainer);


                    const getNumbers = ()=>{
                        const numeration = document.querySelector(`${idSlide} .is-active`).getAttribute('aria-label');
                        // 1/4 -> 01/04
                        const nuevanumeration = numeration.split('/').map(item=> item.padStart(2, '0')).join('/');
                        document.querySelector(`${idSlide} .slider-counter span`).innerHTML = nuevanumeration;
                    }

                    getNumbers();
                    
                    blockSlide.on( 'moved',  getNumbers );
                                    
                    <?php } ?>
            })();
        })
    </script>
<?php } ?>