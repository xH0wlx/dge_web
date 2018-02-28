<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Webface
 */

get_header(); ?>
<div class="col-xs-12 content">
	<div class="row">
		<div class="wrapper">
			<div class="col-xs-12 content-page col-pb">
				<div class="row">


					<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
						<div class="breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
						    <?php if(function_exists('bcn_display'))
						    {
						    	echo '<span class="title">Estas aquí:</span>';
						        bcn_display();
						    }?>
						</div>
						<div class="thum-page">
							<?php the_post_thumbnail( array(1200, 350), ['class' => 'img-page']  );?>
						</div>
						
						<h1><?php the_title(); ?></h1>
					<div class="col-xs-12 content-p">
						

					 	<?php the_content();?>
					</div>
					<?php endwhile; ?>
					<?php endif; ?>   
				</div>

			</div>

<?php
get_footer();
