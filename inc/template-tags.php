<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Leopold
 */

if ( ! function_exists( 'leopold_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function leopold_posted_on() {

	$categories = get_the_category();
	$category = $categories[0]->slug;
	$category_link = '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . $categories[0]->cat_name . '</a>';

	if ( get_the_author_meta( 'email' ) && get_theme_mod( 'post-author-link' ) ) {
		$author_info = '<span class="author"><a href="mailto:' . sanitize_email( get_the_author_meta( 'email' ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
	} else {
		$author_info = '<span class="author-no-email">' . esc_html( get_the_author() ) . '</span>';
	}

	$byline = sprintf(
		esc_html_x( '|&nbsp; %s', 'post author', 'leopold' ),
		'<span class="author">' . $author_info . '</span>'
	);

	echo '<span class="category ' . $category . '-font-color"> ' . $category_link . '&nbsp;</span><span class="byline"> ' . $byline  . '</span>'; // WPCS: XSS OK.


}
endif;

if ( ! function_exists( 'leopold_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function leopold_entry_footer() {
	// Hide category and tag text for pages.

	if ( is_single() ) {
		if ( 'post' === get_post_type() ) {

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ' ', 'leopold' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( '%1$s', 'leopold' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}


			/* Social sharing icons */
			$title = get_the_title();
			$url = esc_url( get_the_permalink() );
			?>
			<div class="share-container">

				<span class="<?php if( !get_theme_mod( 'facebook', true ) ){ echo 'hidden'; } ?> tags-links social-media-share">
					<a class="facebook-link" href="<?php echo esc_url( 'http://www.facebook.com/share.php?u=' . $url . '&title=' . $title ); ?>" target="_blank">
						<i class="fa fa-facebook" aria-hidden="true"></i>
					</a>
				</span>

				<span class="<?php if( !get_theme_mod( 'twitter', true ) ){ echo 'hidden'; } ?> tags-links social-media-share">
					<a class="twitter-link" href="<?php echo esc_url( 'http://twitter.com/home?status=' . $title . '+' . $url ); ?>" target="_blank">
						<i class="fa fa-twitter" aria-hidden="true"></i>
					</a>
				</span>

				<span class="<?php if( !get_theme_mod( 'google-plus', true ) ){ echo 'hidden'; } ?> tags-links social-media-share">
					<a class="google-plus-link" href="<?php echo esc_url( 'https://plus.google.com/share?url=' . $url ); ?>" target="_blank">
						<i class="fa fa-google-plus" aria-hidden="true"></i>
					</a>
				</span>

				<span class="<?php if( !get_theme_mod( 'reddit', true ) ){ echo 'hidden'; } ?> tags-links social-media-share">
					<a class="reddit-link" href="<?php echo esc_url( 'http://www.reddit.com/submit?url=' . $url . '&title=' . $title ); ?>" target="_blank">
						<i class="fa fa-reddit-alien" aria-hidden="true"></i>
					</a>
				</span>

				<span class="<?php if( !get_theme_mod( 'email', true ) ){ echo 'hidden'; } ?> tags-links social-media-share">
					<a class="email-link" href="mailto:?subject=<?php echo $title; ?>&body=<?php echo $title . '%0A' . $url; ?>">
						<i class="fa fa-envelope" aria-hidden="true"></i>
					</a>
				</span>

			</div>

			
			<?php
			/* Published time */
			$post_time = sprintf( _x( 'Published %s ago', '%s = human-readable time difference', 'leopold' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) );

			?>

			<div class="published-time-container">
				<p><?php echo $post_time; ?></p>
				<?php 

				if ( get_the_time( 'U' ) !== get_the_modified_time( 'U') ) {
					$edited_time = sprintf( _x( 'Edited %s ago', '%s = human-readable time difference', 'leopold' ), human_time_diff( get_the_modified_time( 'U' ), current_time( 'timestamp' ) ) );

				?>
				<p><?php echo $edited_time; ?></p>

			<?php
			}
			?>

			<?php
			edit_post_link(
				sprintf(
					esc_html__( 'Edit post', 'leopold' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<p class="edit-link">',
				'</span>'
			);
			?>

			</div>
			<?php
		}
	}

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function leopold_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'leopold_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'leopold_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so leopold_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so leopold_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in leopold_categorized_blog.
 */
function leopold_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'leopold_categories' );
}
add_action( 'edit_category', 'leopold_category_transient_flusher' );
add_action( 'save_post',     'leopold_category_transient_flusher' );


