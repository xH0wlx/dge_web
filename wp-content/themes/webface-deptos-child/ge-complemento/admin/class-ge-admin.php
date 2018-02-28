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
class GE_Admin {
    
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
    
    // CPT FUNCIONARIOS -> SLUG: funcionarios REGISTRO: ge_funcionarios
    private $ge_funcionarios = "ge_funcionarios";
    
        // CPT FUNCIONARIOS -> SLUG: descargas REGISTRO: ge_descargas
    private $ge_descargas = "ge_descargas";
    
    /**
     * @param string $version La versión actual.
     */
    public function __construct( $version ) {
        
        $this->version = $version;
        
        global $wpdb;
        $this->db = $wpdb;
        
    }
    
    /**
	 * Registra los archivos de hojas de estilos del área de administración
	 *
	 * @since    1.0.0
     * @access   public
     * @param    string     $hook Devuelve el texto del slug del menú con el texto toplevel_page
	 */
    public function enqueue_styles($hook) {
        
        /**
         * Una instancia de esta clase debe pasar a la función run()
         * definido en GE_Cargador como todos los ganchos se definen
         * en esa clase particular.
         *
         * El GE_Cargador creará la relación
         * entre los ganchos definidos y las funciones definidas en este
         * clase.
		 */
        
        
        /*
         * ge_wordpress_icons_css
         * Archivo de hojas de estilo principales de la administración
         */
		wp_enqueue_style( 'ge_wordpress_icons_css', GE_EXTENSION_DIR_URL . 'admin/css/ge-wordpress.css', array(), $this->version, 'all' );
        
        
        // Condicional para controlar la carga de los archivos solamente en la página de extension custom post type
        global $post;

        if ( !($hook == 'post-new.php' || $hook == 'post.php') ) {
            return;
        }
        
        if ( $this->ge_funcionarios == $post->post_type ){
            /*
             * Sweet Alert
             * http://t4t5.github.io/sweetalert/
             */
            wp_enqueue_style( 'ge_css_admin_funcionarios', GE_EXTENSION_DIR_URL . 'admin/css/ge-admin-funcionarios.css', array(), $this->version, 'all' );
            
            wp_enqueue_style( 'ge_sweet_alert_css', GE_EXTENSION_DIR_URL . 'helpers/sweetalert-master/dist/sweetalert.css', array(), $this->version, 'all' );
            
            wp_enqueue_style( 'ge_css_bootstrap', GE_EXTENSION_DIR_URL . 'helpers/bootstrap-4.0.0-beta.3-dist/css/bootstrap.min.css', array(), $this->version, 'all' );
        }
        
        if( $this->ge_descargas == $post->post_type ){
            wp_enqueue_style( 'ge_css_admin_descargas', GE_EXTENSION_DIR_URL . 'admin/css/ge-admin-descargas.css', array(), $this->version, 'all' );
            
            wp_enqueue_style( 'ge_sweet_alert_css', GE_EXTENSION_DIR_URL . 'helpers/sweetalert-master/dist/sweetalert.css', array(), $this->version, 'all' );
            
            wp_enqueue_style( 'ge_css_bootstrap', GE_EXTENSION_DIR_URL . 'helpers/bootstrap-4.0.0-beta.3-dist/css/bootstrap.min.css', array(), $this->version, 'all' );
        }

        /*
         * ge_admin_css
         * Archivo de hojas de estilo principales de la administración
         */
		wp_enqueue_style( 'ge_css_admin', GE_EXTENSION_DIR_URL . 'admin/css/ge-admin.css', array(), $this->version, 'all' );
        
    }
    
    /**
	 * Registra los archivos Javascript del área de administración
	 *
	 * @since    1.0.0
     * @access   public
	 */
    public function enqueue_scripts($hook) {
        
        /**
         * Una instancia de esta clase debe pasar a la función run()
         * definido en GE_Cargador como todos los ganchos se definen
         * en esa clase particular.
         *
         * El GE_Cargador creará la relación
         * entre los ganchos definidos y las funciones definidas en este
         * clase.
		 */
        
        // Condicional para controlar la carga de los archivos solamente en la página de extension custom post type
        global $post;

        if ( !($hook == 'post-new.php' || $hook == 'post.php') ) {
            return;
        }
    
        if ( $this->ge_funcionarios == $post->post_type ){
           /*
            * Sweet Alert
            * http://t4t5.github.io/sweetalert/
            */
            wp_enqueue_media();
            
            wp_enqueue_script( 'ge_sweet_alert_js', GE_EXTENSION_DIR_URL . 'helpers/sweetalert-master/dist/sweetalert.min.js', ['jquery'], $this->version, true );
            
            wp_enqueue_script( 'ge_js_admin', GE_EXTENSION_DIR_URL . 'admin/js/ge-funcionarios.js', ['jquery'], $this->version, true );
            
            wp_enqueue_script( 'ge_js_bootstrap', GE_EXTENSION_DIR_URL . 'helpers/bootstrap-4.0.0-beta.3-dist/js/bootstrap.min.js', ['jquery'], $this->version, true );

        }
        if( $this->ge_descargas == $post->post_type ){
            wp_enqueue_script( 'ge_sweet_alert_js', GE_EXTENSION_DIR_URL . 'helpers/sweetalert-master/dist/sweetalert.min.js', ['jquery'], $this->version, true );
            
            wp_enqueue_script( 'ge_js_admin_descargas', GE_EXTENSION_DIR_URL . 'admin/js/ge-descargas.js', ['jquery'], $this->version, true );
            
            wp_enqueue_script( 'ge_js_bootstrap', GE_EXTENSION_DIR_URL . 'helpers/bootstrap-4.0.0-beta.3-dist/js/bootstrap.min.js', ['jquery'], $this->version, true );
        }


        
        //SE USA TRUE COMO ÚLTIMO PARÁMETRO PARA QUE LO AGREGUE ANTES DE LA ETIQUETA CIERRE DE BODY
        wp_enqueue_script( 'ge_css_admin', GE_EXTENSION_DIR_URL . 'admin/js/ge-admin.js', ['jquery'], $this->version, true );
        
    }
    
    public function ge_registrar_cpts(){
        $ge_cpts = new GE_CPT();
        $ge_cpts->add_ge_cpt_funcionarios($this->ge_funcionarios);
        $ge_cpts->add_ge_cpt_descargas($this->ge_descargas);
        $ge_cpts->run();
    }
    
    public function ge_registrar_taxonomias(){
        $ge_taxonomias = new GE_Taxonomia();
        $ge_taxonomias->add_ge_taxonomy_rol($this->ge_funcionarios);
        $ge_taxonomias->add_ge_taxonomy_area_investigacion($this->ge_funcionarios);
        
        //DESCARGAS
        $ge_taxonomias->add_ge_taxonomy_categoria_archivos($this->ge_descargas);
        
        $ge_taxonomias->run();
        
        $term = term_exists( 'directivo', 'ge_rol' );
        if ( $term == 0 || $term == null ) {
           wp_insert_term( 'Directivos', 'ge_rol', array('slug' => 'directivos') );
        }
        
        $term = term_exists( 'académico', 'ge_rol' );
        if ( $term == 0 || $term == null ) {
            wp_insert_term( 'Académicos', 'ge_rol', array('slug' => 'academicos') );
        }
       
        $term = term_exists( 'administrativo', 'ge_rol' );
        if ( $term == 0 || $term == null ) {
            wp_insert_term( 'Administrativos', 'ge_rol',  array('slug' => 'administrativos') );
        }
    }
    
    public function ge_registrar_metaboxes(){
        
        // ESTA FUNCIÓN DEBE SER CAPAZ DE REGISTRAR TODOS LOS METABOXES
        GE_MetaboxCreator::createFuncionariosMetabox($this->ge_funcionarios);
        
        GE_MetaboxCreator::createDescargasMetabox($this->ge_descargas);
    }
    
    /*
    * Parámetros pasados por el hook 'save_post'
    * @param int $post_id The post ID.
    * @param post $post The post object.
    * @param bool $update Whether this is an existing post being updated or not.
    */
    public function ge_save_metaboxes($post_id, $post, $update){
        
        // DIFERENCIAS POR TIPO DE POST
        $post_type = get_post_type($post_id);

        if ( $this->ge_funcionarios == $post_type ){
            GE_MetaboxCreator::saveFuncionariosMetabox($post_id, $post, $update);
        }
        
        if ( $this->ge_descargas == $post_type ){
            GE_MetaboxCreator::saveDescargasMetabox($post_id, $post, $update);
        }
    }
    /**
	 * Controla las visualizaciones en el área de administración
	 *
	 * @since    1.0.0
     * @access   public
	 */
    /*public function controlador_display_menu(){
        
        if($_GET['page'] == 'bc_data' && $_GET['action'] == 'edit' && isset($_GET['id']) ){
            require_once GE_EXTENSION_DIR_URL . 'admin/partials/bc-admin-display-edit.php';
        }else{
            require_once GE_EXTENSION_DIR_URL . 'admin/partials/bc-admin-display.php';
        }
    }*/
    
 

}







