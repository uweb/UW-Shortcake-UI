<?php

namespace UW_Shortcake\Shortcodes;

class Accordion extends Shortcode {

	public static function get_shortcode_ui_args() {
		return array(
			'label'          => esc_html__( 'Accordion', 'uw-shortcake' ),
			'listItemImage'  => 'dashicons-plus-alt',
			'attrs'          => array(
				array(
					'label'        => esc_html__( 'Header', 'uw-shortcake' ),
					'attr'         => 'title',
					'type'         => 'text',
					'description'  => esc_html__( 'Title of accordion menu to show.', 'uw-shortcake' ),
				),
				array(
					'label'        => esc_html__( 'Content', 'uw-shortcake' ),
					'attr'         => 'content',
					'type'         => 'textarea',
					'description'  => esc_html__( 'Content inside accordion.', 'uw-shortcake' ),
				),
			),
		);
	}


	public static function callback( $attrs, $content = '' ) {
		if ( empty( $attrs['content'] ) ) {
			return 'No content for this accordion. Please make sure to include content.';
		}

		return sprintf(
			'<script src="' . get_template_directory_uri() . '/js/uw.accordionmodule.js" type="text/javascript"></script><div id="accordion uw-accordion-shortcode"><div class="js-accordion" data-accordion-prefix-classes="uw-accordion-shortcode"><h2 class="js-accordion__header">%s</h2><div class="js-accordion__panel">%s</div></div></div>',
			esc_attr( $attrs['title'] ),
			do_shortcode( esc_attr( $attrs['content'] ) )
		);
	}

}