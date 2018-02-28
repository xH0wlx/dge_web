<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Webface
 */

get_header(); ?>

<div class="col-xs-12 content">
	<div class="row">
		<div class="wrapper">
			<div class="col-xs-12 content-page notices-page col-pb">
				<div class="row">
					<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
					    <?php if(function_exists('bcn_display'))
					    {
					    	echo '<span class="title">Estas aquí:</span>';
					        bcn_display();
					    }?>
					</div>
					<div class="col-xs-12 col-sm-9">
						<div class="row">
							<?php
							if ( have_posts() ) : ?>
								<h1 class="page-title"><?php printf( esc_html__( 'Resultados para: %s', 'webface' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
								<?php while ( have_posts() ) : the_post(); ?>
									<a href="<?php the_permalink(); ?>" rel="bookmark">
										<div class="col-xs-12">
											<div class="row box">
												<div class="col-xs-12 col-sm-3 text-center">
													<div class="row thum">
														<?php if ( has_post_thumbnail() ) {
											    the_post_thumbnail('medium', array('class' => 'thum' ));
											}
											else {
											    echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) 
											        . '/images/default/medium.jpg" />';
											} ?>
													</div>
												</div>
												<div class="col-xs-12 col-sm-9 text">
													<div class="meta"><?php the_date(); ?></div>
													<div class="title"><?php the_title(); ?></div>
													<?php the_excerpt(); ?>
												</div>
											</div>
										</div>
									</a>
								<?php endwhile;?>
							<?php else: ?>
								<h1 class="page-title"><?php printf( esc_html__( 'No se encontraron resultados para: %s', 'webface' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
							<?php endif;?>
							<div class="col-xs-12">
								<div class="row">
									<?php if (function_exists("wp_bs_pagination"))
								    {
								         //wp_bs_pagination($the_query->max_num_pages);
								         wp_bs_pagination();
									}
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-12 col-sm-3">
						<div class="row sidebar">
							<?php get_sidebar(); ?>
						</div>
					</div>
				</div>
			</div>
<?php
get_footer();
