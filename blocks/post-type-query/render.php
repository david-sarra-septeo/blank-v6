<?php
// Define a class name
$className = 'wp-block-post-type-query';
// manage native BLOCK ID, Classes and inline styles
include dirname(__FILE__).'/../acf-block-classes.php'; ?>

<?php if(!$is_preview){ ?>
<div <?php if($id){ echo ' id="'.esc_attr($id).'"';} ?>class="<?php echo esc_attr($className); ?>"<?php if($inlineStyles){ echo ' style="'.esc_attr($inlineStyles).'"';}?>>
<?php } else{ ?>
<div class="<?php echo esc_attr($classEditorName); ?>"<?php if($inlineEditorStyles){ echo ' style="'.esc_attr($inlineEditorStyles).'"';}?>>
<?php } ?>

<?php
// Arguments de la consulta
$args = array(
    'post_type' => 'campings', // El tipus de contingut personalitzat
    'posts_per_page' => 10, // Nombre de posts a mostrar (pots canviar aquest valor)
    'orderby' => 'date', // Ordenar per data (pots canviar a 'title', 'menu_order', etc.)
    'order' => 'DESC', // Ordena de manera descendent (pots canviar a 'ASC')
);

// Nova consulta WP_Query
$campings_query = new WP_Query($args);

// Comprova si hi ha posts que compleixen els criteris
if ($campings_query->have_posts()) {
    // Llaç pels resultats de la consulta
    while ($campings_query->have_posts()) {
        $campings_query->the_post();
        // Aquí pots mostrar el contingut del post
        ?>
        <div class="campsite-card">
            <?php
            echo '<p>' . get_the_title() . '</p>';
            echo the_post_thumbnail( 'medium' );
            ?>
        </div>
        <?php
    }
    // Restaura la consulta global de WordPress
    wp_reset_postdata();
} else {
    // Si no hi ha posts, mostra un missatge
    echo '<p>No s\'han trobat campings.</p>';
}

?>