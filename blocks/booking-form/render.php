<?php
// Define a class name
$className = 'wp-block-booking-form';
// manage native BLOCK ID, Classes and inline styles
include dirname(__FILE__).'/../acf-block-classes.php';

// ACF
$booking_form = get_field('booking_form');

// Thelis Moteur ACF options

// Single site
$thelis_type = get_field('thelis_type');
$thelis_hide_category = get_field('thelis_hide_category');
$thelis_hide_capacity = get_field('thelis_hide_capacity');
$thelis_search_text = get_field('thelis_search_text');

//Group site
$thelis_site = get_field('thelis_site');

// Mastercamping widget ACF options
$master_client_id = get_field('client_id') ?: 315;
$master_booking_url = get_field('booking_url') ?: 'https://booking.familycampings.com';
$master_ids = get_field('master_ids');
$master_direction = get_field('master_direction');
$master_mobile_button = get_field('master_mobile_button');
$master_hide_category = get_field('master_hide_category');

// Shortcode build up
$form_shortcode = '';

if ( $booking_form == 'thelis' ) {
    
    $form_shortcode = '[moteur_thelis';
    
    if (!$thelis_site) {
        $form_shortcode .= $thelis_type ? ' type= ' .$thelis_type. ' ' : ' ';
        $form_shortcode .= $thelis_hide_category ? ' hide-categories-type= ' .$thelis_hide_category. ' ' : ' ';
        $form_shortcode .= $thelis_hide_capacity ? ' hide-capacity= ' .$thelis_hide_capacity. ' ' : ' ';
        $form_shortcode .= $thelis_search_text ? ' search-text= ' .$thelis_search_text. ' ' : ' ';
        $form_shortcode .=   ']';
    
    } else {
        $form_shortcode .= $thelis_site ? ' site="' .$thelis_site. '"' : ' ';
        $form_shortcode .=   ']';
    }

    $button_shortcode = '';

} else {
    
    // reservas_4.php call
    define('ID_RESERVAS_4', $master_client_id); /* Código del establecimiento de las reservas 4, por defecto, family campings */
    define('URL_RESERVAS_4', $master_booking_url);/*URL de reservas v4*/
    include_once dirname(__FILE__).'../../../inc/reservas_4.php';

    $form_shortcode = '[widget_reservas';
    $form_shortcode .= $master_ids ? ' alojamiento="' .$master_ids. '"' : ' ';
    $form_shortcode .= ($master_direction == 'row') ? ' class="widget_columns"' : ' ';
    $form_shortcode .=   ' target="_blank"]';

    if( $master_hide_category ) {
        $className .= ' hide_lodgment_selector';
    }

    if ( $master_mobile_button ) {
        $className .= ' hide_widget_mobile';
        $button_shortcode = '[boton_reservas';
        $button_shortcode .= $master_ids ? ' alojamiento="' .$master_ids. '"' : ' ';
        $button_shortcode .=   ' target="_blank"]';
    }  else {
        $button_shortcode = '';
    }
    
}
?>

<?php if(!$is_preview){ ?>
<div <?php if($id){ echo ' id="'.esc_attr($id).'"';} ?>class="<?php echo esc_attr($className); ?>"<?php if($inlineStyles){ echo ' style="'.esc_attr($inlineStyles).'"';}?>>
<?php } else { ?>
<div class="<?php echo esc_attr($classEditorName); ?>"<?php if($inlineEditorStyles){ echo ' style="'.esc_attr($inlineEditorStyles).'"';}?>>
<?php } ?>
<?php echo $form_shortcode; ?>
<?php echo $button_shortcode; ?>
</div>