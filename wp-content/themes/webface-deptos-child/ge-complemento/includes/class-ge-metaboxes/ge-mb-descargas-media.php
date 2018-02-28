<?php

require_once('class-ge-metabox.php');

class GE_MB_DescargaMedia extends GE_Metabox{
    
    public static function add($post_type_key){
        $post_types = [$post_type_key]; //ge_descargas

        add_meta_box(
            'ge_descarga_media',
            'Archivo',
            [self::class, 'html'],
            $post_types,
            'normal'  //NORMAL, SIDE o ADVANCED
            //'high', //DEFAULT, HIGH LOW
            //'valor uno' //PARAMETROS PARA LA FUNCIÓN CALLBACK ['args']
        );
    }
    
    public static function html($post, $metabox){
              wp_nonce_field('ge_nonce_seguridad', 'ge_nonce');

      $ge_descarga_titulo = get_post_meta($post->ID, '_ge_descarga_titulo', true);
      $ge_descarga_peso = get_post_meta($post->ID, '_ge_descarga_peso', true);
      $ge_descarga_icono = get_post_meta($post->ID, '_ge_descarga_icono', true);
      $ge_descarga_fecha = get_post_meta($post->ID, '_ge_descarga_fecha', true);
      $ge_descarga_enlace = get_post_meta($post->ID, '_ge_descarga_enlace', true);    
        
      $ge_descarga_titulo = isset( $ge_descarga_titulo )?  esc_attr( $ge_descarga_titulo ) : "";
      $ge_descarga_peso = isset( $ge_descarga_peso )?  esc_attr( $ge_descarga_peso ) : "";
      $ge_descarga_icono = isset( $ge_descarga_icono )?  esc_attr( $ge_descarga_icono ) : "";
      $ge_descarga_fecha = isset( $ge_descarga_fecha )?  esc_attr( $ge_descarga_fecha ) : "";
      $ge_descarga_enlace = isset( $ge_descarga_enlace )?  esc_attr( $ge_descarga_enlace ) : "";

?>
       <button id="btn-marco" class="btn btn-primary" type="button">Añadir Archivo</button>
        <br><br>
        <div style="width:100%;" >

                   <div class='form-group' id="enlace_box">
                       
                        <label for='titulo-descarga'>Título del Archivo:</label>
                        <input name='ge_descarga_titulo' type='text' class='form-control' id='titulo-descarga' value="<?php echo $ge_descarga_titulo; ?>" readonly>
                       
                        <label for='enlace-descarga'>Enlace:</label>
                        <input name='ge_descarga_enlace' type='text' class='form-control' id='enlace-descarga' value="<?php echo $ge_descarga_enlace; ?>" readonly>
                       
                        <label for='size-human-descarga'>Peso:</label>
                        <input name='ge_descarga_size_human' type='text' class='form-control' id='size-human-descarga' value="<?php echo $ge_descarga_peso; ?>" readonly>
                        
                        <label for='icono-descarga'>Icono:</label>
                        <input name='ge_descarga_icon' type='text' class='form-control' id='icono-descarga' value="<?php echo $ge_descarga_icono; ?>" readonly>
                        
                        <label for='fecha-descarga'>Fecha del Archivo:</label>
                        <input name='ge_descarga_fecha' type='text' class='form-control' id='fecha-descarga' value="<?php echo $ge_descarga_fecha; ?>" readonly>
                        
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
        
        if(array_key_exists('ge_descarga_enlace', $_POST)){
                
            sanitize_text_field($_POST['ge_descarga_enlace']);

            update_post_meta(
                      $post_id,
                      '_ge_descarga_enlace',
                      $_POST['ge_descarga_enlace']
            );
            

        }
        if(array_key_exists('ge_descarga_titulo', $_POST)){
                
            sanitize_text_field($_POST['ge_descarga_titulo']);

            update_post_meta(
                      $post_id,
                      '_ge_descarga_titulo',
                      $_POST['ge_descarga_titulo']
            );
            
        }
        if(array_key_exists('ge_descarga_size_human', $_POST)){
                
            sanitize_text_field($_POST['ge_descarga_size_human']);

            update_post_meta(
                      $post_id,
                      '_ge_descarga_peso',
                      $_POST['ge_descarga_size_human']
            );
            
        }
        if(array_key_exists('ge_descarga_icon', $_POST)){
                
            sanitize_text_field($_POST['ge_descarga_icon']);

            update_post_meta(
                      $post_id,
                      '_ge_descarga_icono',
                      $_POST['ge_descarga_icon']
            );
            
        }
        if(array_key_exists('ge_descarga_fecha', $_POST)){
                
            sanitize_text_field($_POST['ge_descarga_fecha']);

            update_post_meta(
                      $post_id,
                      '_ge_descarga_fecha',
                      $_POST['ge_descarga_fecha']
            );
            
        }
        
    }//FIN SAVE
    
}
