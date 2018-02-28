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
                                'post_type' => 'ge_funcionarios',
                                'paged' => $page,
                                's' => isset( $_REQUEST['search'] ) ? $_REQUEST['search'] : '',
                                'meta_key' => '_ge_funcionario_jerarquia',
                                'orderby' => 'meta_value_num',
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
                                      if( !empty(get_post_meta($post->ID, '_ge_funcionario')) ){
                                        $_ge_funcionario = get_post_meta($post->ID, '_ge_funcionario'); 
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
                                                    echo '<img class="structure-thum" src="' . get_template_directory_uri()."/images/default-medium.jpg".'"/>';
                                                } ?>
                                                </div>
                                            </div>
                                            <div class="col-xs-9">
                                                <div class="row text">
                                                   
                                                    <?php if($titulo == "directivos"){ ?>
                                                    <h5><?php echo !empty($_ge_funcionario[0]['cargo_departamento'])? $_ge_funcionario[0]['cargo_departamento']: "";?></h5>
                                                    <?php } ?>
    
                                                    <strong><?php echo !empty(get_the_title())? get_the_title(): "";?></strong>
                                                    <br>
                                                      <?php
                                                          if( is_array( $_ge_funcionario[0]['profesion']) ){
                                                                  echo "<ul>";
                                                                  foreach($_ge_funcionario[0]['profesion'] as $profesion){
                                                                      echo "<li>".$profesion."</li>";
                                                                  }
                                                                  echo "</ul>";
                                                              }else{
                                                                  echo $_ge_funcionario[0]['profesion'];
                                                              }
                                                        ?>
                                                    
                                                        <?php echo !empty($_ge_funcionario[0]['email'])? "<a href='mailto:".$_ge_funcionario[0]['email']."'>".$_ge_funcionario[0]['email']."</a>": "";?>
                                                         / 
                                                        <?php echo !empty($_ge_funcionario[0]['telefono'])? $_ge_funcionario[0]['telefono']: "";?>
                                                    <br><br>
                                                    
                                                    <?php
                                                        if($titulo == "académicos"){
                                                            echo '<a href="'.get_the_permalink().'" class="btn btn-primary btn-block text-white" role="button">Más Información</a>';

                                                        }
                                                    ?>
                        
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
								<h1>Lo sentimos, no se encontraron funcionarios con el criterio buscado.</h1>
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


