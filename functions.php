<?php
/**
 * Leopold functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Leopold
 */

if ( ! function_exists( 'leopold_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
// register custom post type 'my_custom_post_type' with 'supports' parameter

function leopold_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Leopold, use a find and replace
	 * to change 'leopold' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'leopold', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'leopold' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'status',
		'image'
	) );

	add_theme_support( 'custom-logo', array(
	   'height'      => 125,
	   'width'       => 400,
	   'flex-height' => false
	) );

}
endif;
add_action( 'after_setup_theme', 'leopold_setup' );


/**
* Renames post format names Image to Featured and Status to Small.
*/
function leopold_rename_post_formats($translation, $text, $context, $domain) {
    $names = array(
        'Image'  => 'Featured',
        'Status' => 'Small'
    );
    if ($context == 'Post format') {
        $translation = str_replace(array_keys($names), array_values($names), $text);
    }
    return $translation;
}
add_filter('gettext_with_context', 'leopold_rename_post_formats', 10, 4);


/**
* Custom comment styling for Leopold theme.
*/
function leopold_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'div';
		$add_below = 'div-comment';
	}
	?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>


	<div class="comment-wrapper">
		<p class="comment-info">
			<span class="comment-author"><?php esc_url( printf( __( '%s,', 'leopold' ), get_comment_author_link() ) ); ?></span>
			<span class="comment-date">
			<?php
				/* translators: 1: date, 2: time */
				printf( _x( '%s ago', '%s = human-readable time difference', 'leopold' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) );
			?>
			</span>

			<span class="reply-comment">
				<?php esc_url( comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ); ?>
			</span>
			<?php edit_comment_link( __( 'Edit comment', 'leopold' ), '  ', '' ); ?>
		</p>

		<p class="comment-text"><?php printf( get_comment_text() ); ?></p>


		<?php if ( $comment->comment_approved == '0' ) : ?>
		<p>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting approval.', 'leopold' ); ?></em>
			<br />
		</p>
		<?php endif; ?>
	
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	</div>
	<?php
	endif;

}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function leopold_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'leopold_content_width', 640 );
}
add_action( 'after_setup_theme', 'leopold_content_width', 0 );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function leopold_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'leopold' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'leopold_widgets_init' );


function is_blog () {
    return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
}

/**
 * Enqueue scripts and styles.
 */
function leopold_scripts() {
	wp_enqueue_style( 'leopold-style', get_stylesheet_uri() );

	//Mobile menu
	wp_enqueue_script( 'leopold-navigation', get_template_directory_uri() . '/js/navigation.js', array( 'jquery' ), '20151215', true );

	wp_enqueue_script( 'leopold-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}


	//Adding google fonts. Open Sans & Gentium Basic
	wp_enqueue_style( 'leopold-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,800italic,800,700italic,700,600italic,600,400italic|Gentium+Basic:700italic,700,400italic,400');

	//Adding Font Awesome
	wp_enqueue_style( 'leopold-fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.5.0' );

}
add_action( 'wp_enqueue_scripts', 'leopold_scripts' );

/**
 * Enqueue customizer stylesheet
 */
function leopold_enqueue_customizer_stylesheet() {

	wp_register_style( 'leopold-customizer-css', get_template_directory_uri() . '/css/customizer.css' );
	wp_enqueue_style( 'leopold-customizer-css' );

}
add_action( 'customize_controls_print_styles', 'leopold_enqueue_customizer_stylesheet' );

/**
 * Theme activation message
 */
add_action('admin_head', 'leopold_message_css');

function leopold_message_css() {
  echo '<style>
    .notice {
    	display: block;
    }
    .notice p {
    	margin-top: 0;
    }
    #setting-error-tgmpa.notice::before {
    	content: "Thank you for using Leopold!";
    	font-weight: 600;
    	clear: both;
    	font-size: 13px;
    	line-height: 1.5;
    	margin-bottom: -10px;
    }
  </style>';
}

/**
* Transforms hex color code to rgb
*/
function leopold_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
   // return $rgb; // returns an array with the rgb values
}

/**
* Replaces the excerpt "more" text by a link
*/
function leopold_new_excerpt_more($more) {
    global $post;
	return '';
}
add_filter('excerpt_more', 'leopold_new_excerpt_more');


/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.2 for parent theme Leopold for publication on WordPress.org
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */



/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'leopold_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function leopold_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'Smart Social Media Widget',
			'slug'      => 'smart-social-media-widget',
			'required'  => false,
		),


	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'leopold',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

	
	);

	tgmpa( $plugins, $config );
}

/*
 * Make the colored menu work
 */
function leopold_nav_custom_css( $classes, $item ) {
    
    $classes[] = strtolower( $item->title . '-color' );
    return $classes;

}
add_filter( 'nav_menu_css_class', 'leopold_nav_custom_css', 10, 2 );



/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
