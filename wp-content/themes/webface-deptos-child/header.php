<?php
/**
 * @package Webface
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="theme-color" content="#0040b0" />
<meta name="description" content="Sitio web Facultad de Ciencias Empresariales - Universidad del Bío-Bío." />
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Kelly+Slab" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
<script type="text/javascript">
</script>
</head>
<body <?php body_class(); ?>>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'webface' ); ?></a>
	<?php /*header*/;?>
	<header id="masthead" class="site-header col-pb" itemscope itemtype="https://schema.org/Organization">
	<meta itemprop="name" content="Facultad de ciencias empresariales">
		<div class="content-top col-sm-12">
			<div class="row">
				<div class="wrapper top">
					<div class="col-sm-12">
						<div class="row">
							<?php /*menu top*/;?>
							<div class="col-sm-7 col-lg-9 text-right">
								<div class="menu-top">
									<ul>
									<li>
										<div class="dropdown">
										   <a class="dropdown-toggle" id="menu1" data-toggle="dropdown" >LINK DE ÍNTERES</a>
										    <span class="caret"></span>
										    <ul class="top-nav dropdown-menu" id="top-nav" role="menu" aria-labelledby="menu1">
											    <li><a target="blank" href="https://www.gmail.com">CORREO INSTITUCIONAL</a></li>
											    <li><a target="blank" href="http://intranet.ubiobio.cl">INTRANET UBB</a></li>
											   	<li><a target="blank" href="http://moodleubb.ubiobio.cl">MOODLE UBB</a></li>
											    <li><a target="blank" href="http://ubiobio.cl">UNIVERSIDAD DEL BÍO-BÍO</a></li>
											    <li><a target="blank" href="http://www.ubiobio.cl/desarrolloestudiantil/">DIRECCIÓN DE DESARROLLO ESTUDIANTIL</a></li>
											    <li><a target="blank" href="http://formacioncontinua.ubiobio.cl/">FORMACIÓN CONTINUA</a></li>
										    </ul>
										  </div>
									</li>
									
									</ul>
								</div>
							</div>
							<?php /*menu top*/;?>
							<?php /*search*/;?>
							<div class="col-sm-5 col-lg-3">
								<div class="search">
									<form method="get" id="searchformtop" action="<?php bloginfo('url'); ?>/">
										<input type="text" class="search-input" placeholder="Ingrese su busqueda..." value="<?php the_search_query(); ?>" name="s" id="s-top" />
										<button type="submit" class="icon-only" id="searchsubmittop"><i class="fa fa-search" aria-hidden="true"></i></button>
									</form>
								</div>
							</div>
							<?php /*search*/;?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-12">
			<div class="row">
				<div class="wrapper">
				 	<div class="col-xs-12 content-header">
					 	<div class="row">
					 		<?php /*logo*/;?>
							<div class="content-logo col-xs-12">
								<div class="logo">
									<a target="blank" href="http://ubiobio.cl" title="Ir al sitio de la UBB"><img class="logoubb" src="<?php echo get_template_directory_uri(); ?>/images/logoubb.png" alt="Logo"></a>
									<a itemprop="url" href="<?php echo get_site_url(); ?>"><img  itemprop="logo" class="logoface" src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="Logo"></a>
								</div>
							</div>
							<?php /*logo*/;?>
							<?php /*menu principal*/;?>
							<div class="col-xs-12 visible-xs visible-sm">
								<div class="row">
									<a class="button-responsive" data-toggle="collapse" data-target="#main-menu"><i class="fa fa-bars" aria-hidden="true"></i> MENÚ
									</a>
									<nav id="main-menu" class="collapse">
										<div class="responsive-menu"><?php wp_nav_menu( array('menu' => 'menu-1')); ?></div>
									</nav>
								</div>
							</div>
							<?php /*menu principal*/;?>

							<?php /*menu principal FULL */; ?>
							<div class="col-xs-12 visible-lg visible-md">
								<div class="row">
									<nav id="main-menu-full" class="menu-full">
										<?php wp_nav_menu( array('menu' => 'menu-1')); ?>
									</nav>
								</div>
							</div>
							<?php /*menu principal FULL */; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<?php /*header*/;?>
	<?php /*Scripts*/;?>
	<script type="text/javascript">
		/* Agrega las clases de bootstrap al menú wordpress*/
		$cont = 0;
		$('.responsive-menu ul ul').each(function() {
			$(this).addClass('collapse');
			$(this).attr('id', 'sub'+ $cont);
			$(this).parent().prepend('<a class="more-menu hide-more" data-toggle="collapse" data-target="#sub'+ $cont +'"></a>');
			$cont++;
		});
		$('body').on('click','*[data-target="#sub0"]',function(){
			if ($('#sub0').hasClass( "in")) {
				$('*[data-target="#sub0"]').removeClass('show-more');
				$('*[data-target="#sub0"]').addClass('hide-more');
			}
			else {
				$('*[data-target="#sub0"]').removeClass('hide-more');
				$('*[data-target="#sub0"]').addClass('show-more');
				}
		});
		$('body').on('click','*[data-target="#sub1"]',function(){
			if ($('#sub1').hasClass( "in")) {
				$('*[data-target="#sub1"]').removeClass('show-more');
				$('*[data-target="#sub1"]').addClass('hide-more');
			}
			else {
				$('*[data-target="#sub1"]').removeClass('hide-more');
				$('*[data-target="#sub1"]').addClass('show-more');
				}
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			//Cambiar fondo al azar
			$base = "http://webface.ubiobio.cl/wp-content/themes/webface/images/",
			$image = "content-back" + Math.floor( (Math.random() * 2 ) + 1 ) + ".jpg";
			//$('.content').css('background-image', "url(" + $base + $image + ")");
			/* Variables */
			var responsiveWidth = 750;
			/* Funciones */
			// Cambiar la clase de links face
			function changeMenuClass() {
				var width = $(window).width();
				if (width <= responsiveWidth ) {
					$('.links-face').toggleClass('compact-links-face',true);
					$('.links-face').toggleClass('expanded-links-face',false);
					$('.links-face p').css('display','inline-block');
					$('.top-nav').toggleClass('dropdown-menu',false);
					$('.top-nav').toggleClass('collapse',true);
					$('.dropdown-toggle').attr('data-toggle','collapse');
					$('.dropdown-toggle').attr('data-target','#top-nav');
					$('.social i.fa-youtube').css('font-size','4em');
				} else {
					$('.links-face').toggleClass('compact-links-face',false);
					$('.links-face').toggleClass('expanded-links-face',true);
					$('.links-face p').css('display','block');
					$('.top-nav').toggleClass('dropdown-menu',true);
					$('.top-nav').toggleClass('collapse',false);
					$('.top-nav').css('height','auto');
					$('.dropdown-toggle').attr('data-toggle','dropdown');
					$('.dropdown-toggle').removeAttr('data-target');
					$('.social i.fa-youtube').css('font-size','7em');
				}
			}
			// Detectar redimensión
			$(window).resize(function(){
				changeMenuClass();
			});
			$(window).load(function(){
				changeMenuClass();
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.button-responsive').click(function(e ) {
				if ($('#main-menu').hasClass( "in")) {
		        	$('.button-responsive i').toggleClass('fa-bars',true);
		        	$('.button-responsive i').toggleClass('fa-times',false);
		        }
		    	else {
		        	$('.button-responsive i').toggleClass('fa-bars',false);
		        	$('.button-responsive i').toggleClass('fa-times',true);
		    	}
			});
		});
		</script>
