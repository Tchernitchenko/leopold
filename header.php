<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Leopold
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<!-- Used to add grey filter when mobile menu is open -->
<div class="mobile-grey-filter"></div>
<?php
if ( is_blog() ) {
	echo 'yes';
} else {
	echo 'no';
}
?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'leopold' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<?php if ( has_custom_logo() ): ?>
			<?php the_custom_logo(); ?>
		<?php else: ?>
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		<?php endif; ?>

		<nav id="site-navigation" class="main-navigation" role="navigation">

			<!-- Hamburger icon -->
			<a id="nav-toggle" aria-controls="primary-menu" aria-expanded="false" href="#"><span></span></a>

			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<?php include( 'inc/custom-css.php'); ?>

	
	<div id="content" class="site-content">
