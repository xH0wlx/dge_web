<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Webface
 */

get_header(); ?>

<div class="col-xs-12 content">
	<div class="row">
		<div class="wrapper">
			<div class="col-xs-12 content-page notices-page col-pb">
				<div class="row">
					<?php /*breadcumbs*/;?>
					<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
					    <?php if(function_exists('bcn_display'))
					    {
					    	echo '<span class="title">Estas aquí:</span>';
					        bcn_display();
					    }?>
					</div>
					<?php /*breadcumbs*/;?>
					<?php /*noticias*/;?>
					<div class="col-xs-12 col-sm-9">
						<div class="row">
							<?php
							if ( have_posts() ) : ?>
								<?php the_archive_title( '<h1 class="page-title">', '</h1>' );?>
								<?php while ( have_posts() ) : the_post(); ?>
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
								<h1>Lo sentimos, no se encontraron articulos para el mes seleccionado</h1>
							<?php endif;?>
							<?php /*pagination plugin wp_pagenavi*/;?>
								<div class="col-xs-12 text-center">
									<?php wp_pagenavi();?>
								</div>
							<?php /*pagination plugin wp_pagenavi*/;?>
						</div>
					</div>
					<?php /*noticias*/;?>
					<?php /*sidebar*/;?>
					<div class="col-xs-12 col-sm-3">
						<div class="row sidebar">
							<?php get_sidebar(); ?>
						</div>
					</div>
					<?php /*sidebar*/;?>
				</div>
			</div>
<?php
get_footer();


