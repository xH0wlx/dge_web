<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Webface
 */

get_header(); ?>

<div class="col-xs-12 content">
	<div class="row">
		<div class="wrapper">
			<div class="col-xs-12 content-page structure col-pb">
				<div class="row">
					<h1 class="page-title"><?php esc_html_e( 'Uups! La página solicitada no existe.', 'webface' ); ?></h1>

				</div>
			</div>

<?php
get_footer();
