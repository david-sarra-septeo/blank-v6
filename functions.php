<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Block theme
 * @since 1.0.0
 */

/*==============================================
//  Variables to customize the theme
==============================================*/

define('THEME', 'blank6'); /* theme URL */
define('THEME_PROVIDER_NAME', 'Web Agency - Septeo Hospitality');
define('THEME_PROVIDER_URL', 'https://www.septeo.com/es/hospitality');

function blank_scripts() {

	// glightbox
	wp_enqueue_style( 'glightbox', get_bloginfo('stylesheet_directory').'/assets/css/glightbox.min.css' );
	wp_deregister_script('glightbox');
	wp_register_script('glightbox', get_bloginfo('stylesheet_directory').'/assets/js/glightbox.min.js', false, '');
	wp_enqueue_script('glightbox');
	
	// jQuery
	wp_deregister_script('jquery'); // Des-register jQuery
	// do stuff that real browsers can handle here
	wp_register_script('jquery', ('https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'), false, '');
	wp_enqueue_script('jquery'); // Load jQuery

	// Splide script
	wp_deregister_script('splide');
	wp_register_script('splide', get_bloginfo('stylesheet_directory').'/assets/js/splide.min.js', false, '');
	wp_enqueue_script('splide');

	// blank theme custom javaScripts
	wp_register_script('blank_custom', get_bloginfo('stylesheet_directory').'/assets/js/blank_custom.js', false, '');
	wp_enqueue_script('blank_custom');

	// font awesome //
	wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

}

add_action( 'wp_enqueue_scripts', 'blank_scripts' );

function blank_theme_style() {
	
	// Blank styles
	wp_enqueue_style(
		'blank-theme',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);

	// Splide style
	wp_enqueue_style( 'splide', get_bloginfo('stylesheet_directory').'/assets/css/splide.min.css');
	
	// Register front and back styles
	wp_register_style('shared-style', get_template_directory_uri() . '/assets/css/shared.css',array(),wp_get_theme()->get( 'Version' ));
	wp_enqueue_style( 'shared-style' );

}

add_action( 'wp_enqueue_scripts', 'blank_theme_style' );

if ( ! function_exists( 'blank_editor_styles' ) ) :

    function blank_editor_styles() {

        add_editor_style( array( 
            '/assets/css/shared.css',
            '/assets/css/block-editor-style.css'
        ) );

    }

endif;
add_action( 'admin_init', 'blank_editor_styles' );

/*==============================================
//  shortcode - mostrar l'any actual - [year]
==============================================*/
function year_func($atts) {
	extract(shortcode_atts(array(
	), $atts));
	// Traduccions del nostre theme
    return date("Y");

}

add_shortcode('year', 'year_func');

/*==============================================
//  shortcode - print page content - [insertar pagina="ID"]
==============================================*/

function insertarFunc($atts, $content = null) {
	// valor de salida si nunguna ID es especificada
	$salida = NULL;

	// extraemos los atts y los asignamos a un array        
	extract(shortcode_atts(array(
	"pagina" => '',
    "seccion" => '',
    "block" => '',
    "plantilla" => ''    // aqui podemos asignar un valor por defecto
	), $atts));


	if (!empty($pagina)) {
        $page_object = get_page(translate_id($pagina, 'page'));
     }


    if (!empty($block)) {
        $page_object = get_page(translate_id($block, 'wp_block'));
     }

    if (!empty($seccion)) {
	   $page_object = get_page(translate_id($seccion, 'seccion'));
     }

    if ($plantilla) {
        ob_start();
        get_template_part( $plantilla );
        return ob_get_clean();
    }

	// assign the content to $salida
	$salida = apply_filters('the_content',$page_object->post_content);


    return $salida;
}

add_shortcode('insertar', 'insertarFunc');

/*==============================================
//  Disable remote patterns
==============================================*/

if ( ! function_exists( 'your_theme_restrict_block_editor_patterns' ) ) {
	/**
	 * Restricts block editor patterns in the editor by removing support for all patterns from:
	 *   - Dotcom and plugins like Jetpack
	 *   - Dotorg pattern directory except for theme patterns
	 */
	function your_theme_restrict_block_editor_patterns( $dispatch_result, $request, $route ) {
		if ( strpos( $route, '/wp/v2/block-patterns/patterns' ) === 0 ) {
			$patterns = WP_Block_Patterns_Registry::get_instance()->get_all_registered();
 
 
			if ( ! empty( $patterns ) ) {
				// Remove theme support for all patterns from Dotcom, and plugins. See https://developer.wordpress.org/themes/features/block-patterns/#unregistering-block-patterns
				foreach ( $patterns as $pattern ) {
					unregister_block_pattern( $pattern['name'] );
				}
				// Remove theme support for core patterns from the Dotorg pattern directory. See https://developer.wordpress.org/themes/features/block-patterns/#removing-core-patterns
				remove_theme_support( 'core-block-patterns' );
			}
		}
 
 
		return $dispatch_result;
	}
 }
 
 
// Remove and unregister patterns from core, Dotcom, and plugins. See https://github.com/Automattic/jetpack/blob/d032fbb807e9cd69891e4fcbc0904a05508a1c67/projects/packages/jetpack-mu-wpcom/src/features/block-patterns/block-patterns.php#L107
add_filter( 'rest_dispatch_request', 'your_theme_restrict_block_editor_patterns', 12, 3 );
 
 
// Disable the remote patterns coming from the Dotorg pattern directory. See https://developer.wordpress.org/themes/features/block-patterns/#disabling-remote-patterns
add_filter( 'should_load_remote_block_patterns', '__return_false' );

/*==============================================
// Add tracking scripts to <head>
==============================================*/

function add_to_head() {
	echo '<script> /* code... */ </script>';
}
add_action( 'wp_head', 'add_to_head' );

/*==============================================
// modules
==============================================*/

include_once dirname(__FILE__).'/blocks/acf-blocks.php';
//include_once dirname(__FILE__).'/blocks/block-patterns.php';
include_once dirname(__FILE__).'/assets/cpt/campings-cpt.php';

?>