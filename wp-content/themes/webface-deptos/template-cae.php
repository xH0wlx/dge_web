<?php
/**
 * Template Name: Plantilla CAE
 *
 * @Face
 * @
 */

get_header(); 
?>
<div class="col-xs-12 content">
  <div class="row">
    <div class="wrapper">
      <div class="col-xs-12 content-page col-pb">
        <div class="row">
          <div class="thum-page">
            <img class="img-page" style="width: 100%; height: auto" src="<?php echo get_template_directory_uri(); ?>/images/cae-face.jpg">
          </div>
          <?php /*breadcumbs*/;?>
          <div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
              <?php if(function_exists('bcn_display'))
              {
                echo '<span class="title">Estas aquí:</span>';
                  bcn_display();
              }?>
          </div>
          <?php /*breadcumbs*/;?>
            <?php /*content cae*/;?>
            <h1><?php the_title(); ?></h1>
            <div class="col-xs-12 content-p">
            	<h3>Objetivo:</h3>
              <p>El objetivo principal es contribuir al desarrollo de la región del Biobío, por medio de la vinculación de las actividades académicas de las distintas carreras que componen la facultad con las instituciones tanto públicas como privadas; que integran el Comité. Generando en este contexto, la retroalimenación del conocimiento e inserción en la realidad nacional y regional.</p>
              <h3>Integrantes: </h3>
              <p>Los integrantes de este Comité corresponden a representantes de Empresas Privadas, Instituciones Públicas, Fundaciones Sociales y Titulados de nuestra Facultad.</p>
                <h4>Estos son: </h4>
                <?php /*members cae*/;?>
                <div class="col-xs-12">
                  <div class="row col-pb">
                    <div class="members">
                       <div class="box">
                        <i class="fa fa-user" aria-hidden="true"></i> <span class="title-members">Pablo Passeron</span>, Gerente General, TTPSA .
                        </div>
                        <div class="box">
                          <i class="fa fa-user" aria-hidden="true"></i> <span class="title-members">Gustavo Toledo</span>, Gerente, Fidem Consultores. 
                        </div>
                        <div class="box">
                          <i class="fa fa-user" aria-hidden="true"></i> <span class="title-members">Rodrigo Muñoz</span>, Gerente Tienda, Sodimac S.A. 
                        </div> 
                        <div class="box">
                          <i class="fa fa-user" aria-hidden="true"></i> <span class="title-members">Erna Ugarte</span>, Directora Ejecutiva, Fundación Trabaja Por Un Hermano. 
                        </div>
                        <div class="box">
                          <i class="fa fa-user" aria-hidden="true"></i> <span class="title-members">Patricio Loaiza</span>, Jefe de Personal, Orafti .
                        </div>
                        <div class="box">
                          <i class="fa fa-user" aria-hidden="true"></i> <span class="title-members">Héctor Acuña</span>, Coordinador, Techo Para Chile. 
                        </div> 
                        <div class="box">
                          <i class="fa fa-user" aria-hidden="true"></i> <span class="title-members">Juan Ramírez</span>, Presidente, corñuble. 
                        </div>
                        <div class="box">
                          <i class="fa fa-user" aria-hidden="true"></i> <span class="title-members">Leonardo Ilabaca</span>, Auditor, Independiente. 
                        </div>
                        <div class="box">
                          <i class="fa fa-user" aria-hidden="true"></i> <span class="title-members">José Castro Reyes</span>, Asistente Social, Municipalidad San Pedro de La Paz. 
                        </div>
                        <div class="box">
                          <i class="fa fa-user" aria-hidden="true"></i> <span class="title-members">Carlos Aránguiz</span>, Gerente de Desarrollo y Concesiones, Puerto Talcahuano. 
                        </div>
                        <div class="box">
                          <i class="fa fa-user" aria-hidden="true"></i> <span class="title-members">Sergio Giacaman</span>, Subgerente de Relaciones con la Comunidad y RSE, Essbio. 
                        </div>
                        <div class="box">
                          <i class="fa fa-user" aria-hidden="true"></i> <span class="title-members">Felix Perera</span>, Gerente, A.G. PROTUR. 
                        </div>
                        <div class="box">
                          <i class="fa fa-user" aria-hidden="true"></i> <span class="title-members">Andrés Puente</span>, Subgerente de Informática, Essbio. 
                        </div>
                        <div class="box">
                          <i class="fa fa-user" aria-hidden="true"></i> <span class="title-members">Alfonso Zambrano</span>, Socio Fundador, Ávila y Zambrano Consultores. 
                        </div>
                        <div class="box" data-toggle="collapse" data-target="#info03">
                          <i class="fa fa-user" aria-hidden="true"></i> <span class="title-members">Esteban Jeréz</span>, Gerente General, Horizonte Sur. 
                        </div> 
                        <div class="box">
                          <i class="fa fa-user" aria-hidden="true"></i> <span class="title-members">Alejandro Lama</span>, Presidente, Cámara de Comercio, Industria, Turismo y servicios de Chillán-Ñuble A.G. 
                        </div>
                        <div class="box">
                          <i class="fa fa-user" aria-hidden="true"></i> <span class="title-members">Juan Señor</span>, Seremi Hacienda, Ministerio de Hacienda. 
                        </div>
                      </div><!--members-->
                    </div>
                  </div>
                  <?php /*members cae*/;?>
                  <hr>
                  <p>Las líneas de trabajo que se abordan en el trabajo semestral del Comité, son las siguientes:</p>
                  <p class="title-list"><strong>Línea Responsabilidad Social </strong></p>
                    <ul class="list list_tick">
                      <li>Sustentabilidad</li>
                    </ul>

                    <p class="title-list"><strong>Línea Gestión Académica </strong></p>
                    <ul class="list list_tick">
                      <li>Renovación Curricular.</li>
                      <li>Centralización del capital humano.</li>
                      <li>Contenidos de empresas en mallas de la Universidad.</li>
                    </ul>

                    <p class="title-list"><strong>Línea Investigación e Innovación</strong></p>
                    <ul class="list list_tick">
                      <li>Investigaciones.</li> 
                      <li>Gestión de innovación.</li>
                      <li>Empresas Piloto.</li>
                    </ul>
                    <p class="title-list"><strong>Línea Extensión Académica </strong></p>
                    <ul class="list list_tick">
                      <li>Extensión a partir de las necesidades de la comunidad y la articulación con socios estratégicos.</li>
                    </ul>

                    <p class="title-list"><strong>Línea Posicionamiento FACE</strong></p>
                    <ul class="list list_tick">
                      <li>Vinculación con el Medio.</li>
                    </ul>
                    <style type="text/css">
                      .members i {padding-right: 10px}
                    </style>
                  <?php /*noticias cae*/;?>
                  <div class="col-xs-12 notices-page col-pb">
                    <div class="row">
                      <h3>NOTICIAS:</h3>
                      <div class="col-xs-12">
                        <div class="row">
                          <?php $args=array(
                          'post_type' => 'post',
                          'category_name' => 'cae',
                          'posts_per_page' => 100
                          );
                          $comments = new WP_Query($args);
                            if($comments->have_posts()) : while($comments->have_posts()) :
                          $comments->the_post(); ?>
                              <?php /*contenido noticias*/;?>
                                  <div class="col-xs-12">
                                <div class="row box">
                                  <a href="<?php the_permalink(); ?>" rel="bookmark">
                                  <div class="col-xs-12 col-sm-4 text-center thum" style="background-image: url(<?php 
                                    if (has_post_thumbnail()) { 
                                      $thum = get_the_post_thumbnail_url();
                                      if ($thum == !false ) {
                                        the_post_thumbnail_url('large');
                                      }
                                      else {
                                        echo get_template_directory_uri().'/images/default-medium.jpg';
                                      }
                                    }
                                    else {
                                      echo get_template_directory_uri().'/images/default-medium.jpg';
                                    }; 
                                    ?>)">
                                    <div class="row">
                                      <span class="meta-category">
                                        <i class="fa fa-tag" aria-hidden="true"></i> 
                                        <?php $cats=get_the_category(); foreach ($cats as $cat) { echo $cat->name; if (count($cats)>=2) { echo ", ";}};?>
                                      </span>
                                    </div>
                                  </div>
                                  </a>
                                  <div class="col-xs-12 col-sm-8 text">
                                    <div class="meta">
                                      <span class="meta-date">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_the_date('l d, F, Y'); ?>
                                      </span>
                                    </div>
                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                      <div class="title"><?php the_title(); ?></div>
                                    </a>
                                    <div style="text-align:justify"><?php the_excerpt(); ?></div>
                                  </div>
                                </div>
                              </div>
                            <?php endwhile;?>
                          <?php else: ?>
                            Sin noticias.
                          <?php endif;?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php /*noticias cae*/;?>
                </div>
              </div>
            </div>
<?php get_footer(); ?>