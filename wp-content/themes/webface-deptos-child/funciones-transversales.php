<?php 

//FUNCIÓN AUXILIAR
function _get_all_meta_values($key) {
    global $wpdb;
	$result = $wpdb->get_col( 
		$wpdb->prepare( "
			SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
			LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
			WHERE pm.meta_key = '%s' 
			AND p.post_status = 'publish'
			ORDER BY pm.meta_value DESC", 
			$key
		) 
	);

	return $result;
}

function _get_last_meta_value($key) {
    global $wpdb;
	$result = $wpdb->get_col( 
		$wpdb->prepare( "
			SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
			LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
			WHERE pm.meta_key = '%s' 
			AND p.post_status = 'publish'
			ORDER BY pm.meta_value DESC
            LIMIT 1", 
			$key
		) 
	);

	return $result;
}

function limit_posts_per_page() {
    $current_term = get_queried_object();

    $proyectoId = $current_term->term_id;
    $proyectoTaxonomy = $current_term->taxonomy;

    $args = array(
        'parent' => $proyectoId,
        'fields' => 'all',
        'hide_empty' => true
    );
    
    $cantidadHijos = 5;
    
    $hijosTerm = get_terms($proyectoTaxonomy, $args) ;
    
    if(count($hijosTerm) != 0){
        $cantidadHijos = count($hijosTerm);
    }

    if ( $current_term->slug == 'proyectos' ) {
        
        $limit = ( 
            ( !empty( $_REQUEST['anioproyecto']) && empty( $_REQUEST['subterm']) ) || ( !isset( $_REQUEST['anioproyecto']) && !isset( $_REQUEST['subterm']) )
        )? $cantidadHijos : get_option('posts_per_page');

        set_query_var('posts_per_page', $limit);
    }
}
add_filter('pre_get_posts', 'limit_posts_per_page');


function set_event_title_contenidos( $data , $postarr ) {

  if($data['post_type'] == 'ge_contenidos') {
    $_ge_contenido_anio = "";
    $categoria = "";
    if( !empty(get_post_meta($postarr['ID'], '_ge_contenido_anio')) ){
        $_ge_contenido_anio = get_post_meta($postarr['ID'], '_ge_contenido_anio');
        if(is_array($_ge_contenido_anio)){
            $_ge_contenido_anio = $_ge_contenido_anio[0];
        }
    }

    $subcategorias = wp_get_post_terms( $postarr['ID'],'ge_categoria_contenidos', array('order' => 'ASC', 'fields' => 'all')) ;

    foreach($subcategorias as $subcategoria){
        if($subcategoria->parent != 0){
            $categoria = $subcategoria->name;
        }
    } 

    $data['post_title'] = $_ge_contenido_anio." - ".$categoria;
    $data['post_name'] = ($_ge_contenido_anio == "" || $categoria =="")? $postarr['ID'] : sanitize_title($_ge_contenido_anio." - ".$categoria."-".$postarr['ID']);
  }

  return $data;
}
add_filter( 'wp_insert_post_data' , 'set_event_title_contenidos' , '99', 2 );

?>