<?php
// Define a class name
$className = 'wp-image-slider';
// manage native BLOCK ID, Classes and inline styles
include dirname(__FILE__).'/../acf-block-classes.php';

// ACF
$images_slider = get_field('images_slider', false, false);
$link_slider = get_field('link_slider');
$columns = get_field('columns_slider');
$aspect_ratio =  get_field('aspect_ratio') ?: '3_2';
$num_image_size =  get_field('image_size') ?: '4';// '1:XL', '2:large', '3:medium', '4:small','5:mini'

$preview_lateral = get_field('preview_lateral_slider');
$preview_lateral_tablet = get_field('preview_lateral_tablet_slider');
$preview_lateral_mobile = get_field('preview_lateral_mobile_slider');

$miniatures = get_field('miniatures_slider') ? true : false;
$pagination = get_field('pagination_slider') ? 'true' : 'false';
$navigation = get_field('navigation_slider') ? 'true' : 'false';
$numeration = get_field('numeration_slider') ? 'true' : 'false';

$columns = get_field('columns_slider') ?: '3';
$columns_tablet = get_field('columns_tablet_slider') ?: '2';
$columns_mobile = get_field('columns_mobile_slider') ?: '1';


if($num_image_size == '1'){
    $image_size = 'full';
} else if($num_image_size == '2'){
    $image_size = 'large';
} else if($num_image_size == '3'){
    $image_size = 'medium';
} else if($num_image_size == '4'){
    $image_size = 'thumbnail';
}

$orientacion_imagen = get_field('orientacion_imagen') ?: '1';

$loop_slider = get_field('loop_slider');


if(is_admin()) {
    $link= '';
} else {
    $link= $link_slider;
}

$ids_imatges = $images_slider ? implode(',', $images_slider) : '';

$loop = $loop_slider ? 'loop' : 'slide';

$scripts = $is_preview ? 'false' : 'true';$pagination = get_field('pagination_slider') ? 'true' : 'false';


if( !empty($block['style']['spacing']['blockGap']) ) {
    $gap = $block['style']['spacing']['blockGap'];
} else {
    $gap = 'var(--wp--style--block-gap)';
}

$className .= ' aspect-ratio-'.$aspect_ratio;
$className .= $miniatures ? ' slider-with-thumbails' : '';
?>

<?php if(!$is_preview){ ?>
<div <?php if($id){ echo ' id="'.esc_attr($id).'"';} ?>class="<?php echo esc_attr($className); ?>"<?php if($inlineStyles){ echo ' style="'.esc_attr($inlineStyles).'"';}?>>

<?php } else{ ?>
<div class="<?php echo esc_attr($classEditorName); ?>"<?php if($inlineEditorStyles){ echo ' style="'.esc_attr($inlineEditorStyles).'"';}?>>
<?php } ?>
        <?php if($images_slider){ ?>
            <?php
                global $post;
                $queryImages = get_posts( 'post_type=attachment&post_mime_type=image&numberposts=-1&include='.$ids_imatges.'&orderby=post__in' );

                if ( !empty($queryImages) ){
                    
                    $idSlide = 'slide_'.rand(0, 999);
                    $ReCalccolumns = $miniatures ? '1' : $columns;
                    
                    $html = '<div class="slider-container">';
                    $html .= '<div class="splide gallery-slider gallery-columns-'.$ReCalccolumns.'" id="'.$idSlide.'">';
                    $html .= '<div class="splide__track">';
                    $html .= '<div class="splide__list">';
                    $totalSlides = sizeof($queryImages);
                    if($totalSlides <=9 && !$miniatures ){
                        $totalSlides = '0'.$totalSlides;
                    }

                    $currentSlide = 1;
                    foreach($queryImages as $image){
                        $image_gallery_url = wp_get_attachment_image_src($image->ID, $image_size);
                        $url_image = $image_gallery_url[0];
                        $image_gallery = wp_get_attachment_image($image->ID, $image_size);
                        $image_popup = wp_get_attachment_image_src($image->ID, 'full');
                        $alt =  $image->post_excerpt;
                        $url_popup = $image_popup[0];
                        $subtitle =  $image->post_excerpt;

                        // TRANSFORM 1 2 3...9 to 01 02 03...09
                        if($currentSlide <=9){
                            $currentSlide = '0'.$currentSlide;
                        }
                        $slides = $currentSlide.'/'.$totalSlides;

                        
                        if($link) {
                            $html .= '<a href="' . $url_popup . '" id="thumb-'.$image->ID.'" class="splide__slide image-link" data-gallery="'.$idSlide.'"  data-counter="'.$slides.'" alt=" ' .$alt. '">';
                        } else {
                            $html .= '<div id="thumb-'.$image->ID.'" class="splide__slide" data-counter="'.$slides.'">';
                        }

                        $html .= '<div class="image-wrapper">'.$image_gallery.'</div>';
                        
                        if($link) { 
                            $html .= '</a>';
                        } else {
                            $html .= '</div>';
                        }
                        $currentSlide++;
                    }
    
                    $html .= '</div></div></div></div>';


                    if($miniatures){
                        $idminiatures = 'slide_'.rand(0, 999);
                        $html .= '<div class="slider-thumbnails-container">';
                        $html .= '<div class="splide thumbnails-slider gallery-columns-'.$columns.'" id="'.$idminiatures.'">';
                        $html .= '<div class="splide__track">';
                        $html .= '<div class="splide__list">';


                        foreach($queryImages as $image){
                            $image_gallery_url = wp_get_attachment_image_src($image->ID, $image_size);
                            $url_image = $image_gallery_url[0];
                            $image_gallery = wp_get_attachment_image($image->ID, 'thumbnail');
                            

                            $html .= '<div id="thumb-'.$image->ID.'" class="splide__slide">';
                            

                            $html .= '<div class="thumbnail-wrapper">'.$image_gallery.'</div>';
                            
            
                            $html .= '</div>';
                            
                            $currentSlide++;
                        }
                            
                        $html .= '</div></div></div></div>';
                    ?>
                     <?php
                    }
                    ?>
                    
                    <script>
                        'use strict';

                        document.addEventListener('DOMContentLoaded', function () {

                            (function() {
                                const blockSlide = new Splide( '#<?php echo $idSlide ?>', {
                                    type : '<?php echo $loop ?>',
                                    perPage: <?php echo $miniatures ? '1' : $columns ;?>,
                                    <?php if($preview_lateral){?>padding: '<?php echo 'calc('.$preview_lateral.' + '.$gap.')'; ;?>',<?php } ?>
                                    
                                    breakpoints: {
                                        800: {
                                            perPage: <?php echo $miniatures ? '1' : $columns_tablet ;?>,
                                            <?php if($preview_lateral_tablet == '0px'){?>
                                                    padding: 0,
                                                <?php } else if($preview_lateral_tablet){ ?>
                                                    padding: '<?php echo 'calc('.$preview_lateral_tablet.' + '.$gap.')'; ;?>',
                                                    <?php } ?>
                                        },
                                        450: {
                                            perPage: <?php echo $miniatures ? '1' : $columns_mobile ;?>,
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
                                        slideLabel: '0%s / 0%s',
                                    }
                                } );
                                

                                <?php if($miniatures) { ?>


                                    const thumbSlide = new Splide( '#<?php echo $idminiatures ?>', {
                                    
                                        perPage: <?php echo $totalSlides ;?>,
                                        arrows: false,
                                        gap: '<?php echo $gap ;?>',
                                        isNavigation: true,
                                        pagination: false,

                                    } );


                                  blockSlide.sync( thumbSlide );
                                  
                                <?php } ?>

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

                                <?php if($miniatures) { ?>
                                
                                    thumbSlide.mount();
                                
                                <?php } ?>
                                

                            })();
                        })
                    </script>

                    <?php
                    echo $html;
        
                }

            ?>

        <?php } else { ?>
                <p>Add images</p>
                <img src="https://picsum.photos/400/220">
        <?php } ?>
            
</div>