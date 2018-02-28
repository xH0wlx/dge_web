<?php

require_once('class-ge-metabox.php');

class GE_MB_PublicacionesPonencias extends GE_Metabox{
    
    public static function add($post_type_key){
        $post_types = [$post_type_key]; //ge_funcionarios

        add_meta_box(
            'ge_funcionarios_ponencias',
            'Publicaciones / Ponencias',
            [self::class, 'html'],
            $post_types,
            'normal'  //NORMAL, SIDE o ADVANCED
            //'high', //DEFAULT, HIGH LOW
            //'valor uno' //PARAMETROS PARA LA FUNCIÓN CALLBACK ['args']
          );
    }
    
    public static function html($post, $metabox){
        wp_nonce_field('ge_nonce_seguridad', 'ge_nonce');

        $contenido = get_post_meta($post->ID, '_ge_funcionario_pp', true);

        $contenido_value = isset($contenido)? $contenido: '';

        $settings = array(
            'media_buttons' => false,
            'textarea_rows' => 7,
        );
        //$html = "?>
        <?php wp_editor($contenido_value, "id_wpe_publicaciones_ponencias", $settings ); ?> 
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

        if(array_key_exists('id_wpe_publicaciones_ponencias', $_POST)){
          global $allowedposttags;
          $sanitizado = wp_kses( $_POST['id_wpe_publicaciones_ponencias'], $allowedposttags );    
            
            update_post_meta(
              $post_id,
              '_ge_funcionario_pp',
              $_POST['id_wpe_publicaciones_ponencias']
            );
        }
    }//FIN SAVE
    
}
