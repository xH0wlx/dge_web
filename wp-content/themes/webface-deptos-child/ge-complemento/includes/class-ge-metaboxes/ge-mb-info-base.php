<?php

require_once('class-ge-metabox.php');

class GE_MB_InfoBase extends GE_Metabox{
    
    public static function add($post_type_key){
        $post_types = [$post_type_key]; //ge_funcionarios

        add_meta_box(
            'ge_info_base',
            'Información base',
            [self::class, 'html'],
            $post_types,
            'normal'  //NORMAL, SIDE o ADVANCED
            //'high', //DEFAULT, HIGH LOW
            //'valor uno' //PARAMETROS PARA LA FUNCIÓN CALLBACK ['args']
        );
    }
    
    public static function html($post, $metabox){
              wp_nonce_field('ge_nonce_seguridad', 'ge_nonce');

      $ge_funcionario = get_post_meta($post->ID, '_ge_funcionario', true);
      $ge_funcionario_jerarquia = get_post_meta($post->ID, '_ge_funcionario_jerarquia', true);
        
      $cargoDepartamento = isset($ge_funcionario['cargo_departamento'])? esc_attr($ge_funcionario['cargo_departamento']) : '';
      $jerarquiaDepartamento = isset($ge_funcionario_jerarquia)? esc_attr($ge_funcionario_jerarquia) : '';
      $profesion = isset($ge_funcionario['profesion'])? $ge_funcionario['profesion'] : '';
      $email = isset($ge_funcionario['email'])? esc_attr($ge_funcionario['email']) : '';
      $telefono = isset($ge_funcionario['telefono'])? esc_attr($ge_funcionario['telefono']) : '';
      $linkTesis = isset($ge_funcionario['link-tesis'])? esc_url($ge_funcionario['link-tesis']) : '';
/*      $ge_rol = isset($ge_funcionario['ge_rol'])? $ge_funcionario['ge_rol'] : '';

        $args = [
            'taxonomy'     => 'ge_rol',
            'parent'        => 0,
            'hide_empty'    => false,
            'fields'        => 'names' 
        ];
        $terms = get_terms( $args );*/
      //$html = "?>
        <div style="width:100%;" >

                   <div class='form-group' style="display: none;" id="cargo_departamento_box">
                        <label for='cargo_departamento'>Cargo Directivo:</label>
                        <input name='ge_funcionario[cargo_departamento]' type='text' class='form-control' id='cargo_departamento' value="<?php echo $cargoDepartamento ?>">
                        <label for='jerarquia_departamento'>Jerarquía Directivo:</label>
                        <input name='ge_funcionario_jerarquia' type='number' class='form-control' id='jerarquia_departamento' value="<?php echo $jerarquiaDepartamento ?>">
                    </div>
                    <div class="form-group input_fields_wrap">
                        <label>Profesión/es o Grado/s:</label>
                        <div class="input-group mb-3">
                                  <input name="ge_funcionario[profesion][]" type="text" class="form-control profesion_o_grado" value="<?php echo esc_attr($profesion[0]) ?>">
                        
                                  <div class="input-group-append">
                                    <button class="btn btn-primary add_field_button"> + </button>
                                  </div>
                        </div>
                        <?php 
                        if(count($profesion) > 1 ){
                            $largo = count($profesion);
                            for($i=1; $i < $largo; $i++){
                                ?>
                                
                                <div class="input-group mb-3">
                                  <input name="ge_funcionario[profesion][]" type="text" class="form-control profesion_o_grado" value="<?php echo esc_attr($profesion[$i]); ?>">
                                  <div class="input-group-append">
                                    <button class="btn btn-danger remove_field" type="button"> -&nbsp;  </button>
                                  </div>
                                </div>
                                
                                <?php
                            }
                        }
                        
                        ?>
                    </div>
<!--                    <div class='form-group'>
                        <label for='profesion_o_grado'>Profesión o Grado:</label>
                        <input style="width:100%;"  name='ge_funcionario[profesion]' type='text' class='form-control' id='profesion_o_grado' value="<?php //echo $profesion ?>">
                    </div>-->
                    <div class='form-group'>
                        <label for='email'>Email:</label>
                        <input style="width:100%;" name='ge_funcionario[email]' type='email' class='form-control' id='email' value="<?php echo $email ?>">
                    </div>
                    <div class='form-group'>
                        <label for='telefono'>Teléfono:</label>
                        <input style="width:100%;" name='ge_funcionario[telefono]' type='text' class='form-control' id='telefono' value="<?php echo $telefono ?>">
                    </div>
                    <div class='form-group' style="display: none;" id="link_tesis_dirigidas">
                        <label for='link-tesis'>Link de Tesis Dirigidas:</label>
                        <input placeholder="Del sitio http://repobib.ubiobio.cl" style="width:100%;" name='ge_funcionario[link-tesis]' type='text' class='form-control' id='link-tesis' value="<?php echo $linkTesis ?>">
                    </div>

<!--                     <div>
                        <label for='ge_rol'>Rol: </label>
                        <select style="width: 100%;" name='ge_funcionario[ge_rol]' id='ge_rol'>
                          <option value='' >Seleccionar rol</option>
                          <?php
                            /*foreach($terms as $term){
                                echo "<option value='$term' ".selected($ge_rol, $term, false)." >$term</option>";
                            }*/

                            ?>
                        </select>
                      </div>-->

        </div>
    <?php
                //";
        //echo $html;
    }

    function sanitize_text_fields_info_base(&$array){
        foreach($array as $key => $value)
            {

                if(is_array($value))
                {
                    foreach($value as $llave => $valor){
                      $array[$key][$llave] = sanitize_text_field($valor);
                   }
                }else{
                    if( !($key == "link-tesis") ){
                        $array[$key] = sanitize_text_field($value);
                    }
                }
            }
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
        
        if(array_key_exists('ge_funcionario', $_POST)){
            
            self::sanitize_text_fields_info_base($_POST['ge_funcionario']);
            
            if( array_key_exists('ge_funcionario_jerarquia', $_POST) ){
                
                sanitize_text_field($_POST['ge_funcionario_jerarquia']);
                
                $cargo = $_POST['ge_funcionario']['cargo_departamento'];
                $jerarquia = $_POST['ge_funcionario_jerarquia'];
                
                if( $cargo != "" && $jerarquia == "" ){
                    // 0 valor máximo, de mayor importancia, 100 neutro para menor importancia
                    $_POST['ge_funcionario_jerarquia'] = 100;
                }else if( $cargo == "" && jerarquia != "" ){
                    $_POST['ge_funcionario_jerarquia'] = "";
                }
                
                update_post_meta(
                          $post_id,
                          '_ge_funcionario_jerarquia',
                          $_POST['ge_funcionario_jerarquia']
                );
                
            }
         
          update_post_meta(
              $post_id,
              '_ge_funcionario',
              $_POST['ge_funcionario']
            );

/*            $objetoRol = get_term_by( 'name', $_POST["ge_funcionario"]["ge_rol"], 'rol');

            $term_id = term_exists( $_POST['ge_rol'], 'rol', $_POST['ge_rol'] );
            $tag = array( $term_id ); // Correct. This will add the tag with the id 5.
            $aux = $_POST['ge_rol'];
            wp_set_object_terms( $post_id, $objetoRol->term_id, 'rol', false );*/



            //wp_set_post_terms( $post_id, $_POST['ge_rol'], 'rol');
        }
    }//FIN SAVE
    
}
