<?php

/**
 * La funcionalidad específica de administración.
 *
 * @link       http://gestionempresarial.face.ubiobio.cl/
 * @since      1.0.0
 *
 * @package    gestion-empresarial
 * @subpackage gestion-empresarial/includes
 */

/**
 * Define la versión y dos métodos para
 * Encolar la hoja de estilos específica de administración y JavaScript.
 * 
 * @since      1.0.0
 * @package    gestion-empresarial
 * @subpackage gestion-empresarial/includes
 * @author     Luis Muñoz <luis.m.munoz.j@gmail.com>
 * 
 * @property string $version
 */
class GE_Public {
        
    /**
	 * Versión actual
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version  La versión actual
	 */
    private $version;
    
     /**
	 * Objeto wpdb
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      object    $db @global $wpdb
	 */
    private $db;

    /**
     * @param string $version La versión actual del plugin.
     */
    public function __construct( $version ) {
        
        $this->version      = $version;     
        global $wpdb;
        $this->db = $wpdb;
    }
    
    /**
	 * Registra los archivos de hojas de estilos del área de administración
	 *
	 * @since    1.0.0
     * @access   public
	 */
    public function enqueue_styles() {
        
        /**
         * Una instancia de esta clase debe pasar a la función run()
         * definido en GE_Cargador como todos los ganchos se definen
         * en esa clase particular.
         *
         * El GE_Cargador creará la relación
         * entre los ganchos definidos y las funciones definidas en este
         * clase.
		 */
		wp_enqueue_style( 'ge_css_public', GE_EXTENSION_DIR_URL . 'public/css/ge-public.css', array(), $this->version, 'all' );

    }
    
    /**
	 * Registra los archivos Javascript del área de administración
	 *
	 * @since    1.0.0
     * @access   public
	 */
    public function enqueue_scripts() {
        
        /**
         * Una instancia de esta clase debe pasar a la función run()
         * definido en GE_Cargador como todos los ganchos se definen
         * en esa clase particular.
         *
         * El GE_Cargador creará la relación
         * entre los ganchos definidos y las funciones definidas en este
         * clase.
		 */
        wp_enqueue_script( 'ge_js_public', GE_EXTENSION_DIR_URL . 'public/js/ge-public.js', array( 'jquery' ), $this->version, true );
        
    }

}//FIN CLASE








