<style>
<?php
$categories = get_categories( array(
			'parent' => 0,
			'hide_empty' => false
	));

	foreach ( $categories as $cat ) {

		if( get_theme_mod( $cat->slug . '-color' ) ) {

			$color = get_theme_mod( $cat->slug . '-color');
			$hex = leopold_hex2rgb( $color );

			?>

			li.<?php echo $cat->slug . '-color'; ?> {
				border-top: 2px solid <?php echo $color; ?>;
				border-left: 8px solid <?php echo $color; ?>;
			}

			li.<?php echo $cat->slug . '-color'; ?>.menu-item:before {
				background: <?php echo $color; ?>;
			}

			.<?php echo $cat->slug . '-font-color'; ?> a {
				color: <?php echo $color; ?>;
			}

			.<?php echo $cat->slug . '-cat-header'; ?> {
				border-bottom: 2px solid <?php echo $color; ?>;

			}

			<?php if ( !is_single() && is_home() ): ?>


			article.<?php echo $cat->slug . '-border-color'; ?> {

				<?php if ( get_theme_mod( 'post-top-border', true ) ): ?>;
					border-top: <?php echo get_theme_mod( 'post-border-width', 4 ) . 'px'; ?> solid rgba( <?php echo $hex; ?>, <?php echo get_theme_mod( 'post-border-opacity', .2 ); ?> );
				<?php endif; ?>

				<?php if ( get_theme_mod( 'post-right-border', false ) ): ?>;
					border-right: <?php echo get_theme_mod( 'post-border-width', 4 ) . 'px'; ?> solid rgba( <?php echo $hex; ?>, <?php echo get_theme_mod( 'post-border-opacity', .2 ); ?> );
				<?php endif; ?>

				<?php if ( get_theme_mod( 'post-bottom-border', false ) ): ?>;
					border-bottom: <?php echo get_theme_mod( 'post-border-width', 4 ) . 'px'; ?> solid rgba( <?php echo $hex; ?>, <?php echo get_theme_mod( 'post-border-opacity', .2 ); ?> );
				<?php endif; ?>

				<?php if ( get_theme_mod( 'post-left-border', false ) ): ?>;
					border-left: <?php echo get_theme_mod( 'post-border-width', 4 ) . 'px'; ?> solid rgba( <?php echo $hex; ?>, <?php echo get_theme_mod( 'post-border-opacity', .2 ); ?> );
				<?php endif; ?>
			}
			<?php endif; ?>


			<?php if ( get_theme_mod( 'post-box-shadow', true ) ): ?>
				section.widget,
				article.post,
				.site-header,
				.pagination-container,
				footer.site-footer,
				div#comments,
				header.page-header {
					-webkit-box-shadow: 0 1px 2px rgba( 0, 0, 0, 0.05 ), 0 3px 3px rgba( 0, 0, 0, 0.05 );
					box-shadow: 0 1px 2px rgba( 0, 0, 0, 0.05 ), 0 3px 3px rgba( 0, 0, 0, 0.05 );
				}
			<?php endif; ?>

			<?php
		}
	}

	?>

	</style>