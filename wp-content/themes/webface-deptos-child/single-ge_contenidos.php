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
                             <div class="col-xs-12 content-p">
                                <?php the_content(); ?>
                            </div>
						</div><!-- FIN ROW -->
						
						
					
					<?php endwhile; ?>
					<?php endif; ?>   
				

			</div>


<?php
get_footer();
