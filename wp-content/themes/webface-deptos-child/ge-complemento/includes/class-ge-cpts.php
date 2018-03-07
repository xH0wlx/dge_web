<?php

class GE_CPT {
    protected $cpts;
    protected $updates_messages;
    
    public function __construct() {
        
        $this->cpts = [];
        $this->updates_messages = [];
    }
    
    public function run(){
        //REGISTRAR CPTS
        $this->registrar_cpts_agregados();
    }
    
    public function add_ge_cpt_funcionarios($cpt_key){
        
          $labels = $this->ge_cpt_labels('funcionario', 'funcionarios');

          $args = [
            'labels' => $labels,
            'public' => true,
            //'hierarchical' => true, //TIENE SENTIDO SI HUVIESEN HIJOS, EJ > PERSONA > LUIS > CHIMBOBMITE, EJ>ABOUT>MY DOGS>ROCO
            //'has_archive' => true,
            'supports' => array('title', 'thumbnail'/*, 'page-attributes', 'custom-fields'*/),
            'capability_type' => "post",
            'show_ui' => true,
            //'show_in_menu' => 'edit.php?post_type=estructura',
            'show_in_nav_menus' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-id',
            'publicly_queryable' => true, //ej ?producto=camiseta
            'query_var' => true,
            'rewrite' => [
              'slug' => "funcionarios"
            ]
            //'show_in_admin_bar' => false
          ];

          $this->cpts[] = [
              'ge_post_key' => $cpt_key,
              'args' => $args
          ];
        
          // Filtro para actualizar específicamente los mensajes de ge_funcionarios
          add_filter( 'post_updated_messages', [self::class, 'ge_funcionarios_updated_messages']);
    }
                
    function ge_cpt_labels($singular_name, $plural_name){
        $singular = $singular_name;
        $plurarl = $plural_name;
        $ucfirstSingular = ucfirst($singular);
        $ucfirstPlural = ucfirst($plurarl);
        
        $labels = [
            'name' => $ucfirstPlural,
            //'menu_name' => "Prueba",  
            'singular_name' => $ucfirstSingular,
            'add_new' => "Añadir nuevo $singular",
            'add_new_item' => "Añadir nuevo $singular",
            'edit_item' => "Editar $singular",
            'new_item' => "Nuevo $singular",
            'view_item' => "Ver $singular",
            'view_items' => "Ver $plurarl",
            'search_items' => "Buscar $plurarl",
            'not_found' => $ucfirstSingular." no encontrado",
            'not_found_in_trash' => $ucfirstSingular." no encontrado en la papelera",
            'all_items' => "Todos los $plurarl",
            'archives' => "Archivo de $plurarl",
            'attributes' => "Atributos del $singular",
            'insert_into_item' => "Insertar en $singular",
            'uploaded_to_this_item' => "Subido a $singular",
            'featured_image' => "Imagen del $singular",
            'set_featured_image' => "Establecer imagen del $singular",
            'remove_featured_image' => "Remover imagen del $singular",
            'use_featured_image' => "Usar como imagen del $singular",
            'filter_items_list' => "Filtrar lista de $plurarl",
            'items_list_navigation' => "Navegación de lista de $plurarl",
            'items_list' => "Lista de $plurarl"
        ];
        
        return $labels;
    }
    
    function ge_funcionarios_updated_messages ( $msg ) {
        $msg[ 'ge_funcionarios' ] = array (
             0 => '', // Unused. Messages start at index 1.
         1 => "Datos del funcionario actualizados.",
               // or simply "Actor updated.",
               // natural language "The actor's profile has been updated successfully.",
               // or what you need "Actor updated, so remember to check also <strong>the films list</strong>."


         2 => 'Campo personalizado actualizado.',  // Probably better do not touch
         3 => 'Campo personalizado eliminado.',  // Probably better do not touch

         4 => "Datos del funcionario actualizados.",
         5 => "Datos del funcionario restaurados para revisión",
         6 => "Datos del funcionario publicados.",
                // you can use the kind of messages that better fits with your needs
            // 6 => "Good boy, one more... so, 4,999,999 are to reach IMDB.",
            // 6 => "This actor is already on the website.",
            // 6 => "Congratulations, a new Actor's profile has been published.",

         7 => "Datos del funcionario guardados.",
         8 => "Datos del funcionario enviados.",
         9 => "Datos del funcionario agendados.",
        10 => "Datos del funcionario (borrador) actualizados.",
        );
        return $msg;
    }
    
    // DESCARGAS
    
    public function add_ge_cpt_descargas($cpt_key){
        
          $labels = $this->ge_cpt_labels_descargas('descarga', 'descargas');

          $args = [
            'labels' => $labels,
            'public' => true,
            //'hierarchical' => true, //TIENE SENTIDO SI HUVIESEN HIJOS, EJ > PERSONA > LUIS > CHIMBOBMITE, EJ>ABOUT>MY DOGS>ROCO
            //'has_archive' => true,
            'supports' => array('title', 'thumbnail'/* 'editor', 'page-attributes', 'custom-fields'*/),
            'capability_type' => "post",
            'show_ui' => true,
            //'show_in_menu' => 'edit.php?post_type=estructura',
            'show_in_nav_menus' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-download',
            'publicly_queryable' => false, //ej ?producto=camiseta
            'query_var' => true,
            'rewrite' => [
              'slug' => "descargas"
            ]
            //'show_in_admin_bar' => false
          ];

          $this->cpts[] = [
              'ge_post_key' => $cpt_key,
              'args' => $args
          ];
        
          // Filtro para actualizar específicamente los mensajes de ge_funcionarios
          add_filter( 'post_updated_messages', [self::class, 'ge_descargas_updated_messages']);
    }
                
    function ge_cpt_labels_descargas($singular_name, $plural_name){
        $singular = $singular_name;
        $plurarl = $plural_name;
        $ucfirstSingular = ucfirst($singular);
        $ucfirstPlural = ucfirst($plurarl);
        
        $labels = [
            'name' => $ucfirstPlural,
            //'menu_name' => "Prueba",  
            'singular_name' => $ucfirstSingular,
            'add_new' => "Añadir nueva $singular",
            'add_new_item' => "Añadir nueva $singular",
            'edit_item' => "Editar $singular",
            'new_item' => "Nueva $singular",
            'view_item' => "Ver $singular",
            'view_items' => "Ver $plurarl",
            'search_items' => "Buscar $plurarl",
            'not_found' => $ucfirstSingular." no encontrada",
            'not_found_in_trash' => $ucfirstSingular." no encontrada en la papelera",
            'all_items' => "Todas las $plurarl",
            'archives' => "Archivo de $plurarl",
            'attributes' => "Atributos de la $singular",
            'insert_into_item' => "Insertar en $singular",
            'uploaded_to_this_item' => "Subido a la $singular",
            'featured_image' => "Imagen de la $singular",
            'set_featured_image' => "Establecer imagen de la $singular",
            'remove_featured_image' => "Remover imagen de la $singular",
            'use_featured_image' => "Usar como imagen de la $singular",
            'filter_items_list' => "Filtrar lista de $plurarl",
            'items_list_navigation' => "Navegación de lista de $plurarl",
            'items_list' => "Lista de $plurarl"
        ];
        
        return $labels;
    }
    
    function ge_descargas_updated_messages ( $msg ) {
        $msg[ 'ge_descargas' ] = array (
             0 => '', // Unused. Messages start at index 1.
         1 => "Datos de la descarga actualizados.",
               // or simply "Actor updated.",
               // natural language "The actor's profile has been updated successfully.",
               // or what you need "Actor updated, so remember to check also <strong>the films list</strong>."


         2 => 'Campo personalizado actualizado.',  // Probably better do not touch
         3 => 'Campo personalizado eliminado.',  // Probably better do not touch

         4 => "Datos de la descarga actualizados.",
         5 => "Datos de la descarga restaurados para revisión",
         6 => "Datos de la descarga publicados.",
                // you can use the kind of messages that better fits with your needs
            // 6 => "Good boy, one more... so, 4,999,999 are to reach IMDB.",
            // 6 => "This actor is already on the website.",
            // 6 => "Congratulations, a new Actor's profile has been published.",

         7 => "Datos de la descarga guardados.",
         8 => "Datos de la descarga enviados.",
         9 => "Datos de la descarga agendados.",
        10 => "Datos de la descarga (borrador) actualizados.",
        );
        return $msg;
    }
    
    
     public function add_ge_cpt_ordenables($cpt_key){
        
          $labels = $this->ge_cpt_labels_ordenables('Contenido', 'Contenidos');

          $args = [
            'labels' => $labels,
            'public' => true,
            //'hierarchical' => true,
            //'has_archive' => true,
            'supports' => array('editor'/*, 'page-attributes', 'custom-fields'*/),
            'capability_type' => "post",
            'show_ui' => true,
            //'show_in_menu' => 'edit.php?post_type=estructura',
            'show_in_nav_menus' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-editor-ol',
            'publicly_queryable' => true, //ej ?producto=camiseta
            'query_var' => true,
            'rewrite' => [
              'slug' => "contenido"
            ]
            //'show_in_admin_bar' => false
          ];

          $this->cpts[] = [
              'ge_post_key' => $cpt_key,
              'args' => $args
          ];
        
          add_filter( 'post_updated_messages', [self::class, 'ge_ordenables_updated_messages']);
    }
                
    function ge_cpt_labels_ordenables($singular_name, $plural_name){
        $singular = $singular_name;
        $plurarl = $plural_name;
        $ucfirstSingular = ucfirst($singular);
        $ucfirstPlural = ucfirst($plurarl);
        
        $labels = [
            'name' => $ucfirstPlural,
            //'menu_name' => "Prueba",  
            'singular_name' => $ucfirstSingular,
            'add_new' => "Añadir nuevo $singular",
            'add_new_item' => "Añadir nuevo $singular",
            'edit_item' => "Editar $singular",
            'new_item' => "Nuevo $singular",
            'view_item' => "Ver $singular",
            'view_items' => "Ver $plurarl",
            'search_items' => "Buscar $plurarl",
            'not_found' => $ucfirstSingular." no encontrado",
            'not_found_in_trash' => $ucfirstSingular." no encontrado en la papelera",
            'all_items' => "Todos los $plurarl",
            'archives' => "Archivo de $plurarl",
            'attributes' => "Atributos del $singular",
            'insert_into_item' => "Insertar en $singular",
            'uploaded_to_this_item' => "Subido a $singular",
            'featured_image' => "Imagen del $singular",
            'set_featured_image' => "Establecer imagen del $singular",
            'remove_featured_image' => "Remover imagen del $singular",
            'use_featured_image' => "Usar como imagen del $singular",
            'filter_items_list' => "Filtrar lista de $plurarl",
            'items_list_navigation' => "Navegación de lista de $plurarl",
            'items_list' => "Lista de $plurarl"
        ];
        
        return $labels;
    }
    
    function ge_ordenables_updated_messages ( $msg ) {
        $msg[ 'ge_contenidos' ] = array (
             0 => '', // Unused. Messages start at index 1.
         1 => "Datos del contenido actualizados.",
               // or simply "Actor updated.",
               // natural language "The actor's profile has been updated successfully.",
               // or what you need "Actor updated, so remember to check also <strong>the films list</strong>."


         2 => 'Campo personalizado actualizado.',  // Probably better do not touch
         3 => 'Campo personalizado eliminado.',  // Probably better do not touch

         4 => "Datos del contenido actualizados.",
         5 => "Datos del contenido restaurados para revisión",
         6 => "Datos del contenido publicados.",
                // you can use the kind of messages that better fits with your needs
            // 6 => "Good boy, one more... so, 4,999,999 are to reach IMDB.",
            // 6 => "This actor is already on the website.",
            // 6 => "Congratulations, a new Actor's profile has been published.",

         7 => "Datos del contenido guardados.",
         8 => "Datos del contenido enviados.",
         9 => "Datos del contenido agendados.",
        10 => "Datos del contenido (borrador) actualizados.",
        );
        return $msg;
    }
    
    
    public function registrar_cpts_agregados(){
        
        foreach( $this->cpts as $cpt ) {
            
            extract( $cpt, EXTR_OVERWRITE );
            
            register_post_type($ge_post_key, $args);
        }
        
        flush_rewrite_rules();
    }
        
}