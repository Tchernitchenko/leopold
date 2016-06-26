<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Leopold
 */

get_header(); 

/* Query the newest featured post */
$args = array(
	'post_type' => 'post',
	'orderby' => 'date',
	'order' => 'DESC',
  	'tax_query' => array(
    	array(
	      'taxonomy' => 'post_format',
	      'field' => 'slug',
	      'terms' => 'post-format-image'
	    )
	)
);


$featured_query = new WP_Query( $args ); 

while ( $featured_query->have_posts() ) : $featured_query->the_post();

	get_template_part( 'template-parts/content-featured');
	break;	//Break loop after most recent featured post is found.

endwhile;

?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


		<?php
		if ( have_posts() ) :

			$i = 0;
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */

				//Prevents the current featured post to show up in the feed.
				if( get_post_format() === 'image' && $i == 0 && $paged == 1 ) {
					$i++;
				} else {
					get_template_part( 'template-parts/content' );
				}

			endwhile;

			if ( get_next_posts_link() || get_previous_posts_link() ): ?>			
			<div class="pagination-container">
				<div class="alignleft"><?php next_posts_link( __( '&larr; Older posts' , 'leopold' ) ); ?></div>
				<div class="alignright"><?php previous_posts_link( __( 'Newer posts &rarr;', 'leopold' ) ); ?></div>
			</div>
			<?php endif; ?>

		<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
