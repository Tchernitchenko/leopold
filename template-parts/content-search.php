<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Leopold
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'small-format' ); ?>>

	<header class="entry-header">

		<?php if ( has_post_thumbnail()): ?>

				<?php the_post_thumbnail(); ?>

		<?php endif; ?>

	</header><!-- .entry-header -->

	<div class="entry-content">


		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php leopold_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>

		<?php
		if ( !is_single() ) {
			the_excerpt();
		} else {
			the_content();
		}

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'leopold' ),
				'after'  => '</div>',
			) );
			
		?>
	</div><!-- .entry-content -->

	<?php if ( is_single() ): ?>
	<footer class="entry-footer">
		<?php leopold_entry_footer(); ?>
	</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->