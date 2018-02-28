<?php
/**
 * Template Name: Plantilla-personal-administrativo
 *
 * @Face
 * @
 */

get_header(); 
?>

<div class="col-xs-12 content">
	<div class="row">
		<div class="wrapper">
			<div class="col-xs-12 content-page structure col-pb">
				<div class="row">
					<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
					    <?php if(function_exists('bcn_display'))
					    {
					    	echo '<span class="title">Estas aquí:</span>';
					        bcn_display();
					    }?>
					</div>
				<h1>
					Personal Administrativo
				</h1>
				<?php $args=array(
					'taxonomy' => 'departamento',
					'term' => 'per-adm',
					'post_type' => 'estructura',
					'orderby'          => 'title',
					'order'            => 'ASC',
					'posts_per_page' => 100
					);
					$comments = new WP_Query($args);
				    if($comments->have_posts()) : while($comments->have_posts()) :
					$comments->the_post(); ?>
						<div class="col-sm-12 col-md-6 structure-box">
							<div class="row">
								<div class="col-xs-3">
									<div class="row thum">
										<?php if ( has_post_thumbnail() ) {
									    the_post_thumbnail('thumbnail', array('class' => 'structure-thum' ));
									}
									else {
									    echo '<img class="structure-thum" src="' . get_bloginfo( 'stylesheet_directory' ) 
									        . '/images/default/thumbnail.jpg" />';
									} ?>
									</div>
								</div>
								<div class="col-xs-9">
									<div class="row text">
										<strong><?php the_title(); ?></strong>
										<?php the_content(); ?>
									</div>
								</div>
							</div>
						</div>
					<?php endwhile; endif; ?>
			  	<?php wp_reset_query(); // end Fan Cooments loop. ?>
			</div>
		</div>

<?php get_footer(); ?>