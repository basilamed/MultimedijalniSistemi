<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MultimedijalniSistemi
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script>
        $(document).ready(function () {
            // Podešavanje slajdera
            $('#slider').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                adaptiveHeight: true
            });

            // Prikazivanje/skrivanje hamburger menija
            $('#mobile-menu-toggle').on('click', function() {
                $('#mobile-menu-items').slideToggle();
            });
        });
    </script>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'multimedijalnisistemi' ); ?></a>

	<header class="site-header">
	<div class="site-header-logo">
	<?php
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
		?>
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo-link">
			<img src="<?php echo $image[0]; ?>" alt="Logo" class="logo">
		</a>
		<p class="site-description"><?php bloginfo( 'description' ); ?></p>
		</div>
		<!-- <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu-1',
                    'menu_class' => 'your-menu-class', // Dodaj custom klasu za stilizovanje menija
                ));
            ?> -->
            <!-- Hamburger meni za mobilne ekrane -->
            <div class="mobile-menu">
                <div class="menu-toggle" id="mobile-menu-toggle">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </div>
                <div class="your-menu-class" id="mobile-menu-items">
                    <?php
                        // Dodajte ovde stavke menija
                        wp_nav_menu(array(
                            'theme_location' => 'menu-1',
                            'container' => '',
                            'items_wrap' => '%3$s', // Bez <ul> i <li> tagova
							
                        ));
                    ?>
                </div>
            </div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	
  </header><!-- .site-header -->
 