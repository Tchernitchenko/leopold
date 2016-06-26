<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Leopold
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

		<?php $cat = get_the_category(); ?>	
			<header class="page-header <?php if( is_category() ) { echo $cat[0]->slug . '-cat-header'; } ?>">
				<h2 class="page-title"><?php printf( __( 'Browsing: ', 'leopold' ) ); ?> 
					<span class="archive-title">
						<?php if ( is_date() ) {
							echo get_the_date( 'F, Y' );
						} else {
							single_term_title(); 
						}
						?>
					</span>
				</h2>
				
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
