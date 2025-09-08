<?php
// Define a class name
$className = 'wp-block-lodgings';
// manage native BLOCK ID, Classes and inline styles
include dirname(__FILE__).'/../acf-block-classes.php'; ?>
<?php if(!$is_preview){ ?>
<div <?php if($id){ echo ' id="'.esc_attr($id).'"';} ?>class="<?php echo esc_attr($className); ?>"<?php if($inlineStyles){ echo ' style="'.esc_attr($inlineStyles).'"';}?>>
<?php } else{ ?>
<div class="<?php echo esc_attr($classEditorName); ?>"<?php if($inlineEditorStyles){ echo ' style="'.esc_attr($inlineEditorStyles).'"';}?>>
<?php } ?>

    <?php $post_id = get_the_id(); ?>
    <?php $idSlide = 'content-gallery_'.rand(0, 9999); ?>
    <?php global $post; ?>
    <?php $select_pages = get_field( 'select_pages' ); ?>
    <?php if ( $select_pages ) : ?>
        <?php $content_type = get_field('slider'); ?>
        <?php if ( $content_type == 'slider' ): ?>
        <?php $content_type_class = "splide lodgings-gallery" ?>
        <?php else: ?>
        <?php
        $content_type_class = "lodgings-grid lodgings-gallery";
        $lodging_column_desktop = get_field('lodging_column_desktop');
        $lodging_column_tablet = get_field('lodging_column_tablet');
        $lodging_column_mobile = get_field('lodging_column_mobile');
        $inlineStyles .= ' --wp--style--block-desktop-column:'.$lodging_column_desktop.';--wp--style--block-tablet-column:'.$lodging_column_tablet.';--wp--style--block-mobile-column:'.$lodging_column_mobile.';';
        ?>
        <?php endif; ?> 
            <div class="slider-container lodgings">
                <div class="<?php echo $content_type_class; ?>" id="<?php echo $idSlide ?>" style="<?php echo $inlineStyles; ?>" >
                    <div class="splide__track">
                        <div class="splide__list">
                            <?php foreach ( $select_pages as $i => $post ) :  ?>
                                <?php if(get_the_id() != $post_id) { ?>
                                    <?php setup_postdata( $post ); ?>
                                        <div class="splide__slide wp-block-group">
                                            <?php $lodging_button = get_field('lodging_button'); ?>
                                            <?php if(!$lodging_button): ?>
                                            <a class="lodging-block-container" href="<?php the_permalink(); ?>">
                                            <?php else: ?>
                                            <div class="lodging-block-container">
                                            <?php endif; ?>
                                                <div class="lodging-block-wrapper">
                                                    <?php $lodging_aspect_ratio = get_field('lodging_aspect_ratio'); ?>
                                                    <?php $lodging_image_size = get_field('lodging_image_size'); ?>
                                                    <div class="lodging-image">
                                                        <?php the_post_thumbnail( $lodging_image_size, array('style' => 'object-fit: cover; aspect-ratio:' . $lodging_aspect_ratio)); ?>
                                                    </div>
                                                    <div class="lodging-info">
                                                        <div class="info-wrapper">
                                                        <h2 class="has-h-5-font-size has-maharlika-font-family lodging-title"><?php the_title(); ?></h2>
                                                        <?php $show_icons = get_field('show_icons'); ?>
                                                        <?php if ( have_rows( 'lodging_icons', $post->ID ) && $show_icons) : ?>
                                                            <div class="icons-horizontales is-not-stacked-on-mobile">                                                           
                                                                <?php while ( have_rows( 'lodging_icons', $post->ID ) ) : the_row(); ?>
                                                                    <div class="wp-block-group">
                                                                        <?php $icon = get_sub_field( 'icon' ); ?>
                                                                        <img class="icon-lodging" src="<?php echo esc_url( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['alt'] ); ?>" />
                                                                         <p class="value-lodging"><?php the_sub_field( 'value' ); ?></p>
                                                                    </div>
                                                                <?php endwhile; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        </div>
                                                        <?php if(!$lodging_button): else: ?>
                                                        <div class="wp-block-buttons is-content-justification-center is-layout-flex">
                                                            <div class="wp-block-button">
                                                                <a class="wp-block-button__link has-theme-orange-background-color has-background wp-element-button" href="<?php the_permalink(); ?>"><strong><?php echo __( 'See more', THEME); ?></strong></a>
                                                            </div>
                                                        </div>    
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php if(!$lodging_button): ?>
                                            </a>
                                            <?php else: ?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php wp_reset_postdata(); ?>
                                <?php } ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($content_type == 'slider'): ?>
            <?php
            $columns = get_field('lodging_columns_slider') ?: '3';
            $columns_tablet = get_field('lodging_columns_tablet_slider') ?: '2';
            $columns_mobile = get_field('lodging_columns_mobile_slider') ?: '1';

            $preview_lateral = get_field('lodging_preview_lateral_slider');
            $preview_lateral_tablet = get_field('lodging_preview_lateral_tablet_slider');
            $preview_lateral_mobile = get_field('lodging_preview_lateral_mobile_slider');

            $pagination = get_field('lodging_pagination_slider') ? 'true' : 'false';
            $navigation = get_field('lodging_navigation_slider') ? 'true' : 'false';
            $numeration = get_field('lodging_numeration_slider') ? 'true' : 'false';

            $loop = get_field('lodging_loop') ? 'loop' : 'slide';

            if( !empty($block['style']['spacing']['blockGap']) ) {
                $gap = $block['style']['spacing']['blockGap'];
            } else {
                $gap = 'var(--wp--style--block-gap)';
            }
            ?>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    (function() {
                        const blockSlide = new Splide( '#<?php echo $idSlide ?>', {
                            type : '<?php echo $loop ;?>',
                            perPage: <?php echo $columns ;?>,
                            <?php if($preview_lateral){?>padding: '<?php echo 'calc('.$preview_lateral.' + '.$gap.')'; ;?>',<?php } ?>
                            breakpoints: {
                                999: {
                                    perPage: <?php echo $columns_tablet ;?>,
                                    <?php if($preview_lateral_tablet == '0px'){?>
                                            padding: 0,
                                        <?php } else if($preview_lateral_tablet){ ?>
                                            padding: '<?php echo 'calc('.$preview_lateral_tablet.' + '.$gap.')'; ?>',
                                            <?php } ?>
                                },
                                450: {
                                    perPage: <?php echo $columns_mobile ;?>,
                                    <?php if($preview_lateral_mobile == '0px'){?>
                                            padding: 0,
                                        <?php } else if($preview_lateral_mobile){ ?>
                                            padding: '<?php echo 'calc('.$preview_lateral_mobile.' + '.$gap.')'; ?>',
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
            <?php endif; ?>

    <?php endif; ?>

</div>