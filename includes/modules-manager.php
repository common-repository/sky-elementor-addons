<?php

namespace Sky_Addons;

use Elementor\Element_Base;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

final class Managers {

	private $_modules = null;

	const WIDGETS_DB_KEY = 'sky_addons_inactive_widgets';
	const EXTENSIONS_DB_KEY = 'sky_addons_inactive_extensions';

	public static function get_inactive_widgets() {
		return get_option( self::WIDGETS_DB_KEY, [] );
	}
	public static function get_inactive_extensions() {
		return get_option( self::EXTENSIONS_DB_KEY, [] );
	}
	private function is_module_active( $module_id ) {
		$module_data      = $this->get_module_data( $module_id );
		$inactive_widgets = self::get_inactive_widgets();

		if ( ! $inactive_widgets ) {
			return $module_data['default_activation'];
		} else {
			if ( ! in_array( $module_id, $inactive_widgets ) ) {
				return true;
			} else {
				return false;
			}
		}
	}

	private function has_module_style( $module_id ) {

		$module_data = $this->get_module_data( $module_id );

		if ( isset( $module_data['has_style'] ) ) {
			return $module_data['has_style'];
		} else {
			return false;
		}
	}

	private function get_module_data( $module_id ) {
		return isset( $this->_modules[ $module_id ] ) ? $this->_modules[ $module_id ] : false;
	}

	public function __construct() {
		$modules   = [];
		$modules[] = 'advanced-accordion';
		$modules[] = 'advanced-skill-bars';
		$modules[] = 'advanced-slider';
		$modules[] = 'animated-heading';
		$modules[] = 'audio-player';
		$modules[] = 'card';
		$modules[] = 'changelog';
		$modules[] = 'content-switcher';
		$modules[] = 'dual-button';
		$modules[] = 'glory-slider';
		$modules[] = 'info-box';
		$modules[] = 'image-compare';
		$modules[] = 'list-group';
		$modules[] = 'logo-grid';
		$modules[] = 'logo-carousel';
		$modules[] = 'momentum-slider';
		$modules[] = 'number';
		$modules[] = 'panel-slider';
		$modules[] = 'pdf-viewer';
		$modules[] = 'portion-effect';
		$modules[] = 'reading-progress';
		$modules[] = 'review'; // carousel in pro version
		$modules[] = 'slinky-menu';
		$modules[] = 'social-icons';
		$modules[] = 'stellar-slider';
		$modules[] = 'step-flow';
		$modules[] = 'table-of-contents';
		$modules[] = 'team-member';
		$modules[] = 'testimonial'; // carousel in pro version
		$modules[] = 'tidy-list';

		/**
		 * All Post Widgets
		 */

		$modules[] = 'fellow-slider';
		$modules[] = 'generic-grid';
		$modules[] = 'generic-carousel';
		$modules[] = 'luster-grid';
		$modules[] = 'luster-carousel';
		$modules[] = 'mate-list';
		$modules[] = 'mate-slider';
		$modules[] = 'mate-carousel';
		$modules[] = 'naive-list';
		$modules[] = 'naive-carousel';
		$modules[] = 'post-list';
		$modules[] = 'sapling-grid';
		$modules[] = 'sapling-carousel';
		$modules[] = 'ultra-grid';
		$modules[] = 'ultra-carousel';

		// $modules[] = 'post-test';


		// extensions

		if ( ! in_array( 'animated-gradient-bg', self::get_inactive_extensions() ) ) {
			$modules[] = 'animated-gradient-bg';
		}
		if ( ! in_array( 'backdrop-filter', self::get_inactive_extensions() ) ) {
			$modules[] = 'backdrop-filter';
		}
		if ( ! in_array( 'custom-clip-path', self::get_inactive_extensions() ) ) {
			$modules[] = 'custom-clip-path';
		}
		if ( ! in_array( 'equal-height', self::get_inactive_extensions() ) ) {
			$modules[] = 'equal-height';
		}
		if ( ! in_array( 'floating-effects', self::get_inactive_extensions() ) ) {
			$modules[] = 'floating-effects';
		}
		if ( ! in_array( 'reveal-effects', self::get_inactive_extensions() ) ) {
			$modules[] = 'reveal-effects';
		}
		if ( ! in_array( 'ripples-effect', self::get_inactive_extensions() ) ) {
			$modules[] = 'ripples-effect';
		}
		if ( ! in_array( 'wrapper-link', self::get_inactive_extensions() ) ) {
			$modules[] = 'wrapper-link';
		}


		// Fetch all modules data
		foreach ( $modules as $module ) {
			$this->_modules[ $module ] = require SKY_ADDONS_MODULES_PATH . $module . '/module.info.php';
		}

		$direction_suffix = is_rtl() ? '-rtl' : '';

		foreach ( $this->_modules as $module_id => $module_data ) {

			if ( ! $this->is_module_active( $module_id ) ) {
				continue;
			}

			$class_name = str_replace( '-', ' ', $module_id );
			$class_name = str_replace( ' ', '', ucwords( $class_name ) );
			$class_name = __NAMESPACE__ . '\\Modules\\' . $class_name . '\Module';

			if ( $this->has_module_style( $module_id ) ) {
				wp_register_style( 'sa-' . $module_id, SKY_ADDONS_URL . 'assets/css/sa-' . $module_id . $direction_suffix . '.css', [], SKY_ADDONS_VERSION );
			}

			$class_name::instance();
		}
	}
}

// Managers::init();

