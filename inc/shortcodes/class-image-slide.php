<?php

namespace UW_Shortcake\Shortcodes;

class Image_Slide extends Shortcode {

	public static function get_shortcode_ui_args() {
		return array(
			'label'          => esc_html__( 'Image Slide', 'uw-shortcake' ),
			'listItemImage'  => 'dashicons-id',
			'attrs'          => array(
				array(
					'label'        => esc_html__( 'Title', 'uw-shortcake' ),
					'attr'         => 'title',
					'type'         => 'text',
					'description'  => esc_html__( 'Header in slide.', 'uw-shortcake' ),
				),
				array(
					'label'        => esc_html__( 'Text', 'uw-shortcake' ),
					'attr'         => 'text',
					'type'         => 'text',
					'description'  => esc_html__( 'Text inside slide.', 'uw-shortcake' ),
				),
				array(
					'label'        => esc_html__( 'Link', 'uw-shortcake' ),
					'attr'         => 'link',
					'type'         => 'url',
					'description'  => esc_html__( 'Makes slide a clickable link.', 'uw-shortcake' ),
				),
				array(
					'label'  		=> esc_html__( 'Background Image', 'uw-shortcake' ),
					'attr'   		=> 'image',
					'type'   		=> 'attachment',
					'libraryType'	=> array( 'image' ),
					'addButton'		=> esc_html__( 'Select Image', 'uw-shortcake' ),
					'frameTitle'	=> esc_html__( 'Select Image', 'uw-shortcake' ),
					'description'  	=> esc_html__( 'Image becomes backround of the slide for desktop users.', 'uw-shortcake' ),
				),
				array(
					'label'  		=> esc_html__( 'Mobile Image', 'uw-shortcake' ),
					'attr'   		=> 'mobileImage',
					'type'   		=> 'attachment',
					'libraryType'	=> array( 'image' ),
					'addButton'		=> esc_html__( 'Select Mobile Image', 'uw-shortcake' ),
					'frameTitle'	=> esc_html__( 'Select Mobile Image', 'uw-shortcake' ),
					'description'  	=> esc_html__( 'Image becomes backround of the slide for mobile users.', 'uw-shortcake' ),
				),
				// array(
				// 	'label'  		=> esc_html__( 'Overlay Image', 'uw-shortcake' ),
				// 	'attr'   		=> 'overlayImage',
				// 	'type'   		=> 'attachment',
				// 	'libraryType'	=> array( 'image' ),
				// 	'addButton'		=> esc_html__( 'Select Image', 'uw-shortcake' ),
				// 	'frameTitle'	=> esc_html__( 'Select Image', 'uw-shortcake' ),
				// 	'description'  	=> esc_html__( 'Image becomes an overlay on top of the slide for desktop users.', 'uw-shortcake' ),
				// ),
				array(
					'label'  		=> esc_html__( 'Text Alignment', 'uw-shortcake' ),
					'attr'   		=> 'align',
					'type'   		=> 'select',
					'options' 		=> array(
						'left'				=> esc_html__( 'Left', 'uw-shortcake' ),
						'right'			=> esc_html__( 'Right', 'uw-shortcake' ),
					),
					'description'  => esc_html__( 'Default: left.', 'uw-shortcake' ),
				),
				// array(
				// 	'label'  		=> esc_html__( 'Use Overlay?', 'uw-shortcake' ),
				// 	'attr'   		=> 'overlay',
				// 	'type'   		=> 'checkbox',
				// 	'description'  => esc_html__( 'Default: no.', 'uw-shortcake' ),
				// ),
			),
		);
	}


	public static function callback( $attrs, $content = '' ) {
		if ( empty( $attrs['image'] ) ) {
			return 'Slide must have image.';
		}
		$defaults = array(
			'title' 		=> '',
			'text' 			=> '',
			'url'			=> '#',	
			'image'			=> '',
			'mobileImage'	=> '',
			'align'			=> 'left',	
		);
		
		$atts = shortcode_atts( $defaults, $attrs );

		return sprintf('<div class="module basic-module" style="background-image: url(%s);"><img class="mobile-overlay" src="%s" style="visibility:hidden; position:absolute; %s"/><div class="mobile-image" style="background-image: url(%s);"></div><div class="basic-mod-container container side-%s"><div class="mod-text-container"><div class="mod-text"><h3>%s</h3><p>%s</p></div></div></div></div>', wp_get_attachment_url( $atts[ 'image' ] , $size = 'full'), '', '', wp_get_attachment_url( $atts[ 'mobileImage' ] , $size = 'full'), $atts['align'], $atts['title'], $atts['text']);
	}

}