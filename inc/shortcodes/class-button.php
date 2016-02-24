<?php

namespace UW_Shortcake\Shortcodes;

class Button extends Shortcode {

	public static function get_shortcode_ui_args() {
		return array(
			'label'          => esc_html__( 'Button', 'uw-shortcake' ),
			'listItemImage'  => 'dashicons-migrate',
			'attrs'          => array(
				array(
					'label'        => esc_html__( 'Text', 'uw-shortcake' ),
					'attr'         => 'title',
					'type'         => 'text',
					'description'  => esc_html__( 'Text inside button.', 'uw-shortcake' ),
				),
				array(
					'label'        => esc_html__( 'Link', 'uw-shortcake' ),
					'attr'         => 'src',
					'type'         => 'text',
					'description'  => esc_html__( 'Where button links to.', 'uw-shortcake' ),
				),
				array(
					'label'  		=> esc_html__( 'Button Size', 'uw-shortcake' ),
					'attr'   		=> 'size',
					'type'   		=> 'select',
					'options' 		=> array(
						'lg'			=> esc_html__( 'Large', 'uw-shortcake' ),
						'sm'			=> esc_html__( 'Small', 'uw-shortcake' ),
					),
					'description'  => esc_html__( 'Default: Large.', 'uw-shortcake' ),
				),
				array(
					'label'  		=> esc_html__( 'Button Color', 'uw-shortcake' ),
					'attr'   		=> 'color',
					'type'   		=> 'select',
					'options' 		=> array(
						''				=> esc_html__( 'Default', 'uw-shortcake' ),
						'btn-purple'		=> esc_html__( 'Purple', 'uw-shortcake' ),
						'btn-gold'			=> esc_html__( 'Gold', 'uw-shortcake' ),
					),
					'description'  => esc_html__( 'Default: ?.', 'uw-shortcake' ),
				),
			),
		);
	}


	public static function callback( $attrs, $content = '' ) {
		if ( empty( $attrs['title'] ) ) {
			return 'Button must contain text.';
		}
		$defaults = array(
			'title' 		=> '',
			'src'			=> '#',	
			'size'			=> 'lg',
			'color'			=> '',	
		);
		
		$atts = shortcode_atts( $defaults, $attrs );

		return sprintf('<a class="uw-btn btn-%s %s" href="%s">%s</a>', $atts['size'], $atts['color'], $atts['src'], $atts['title']);
	}

}