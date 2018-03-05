<?php

require_once('class-ge-metabox.php');

class GE_MB_Anio extends GE_Metabox{
    
    public static function add($post_type_key){
        $post_types = [$post_type_key]; //ge_contenidos

        add_meta_box(
            'ge_anio',
            'Año',
            [self::class, 'html'],
            $post_types,
            'normal'  //NORMAL, SIDE o ADVANCED
            //'high', //DEFAULT, HIGH LOW
            //'valor uno' //PARAMETROS PARA LA FUNCIÓN CALLBACK ['args']
        );
    }
    
    public static function html($post, $metabox){
      wp_nonce_field('ge_nonce_seguridad', 'ge_nonce');

      $ge_contenido_anio = get_post_meta($post->ID, '_ge_contenido_anio', true);
        
      $contenidoAnio = isset($ge_contenido_anio)? esc_attr($ge_contenido_anio) : '';

      //$html = "?>
        <div style="width:100%;" >
                    <div class='form-group'>
                        <label for='anio'>Año:</label>
                        <input style="width:100%;" name='_ge_contenido_anio' type='number' class='form-control' id='anio' value="<?php echo $contenidoAnio ?>">
                    </div>
        </div>
    <?php
                //";
        //echo $html;
    }
    
    public static function save($post_id, $post, $update){
        //VALIDAR QUE EL TIPO DE POST SEA EL REGISTRADO
        $valor_nonce = isset($_POST['ge_nonce']) ? $_POST['ge_nonce'] : '';
        $action_nonce = 'ge_nonce_seguridad';

        if(!isset($valor_nonce)){
          return;
        }

        if(!wp_verify_nonce($valor_nonce, $action_nonce)){
          return;
        }

        if(!current_user_can('edit_post', $post_id)){
          return;
        }
        
            
        if( array_key_exists('_ge_contenido_anio', $_POST) ){

            sanitize_text_field($_POST['_ge_contenido_anio']);
            
            $anio = $_POST['_ge_contenido_anio'];

            update_post_meta(
                      $post_id,
                      '_ge_contenido_anio',
                      $_POST['_ge_contenido_anio']
            );

        }
         
    }//FIN SAVE
    
}
