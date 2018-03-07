<?php
/**
 * Webface child functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Webface
 */

if ( ! function_exists( 'delete_post_type' ) ) :
function delete_post_type(){
    unregister_post_type( 'estructura' );
}
endif;

add_action('init','delete_post_type', 100);


require_once get_template_directory() . '/../webface-deptos-child/funciones-transversales.php' ;

require_once get_template_directory() . '/../webface-deptos-child/ge-complemento/gestion-empresarial-complemento.php' ;