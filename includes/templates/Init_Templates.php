<?php

namespace Sky_Addons\Templates;

defined('ABSPATH') || die();

class Init_Templates {
	private static $instance = null;

	public static function url() {
		if (defined('SKY_ADDONS__FILE__')) {
			$file = trailingslashit(plugin_dir_url(SKY_ADDONS__FILE__)) . 'includes/templates/';
		} else {
			$file = trailingslashit(plugin_dir_url(__FILE__));
		}
		return $file;
	}

	public static function dir() {
		if (defined('SKY_ADDONS__FILE__')) {
			$file = trailingslashit(plugin_dir_path(SKY_ADDONS__FILE__)) . 'includes/templates/';
		} else {
			$file = trailingslashit(plugin_dir_path(__FILE__));
		}
		return $file;
	}

	public function init() {
		add_action(
			'elementor/editor/after_enqueue_scripts',
			function () {
				wp_enqueue_style("sky-templates-library-editor", self::url() . 'assets/css/template-library.min.css', ['elementor-editor'], SKY_ADDONS_VERSION);
				wp_enqueue_script("sky-templates-library-editor", self::url() . 'assets/js/template-library.min.js', ['elementor-editor'], SKY_ADDONS_VERSION, true);

				/**
				 * Verify by DB Activate Pro
				 */
				$pro = function_exists('sky_addons_init_pro') && true == sky_addons_init_pro() ? true : false;

				$localize_data = [
					'pluginName'     => 'Sky Addons',
					'panelLogoTitle' => 'Sky Addons',
					'hasPro'         => !$pro ? false : true,
					'templateLogo'   => self::url() . 'assets/templates-library-logo.svg',
					'i18n'           => [
						'templatesEmptyTitle'       => esc_html__('Sorry, Templates doesn\'t Found.', 'sky-elementor-addons'),
						'templatesEmptyMessage'     => esc_html__('Please try again or click over sync on Toolbar.', 'sky-elementor-addons'),
						'templatesNoResultsTitle'   => esc_html__('Sorry, Results doesn\'t Found.', 'sky-elementor-addons'),
						'templatesNoResultsMessage' => esc_html__('Please make sure that the keywords you entered are spelled correctly. If your search does not return any results, try checking for different keywords.', 'sky-elementor-addons'),
					],
					'tab_style'   => json_encode(self::get_tabs()),
					'default_tab' => 'page'
				];
				wp_localize_script(
					'sky-templates-library-editor',
					'skyTemplatesEditor',
					$localize_data
				);
			}
		);
	}

	public static function get_tabs() {
		return apply_filters('sky_addons_editor/templates_tabs', [
			'page'    => ['title' => 'Pages'],
			'section' => ['title' => 'Blocks'],
			'header'  => ['title' => 'Headers'],
			'footer'  => ['title' => 'Footers'],
		]);
	}
	public static function instance() {
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}
}
