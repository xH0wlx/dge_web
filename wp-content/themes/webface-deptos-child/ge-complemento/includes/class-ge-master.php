<?php

/**
 * El archivo que define la clase del cerebro principal
 *
 * Una definición de clase que incluye atributos y funciones que se 
 * utilizan tanto del lado del público como del área de administración.
 * 
 * @link       http://gestionempresarial.face.ubiobio.cl/
 * @since      1.0.0
 *
 * @package    gestion-empresarial
 * @subpackage gestion-empresarial/includes
 */

/**
 *
 * @since      1.0.0
 * @package    gestion-empresarial
 * @subpackage gestion-empresarial/includes
 * @author     Luis Muñoz <luis.m.munoz.j@gmail.com>
 * 
 * @property object $cargador
 * @property string $version
 */
class GE_Master {
    /**
	 * El cargador que es responsable de mantener y registrar
     * todos los ganchos (hooks).
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      GE_Cargador    $cargador  Mantiene y registra todos los ganchos ( Hooks )
	 */
    protected $cargador;
        
    /**
     * Versión actual
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version  La versión actual
	 */
    protected $version;
    
    /**
     * Versión actual
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $ge_filters_functions  La clase para las funciones de filtros
	 */
    protected $ge_filters_functions;
    protected $ge_filters_functions_co;
    
    /**
     * Versión actual
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $ge_filters_query  La clase para las funciones de filtros en edit.php
	 */
    protected $ge_filters_query;
    
    protected $ge_filters_query_co;
    
    /**
     * Constructor
	 *
	 * Establece el nombre y la versión que se puede utilizar en todo el código.
     * Cargar las dependencias, carga de instancias
     * Establecer los ganchos para el área de administración y
     * el lado público del sitio.
	 *
	 * @since    1.0.0
	 */
    public function __construct() {
        
        $this->version = '1.0.0';
        
        $this->cargar_dependencias();
        $this->cargar_instancias();
        $this->definir_admin_filters();
        $this->definir_admin_hooks();
        $this->definir_public_hooks();
        
    }
    
    /**
	 *
	 * Incluya los siguientes archivos:
	 *
	 * - GE_Cargador. Itera los ganchos.
	 * - GE_Admin. Define todos los ganchos del área de administración.
	 * - GE_Public. Define todos los ganchos del del cliente/público.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
    private function cargar_dependencias() {
        
        /**
		 * La clase responsable de iterar los filtros y las acciones (EL ORDEN ES IMPORTANTE) .
		 */
        require_once GE_EXTENSION_DIR_PATH . 'includes/class-ge-pre-cargador.php';     
        
        /**
		 * La clase responsable de iterar las acciones y filtros.
		 */
        require_once GE_EXTENSION_DIR_PATH . 'includes/class-ge-cargador.php';     
        
        /**
		 * La clase responsable de definir todos los cpts a utilizar
		 */
        require_once GE_EXTENSION_DIR_PATH . 'includes/class-ge-cpts.php';
        
        /**
		 * La clase responsable de definir todas las taxonomías a utilizar
		 */
        require_once GE_EXTENSION_DIR_PATH . 'includes/class-ge-taxonomias.php';    
        
        /**
		 * La clase responsable de definir todas los metaboxes a utilizar
		 */
        require_once GE_EXTENSION_DIR_PATH . 'includes/class-ge-metaboxes/class-ge-metabox-creator.php';    
        
        /**
		 * La clase responsable de las funciones de los filtros
		 */
        require_once GE_EXTENSION_DIR_PATH . 'includes/class-ge-filters/class-ge-filter-functions.php';
        require_once GE_EXTENSION_DIR_PATH . 'includes/class-ge-filters/class-ge-filter-functions-contenido-ordenable.php';
        
        /**
		 * La clase responsable de las funciones de los filtros en edit.php
		 */
        require_once GE_EXTENSION_DIR_PATH . 'includes/class-ge-filters/class-ge-filter-query.php';
        
         /**
		 * La clase responsable de las funciones de los filtros en edit.php para contenidos ordenables
		 */
        require_once GE_EXTENSION_DIR_PATH . 'includes/class-ge-filters/class-ge-filter-query-contenido-ordenable.php';   
        
         /**
		 * La clase responsable de definir todas las acciones en el
         * área de administración
		 */
        require_once GE_EXTENSION_DIR_PATH . 'admin/class-ge-admin.php';
        
        /**
		 * La clase responsable de definir todas las acciones en el
         * área del lado del cliente/público
		 */
        require_once GE_EXTENSION_DIR_PATH . 'public/class-ge-public.php';     
        
    }
    
    
    /**
	 * Cargar todas las instancias necesarias para el uso de los 
     * archivos de las clases agregadas
	 *
	 * @since    1.0.0
	 * @access   private
	 */
    private function cargar_instancias() {
        
        // Crea una instancia del cargador que se utilizará para registrar los ganchos con WordPress.
        $this->pre_cargador         = new GE_Pre_Cargador;
        $this->cargador             = new GE_Cargador;
        
        $this->ge_admin             = new GE_Admin( $this->get_version() );
        $this->ge_filters_functions = new GE_FiltersFunctions();    
        $this->ge_filters_functions_co = new GE_FiltersFunctionsCO();    
        $this->ge_filters_query     = new GE_FiltersQuery();
        $this->ge_filters_query_co     = new GE_FiltersQueryCO();
        
        $this->ge_public            = new GE_Public( $this->get_version() );
   
    }
    
    /**
	 * Registrar todos los ganchos relacionados con la funcionalidad del área de administración
	 *
	 * @since    1.0.0
	 * @access   private
	 */
    private function definir_admin_hooks() {
        
        // GE_Cargador llamará a las respectivas funciones (tercer parámetro) de GE_Admin en class-ge-admin
        $this->cargador->add_action( 'admin_enqueue_scripts', $this->ge_admin, 'enqueue_styles' );
        $this->cargador->add_action( 'admin_enqueue_scripts', $this->ge_admin, 'enqueue_scripts' );
        
        // REGISTRO DE CPT'S
        $this->cargador->add_action('init', $this->ge_admin,'ge_registrar_cpts');
        
        // REGISTRO DE TAXONOMÍAS
        $this->cargador->add_action('init', $this->ge_admin,'ge_registrar_taxonomias');
        
        // REGISTRO DE METABOXES
        $this->cargador->add_action('add_meta_boxes', $this->ge_admin,'ge_registrar_metaboxes');
        
        // GUARDADO DE METABOXES
        $this->cargador->add_action('save_post', $this->ge_admin,'ge_save_metaboxes', 10, 3);
        
        // Acciones para filtros (Se usa precargador porque se necesita cargar el filtro antes del hook)
        $this->pre_cargador->add_action( 'manage_ge_funcionarios_posts_custom_column', $this->ge_filters_functions, 'ge_funcionarios_custom_column_content' );
        $this->pre_cargador->add_action( 'manage_ge_contenidos_posts_custom_column', $this->ge_filters_functions_co, 'ge_contenidos_custom_column_content' );
        
        $this->cargador->add_action( 'restrict_manage_posts', $this->ge_filters_query,'ge_admin_posts_filter_restrict_manage_posts' );
        $this->cargador->add_action( 'restrict_manage_posts', $this->ge_filters_query_co,'ge_admin_posts_filter_restrict_manage_posts' );

    }
    
    /**
	 * Registrar todos los filtros relacionados con la funcionalidad del área de administración
	 *
	 * @since    1.0.0
	 * @access   private
	 */
    private function definir_admin_filters() {
        $this->cargador->add_filter( 'enter_title_here', $this->ge_filters_functions, 'ge_change_title_text' );

        $this->cargador->add_filter( 'parse_query', $this->ge_filters_query, 'ge_posts_filter' );
        $this->cargador->add_filter( 'parse_query', $this->ge_filters_query_co, 'ge_posts_filter' );
        
        $this->pre_cargador->add_filter( 'manage_ge_funcionarios_posts_columns', $this->ge_filters_functions, 'ge_funcionarios_modify_columns' );
        $this->pre_cargador->add_filter( 'manage_ge_contenidos_posts_columns', $this->ge_filters_functions_co, 'ge_contenidos_modify_columns' );
    }
        
    /**
	 * Registrar todos los ganchos relacionados con la funcionalidad del área de administración
	 *
	 * @since    1.0.0
	 * @access   private
	 */
    private function definir_public_hooks() {
        
        // GE_Cargador llamará a las respectivas funciones (tercer parámetro) de GE_Public en class-ge-public
        $this->cargador->add_action( 'wp_enqueue_scripts', $this->ge_public, 'enqueue_styles' );
		$this->cargador->add_action( 'wp_enqueue_scripts', $this->ge_public, 'enqueue_scripts' );
                
    }
    
    /**
	 * Ejecuta el cargador para ejecutar todos los ganchos con WordPress.
	 *
	 * @since    1.0.0
     * @access   public
	 */
    public function run() {
        // Comienza a agregar todos las acciones y filtros almacenados en el arreglo de GE_Cargador
        $this->cargador->run();
        $this->pre_cargador->run();
    }

	/**
	 * La referencia a la clase que itera los ganchos.
	 *
	 * @since     1.0.0
     * @access    public
	 * @return    GE_Cargador    Itera los ganchos.
	 */
	public function get_cargador() {
		return $this->cargador;
	}

	/**
	 * Retorna el número de la versión
	 *
	 * @since     1.0.0
     * @access    public
	 * @return    string    El número de la versión.
	 */
	public function get_version() {
		return $this->version;
	}
}
















