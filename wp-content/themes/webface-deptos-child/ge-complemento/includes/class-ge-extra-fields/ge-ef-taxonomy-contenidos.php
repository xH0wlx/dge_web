<?php


class GE_EF_Imagen{
    public function __construct() {
    }
    
    function categoria_contenido_add_new_meta_fields(){
	?>
        <div class="form-field">
            <label for="imagen-taxonomia">Imágen</label>
            <input type="text" name="_imagenPath" id="imagen-taxonomia" value="" readonly>
            <p class="description">Imágen de la Categoría</p>
            <button id="btn-imagen-taxonomia" class="button" type="button">Añadir Imágen</button>
			<button id="btn-imagen-taxonomia-limpiar" class="button" type="button">Quitar Imágen</button>
        </div>
	<?php
    }
    
    function categoria_contenido_edit_meta_fields($term){
	$t_id = $term->term_id;
 
	$term_meta = get_option("taxonomy_$t_id");
	?>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="imagen-taxonomia">Imágen</label>
			</th>
			<td>
				<input type="text" name="_imagenPath" id="imagen-taxonomia" value="<?php echo esc_url( $term_meta ) ? esc_url( $term_meta ) : ''; ?>" readonly>
				<p class="description">Imágen de la Categoría</p>
				<button id="btn-imagen-taxonomia" class="button" type="button">Añadir Imágen</button>
				<button id="btn-imagen-taxonomia-limpiar" class="button" type="button">Quitar Imágen</button>
			
			</td>
		</tr>
	<?php
    }
    
    function categoria_contenido_save_custom_meta( $term_id ) {
        if ( isset( $_POST['_imagenPath'] ) ) {
            $t_id = $term_id;
            $term_meta = $_POST['_imagenPath'];
            
            update_option( "taxonomy_$t_id", $term_meta );
        }
    }  

}
