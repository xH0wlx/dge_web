<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Webface
 */
get_header(); ?>
<div class="col-xs-12 content">
	<div class="row">
		<div class="wrapper">
			<div class="col-xs-12 slider col-pb">
				<div class="row">
					<?php echo do_shortcode("[recent_post_slider design='design-1' category='noticias' limit='5' show_author='false' show_read_more='false' show_category_name='false' show_content='false' show_date='true' dots='false']"); ?>
				</div>
			</div>
			<?php /*news*/;?>
			<div class="col-xs-12 notices col-pb">
				<div class="row">
					<?php $args=array(
						'post_type' => 'post',
						'category_name' => 'noticias',
						'posts_per_page' => 3
						);
						$comments = new WP_Query($args);
					    if($comments->have_posts()) : while($comments->have_posts()) :
						$comments->the_post(); ?>
						<a href="<?php the_permalink(); ?>" rel="bookmark">
							<article class="col-xs-12 col-sm-4 box bd-r" itemscope itemtype="https://schema.org/BlogPosting">
							<meta itemprop="url" content="<?php the_permalink(); ?>">
							<meta itemprop="author" content="Facultad de ciencias empresariales">
							<span itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
								<meta itemprop="name" content="Facultad de ciencias empresariales">
						        <span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
						            <meta itemprop="url" content="<?php echo get_template_directory_uri(); ?>/images/logo.png">

						        </span>
							</span>
								<div class="row">
									<div class="col-xs-12 thum" style="background-image: url(<?php if ( has_post_thumbnail() ) { echo the_post_thumbnail_url( $medium );} else { echo '' . get_bloginfo( 'stylesheet_directory' ). '/images/default/medium.jpg" />'; } ?>)">
										<div class="row">
											<figure itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
											<meta itemprop="width" content="400">
											<meta itemprop="height" content="300">
											</figure>
											<span class="meta-category">
												<i class="fa fa-tag" aria-hidden="true"></i> 
												<?php $cats=get_the_category(); foreach ($cats as $cat) { echo $cat->name; if (count($cats)>=2) { echo ", ";}};?>
											</span>
										</div>
									</div>
										<div class="col-xs-12 text">
										<div class="row">
											<div class="meta"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_the_date('l d, F, Y'); ?></div>
											<meta  itemprop="datePublished" content="<?php echo get_the_date('Y-m-d'); ?>">
											<div itemprop="name headline"><?php the_title(); ?></div>
										</div>
									</div>
								</div>
							</article>
						</a>
					<?php endwhile; endif; ?>
  					<?php wp_reset_query(); // end Fan Cooments loop. ?>
				</div>
			</div>
			<?php /*news*/;?>
<?php get_footer();
