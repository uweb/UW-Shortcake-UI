<?php

/**
 * Manages registered shortcodes
 */
class UW_Shortcake {

	private static $instance;

	private $internal_shortcode_classes = array(
		// 'UW_Shortcake\Shortcodes\Facebook',
		// 'UW_Shortcake\Shortcodes\Iframe',
		// 'UW_Shortcake\Shortcodes\Image_Comparison',
		// 'UW_Shortcake\Shortcodes\Infogram',
		// 'UW_Shortcake\Shortcodes\Rap_Genius',
		// 'UW_Shortcake\Shortcodes\PDF',
		// 'UW_Shortcake\Shortcodes\Scribd',
		// 'UW_Shortcake\Shortcodes\Script',
		// 'UW_Shortcake\Shortcodes\Playbuzz',
		'UW_Shortcake\Shortcodes\Accordion',
		'UW_Shortcake\Shortcodes\Button',
		'UW_Shortcake\Shortcodes\Trumba_RSS',
		);
	private $registered_shortcode_classes = array();
	private $registered_shortcodes = array();

	public static function get_instance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new UW_Shortcake;
			self::$instance->setup_actions();
			self::$instance->setup_filters();
		}
		return self::$instance;
	}

	/**
	 * Autoload any of our shortcode classes
	 */
	public function autoload_shortcode_classes( $class ) {
		$class = ltrim( $class, '\\' );
		if ( 0 !== stripos( $class, 'UW_Shortcake\\Shortcodes' ) ) {
			return;
		}

		$parts = explode( '\\', $class );
		// Don't need "UW_Shortcake\Shortcodes\"
		array_shift( $parts );
		array_shift( $parts );
		$last = array_pop( $parts ); // File should be 'class-[...].php'
		$last = 'class-' . $last . '.php';
		$parts[] = $last;
		$file = dirname( __FILE__ ) . '/shortcodes/' . str_replace( '_', '-', strtolower( implode( $parts, '/' ) ) );
		if ( file_exists( $file ) ) {
			require $file;
		}

	}

	/**
	 * Set up shortcode actions
	 */
	private function setup_actions() {
		spl_autoload_register( array( $this, 'autoload_shortcode_classes' ) );
		add_action( 'init', array( $this, 'action_init_register_shortcodes' ) );
		add_action( 'shortcode_ui_after_do_shortcode', function( $shortcode ) {
			return $this::get_uw_shortcake_admin_dependencies();
		});
	}

	/**
	 * Set up shortcode filters
	 */
	private function setup_filters() {
		add_filter( 'pre_kses', array( $this, 'filter_pre_kses' ) );
	}

	/**
	 * Register all of the shortcodes
	 */
	public function action_init_register_shortcodes() {

		$this->registered_shortcode_classes = apply_filters( 'uw_shortcake_shortcode_classes', $this->internal_shortcode_classes );
		foreach ( $this->registered_shortcode_classes as $class ) {
			$shortcode_tag = $class::get_shortcode_tag();
			$this->registered_shortcodes[ $shortcode_tag ] = $class;
			add_shortcode( $shortcode_tag, array( $this, 'do_shortcode_callback' ) );
			$class::setup_actions();
			$ui_args = $class::get_shortcode_ui_args();
			if ( ! empty( $ui_args ) && function_exists( 'shortcode_ui_register_for_shortcode' ) ) {
				shortcode_ui_register_for_shortcode( $shortcode_tag, $ui_args );
			}
		}
		add_editor_style(  get_template_directory_uri() . '/style.dev.css' );

	}

	/**
	 * Modify post content before kses is applied
	 * Used to trans
	 */
	public function filter_pre_kses( $content ) {

		foreach ( $this->registered_shortcode_classes as $shortcode_class ) {
			$content = $shortcode_class::reversal( $content );
		}
		return $content;
	}

	/**
	 * Do the shortcode callback
	 */
	public function do_shortcode_callback( $attrs, $content = '', $shortcode_tag ) {

		if ( empty( $this->registered_shortcodes[ $shortcode_tag ] ) ) {
			return '';
		}

		wp_enqueue_script( 'uw-shortcake', UW_SHORTCAKE_URL_ROOT . 'assets/js/uw-shortcake-bakery.js', array( 'jquery' ), UW_SHORTCAKE_VERSION );

		$class = $this->registered_shortcodes[ $shortcode_tag ];
		return $class::callback( $attrs, $content, $shortcode_tag );
	}

	/**
	 * Admin dependencies.
	 * Scripts required to make shortcake previews work correctly in the admin.
	 *
	 * @return string
	 */
	public static function get_uw_shortcake_admin_dependencies() {
		if ( ! is_admin() ) {
			return;
		}
		$r = '<script src="' . esc_url( includes_url( 'js/jquery/jquery.js' ) ) . '"></script>';
		$r .= '<script type="text/javascript" src="' . esc_url( UW_SHORTCAKE_URL_ROOT . 'assets/js/uw-shortcake-bakery.js' ) . '"></script>';
		return $r;
	}

}
