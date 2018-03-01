<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Webface
 */

get_header(); 
?>
<div class="col-xs-12 content">
	<div class="row">
		<div class="wrapper">
			<div class="col-xs-12 content-page col-pb">

					<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
						<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
						    <?php if(function_exists('bcn_display'))
						    {
						    	echo '<span class="title">Estas aquí:</span>';
						        bcn_display();
						    }?>
						</div>
						
						<h1><?php the_title(); ?></h1>
						<br>
						<div class="row">
                             <div class="col-md-12">
                             
                              <div class="panel panel-primary">
                                  <div class="panel-heading"></div>
                                  <div class="panel-body">
                            <div class="col-md-4 col-xs-12">
                                <div class="img-circular center-block" style="background-image: url('<?php echo has_post_thumbnail($post->ID)? get_the_post_thumbnail_url($post->ID): get_template_directory_uri().'/images/default-medium.jpg'; ?>');"></div>                         
                            </div>
                            
                            <div class="col-md-8">
                               
                                <!--<hr class="linea-azul">-->
                                
                             
                                    <?php
                                      
                                      if( !empty(get_post_meta($post->ID, '_ge_funcionario')) ){
                                        $_ge_funcionario = get_post_meta($post->ID, '_ge_funcionario'); 
                                      }
                                    ?>
                                    <table class="table">
                                      <tbody>
                                         <?php 
                                            if( !empty($_ge_funcionario[0]['cargo_departamento']) ){
                                           ?>
                                          <tr>
                                              <td><strong>Cargo directivo:</strong></td>
                                              <td><?php echo $_ge_funcionario[0]['cargo_departamento']; ?></td>
                                          </tr>   
                                        <?php     
                                            }
                                          ?>
                                          
                                          <?php 
                                            if( !empty($_ge_funcionario[0]['profesion'][0]) ){
                                           ?>
                                          <tr>
                                              <td><strong>Profesión:</strong></td>
                                              <td>
                                                 <?php
                                                  if( is_array( $_ge_funcionario[0]['profesion']) ){
                                                          echo "<ul>";
                                                          foreach($_ge_funcionario[0]['profesion'] as $profesion){
                                                              echo "<li>- ".$profesion."</li>";
                                                          }
                                                          echo "</ul>";
                                                      }
                                                ?>
                                              </td>
                                          </tr>   
                                        <?php     
                                            }
                                          ?>
                                          
                                          <?php 
                                            if( !empty($_ge_funcionario[0]['email']) ){
                                           ?>
                                          <tr>
                                              <td><strong>Email:</strong></td>
                                              <td><?php echo "<a href='mailto:".$_ge_funcionario[0]['email']."'>".$_ge_funcionario[0]['email']."</a>"; ?></td>
                                          </tr>   
                                        <?php     
                                            }
                                          ?>
        
                                         <?php 
                                            if( !empty($_ge_funcionario[0]['telefono']) ){
                                           ?>
                                          <tr>
                                              <td><strong>Fono:</strong></td>
                                              <td><?php echo $_ge_funcionario[0]['telefono']; ?></td>
                                          </tr>   
                                        <?php     
                                            }
                                          ?>
                                      </tbody>
                                    </table>
                                    
                                    
                                  </div>
                                </div>
                            </div>
                            
                            </div>
						</div><!-- FIN ROW -->
						
						<div class="row">
                           <div class="col-md-12">
                              
                               <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                  
                                  <?php
                                   $_ge_funcionario_ta = (get_post_meta($post->ID, '_ge_funcionario_ta') != null) ? get_post_meta($post->ID, '_ge_funcionario_ta') : [];
                                   if(!empty( $_ge_funcionario_ta[0]) ){  
                                    ?>       
                                       <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="ge_heading_trabajo_actualidad">
                                          <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#ge_collapse_trabajo_actualidad" aria-expanded="true" aria-controls="ge_collapse_trabajo_actualidad">
                                              <span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Actualmente trabaja en:
                                            </a>
                                          </h4>
                                        </div>
                                        <div id="ge_collapse_trabajo_actualidad" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="ge_heading_trabajo_actualidad">
                                          <div class="panel-body">
                                            <?php echo $_ge_funcionario_ta[0]; ?>
                                          </div>
                                        </div>
                                      </div>
                                    <?php  
                                   }// ACTUALMENTE TRABAJA EN
                                   ?>
                                  
                                  <?php
                                   if( !empty( wp_get_object_terms( $post->ID, 'ge_area_investigacion', array('orderby' => 'name'))) ){
                                       
                                        $_ge_funcionario_a = wp_get_object_terms( $post->ID, 'ge_area_investigacion', array('orderby' => 'name'));
                                    ?>       
                                       <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="ge_heading_ai">
                                          <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#ge_collapse_ai" aria-expanded="false" aria-controls="ge_collapse_ai">
                                              <span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Áreas de investigación
                                            </a>
                                          </h4>
                                        </div>
                                        <div id="ge_collapse_ai" class="panel-collapse collapse" role="tabpanel" aria-labelledby="ge_heading_ai">
                                          <div class="panel-body">
                                            <?php
                                                foreach($_ge_funcionario_a as $i => $tag){
                                                    if($i == 0){
                                                        echo $tag->name;
                                                    }else{
                                                       echo ", ".$tag->name;
                                                    }
                                                }
                                                //var_dump( wp_get_object_terms( $post->ID, 'ge_area_investigacion', array('orderby' => 'name')) ) ;
                                              ?>
                                          </div>
                                        </div>
                                      </div>
                                    <?php  
                                   }// Áreas de investigación
                                   ?>
                                  
                                  <?php
                                   $_ge_funcionario_p = (get_post_meta($post->ID, '_ge_funcionario_p') != null) ? get_post_meta($post->ID, '_ge_funcionario_p') : [];
                                   if(!empty( $_ge_funcionario_p[0]) ){  
                                    ?>       
                                       <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="ge_heading_proyectos">
                                          <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#ge_collapse_proyectos" aria-expanded="false" aria-controls="ge_collapse_proyectos">
                                              <span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Proyectos
                                            </a>
                                          </h4>
                                        </div>
                                        <div id="ge_collapse_proyectos" class="panel-collapse collapse" role="tabpanel" aria-labelledby="ge_heading_proyectos">
                                          <div class="panel-body">
                                            <?php echo $_ge_funcionario_p[0]; ?>
                                          </div>
                                        </div>
                                      </div>
                                    <?php  
                                   }// IF PROYECTOS
                                   ?>
                                  
                                  <?php
                                   $_ge_funcionario_pp = (get_post_meta($post->ID, '_ge_funcionario_pp') != null) ? get_post_meta($post->ID, '_ge_funcionario_pp') : [];

                                   if( !empty($_ge_funcionario_pp[0]) ){
                                       
                                    ?>       
                                       <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="ge_heading_publicaciones">
                                          <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#ge_collapse_publicaciones" aria-expanded="false" aria-controls="ge_collapse_publicaciones">
                                              <span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Publicaciones / Ponencias
                                            </a>
                                          </h4>
                                        </div>
                                        <div id="ge_collapse_publicaciones" class="panel-collapse collapse" role="tabpanel" aria-labelledby="ge_heading_publicaciones">
                                          <div class="panel-body">
                                            <?php echo $_ge_funcionario_pp[0]; ?>
                                          </div>
                                        </div>
                                      </div>
                                    <?php  
                                   }// IF PONENCIAS
                                   ?>
                                   
                                   <?php

                                   if( !empty($_ge_funcionario[0]['link-tesis']) ){  
                                    ?>       
                                       <div class="panel panel-default">
                                        <div class="panel-heading" role="tab" id="ge_heading_tesis">
                                          <h4 class="panel-title">
                                            <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#ge_collapse_tesis" aria-expanded="false" aria-controls="ge_collapse_tesis">
                                              <span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;Tesis Dirigidas
                                            </a>
                                          </h4>
                                        </div>
                                        <div id="ge_collapse_tesis" class="panel-collapse collapse" role="tabpanel" aria-labelledby="ge_heading_tesis">
                                          <div class="panel-body">
                                              <button type="button" class="btn btn-outline-primary"><strong><a target="_blank" href="<?php echo esc_url($_ge_funcionario[0]['link-tesis']) ?>">Repositorio de Tesis UBB</a></strong></button>
                                          </div>
                                        </div>
                                      </div>
                                    <?php  
                                   }// Tesis
                                   ?>
                                   
                                </div>
                                
                           </div>
                        </div>
						
						<br><br>
						

						
					
					<?php endwhile; ?>
					<?php endif; ?>   
				

			</div>


<?php
get_footer();
