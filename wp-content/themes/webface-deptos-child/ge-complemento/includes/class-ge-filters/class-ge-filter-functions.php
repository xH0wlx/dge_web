<?php

class GE_FiltersFunctions {
    
     public function __construct() {
     }

    // CPT = ge_funcionarios
    public function ge_change_title_text( $title ){
         $screen = get_current_screen();
        
         if  ( "ge_funcionarios" == $screen->post_type ) {
              $title = 'Ingrese el nombre con formato APELLIDO APELLIDO, NOMBRE';
         }
         return $title;
    }
    
    /**
     * Un filtro para agregar columnas personalizadas y remover las ya creadas (built-in)
     * columns from the edit.php screen.
     * 
     * @access public
     * @param Array $columns Las columnas existentes
     * @return Array $filtered_columns Las columnas filtradas
     */
    public function ge_funcionarios_modify_columns( $columns ) {
        
      // Nueva columna para agregar la tabla
      $new_columns = array(
        'ge_rol_column' => 'Rol/es',
        'ge_featured_image_column' => 'Imágen'
      );

      // Remover columnas no deseadas (ej publish date)
      //unset( $columns['date'] );

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
    function ge_funcionarios_custom_column_content( $column ) {

      // Obtiene el objeto post para esta dila así podemos mostrar información relevante
      global $post;

      // Chequea para saber si $column coincide con los nombres de las columnas personalizadas
      switch ( $column ) {

        case 'ge_rol_column' :
          // Recuperar post meta $terms = wp_get_post_terms( $post_id, $taxonomy, $args );
          $arrayRoles = wp_get_object_terms( $post->ID, 'ge_rol',  array("orderby " => "name", "fields" => "names") );
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
        
          echo ( !empty( $output ) ? $output : 'No tiene un rol asignado' );
          break;
              
          case 'ge_featured_image_column' :
                the_post_thumbnail( [60,60] );
            break;

      }
    }
    
}