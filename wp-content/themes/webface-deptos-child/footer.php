<?php
/**
 * The template for displaying the footer
 * @package Webface
 */
?>
			<?php /*links face footer¨*/; ?>
			<div class="col-xs-12 links-face expanded-links-face">
				<div class="row boxorange">
					<a target="blank" href="http://ubiobio.cl">
						<div class="col-xs-12 col-sm-4 col-md-2 col-md-offset-1 box text-center">
							<i class="fa fa-globe fa-3x" aria-hidden="true"></i>
							<p>UNIVERSIDAD DEL BÍO-BÍO</p>
						</div>
					</a>
					<a target="blank" href="http://asface.ubiobio.cl/w/">
						<div class="col-xs-12 col-sm-4 col-md-2 box text-center">
							<i class="fa fa-leanpub" aria-hidden="true"></i>
							<p>APRENDIZAJE SERVICIO</p>
						</div>
					</a>
					<a target="blank" href="http://observatoriolaboralnuble.cl/">
						<div class="col-xs-12 col-sm-4 col-md-2 box text-center">
							<i class="fa fa-pie-chart" aria-hidden="true"></i>
							<p>OBSERVATORIO LABORAL ÑUBLE</p>
						</div>
					</a>
					<a target="blank" href="http://tributaria.face.ubiobio.cl">
						<div class="col-xs-12 col-sm-4 col-md-2 box text-center">
							<i class="fa fa-tree" aria-hidden="true"></i>
							<p>CENTRO AGRONEGOCIOS</p>
						</div>
					</a>
					<!--
					<a target="blank" href="http://etica.face.ubiobio.cl">
						<div class="col-xs-12 col-sm-4 col-md-2 box text-center">
							<i class="fa fa-male" aria-hidden="true"></i>
							<p>PROGRAMA DE ÉTICA</p>
						</div>
					</a>
					-->
					<a class="a-collapse rotate-arrow" data-toggle="collapse" data-target="#menu-vinculacion">
						<div class="col-xs-12 col-sm-4 col-md-2 box text-center">
							<i class="fa fa-handshake-o" aria-hidden="true"></i>
							<p>VINCULACIÓN FACE</p><i class="visible-xs-inline pull-right fa fa-caret-down"></i>
                            <div class="col-sm-12 hidden-xs">
                                <div class="down-arrow-corregida rotate-arrow" data-toggle="collapse" data-target="#menu-vinculacion"></div>   
                            </div>
						</div>
					</a>
				</div>
			</div>
			<!-- <div class="col-xs-12"><div class="down-arrow rotate-arrow" data-toggle="collapse" data-target="#menu-vinculacion"></div></div> -->
			<div id="menu-vinculacion" class="col-xs-12 collapse compact-links-face">
				<div class="row">
					<div class="col-xs-12 content-box">
						<div class="row">
							<a href="<?php echo get_site_url(); ?>/index.php/category/titulados">
								<div class="col-xs-12 col-sm-4 col-md-2 box text-center">
									<i class="fa fa-certificate" aria-hidden="true"></i> TITULADOS
								</div>
							</a>
							<a href="<?php echo get_site_url(); ?>/index.php/vinculacion-empresas">
								<div class="col-xs-12 col-sm-4 col-md-2 box text-center">
									<i class="fa fa-building" aria-hidden="true"></i> VINCULACIÓN EMPRESAS
								</div>
							</a>
							<a href="<?php echo get_site_url(); ?>/index.php/comite-asesor-externo-cae">
								<div class="col-xs-12 col-sm-4 col-md-2 box text-center">
									<i class="fa fa-external-link-square" aria-hidden="true"></i> COMITÉ ASESOR EXTERNO
								</div>
							</a>
							<a target="blank" href="https://vinculacion.face.ubiobio.cl/">
								<div class="col-xs-12 col-sm-4 col-md-2 box text-center">
									<i class="fa fa-star-o" aria-hidden="true"></i> PORTAL VINCULACIÓN
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>
			<?php /*links face footer¨*/; ?>
			<?php /*footer¨*/; ?>
			<footer class="site-footer">
				<div class="col-xs-12 footer">
					<div class="row">
						<?php /*sidebar left*/; ?>
						<div class="col-xs-12 col-sm-4 widget-footer footer-left">
							<?php
							if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Left') ) : ?>
							<?php endif; ?>
						</div>
						<?php /*sidebar center*/; ?>
						<div class="col-xs-12 col-sm-4 widget-footer footer-center">
							<?php
							if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Center') ) : ?>
							<?php endif; ?>
						</div>
						<?php /*sidebar right*/; ?>
						<div class="col-xs-12 col-sm-4 widget-footer footer-right">
							<?php
							if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Right') ) : ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php /*sidebar sellos*/; ?>
				<div class="col-xs-12 sellos footer text-center col-pb" style="margin-top: 1px; padding: 15px">
					<?php
					if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Sellos') ) : ?>
					<?php endif; ?>
				</div>
				<?php /*copyright*/; ?>
				<div class="col-xs-12 copyright text-center">
				ALGUNOS DERECHOS RESERVADOS <strong><i class="fa fa-copyright" aria-hidden="true"></i> 1989 - 2017 FACULTAD DE CIENCIAS EMPRESARIALES - UNIVERSIDAD DEL BÍO-BÍO</strong>
				</div>
			</footer>
			<?php /*footer¨*/; ?>
		</div>
	</div>
</div>
<span class="button-up"><i class="fa fa-arrow-up fa-2x" aria-hidden="true"></i></span>
<script type="text/javascript">
	$(document).ready(function(){
 
	$('.button-up').click(function(){
		$('body, html').animate({
			scrollTop: '0px'
		}, 300);
	});
 
	$(window).scroll(function(){
		if( $(this).scrollTop() > 0 ){
			$('.button-up').slideDown(300);
		} else {
			$('.button-up').slideUp(300);
		}
	});
 
});
</script>
<?php wp_footer(); ?>
<script type="text/javascript">
$(document).ready(function(){
	$('.rotate-arrow').click(function(e ) {
		if ($('#menu-vinculacion').hasClass( "in")) {
        	$('.down-arrow-corregida').addClass('rotate-arrow');
        }
    	else {
        	$('.down-arrow-corregida').removeClass('rotate-arrow');
    	}
	});
});
</script>
</body>
</html>
