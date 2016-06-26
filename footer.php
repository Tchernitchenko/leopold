<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Leopold
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="footer-header">
			<?php if ( get_theme_mod( 'footer-title' ) === 'logo' && has_custom_logo() ): ?>
				<?php the_custom_logo(); ?>
			<?php else: ?>
				<h3><?php bloginfo( 'name' ); ?></h3>
			<?php endif; ?>
		</div>

		<div class="footer-column">
			<h4><?php printf( __( 'Email', 'leopold' ) ); ?></h4>

			<div class="footer-info-section">
				<p class="semi-header mail-title-1"><?php echo get_theme_mod( 'mail-title-1' ); ?></p>
				<p class="footer-content mail-1-1"><a href="mailto:<?php echo get_theme_mod( 'mail-1-1' ); ?>" target="_top"><?php echo get_theme_mod( 'mail-1-1' ); ?></a></p>
				<p class="footer-content mail-1-2"><a href="mailto:<?php echo get_theme_mod( 'mail-1-2' ); ?>" target="_top"><?php echo get_theme_mod( 'mail-1-2' ); ?></a></p>
				<p class="footer-content mail-1-3"><a href="mailto:<?php echo get_theme_mod( 'mail-1-3' ); ?>" target="_top"><?php echo get_theme_mod( 'mail-1-3' ); ?></a></p>
			</div>

			<div class="footer-info-section">
				<p class="semi-header mail-title-2"><?php echo get_theme_mod( 'mail-title-2' ); ?></p>
				<p class="footer-content mail-2-1"><a href="mailto:<?php echo get_theme_mod( 'mail-2-1' ); ?>" target="_top"><?php echo get_theme_mod( 'mail-2-1' ); ?></a></p>
				<p class="footer-content mail-2-2"><a href="mailto:<?php echo get_theme_mod( 'mail-2-2' ); ?>" target="_top"><?php echo get_theme_mod( 'mail-2-2' ); ?></a></p>
				<p class="footer-content mail-2-3"><a href="mailto:<?php echo get_theme_mod( 'mail-2-3' ); ?>" target="_top"><?php echo get_theme_mod( 'mail-2-3' ); ?></a></p>
			</div>

			<div class="footer-info-section">
				<p class="semi-header mail-title-3"><?php echo get_theme_mod( 'mail-title-3' ); ?></p>
				<p class="footer-content mail-3-1"><a href="mailto:<?php echo get_theme_mod( 'mail-3-1' ); ?>" target="_top"><?php echo get_theme_mod( 'mail-3-1' ); ?></a></p>
				<p class="footer-content mail-3-2"><a href="mailto:<?php echo get_theme_mod( 'mail-3-2' ); ?>" target="_top"><?php echo get_theme_mod( 'mail-3-2' ); ?></a></p>
				<p class="footer-content mail-3-3"><a href="mailto:<?php echo get_theme_mod( 'mail-3-3' ); ?>" target="_top"><?php echo get_theme_mod( 'mail-3-3' ); ?></a></p>
			</div>
		</div>

		<div class="footer-column">
			<h4><?php printf( __( 'Phone', 'leopold' ) ); ?></h4>

			<div class="footer-info-section">
					<p class="semi-header phone-title-1"><?php echo get_theme_mod( 'phone-title-1' ); ?></p>
					<p class="footer-content phone-1-1"><a href="tel:<?php echo str_replace(' ', '-', get_theme_mod( 'phone-1-1' ) ); ?>" target="_top"><?php echo get_theme_mod( 'phone-1-1' ); ?></a></p>
					<p class="footer-content phone-1-2"><a href="tel:<?php echo str_replace(' ', '-', get_theme_mod( 'phone-1-2' ) ); ?>" target="_top"><?php echo get_theme_mod( 'phone-1-2' ); ?></a></p>
					<p class="footer-content phone-1-3"><a href="tel:<?php echo str_replace(' ', '-', get_theme_mod( 'phone-1-3' ) ); ?>" target="_top"><?php echo get_theme_mod( 'phone-1-3' ); ?></a></p>
			</div>

			<div class="footer-info-section">
					<p class="semi-header phone-title-2"><?php echo get_theme_mod( 'phone-title-2' ); ?></p>
					<p class="footer-content phone-2-1"><a href="tel:<?php echo str_replace(' ', '-', get_theme_mod( 'phone-2-1' ) ); ?>" target="_top"><?php echo get_theme_mod( 'phone-2-1' ); ?></a></p>
					<p class="footer-content phone-2-2"><a href="tel:<?php echo str_replace(' ', '-', get_theme_mod( 'phone-2-2' ) ); ?>" target="_top"><?php echo get_theme_mod( 'phone-2-2' ); ?></a></p>
					<p class="footer-content phone-2-3"><a href="tel:<?php echo str_replace(' ', '-', get_theme_mod( 'phone-2-3' ) ); ?>" target="_top"><?php echo get_theme_mod( 'phone-2-3' ); ?></a></p>
			</div>

			<div class="footer-info-section">
					<p class="semi-header phone-title-3"><?php echo get_theme_mod( 'phone-title-3' ); ?></p>
					<p class="footer-content phone-3-1"><a href="tel:<?php echo str_replace(' ', '-', get_theme_mod( 'phone-3-1' ) ); ?>" target="_top"><?php echo get_theme_mod( 'phone-3-1' ); ?></a></p>
					<p class="footer-content phone-3-2"><a href="tel:<?php echo str_replace(' ', '-', get_theme_mod( 'phone-3-2' ) ); ?>" target="_top"><?php echo get_theme_mod( 'phone-3-2' ); ?></a></p>
					<p class="footer-content phone-3-3"><a href="tel:<?php echo str_replace(' ', '-', get_theme_mod( 'phone-3-3' ) ); ?>" target="_top"><?php echo get_theme_mod( 'phone-3-3' ); ?></a></p>
			</div>
		</div>



		<div class="footer-column">
			<h4><?php printf( __( 'Address', 'leopold' ) ); ?></h4>
			<p class="footer-address">
				<?php 
				if ( get_theme_mod( 'footer-address' ) ) {
					echo str_replace( ',,', '<br/>', get_theme_mod( 'footer-address' ) );	
				}
				?>
			</p>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
