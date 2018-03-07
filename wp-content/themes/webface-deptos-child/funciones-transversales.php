<?php 

//FUNCIÓN AUXILIAR
function _get_all_meta_values_distinct_by_category_id($key, $idCategory){
    global $wpdb;
    $result = $wpdb->get_col(
        $wpdb->prepare("
            SELECT DISTINCT pm.meta_value FROM {$wpdb->postmeta} pm
			LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
            LEFT JOIN {$wpdb->term_relationships} tr ON p.ID = tr.object_id
            LEFT JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
            LEFT JOIN {$wpdb->terms} t ON tr.term_taxonomy_id = t.term_id
			WHERE pm.meta_key = '%s'
            AND (tt.term_id = %d OR tt.parent = %d)
			AND p.post_status = 'publish'
			ORDER BY pm.meta_value DESC",
            [$key,
            $idCategory,
            $idCategory]
        )
    );
    
    return $result;
}

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

function _get_max_meta_value_by_terms_id($metaKey, $termsIds){
    global $wpdb;
    $result = $wpdb->get_var(
        $wpdb->prepare("
            SELECT MAX(pm.meta_value) FROM {$wpdb->postmeta} pm
			LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
            LEFT JOIN {$wpdb->term_relationships} tr ON p.ID = tr.object_id
            LEFT JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
            LEFT JOIN {$wpdb->terms} t ON tr.term_taxonomy_id = t.term_id
			WHERE pm.meta_key = '%s'
            AND tt.term_id IN(".implode(', ', $termsIds).")
			AND p.post_status = 'publish' ",
            $metaKey              
        )
    );
    
    return $result;
}

function _get_terms_by_last_year($metaKey, $lastYear, $termsIds){
    global $wpdb;
    $result = $wpdb->get_results(
        $wpdb->prepare("
            SELECT * FROM {$wpdb->postmeta} pm
			LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
            LEFT JOIN {$wpdb->term_relationships} tr ON p.ID = tr.object_id
            LEFT JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
            LEFT JOIN {$wpdb->terms} t ON tr.term_taxonomy_id = t.term_id
			WHERE pm.meta_key = '%s'
            AND pm.meta_value = '%s'
            AND tt.term_id IN (".implode(', ', $termsIds).")
			AND p.post_status = 'publish'
			ORDER BY pm.meta_value DESC",
            $metaKey,
            $lastYear
        )
    );
    
    return $result;
}

/*function limit_posts_per_page() {
    $current_term = get_queried_object();
    
    if ( $current_term->slug == 'proyectos' ) {
        $cantidadHijos = 0; //DEFAULT

        $proyectoId = $current_term->term_id;

        $args = array(
            'parent' => $proyectoId,
            'fields' => 'ids',
            'hide_empty' => true
        );

        $proyectoTaxonomy = $current_term->taxonomy;

        $hijosTermIdes = get_terms($proyectoTaxonomy, $args) ;

        $maxValueYearProyectos = _get_max_meta_value_by_terms_id('_ge_contenido_anio', $hijosTermIdes);

        $resultadoUltimoAnio = _get_terms_by_last_year('_ge_contenido_anio', $maxValueYearProyectos, $hijosTermIdes);

        if(count($resultadoUltimoAnio) != 0){
            $cantidadUltimoAnio = count($resultadoUltimoAnio);
        }

        if( !isset( $_REQUEST['anioproyecto'] ) && !isset( $_REQUEST['subterm'] ) && !get_query_var( 'paged' ) ){
            $limit = $cantidadUltimoAnio;
        }else{
            $limit = get_option('posts_per_page');
        }

        set_query_var('posts_per_page', $limit);
    }
}
add_filter('pre_get_posts', 'limit_posts_per_page');*/


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
        $categoria = $subcategoria->name;
    } 

    $data['post_title'] = $_ge_contenido_anio." - ".$categoria;
    $data['post_name'] = ($_ge_contenido_anio == "" || $categoria =="")? $postarr['ID'] : sanitize_title($_ge_contenido_anio." - ".$categoria."-".$postarr['ID']);
  }

  return $data;
}
add_filter( 'wp_insert_post_data' , 'set_event_title_contenidos' , '99', 2 );

?>