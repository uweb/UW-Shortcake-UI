<?php

namespace UW_Shortcake\Shortcodes;

class Trumba_RSS extends Shortcode {

	public static function get_shortcode_ui_args() {
		return array(
			'label'          => esc_html__( 'Trumba Rss', 'uw-shortcake' ),
			'listItemImage'  => 'dashicons-list-view',
			'attrs'          => array(
				array(
					'label'        => esc_html__( 'URL', 'uw-shortcake' ),
					'attr'         => 'url',
					'type'         => 'text',
					'description'  => esc_html__( 'Link to RSS feed of Trumba calendar.', 'uw-shortcake' ),
				),
				array(
					'label'  		=> esc_html__( 'Include Category?', 'uw-shortcake' ),
					'attr'   		=> 'cat',
					'type'   		=> 'select',
					'options' 		=> array(
						'true'			=> esc_html__( 'Yes', 'uw-shortcake' ),
						'false'			=> esc_html__( 'No', 'uw-shortcake' ),
					),
					'description'  => esc_html__( 'Default: Yes.', 'uw-shortcake' ),
				),
				array(
					'label'  		=> esc_html__( 'Include Description?', 'uw-shortcake' ),
					'attr'   		=> 'desc',
					'type'   		=> 'select',
					'options' 		=> array(
						'false'			=> esc_html__( 'No', 'uw-shortcake' ),
						'true'			=> esc_html__( 'Yes', 'uw-shortcake' ),
					),
					'description'  => esc_html__( 'Default: No.', 'uw-shortcake' ),
				),
			),
		);
	}


	public static function callback( $attrs, $content = '' ) {
		if ( empty( $attrs['url'] ) ) {
			return 'Missing required URL to identify the feed.';
		}

		$defaults = array(
			'url' 		=> '',
			'cat'		=> 'true',	
			'desc'		=> 'false',
		);
		
		$atts = shortcode_atts( $defaults, $attrs );

		
        $xml=simplexml_load_file( $atts['url'] ) or die("Error: Cannot create feed from URL.");

        $return = "";

        foreach ($xml->channel->item as $item) {

            $return .= "<h3 class='trumba-title'><span>" . $item->title . "</span></h3>" ;
            $return .= ($atts['cat'] == 'true') ? "<p class='trumba-category'>" . $item->category . "</p>" : '';
            $return .= ($atts['desc'] == 'true') ? "<p class='trumba-description'>" . $item->description . "</p>" : '';
                        
        }

        return $return;
	}

}