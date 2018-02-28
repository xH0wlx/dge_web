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
                            $page = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

                            $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

                            $args = [
                                'post_type' => 'ge_descargas',
                                'paged' => $page,
                                's' => isset( $_REQUEST['search'] ) ? $_REQUEST['search'] : '',
                                'meta_key' => '_ge_descarga_titulo',
                                'orderby' => 'meta_value',
                                'order' => 'ASC',
                                'tax_query' => [
                                                [
                                                    'taxonomy' => $term->taxonomy,
                                                    'field'    => 'slug',
                                                    'terms'    => $term->slug,
                                                ]
                                               ],
                            ];
                            $wp_query = new WP_Query( $args );
                
							if ( have_posts() ) : ?>
                            
							    <h1><?php 
                                    $titulo =  mb_strtolower(single_term_title('', false), 'UTF-8');
                                    echo $titulo;
                                    ?>
                                </h1>
                                
                                <form role="search" action="" method="GET"> 
                                  <div class="row">
                                    <div class="col-xs-12 col-md-3  col-md-offset-9">
                                      <div class="input-group">
                                   <input type="text" class="form-control" placeholder="Búsqueda de <?php echo $titulo; ?>" name="search" id="ge_search" value="<?php echo isset( $_REQUEST['search'] ) ? $_REQUEST['search'] : ''; ?>"/>
                                   <input type='hidden' name='paged' value='1'>
                                   <div class="input-group-btn">
                                        <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                        </button>
                                   </div>
                                   </div>
                                    </div>
                                  </div>
                                </form>                                
                                
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
                                      if( !empty(get_post_meta($post->ID, '_ge_descarga_enlace')) ){
                                        $_ge_descarga_enlace = get_post_meta($post->ID, '_ge_descarga_enlace', true); 
                                      }
                                      if( !empty(get_post_meta($post->ID, '_ge_descarga_titulo')) ){
                                        $_ge_descarga_titulo = get_post_meta($post->ID, '_ge_descarga_titulo', true); 
                                      }
                                      if( !empty(get_post_meta($post->ID, '_ge_descarga_peso')) ){
                                        $_ge_descarga_peso = get_post_meta($post->ID, '_ge_descarga_peso', true); 
                                      }
                                      if( !empty(get_post_meta($post->ID, '_ge_descarga_icono')) ){
                                        $_ge_descarga_icono = get_post_meta($post->ID, '_ge_descarga_icono', true); 
                                      }
                                      if( !empty(get_post_meta($post->ID, '_ge_descarga_fecha')) ){
                                        $_ge_descarga_fecha = get_post_meta($post->ID, '_ge_descarga_fecha', true); 
                                      }
                                    ?>
							        <div class="col-sm-12 col-md-6 structure-box">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <div class="row thum">
                                                    <?php if ( has_post_thumbnail() ) {
                                                    the_post_thumbnail('thumbnail', array('class' => 'structure-thum' ));
                                                }
                                                else {
                                                    echo '<img class="structure-thum" src="' . $_ge_descarga_icono.'" />';
                                                } ?>
                                                </div>
                                            </div>
                                            <div class="col-xs-9">
                                                <div class="row text">
                                                   
                                                    <br><br>
    
                                                    <strong><?php echo !empty(get_the_title())? get_the_title(): "";?></strong>                                
                                            
                                                    <br><br>                                               
                                                    
                                                    <a href="<?php echo $_ge_descarga_enlace; ?>" class="btn btn-primary btn-block text-white" role="button" target="_blank"><i class="fa fa-download" aria-hidden="true"></i>&nbsp;&nbsp;Descargar (<?php echo $_ge_descarga_peso; ?>)</a>
                        
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
								<h1>Lo sentimos, no se encontraron descargas con el criterio buscado.</h1>
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


