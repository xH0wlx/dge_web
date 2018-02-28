<?php
/**
 * Webface functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Webface
 */

if ( ! function_exists( 'webface_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function webface_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Webface, use a find and replace
	 * to change 'webface' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'webface', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'webface' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'webface_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif;
add_action( 'after_setup_theme', 'webface_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function webface_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'webface_content_width', 640 );
}
add_action( 'after_setup_theme', 'webface_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function webface_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'webface' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'webface' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
  register_sidebar(array('name' => 'sidebar-2','before_widget' => '','after_widget' => '','before_title' => '<h3>','after_title' => '</h3>'));
	register_sidebar(array('name' => 'Footer Left','before_widget' => '','after_widget' => '','before_title' => '<h3>','after_title' => '</h3>'));
	register_sidebar(array('name' => 'Footer Center','before_widget' => '','after_widget' => '','before_title' => '<h3>','after_title' => '</h3>'));
	register_sidebar(array('name' => 'Footer Right','before_widget' => '','after_widget' => '','before_title' => '<h3>','after_title' => '</h3>'));
	register_sidebar(array('name' => 'Footer Sellos','before_widget' => '','after_widget' => '','before_title' => '<h3>','after_title' => '</h3>'));
}
add_action( 'widgets_init', 'webface_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function webface_scripts() {
  wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), false );
  wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), false);
  wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css', array(), false);
	wp_enqueue_style( 'webface-style', get_stylesheet_uri() );
	wp_enqueue_script( 'webface-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'webface-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'webface_scripts' );

/************************************************
 * Entrada personalizada estructura.
 ************************************************/
add_action( 'init', 'register_cpt_estructura' );
function register_cpt_estructura() {

    $labels = array( 
        'name' => _x( 'Estructura', 'estructura' ),
        'singular_name' => _x( 'Estructura', 'estructura' ),
        'add_new' => _x( 'Agregar nuevo profesional', 'estructura' ),
        'add_new_item' => _x( 'Agregar nuevo profesional', 'estructura' ),
        'edit_item' => _x( 'Editar profesional', 'estructura' ),
        'new_item' => _x( 'Nuevo profesional', 'estructura' ),
        'view_item' => _x( 'ver profesional', 'estructura' ),
        'search_items' => _x( 'Search estructuras', 'estructura' ),
        'not_found' => _x( 'No se encontraron profesionales', 'estructura' ),
        'not_found_in_trash' => _x( 'No estructuras found in Trash', 'estructura' ),
        'parent_item_colon' => _x( 'Parent estructura:', 'estructura' ),
        'menu_name' => _x( 'Estructura', 'estructura' ),
    );
    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies' => array( 'concepcion','chillan' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => false, //desactiva el single o page
        'exclude_from_search' => true,
        'has_archive' => false, //desactiva el archivo
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'estructura', $args );
}
/************************************************
 * Taxonomias entrada personalizada esructura.
 ************************************************/
add_action( 'init', 'build_taxonomies', 0 );
 
function build_taxonomies() {
register_taxonomy( 'departamento', 'estructura', array( 'hierarchical' => true, 'label' => 'Departamento', 'query_var' => true, 'rewrite' => true ) );
}
/************************************************
 * Agrega el texto leer+ a los extractos.
 ************************************************/
function mi_excerpt_leermas() {
       global $post;
  return '<a style="color: #ff8300" href="'. get_permalink($post->ID) . '"> ... Ir al artículo.</a>';
}
add_filter('excerpt_more', 'mi_excerpt_leermas');

/************************************************
 * Bootstrap WordPress Pagination Using WP-Pagenavi.
 ************************************************/
//attach our function to the wp_pagenavi filter
add_filter( 'wp_pagenavi', 'ik_pagination', 10, 2 );
  
//customize the PageNavi HTML before it is output
function ik_pagination($html) {
    $out = '';
  
    //wrap a's and span's in li's
    $out = str_replace("<div","",$html);
    $out = str_replace("class='wp-pagenavi'>","",$out);
    $out = str_replace("<a","<li><a",$out);
    $out = str_replace("</a>","</a></li>",$out);
    $out = str_replace("<span","<li><span",$out);  
    $out = str_replace("</span>","</span></li>",$out);
    $out = str_replace("</div>","",$out);
    $out = str_replace("<li><span class='current'","<li class='active'><span",$out); 
    return '<nav>
            <ul class="pagination">'.$out.'</ul>
      </nav>';
}
/************************************************
 * Remove text title wordpress.
 ************************************************/
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
          $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
          $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
          $title = '<span class="vcard">' . get_the_author() . '</span>' ;
        } elseif ( is_year() ) {
          $title = sprintf( __( 'Año: %s' ), get_the_date( _x( 'Y', 'yearly archives date format' ) ) );
        } elseif ( is_month() ) {
          $title = sprintf( __( 'Mes: %s' ), get_the_date( _x( 'F Y', 'monthly archives date format' ) ) );
        } elseif ( is_day() ) {
          $title = sprintf( __( 'Dia: %s' ), get_the_date( _x( 'F j, Y', 'daily archives date format' ) ) );
        }
    return $title;
});
/************************************************
 * disable srcset images.
 ************************************************/
function meks_disable_srcset( $sources ) {
    return false;
}

add_filter( 'wp_calculate_image_srcset', 'meks_disable_srcset' );

/*****************
# agrega la imagen en el rss
******************/
add_action('rss2_item', function(){
  global $post;

  $output = '';
  $thumbnail_ID = get_post_thumbnail_id( $post->ID );
  $thumbnail = wp_get_attachment_image_src($thumbnail_ID, 'large');
  $output .= '<postthumbnail><![CDATA[';
    $output .= $thumbnail[0];
    $output .= ']]></postthumbnail>';

  echo $output;
});

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
