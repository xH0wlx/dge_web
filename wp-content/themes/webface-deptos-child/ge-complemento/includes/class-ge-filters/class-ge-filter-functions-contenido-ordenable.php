<?php

class GE_FiltersFunctionsCO {
    
     public function __construct() {
     }

    /**
     * Un filtro para agregar columnas personalizadas y remover las ya creadas (built-in)
     * columns from the edit.php screen.
     * 
     * @access public
     * @param Array $columns Las columnas existentes
     * @return Array $filtered_columns Las columnas filtradas
     */
    public function ge_contenidos_modify_columns( $columns ) {
        
      // Nueva columna para agregar la tabla
      $new_columns = array(
        'ge_categoria_contenidos_column' => 'Categoría',
        'ge_anio_column' => 'Año'
      );

      // Remover columnas no deseadas (ej publish date)
      unset( $columns['title'] );

      // Combinar las columnas existentes con las nuevas
      $filtered_columns = array_merge( $columns, $new_columns );

      // Retornar el arreglo de columnas filtrado
      return $filtered_columns;
    }
    
    /**
     * Renderiza el contenido de la columna personalizada en edit.php
     * en la tabla de ge_funcionarios post types.
     * 
     * @access public
     * @param String $column El nombre de la columna sobre la que se actúa
     * @return void
     */
    function ge_contenidos_custom_column_content( $column ) {

      // Obtiene el objeto post para esta dila así podemos mostrar información relevante
      global $post;

      // Chequea para saber si $column coincide con los nombres de las columnas personalizadas
      switch ( $column ) {

        case 'ge_categoria_contenidos_column' :
          // Recuperar post meta $terms = wp_get_post_terms( $post_id, $taxonomy, $args );
          $arrayRoles = wp_get_object_terms( $post->ID, 'ge_categoria_contenidos',  array("orderby " => "name", "fields" => "names") );
          $output = "";
              
          if(  !empty($arrayRoles) ){
              $countFilas = count($arrayRoles);
              foreach($arrayRoles as $i => $rol){
                  
                  if($i==0 || $i == $countFilas){
                      $output = $output.$rol;
                  }else{
                      $output = $output.", ".$rol;
                  }
              }
          }
        
          echo ( !empty( $output ) ? $output : 'No tiene sub categoría asignada' );
          break;
        
          case 'ge_anio_column' :
              // Recuperar post meta $terms = wp_get_post_terms( $post_id, $taxonomy, $args );
          $anio = get_post_meta( $post->ID, '_ge_contenido_anio', true );
          $output = "";
              
          if(  !empty($anio) ){
              $output = $anio;
          }
        
          echo ( !empty( $output ) ? $output : 'No tiene año asignado' );
              break;

      }
    }
    
}