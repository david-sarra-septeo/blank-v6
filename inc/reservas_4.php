<?php

function reservas4_scripts() {

// widget reservas 4
wp_enqueue_style( 'master_booking_plugin', 'https://rsv4.mastercamping.com/widget/latest/master_booking_plugin.min.css' );
wp_enqueue_style( 'master_booking_plugin_custom', get_bloginfo('stylesheet_directory').'/assets/css/master_booking_plugin_custom.css' );
wp_deregister_script('master_booking_plugin');
wp_register_script('master_booking_plugin', 'https://rsv4.mastercamping.com/widget/latest/master_booking_plugin.min.js',false , '');
wp_enqueue_script('master_booking_plugin');
//tracking
wp_deregister_script('trackwp');
wp_register_script('trackwp', get_template_directory_uri().'/assets/js/trackwp.js',false , '');
wp_enqueue_script('trackwp');
}
add_action( 'wp_enqueue_scripts', 'reservas4_scripts' );


/*====================================================
//  Constantes necesarias para los botones y widget
====================================================*/
// IMPORTANTE, DEFINIR 'ID_RESERVAS_4' i 'URL_RESERVAS_4' en funcitons.php
if(!defined('ID_RESERVAS_4')) {
    define('ID_RESERVAS_4', 1046); // Si no está definido, utilizamos el código de familycampings

    } else if (!defined('URL_RESERVAS_4')) {
    define('URL_RESERVAS_4', 'https://booking.familycampings.com'); // Si no está definido, utilizamos la url de familycampings
}

// IDIOMA
if(function_exists('icl_object_id')) { // Idioma Para WPML
    define('IDIOMA_RESERVAS',ICL_LANGUAGE_CODE);

} else { // Transposh o sin plugin de idioma
    $codi_idioma = get_bloginfo('language');
    define('IDIOMA_RESERVAS', substr($codi_idioma, 0, 2));
}

//MCS
if(defined('ID_GRUPO_RESERVAS_4')){
    
}


/*===================================================
//  Boton de reservas para reservas online y offline
=====================================================*/
//[boton_reservas]
//[boton_reservas alojamiento="XX"]
//[boton_reservas alojamiento="XX;AA;BB"]
//[boton_reservas]Reserve ahora[/boton_reservas]
//[boton_reservas alojamiento="XX"]Reserve ahora[/boton_reservas]

function boton_reservas_func($atts, $texto_personalizado = null) {
	extract(shortcode_atts(array(
	'alojamiento' => false,
    'promocion' => false,
    'checkin' => false, // AAAA-MM-DD
    'checkout' => false, // AAAA-MM-DD
    'edades'  => false //Ej. 18,18,0,4
	), $atts));


    //URL de reservas
    $urlReserves = URL_RESERVAS_4.'/search';


    $urlReserves .= '?lang='.IDIOMA_RESERVAS;


    // PARAMETRO ALOJAMIENTO
	if( !$alojamiento == false) {
		$urlReserves .= '&categoryIds='.$alojamiento;
    }

    //PARAMETRO CÓDIGO PROMOCIONAL
	if( !$promocion == false) {
		$urlReserves .=	'&promotionCode='.$promocion;
	}

    //PARAMETRO CHECKIN
    if( !$checkin == false) {
        $urlReserves .=	'&checkin='.$checkin;
    }

    //PARAMETRO CHECKOUT
    if( !$checkout == false) {
        $urlReserves .=	'&checkout='.$checkout;
    }

    //PARAMETRO EDADES
    if( !$edades == false) {
        $urlReserves .=	'&guestAges='.$edades;
    }

    // TEXTO PERSONALIZADO
	if( $texto_personalizado == '' ) {// El texto del boton por defecto
		$textoBoton = __( 'Book', THEME);

	} else {// El texto del boton si lo especifica el usuario
		$textoBoton = $texto_personalizado;
	}


	return '<a class="boton-reservar" href="'.$urlReserves.'" target="_blank">'.$textoBoton.'</a>';

}

add_shortcode('boton_reservas', 'boton_reservas_func');


/*===================================================
//  Widget de reservas
=====================================================*/
//[widget_reservas]
//[widget_reservas alojamiento="XX" grupo="YY,XX" promocion="test"]


function widget_reservas_func($atts, $texto_personalizado = null) {
	extract(shortcode_atts(array(
	'alojamiento' => false, //Categorias pre-seleccionadas
	'grupo' => false, //Grupos de categorias pre-seleccionados
    'promocion' => false, //soporte para codigos promocionales
    'campo_promocion' => false,
    'entrada' => false, // AAAA-MM-DD
    'salida' => false, // AAAA-MM-DD
    'edades'  => false, //Ej. 18,18,0,4
    'id'  => false, //Opcional id, por defecto #widgetBookingContainerXXX (XXX = numero aleatorio entre 0 y 999)
    'class' => false, // classe, para widget horizontal = widget_columns
    'idioma' => false, // por defecto hereda el idioma de la página donde se encuentra, no utilizar a no ser que se necesite.
    'establecimiento' => false,   // Por defecto es ID_RESERVAS_4, sólo utilizar este parámetro en caso de querer cargar un establecimiento distinto
    'idGrupo' => false, // Por defecto es ID_GRUPO_RESERVAS_4, sólo utilizar este parámetro en caso de querer cargar un establecimiento distinto
    'url' => false, // Por defecto es URL_RESERVAS_4, sólo utilizar este parámetro en caso de querer cargar un establecimiento distinto
    'selector' => false, // Selector de categorias en popup, campo true o false, por defecto 'false'
    'target' => false // Para abrir reservas en ventana nueva, añadir el parametro con valor '_blank'
	), $atts));

    $idWidget = $id ?: 'widgetBookingContainer'.rand(0, 9999);
    $urlReserves = $url ?: URL_RESERVAS_4;
    $idProperty = $establecimiento ?: ID_RESERVAS_4;
    $idiomaReserves = $idioma ?: IDIOMA_RESERVAS;

    if($idGrupo) {
        $propertyGroupId = $idGrupo;
    } else if(defined('ID_GRUPO_RESERVAS_4')){
        $propertyGroupId = ID_GRUPO_RESERVAS_4;
    } else {
        $propertyGroupId = ''; 
    }




    $html = "<script>
            document.addEventListener('DOMContentLoaded', function () {

                var widget = new MasterWidget('".$idWidget."', {
                    lang: '".$idiomaReserves."',";

    if($propertyGroupId){ //MCS
    $html .=        "
                    propertyGroupId: '".$propertyGroupId."',
                    propertyId: '".$idProperty."',";
                    
    } else { // RESERVAS MASTER
    $html .=        "idProperty: '".$idProperty."',";
    }

    $html .= $class ? "class: '".$class."'," : "";

    $html .= $alojamiento ? "categoryIds: [".$alojamiento."]," : "";

    $html .= $grupo ? "categoryGroupIds: [".$grupo."]," : "";

    $html .= $entrada ? "checkin: new Date('".$entrada."')," : "";

    $html .= $salida ? "checkout: new Date('".$salida."')," : "";

    $html .= $edades ? "guestAges: [".$edades."]," : "";

    $html .= $promocion ? "promotionCode: '".$promocion."'," : "";

    $html .= $campo_promocion ? "promotionCodeInput: true," : "";

    $html .= $target ? "target: '".$target."'," : "";

    $html .= $selector ? "dropdown: false," : "dropdown: true,";


    $html .= "
                    url: '".$urlReserves."'
                });


            });

            </script>";



    $html .= '<div id="'.$idWidget.'"> </div>';

            

    return $html;
}

add_shortcode('widget_reservas', 'widget_reservas_func');
?>
