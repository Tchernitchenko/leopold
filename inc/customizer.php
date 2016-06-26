<?php
/**
 * Leopold Theme Customizer.
 *
 * @package Leopold
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function leopold_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'refresh';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


	$wp_customize->remove_section('static_front_page');



	$wp_customize->add_section( 'social-sharing-settings',
		array(
			'title' => __( 'Social sharing', 'leopold'),
			'capability' => 'edit_theme_options',
			'description' => __( 'Check which article sharing options will be available when viewing an article.', 'leopold' )
		)
	);

	$share_array = array( 'facebook', 'twitter', 'google-plus', 'reddit', 'email' );
	foreach ( $share_array as $social ) {

		$wp_customize->add_setting( $social,
			array(
				'default' => true,
				'type' => 'theme_mod',
				'sanitize_callback' => 'leopold_sanitize_checkbox',
				'transport' => 'postMessage'
			)
		);

		$wp_customize->add_control( $social,
			array(
				'settings' => $social,
				'type' => 'checkbox',
				'label' => ucfirst( str_replace( '-', ' ', $social ) ),
				'section' => 'social-sharing-settings'
			)
		);

	}

	$wp_customize->add_section( 'leopold_general_section',
		array(
			'priority' => 110,
			'title' => __( 'General settings', 'leopold' ),
			'capability' => 'edit_theme_options',
			'description' => __( 'Misc. theme specific settings', 'leopold' )
		)
	);

	$wp_customize->add_setting( 'post-box-shadow',
		array(
			'default' => true,
			'type' => 'theme_mod',
			'sanitize_callback' => 'leopold_sanitize_checkbox',
			'transport' => 'refresh'
		)
	);

	$wp_customize->add_control( 'post-box-shadow',
		array(
			'settings' => 'post-box-shadow',
			'type' => 'checkbox',
			'label' => __( 'Activate shadow on all box elements.', 'leopold' ),
			'description' => '',
			'section' => 'leopold_general_section'
		)
	);

	$wp_customize->add_setting( 'post-author-link',
		array(
			'default' => true,
			'type' => 'theme_mod',
			'sanitize_callback' => 'leopold_sanitize_checkbox',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 'post-author-link',
		array(
			'type' => 'checkbox',
			'label' => __( 'Make author name link to authors email', 'leopold' ),
			'description' => '',
			'section' => 'leopold_general_section'
		)
	);



	$wp_customize->add_section( 'post-border-section',
		array(
			'priority' => 120,
			'title' => __( 'Post border', 'leopold' ),
			'capability' => 'edit_theme_options',
			'description' => __( 'Activate colored borders around the article box. Front page only.', 'leopold' ),
		)
	);

	$wp_customize->add_setting( 'post-top-border',
		array(
			'default' => true,
			'type' => 'theme_mod',
			'sanitize_callback' => 'leopold_sanitize_checkbox',
			'transport' => 'refresh'
		)
	);

	$wp_customize->add_control( 'post-top-border',
		array(
			'settings' => 'post-top-border',
			'type' => 'checkbox',
			'label' => __( 'Top border', 'leopold' ),
			'description' => '',
			'section' => 'post-border-section'
		)
	);

	$wp_customize->add_setting( 'post-right-border',
		array(
			'default' => false,
			'type' => 'theme_mod',
			'sanitize_callback' => 'leopold_sanitize_checkbox',
			'transport' => 'refresh'
		)
	);

	$wp_customize->add_control( 'post-right-border',
		array(
			'settings' => 'post-right-border',
			'type' => 'checkbox',
			'label' => __( 'Right border', 'leopold' ),
			'description' => '',
			'section' => 'post-border-section'
		)
	);

	$wp_customize->add_setting( 'post-bottom-border',
		array(
			'default' => false,
			'type' => 'theme_mod',
			'sanitize_callback' => 'leopold_sanitize_checkbox',
			'transport' => 'refresh'
		)
	);

	$wp_customize->add_control( 'post-bottom-border',
		array(
			'settings' => 'post-bottom-border',
			'type' => 'checkbox',
			'label' => __( 'Bottom border', 'leopold' ),
			'description' => '',
			'section' => 'post-border-section'
		)
	);

	$wp_customize->add_setting( 'post-left-border',
		array(
			'default' => false,
			'type' => 'theme_mod',
			'sanitize_callback' => 'leopold_sanitize_checkbox',
			'transport' => 'refresh'
		)
	);

	$wp_customize->add_control( 'post-left-border',
		array(
			'settings' => 'post-left-border',
			'type' => 'checkbox',
			'label' => __( 'Left border', 'leopold' ),
			'description' => '',
			'section' => 'post-border-section'
		)
	);

	$wp_customize->add_setting( 'post-border-width',
		array(
			'default' => 4,
			'type' => 'theme_mod',
			'sanitize_callback' => 'leopold_sanitize_border_width',
			'transport' => 'refresh'
		)
	);

	$wp_customize->add_control( 'post-border-width', array(
	    'type'        => 'range',
	    'section'     => 'post-border-section',
	    'label'       => __( 'Border thickness', 'leopold' ),
	    'description' => __( 'Min 1px, max 6px', 'leopold' ),
	    'input_attrs' => array(
	        'min'   => 1,
	        'max'   => 6,
	        'step'  => 1,
	        'style' => 'color: #0a0',
	    ),
	) );

	$wp_customize->add_setting( 'post-border-opacity',
		array(
			'default' => .2,
			'type' => 'theme_mod',
			'sanitize_callback' => 'leopold_sanitize_border_opacity',
			'transport' => 'refresh'
		)
	);

	$wp_customize->add_control( 'post-border-opacity', array(
	    'type'        => 'range',
	    'section'     => 'post-border-section',
	    'label'       => __( 'Border opacity', 'leopold' ),
	    'description' => __( 'Min 10%, max 100%', 'leopold' ),
	    'input_attrs' => array(
	        'min'   => .1,
	        'max'   => 1,
	        'step'  => .05,
	        'style' => 'color: #0a0',
	    ),
	) );



	/**
	* Category options
	*/
	$wp_customize->add_section( 'category-colors',
		array(
			'priority' => 115,
			'title' => __( 'Category colors', 'leopold' ),
			'capability' => 'edit_theme_options',
			'description' => __( 'Assign what categories will use what color. This will be used throughout the site.', 'leopold' )
		)
	);

	$categories = get_categories( array(
			'parent' => 0,
			'hide_empty' => false,
	));


	foreach ( $categories as $cat ) {

	
		$wp_customize->add_setting( $cat->slug . '-color', array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_hex_color',
			'transport' => 'refresh'
		));

		$wp_customize->add_control( 
			new WP_Customize_Color_Control(
				$wp_customize,
				$cat->slug . '-color',
					array(
						'label' => $cat->name,
						'section' => 'category-colors'
					)
			)
		);

	}



	$wp_customize->add_section( 'footer-email',
		array(
			'title' => __( 'Footer email', 'leopold' ),
			'capability' => 'edit_theme_options',
			'description' => __( "Footer email information. Each section will be displayed as it's own block in the footer.", 'leopold' ),
		)
	);

	//Mail section #1
	$wp_customize->add_setting( 'mail-title-1',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 'mail-title-1',
		array(
			'settings' => 'mail-title-1',
			'type' => 'text',
			'label' => __( 'Mail section #1', 'leopold' ),
			'description' => __( 'Title', 'leopold' ),
			'section' => 'footer-email'
		)
	);

	$wp_customize->add_setting( 'mail-1-1',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_email',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 'mail-1-1',
		array(
			'settings' => 'mail-1-1',
			'type' => 'text',
			'description' => __( 'Email', 'leopold' ),
			'section' => 'footer-email'
		)
	);

	$wp_customize->add_setting( 'mail-1-2',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_email',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 'mail-1-2',
		array(
			'settings' => 'mail-1-2',
			'type' => 'text',
			'description' => __( 'Email', 'leopold' ),
			'section' => 'footer-email'
		)
	);

	$wp_customize->add_setting( 'mail-1-3',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_email',
			'transport' => 'postMessage'
		)
	);


	$wp_customize->add_control( 'mail-1-3',
		array(
			'settings' => 'mail-1-3',
			'type' => 'text',
			'description' => __( 'Email', 'leopold' ),
			'section' => 'footer-email'
		)
	);



	//Mail section #2
	$wp_customize->add_setting( 'mail-title-2',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 'mail-title-2',
		array(
			'settings' => 'mail-title-2',
			'type' => 'text',
			'label' => __( 'Mail section #2', 'leopold' ),
			'description' => __( 'Title', 'leopold' ),
			'section' => 'footer-email'
		)
	);

	$wp_customize->add_setting( 'mail-2-1',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_email',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 'mail-2-1',
		array(
			'settings' => 'mail-2-1',
			'type' => 'text',
			'description' => __( 'Email', 'leopold' ),
			'section' => 'footer-email'
		)
	);

	$wp_customize->add_setting( 'mail-2-2',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_email',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 'mail-2-2',
		array(
			'settings' => 'mail-2-2',
			'type' => 'text',
			'description' => __( 'Email', 'leopold' ),
			'section' => 'footer-email'
		)
	);

	$wp_customize->add_setting( 'mail-2-3',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_email',
			'transport' => 'postMessage'
		)
	);


	$wp_customize->add_control( 'mail-2-3',
		array(
			'settings' => 'mail-2-3',
			'type' => 'text',
			'description' => __( 'Email', 'leopold' ),
			'section' => 'footer-email'
		)
	);




	//Mail section #3
	$wp_customize->add_setting( 'mail-title-3',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 'mail-title-3',
		array(
			'settings' => 'mail-title-3',
			'type' => 'text',
			'label' => __( 'Mail section #3', 'leopold' ),
			'description' => __( 'Title', 'leopold' ),
			'section' => 'footer-email'
		)
	);

	$wp_customize->add_setting( 'mail-3-1',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_email',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 'mail-3-1',
		array(
			'settings' => 'mail-3-1',
			'type' => 'text',
			'description' => __( 'Email', 'leopold' ),
			'section' => 'footer-email'
		)
	);

	$wp_customize->add_setting( 'mail-3-2',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_email',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 'mail-3-2',
		array(
			'settings' => 'mail-3-2',
			'type' => 'text',
			'description' => __( 'Email', 'leopold' ),
			'section' => 'footer-email'
		)
	);

	$wp_customize->add_setting( 'mail-3-3',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_email',
			'transport' => 'postMessage'
		)
	);


	$wp_customize->add_control( 'mail-3-3',
		array(
			'settings' => 'mail-3-3',
			'type' => 'text',
			'description' => __( 'Email', 'leopold' ),
			'section' => 'footer-email'
		)
	);



	//Footer phone
	$wp_customize->add_section( 'footer-phone',
		array(
			'title' => __( 'Footer phone', 'leopold' ),
			'capability' => 'edit_theme_options',
			'description' => __( "Footer phone information. Each section will be displayed as it's own block in the footer.", 'leopold' )
		)
	);

	//Phone section #1
	$wp_customize->add_setting( 'phone-title-1',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 'phone-title-1',
		array(
			'settings' => 'phone-title-1',
			'type' => 'text',
			'label' => __( 'Phone section #1', 'leopold' ),
			'description' => __( 'Title', 'leopold' ),
			'section' => 'footer-phone'
		)
	);

	$wp_customize->add_setting( 'phone-1-1',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 'phone-1-1',
		array(
			'settings' => 'phone-1-1',
			'type' => 'text',
			'description' => __( 'Phone', 'leopold' ),
			'section' => 'footer-phone'
		)
	);

	$wp_customize->add_setting( 'phone-1-2',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 'phone-1-2',
		array(
			'settings' => 'phone-1-2',
			'type' => 'text',
			'description' => __( 'Phone', 'leopold' ),
			'section' => 'footer-phone'
		)
	);

	$wp_customize->add_setting( 'phone-1-3',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		)
	);


	$wp_customize->add_control( 'phone-1-3',
		array(
			'settings' => 'phone-1-3',
			'type' => 'text',
			'description' => __( 'Phone', 'leopold' ),
			'section' => 'footer-phone'
		)
	);




	//Phone section #2
	$wp_customize->add_setting( 'phone-title-2',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 'phone-title-2',
		array(
			'settings' => 'phone-title-2',
			'type' => 'text',
			'label' => __( 'Phone section #2', 'leopold' ),
			'description' => __( 'Title', 'leopold' ),
			'section' => 'footer-phone'
		)
	);

	$wp_customize->add_setting( 'phone-2-1',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 'phone-2-1',
		array(
			'settings' => 'phone-2-1',
			'type' => 'text',
			'description' => __( 'Phone', 'leopold' ),
			'section' => 'footer-phone'
		)
	);

	$wp_customize->add_setting( 'phone-2-2',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 'phone-2-2',
		array(
			'settings' => 'phone-2-2',
			'type' => 'text',
			'description' => __( 'Phone', 'leopold' ),
			'section' => 'footer-phone'
		)
	);

	$wp_customize->add_setting( 'phone-2-3',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		)
	);


	$wp_customize->add_control( 'phone-2-3',
		array(
			'settings' => 'phone-2-3',
			'type' => 'text',
			'description' => __( 'Phone', 'leopold' ),
			'section' => 'footer-phone'
		)
	);


	//Phone section #3
	$wp_customize->add_setting( 'phone-title-3',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 'phone-title-3',
		array(
			'settings' => 'phone-title-3',
			'type' => 'text',
			'label' => __( 'Phone section #3', 'leopold' ),
			'description' => __( 'Title', 'leopold' ),
			'section' => 'footer-phone'
		)
	);

	$wp_customize->add_setting( 'phone-3-1',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 'phone-3-1',
		array(
			'settings' => 'phone-3-1',
			'type' => 'text',
			'description' => __( 'Phone', 'leopold' ),
			'section' => 'footer-phone'
		)
	);

	$wp_customize->add_setting( 'phone-3-2',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 'phone-3-2',
		array(
			'settings' => 'phone-3-2',
			'type' => 'text',
			'description' => __( 'Phone', 'leopold' ),
			'section' => 'footer-phone'
		)
	);

	$wp_customize->add_setting( 'phone-3-3',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		)
	);


	$wp_customize->add_control( 'phone-3-3',
		array(
			'settings' => 'phone-3-3',
			'type' => 'text',
			'description' => __( 'Phone', 'leopold' ),
			'section' => 'footer-phone'
		)
	);

	$wp_customize->add_section( 'footer-options',
		array(
			'title' => __( 'Footer options', 'leopold' ),
			'capability' => 'edit_theme_options'
		)
	);

	$wp_customize->add_setting( 'footer-title',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'leopold_sanitize_footer_title',
			'transport' => 'refresh'
		)
	);

	$wp_customize->add_control( 'footer-title',
			array(
				'settings' => 'footer-title',
				'type' => 'radio',
				'description' => __( '<b>Footer title.</b> If you chose logo, a logo must be set in the Site Identity section.', 'leopold' ),
				'choices' => array(
					'logo' => __( 'Site logo', 'leopold' ),
					'title' => __( 'Site title', 'leopold' )
				),
				'section' => 'footer-options'
			)
		);



	$wp_customize->add_setting( 'footer-address',
		array(
			'default' => '',
			'type' => 'theme_mod',
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage'
		)
	);

	$wp_customize->add_control( 'footer-address',
		array(
			'settings' => 'footer-address',
			'type' => 'textarea',
			'description' => __( '<b>Address.</b> Type ,, to output a new line', 'leopold' ),
			'section' => 'footer-options'
		)
	);

	// $wp_customize->get_control( 'post-border-option' )->active_callback = 'is_front_page';


}
add_action( 'customize_register', 'leopold_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function leopold_customize_preview_js() {
	wp_enqueue_script( 'leopold_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'leopold_customize_preview_js' );



/*
* Sanitize layout settings
*/
function leopold_sanitize_footer_title( $value ) {
	if ( !in_array( $value, array( 'logo', 'title' ) ) ) {
		$value = 'title';
	}

	return $value;
}

function leopold_sanitize_border_opacity( $value ) {
	if ( !in_array( $value, array( 0.1, 0.15, 0.2, 0.25, 0.3, 0.35, 0.4, 0.45, 0.5, 0.55, 0.6, 0.65, 0.7, 0.75, 0.8, 0.85, 0.9, 0.95, 1 ) ) ) {
		$value = 0.2;
	}

	return $value;
}

function leopold_sanitize_border_width( $value ) {
	if ( !in_array( $value, array( 1, 2, 3, 4, 5, 6 ) ) ) {
		$value = 2;
	}

	return $value;
}

function leopold_sanitize_checkbox( $value ) {
	if ( !in_array( $value, array( true, false ) ) ) {
		$value = false;
	}

	return $value;
}






