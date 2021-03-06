<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Webface
 */

get_header();

?>
<div class="col-xs-12 content">
	<div class="row">
		<div class="wrapper">
			<div class="col-xs-12 content-page structure col-pb">
				
					<?php /*breadcumbs*/;?>
					<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
					    <?php if(function_exists('bcn_display'))
					    {
					    	echo '<span class="title">Estas aquí:</span>';
					        bcn_display();
					    }?>
					</div>
		
				      		<?php
                
                            $metaKeyContenidoAnio = '_ge_contenido_anio';
  
                            $page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

                            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
                
                            if( !isset( $_REQUEST['anioproyecto'] ) && !isset( $_REQUEST['subterm'] ) && !get_query_var( 'paged' ) ){       
                                //MUESTRA INICIAL
                                $args = array(
                                    'parent' => $term->term_id,
                                    'fields' => 'ids',
                                    'hide_empty' => true
                                );

                                $proyectoTaxonomy = $term->taxonomy;

                                $hijosTermIdes = get_terms($proyectoTaxonomy, $args) ;

                                $maxValueYearProyectos = _get_max_meta_value_by_terms_id($metaKeyContenidoAnio, $hijosTermIdes);
        
                                $anioPrimerPagina = $maxValueYearProyectos;
                            }else{
                                $anioPrimerPagina = '';
                            }
                
                            $args = [
                                'post_type' => 'ge_contenidos',
                                'paged' => $page,
                                //'posts_per_page' => get_query_var('posts_per_page'),
                                'meta_key' => $metaKeyContenidoAnio,
                                'meta_value' => !empty( $_REQUEST['anioproyecto'] ) ? $_REQUEST['anioproyecto'] : $anioPrimerPagina,
                                'meta_compare' => '=',
                                'orderby' => 'meta_value_num',
                                'order' => 'DESC',
                                'tax_query' => [
                                                [
                                                    'taxonomy' => $term->taxonomy,
                                                    'field'    => 'slug',
                                                    'terms'    => !empty( $_REQUEST['subterm'] ) ? $_REQUEST['subterm'] : $term->slug,//$term->slug,
                                                ]
                                               ],
                            ];
                            
                            $wp_query = new WP_Query( $args );
                
							if ( have_posts() ) : ?>
                            
							    <h1><?php echo mb_strtolower($term->slug, 'UTF-8'); ?></h1>
                                
                                <?php 
                
                                    $args = array(
                                        'parent' => $term->term_id,
                                        'fields' => 'all',
                                        'hide_empty' => true
                                    );
               
                                    $hijosTerm = get_terms($term->taxonomy, $args) ;
                                    
                                    $aniosProyectos = _get_all_meta_values_distinct_by_category_id($metaKeyContenidoAnio, $term->term_id);
                
                                ?>
                                
                                <div class="panel panel-info">
                                  <!--<div class="panel-heading">Filtro</div>-->
                                  <div class="panel-body">
                                      <form role="search" action="" method="GET"> 
                                          <div class="row">
                                           <div class="col-xs-12 col-md-3">
                                               <div class="form-group">
                                                   <label for="anio-proyecto">Año:</label>
                                                   <select id="anio-proyecto" name="anioproyecto" class="form-control form-control-reset">
                                                      <option value=""  >-- Todos --</option>
                                                         <?php
                                                            foreach($aniosProyectos as $anio){
                                                                $anioSelected = isset($_REQUEST['anioproyecto'])? $_REQUEST['anioproyecto'] : $anioPrimerPagina;
                                                          ?>
                                                              <option value="<?php echo $anio; ?>" <?php selected( $anioSelected, $anio ); ?> ><?php echo $anio; ?></option>
                                                        <?php  
                                                            }
                                                          ?>
                                                    </select>
                                               </div>
                                           </div>
                                          <div class="col-xs-12 col-md-3">
                                             <div class="form-group">
                                                    <label for="subcategoria">Tipo:</label>
                                                     <select id="subcategoria" name="subterm" class="form-control form-control-reset">
                                                      <option value="" >-- Todas --</option>
                                                         <?php
                                                            foreach($hijosTerm as $term){
                                                          ?>
                                                              <option value="<?php echo $term->slug; ?>" <?php selected( $_REQUEST['subterm'], $term->slug ); ?> ><?php echo $term->name; ?></option>
                                                         <?php  
                                                            }
                                                          ?>
                                                      </select>
                                             </div>
                                              
                                          </div>
                                           <div class="col-xs-12 col-md-2">
                                                  <div class="form-group">
                                                       <label for="boton-formulario">&nbsp;</label>
                                                        <button id="boton-formulario" class="btn btn-primary btn-block" type="submit">
                                                    <i class="fa fa-search" aria-hidden="true"></i> Filtrar
                                                    </button>
                                                   </div>
                                            </div>
                                            
                                            <input type='hidden' name='paged' value='1'>

                                          </div>
                                       </form>
                                  </div>
                                </div>                              
                                
                                <?php 
                                    $i=1;
                                    $cantPost = $wp_query->post_count;  
                                    if($cantPost % 2 == 0){
                                        $impar = false;
                                    }else{
                                        $impar = true;
                                    }
                                ?>
								<?php while ( have_posts() ) : the_post(); ?>
                                    
                                    <?php 
                                        if( $i == 1 ){
                                                echo '<div class="row">';
                                        }
                                    ?>

									<?php
                                      if( !empty(get_post_meta($post->ID, $metaKeyContenidoAnio)) ){
                                        $_ge_contenido_anio = get_post_meta($post->ID, $metaKeyContenidoAnio); 
                                      }
                                    ?>
							        <div class="col-sm-12 col-md-6 structure-box" style="min-height: 0px;">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <div class="row thum">
                                                <?php 
                                                
                                                $subcategorias = wp_get_post_terms( get_the_ID(),'ge_categoria_contenidos', array('order' => 'ASC', 'fields' => 'all')) ;

                                                if ( !empty($subcategorias) ) {
                                                    $ultimaCategoriaPathImagen = '';
                                                    foreach($subcategorias as $subcategoria){
                                                            if($subcategoria->parent != 0){
                                                                $ultimaCategoriaPathImagen = get_option("taxonomy_$subcategoria->term_id");
                                                            }
                                                    }
                                                    $ultimaCategoriaPathImagen = ($ultimaCategoriaPathImagen == '') ? 
                                                        get_template_directory_uri()."/images/default-medium.jpg": $ultimaCategoriaPathImagen;
                                                    
                                                    echo '<img class="structure-thum" src="' . $ultimaCategoriaPathImagen .'"/>';
                                                }
                                                else {
                                                    echo '<img class="structure-thum" src="' . get_template_directory_uri()."/images/default-medium.jpg".'"/>';
                                                } ?>
                                                </div>
                                            </div>
                                            <div class="col-xs-9">
                                                <div class="row text">
                                                    <?php
                                                                                    
                                                        foreach($subcategorias as $subcategoria){
                                                            if($subcategoria->parent != 0){
                                                                echo $subcategoria->name."<br>";
                                                            }
                                                        } 
                                                       
                                                        echo "Año ";
                                                        echo !empty($_ge_contenido_anio[0])? $_ge_contenido_anio[0]: "";
                                                        echo "<br>";
                                                    ?>
                                                    <br>
                                                    
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <?php
                                                        echo '<a href="'.get_the_permalink().'" class="btn btn-primary btn-block text-white" role="button">Detalle&nbsp;&nbsp;<i class="fa fa-caret-right"></i></a>';
                                                    ?>
                                                        </div>
                                                    </div>
                                                    
                        
                                                </div>                                           
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php
                                    if( $i % 2 == 0 ){
                                        if($cantPost == $i ){
                                           echo '</div>'; 
                                        }else{
                                           echo '</div><div class="row">';
                                        }
                                     }
                                    if( $impar &&  ($cantPost == $i) ){
                                        echo "</div>";
                                    }
                                    $i++;
                                    ?>
                                    
								<?php endwhile;?>
							<?php else: ?>
								<h1>Lo sentimos, no se encontraron proyectos con el criterio buscado.</h1>
							<?php endif;?>
							
						
							<?php /*pagination plugin wp_pagenavi*/;?>
								<div class="col-xs-12 text-center">
									<?php if ( function_exists('wp_pagenavi') ){
                                        wp_pagenavi();
                                      }?>
								</div>
							<?php /*pagination plugin wp_pagenavi*/;?>
			</div><!-- FINAL CONTENT-PAGE STRUCTURE COL-PB -->
			<!-- no debe cerrarse el wrapper -->
			
        
<?php
get_footer();


