<?php

/**
 * Archivo de extensiones para el template webface-deptos
 *
 * @link                http://gestionempresarial.face.ubiobio.cl/
 * @since               1.0.0
 * @package             gestion-empresarial
 *
 */

// Previene el acceso a este código fuera de la ejecución de Wordpress.
if ( ! defined( 'ABSPATH' ) ) exit;

define('GE_NOMBRE_ROOT', 'ge-complemento');

// Define la ruta a la carpeta con el código, se usa para codificación interna
define( 'GE_EXTENSION_DIR_PATH', dirname( __FILE__ ) . '/' );

// Define la ruta al recurso via URL, se usa por ejemplo, archivos css
define( 'GE_EXTENSION_DIR_URL', get_stylesheet_directory_uri() . '/'. GE_NOMBRE_ROOT . '/' );

require_once GE_EXTENSION_DIR_PATH . 'includes/class-ge-master.php';

function run_ge_master() {
    $ge_master = new GE_Master;
    $ge_master->run();
}

// Ejecuta el archivo master que a su vez ejecutará el cargador
run_ge_master();

?>