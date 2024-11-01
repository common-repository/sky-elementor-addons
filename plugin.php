<?php

namespace Sky_Addons;

use Elementor\Plugin;
use Elementor\Controls_Manager;
use Elementor\Elements_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Main class plugin -> Sky_Addons
 */
class Sky_Addons_Plugin {

	/**
	 * @var Plugin -> Sky_Addons
	 */
	private static $_instance;

	/**
	 * Modules Manager
	 * @var Managers
	 */
	private $_modules_manager;

	/**
	 * @var array
	 */
	private $_localize_settings = [];

	/**
	 * @return string
	 */
	public function get_version() {
		return SKY_ADDONS_VERSION;
	}

	/**
	 * Throw error on object clone
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'sky-elementor-addons' ), '1.0.0' );
	}

	/**
	 * Disable unserializing of the class
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'sky-elementor-addons' ), '1.0.0' );
	}

	/**
	 * @return Plugin
	 */
	public static function elementor() {
		return Plugin::$instance;
	}

	/**
	 * @return Plugin -> Sky_Addons
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();

			/**
			 * Fire this action on the load time
			 * This method will catch by PRO
			 * Pro will not work without this method
			 */
			do_action( 'skyaddons_loaded' );
		}

		return self::$_instance;
	}

	private function _includes() {

		require_once __DIR__ . '/includes/functions.php';

		require SKY_ADDONS_PATH . 'includes/modules-manager.php';
		/**
		 * Utils Files
		 */
		require SKY_ADDONS_PATH . 'includes/utils.php';

		require_once sky_addons_core()->includes_dir . 'custom-meta-box.php';

		require_once sky_addons_core()->traits_dir . 'global-swiper-controls.php';
		require_once sky_addons_core()->traits_dir . 'global-widget-controls.php';
		require_once sky_addons_core()->traits_dir . 'global-widget-functions.php';

		/**
		 * Select Control
		 * @since 1.1.0
		 */
		require_once SKY_ADDONS_INC_PATH . 'controls/select-input/dynamic-input-module.php';
		require_once SKY_ADDONS_INC_PATH . 'controls/select-input/dynamic-select.php';

		/**
		 * Templates Library
		 *
		 */
		require_once( sky_addons_core()->includes_dir . 'templates/Init_Templates.php' );
		require_once( sky_addons_core()->includes_dir . 'templates/Import_Template.php' );
		require_once( sky_addons_core()->includes_dir . 'templates/Library_Api.php' );
		require_once( sky_addons_core()->includes_dir . 'templates/Load_Template.php' );
	}

	public function autoload( $class ) {
		if ( 0 !== strpos( $class, __NAMESPACE__ ) ) {
			return;
		}

		$filename = strtolower(
			preg_replace(
				[ '/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
				[ 
					'', '$1-$2', '-', DIRECTORY_SEPARATOR
				],
				$class
			)
		);
		$filename = SKY_ADDONS_PATH . $filename . '.php';

		if ( is_readable( $filename ) ) {
			include( $filename );
		}
	}

	public function get_localize_settings() {
		return $this->_localize_settings;
	}

	public function add_localize_settings( $setting_key, $setting_value = null ) {
		if ( is_array( $setting_key ) ) {
			$this->_localize_settings = array_replace_recursive( $this->_localize_settings, $setting_key );

			return;
		}

		if ( ! is_array( $setting_value ) || ! isset( $this->_localize_settings[ $setting_key ] ) || ! is_array( $this->_localize_settings[ $setting_key ] ) ) {
			$this->_localize_settings[ $setting_key ] = $setting_value;

			return;
		}

		$this->_localize_settings[ $setting_key ] = array_replace_recursive( $this->_localize_settings[ $setting_key ], $setting_value );
	}

	public function enqueue_styles() {
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_register_style(
			'sky-elementor-addons',
			SKY_ADDONS_URL . 'assets/css/sky-addons' . $direction_suffix . '.css',
			[],
			SKY_ADDONS_VERSION
		);

		wp_enqueue_style( 'sky-elementor-addons' );
	}

	public function enqueue_styles_backend() {
		$direction_suffix = is_rtl() ? '.rtl' : '';

		wp_enqueue_style(
			'sky-elementor-addons-icons',
			SKY_ADDONS_URL . 'assets/css/sky-editor' . $direction_suffix . '.css',
			[],
			SKY_ADDONS_VERSION
		);
	}

	public function enqueue_scripts() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_register_script(
			'sky-elementor-addons',
			SKY_ADDONS_URL . 'assets/js/sky-addons' . $suffix . '.js',
			[ 
				'jquery', 'elementor-frontend'
			],
			SKY_ADDONS_VERSION,
			true
		);

		if ( Sky_Addons_Plugin::elementor()->preview->is_preview_mode() || Sky_Addons_Plugin::elementor()->editor->is_edit_mode() ) {
			//   todo condition check
			wp_enqueue_script( 'anime' );
			wp_enqueue_script( 'tippyjs' );
			wp_enqueue_script( 'equal-height' );
			wp_enqueue_script( 'granim' );
			wp_enqueue_script( 'ripples' );
			wp_enqueue_script( 'revealFx' );
		}

		wp_localize_script(
			'sky-elementor-addons',
			'Sky_AddonsFrontendConfig', // This is used in the js file to group all of your scripts together
			[ 
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'sky-elementor-addons' ),
			]
		);

		wp_enqueue_script( 'sky-elementor-addons' );

	}

	public function register_site_scripts() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_register_script( 'sa-image-compare', SKY_ADDONS_ASSETS_URL . 'vendor/js/image-compare-viewer' . $suffix . '.js', [ 
			'jquery', 'elementor-frontend'
		], '1.0.0', true );
		wp_register_script( 'momentum', SKY_ADDONS_ASSETS_URL . 'vendor/js/momentum-slider' . $suffix . '.js', [], '1.0.0', true );
		wp_register_script( 'sa-reading-progress', SKY_ADDONS_ASSETS_URL . 'vendor/js/jquery.reading-progress' . $suffix . '.js', [ 
			'jquery'
		], '1.0.0', true );
		wp_register_script( 'sa-accordion', SKY_ADDONS_ASSETS_URL . 'vendor/js/accordion' . $suffix . '.js', [], '3.1.1', true );
		/**
		 * No need Suffix on Anime JS
		 */
		wp_register_script( 'anime', SKY_ADDONS_ASSETS_URL . 'vendor/js/anime.min.js', [ 
			'jquery'
		], '3.2.1', true );
		wp_register_script( 'popper', SKY_ADDONS_ASSETS_URL . 'vendor/js/popper' . $suffix . '.js', [], '2.10.1', true );
		wp_register_script( 'tippyjs', SKY_ADDONS_ASSETS_URL . 'vendor/js/tippy-bundle.umd' . $suffix . '.js', [], '6.3.1', true );

		wp_register_script( 'countUp', SKY_ADDONS_ASSETS_URL . 'vendor/js/countUp' . $suffix . '.js', [], '2.0.4', true );
		wp_register_script( 'sweetalert2', SKY_ADDONS_ASSETS_URL . 'vendor/js/sweetalert2' . $suffix . '.js', [], '2.0.0', true );
		wp_register_script( 'metis-menu', SKY_ADDONS_ASSETS_URL . 'vendor/js/metis-menu' . $suffix . '.js', [ 'jquery' ], '3.0.7', true );
		wp_register_script( 'equal-height', SKY_ADDONS_ASSETS_URL . 'vendor/js/jquery.matchHeight' . $suffix . '.js', [ 'jquery' ], '0.7.2', true );
		wp_register_script( 'pdfobject', SKY_ADDONS_ASSETS_URL . 'vendor/js/pdfobject' . $suffix . '.js', [ 'jquery' ], 'v2.2.7', true );
		wp_register_script( 'granim', SKY_ADDONS_ASSETS_URL . 'vendor/js/granim' . $suffix . '.js', [], 'v2.0.0', true );
		wp_register_script( 'ripples', SKY_ADDONS_ASSETS_URL . 'vendor/js/jquery.ripples' . $suffix . '.js', [ 'jquery' ], 'v0.5.3', true );
		wp_register_script( 'slinky', SKY_ADDONS_ASSETS_URL . 'vendor/js/slinky' . $suffix . '.js', [ 'jquery' ], '1.0.0', true );
		wp_register_script( 'revealFx', SKY_ADDONS_ASSETS_URL . 'vendor/js/revealFx' . $suffix . '.js', [ 'jquery' ], '0.0.2', true );
		wp_register_script( 'typed', SKY_ADDONS_ASSETS_URL . 'vendor/js/typed' . $suffix . '.js', [], 'v2.0.12', true );
		wp_register_script( 'morphext', SKY_ADDONS_ASSETS_URL . 'vendor/js/morphext' . $suffix . '.js', [], 'v2.4.4', true );
		wp_register_script( 'plyr', SKY_ADDONS_ASSETS_URL . 'vendor/js/plyr' . $suffix . '.js', [], '3.7.2', true );
	}

	public function register_site_styles() {
		$direction_suffix = is_rtl() ? '.rtl' : '.min';
		wp_register_style( 'sa-accordion', SKY_ADDONS_ASSETS_URL . 'vendor/css/accordion' . $direction_suffix . '.css', [], '3.1.1' );
		wp_register_style( 'tippy', SKY_ADDONS_ASSETS_URL . 'vendor/css/tippy-animation' . $direction_suffix . '.css', [], '6.3.1' );
		wp_register_style( 'momentum', SKY_ADDONS_ASSETS_URL . 'vendor/css/momentum-slider' . $direction_suffix . '.css', [], '1.0.0' );
		wp_register_style( 'metis-menu', SKY_ADDONS_ASSETS_URL . 'vendor/css/metis-menu' . $direction_suffix . '.css', [], '13.0.7' );
		wp_register_style( 'slinky', SKY_ADDONS_ASSETS_URL . 'vendor/css/slinky' . $direction_suffix . '.css', [], '1.0.0' );
		wp_register_style( 'plyr', SKY_ADDONS_ASSETS_URL . 'vendor/css/plyr' . $direction_suffix . '.css', [], '6.3.1' );
	}

	public function enqueue_editor_scripts() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		wp_register_script( 'sky-addons-editor', SKY_ADDONS_ASSETS_URL . 'js/sky-addons-editor' . $suffix . '.js', [ 
			'backbone-marionette',
			'elementor-common-modules',
			'elementor-editor-modules',
		], SKY_ADDONS_VERSION, true );

		$localize_data = [ 
			'pro_installed' => _is_sky_addons_pro_activated(),
			'promotional_widgets' => [],
		];

		if ( ! _is_sky_addons_pro_activated() ) {
			$pro_widget_map = new \Sky_Addons\Includes\Pro_Widget_Map();
			$localize_data['promotional_widgets'] = $pro_widget_map->get_pro_widget_map();
		}

		wp_localize_script( 'sky-addons-editor', 'SkyAddonsEditorConfig', $localize_data );

		wp_enqueue_script( 'sky-addons-editor' );
	}

	public function enqueue_editor_style() {
		$direction_suffix = is_rtl() ? '.rtl' : '';
		wp_register_style( 'sky-widget-icons', SKY_ADDONS_ASSETS_URL . 'css/sky-widget-icons' . $direction_suffix . '.css', [], SKY_ADDONS_VERSION );
		wp_enqueue_style( 'sky-widget-icons' );
	}

	public function elementor_init() {
		$this->_modules_manager = new Managers();

		/**
		 * Add element category in panel
		 */
		Plugin::instance()->elements_manager->add_category(
			'sky-elementor-addons',
			[ 
				'title' => esc_html__( 'Sky Addons', 'sky-elementor-addons' ),
				'icon' => 'font',
			]
		);

		if ( class_exists( 'Sky_Addons\Templates\Init_Templates' ) ) {
			\Sky_Addons\Templates\Import_Template::instance()->load();
			\Sky_Addons\Templates\Library_Load::instance()->load();
			\Sky_Addons\Templates\Init_Templates::instance()->init();
		}

	}

	public static function sky_addons_file() {
		return SKY_ADDONS__FILE__;
	}

	public static function sky_addons_url() {
		return trailingslashit( plugin_dir_url( self::sky_addons_file() ) );
	}

	public static function sky_addons_dir() {
		return trailingslashit( plugin_dir_path( self::sky_addons_file() ) );
	}

	/**
	 * Initialize the plugin
	 *
	 * @return void
	 */
	public function init_plugin() {
		require_once __DIR__ . '/includes/functions.php';
		if ( is_admin() ) {
			require_once sky_addons_core()->includes_dir . 'admin.php';
		} else {
			//TODO for frontEnd
		}
	}



	protected function add_actions() {

		add_action( 'elementor/init', [ $this, 'elementor_init' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'register_site_scripts' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ], 998 );

		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'enqueue_editor_style' ] );
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_styles_backend' ], 991 );
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'enqueue_editor_scripts' ] );

		add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'enqueue_scripts' ], 998 );
		add_action( 'elementor/frontend/before_register_styles', [ $this, 'register_site_styles' ] );

		add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );

		$this->init_plugin();
	}

	/**
	 * Plugin-> Sky_Addons constructor.
	 */
	private function __construct() {
		spl_autoload_register( [ $this, 'autoload' ] );

		$this->_includes();
		$this->add_actions();
	}
}

/**
 * Initializes the main plugin
 */
function sky_elementor_addons() {
	if ( ! defined( 'SKY_ADDONS_TEST' ) ) {
		// In tests we run the instance manually.
		Sky_Addons_Plugin::instance();
	}
}

// kick-off the plugin
sky_elementor_addons();
