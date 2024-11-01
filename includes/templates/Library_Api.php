<?php

namespace Sky_Addons\Templates;

use Elementor\TemplateLibrary\Source_Base;
use Elementor\TemplateLibrary\Source_Remote;
use Elementor\TemplateLibrary\Classes\Images;
use Elementor\Api;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
	exit;
}

/**
 * Elementor template library remote source.
 * 
 */
class Library_Api extends Source_Base {

	/**
	 * Library option key.
	 */
	const LIBRARY_OPTION_KEY = 'sky_addons_templates_library_info';

	/**
	 * Timestamp cache key to trigger library sync.
	 */
	const LIBRARY_TIMESTAMP_CACHE_KEY = 'sky_addons_remote_update_timestamp';

	/**
	 * API info URL.
	 *
	 * Holds the URL of the info API.
	 *
	 * @access public
	 * @static
	 *
	 * @var string API info URL.
	 */
	const API_INFO_URL = 'https://skyaddons.com/wp-json/templates-library/v1/data/';

	/**
	 * Directly Grab JSON file to import
	 * Now not using
	 * Used first on Alpha Version
	 */
	// const API_DATA_URL = 'https://wowdevs.com/templates/json/%d.json';

	public function get_id() {
		return 'sky-templates-library';
	}

	public function get_title() {
		return esc_html__('Sky Templates Library', 'sky-elementor-addons');
	}

	public function register_data() {
	}

	public function get_items($args = []) {
		$library_data = self::get_library_data();
		$templates = [];
		if (!empty($library_data['templates'])) {
			foreach ($library_data['templates'] as $template_data) {
				$templates[] = $this->prepare_template($template_data);
			}
		}
		return $templates;
	}

	public function get_tags() {
		$library_data = self::get_library_data();
		return (!empty($library_data['tags']) ? $library_data['tags'] : []);
	}

	public function get_type_tags() {
		$library_data = self::get_library_data();
		return (!empty($library_data['type_tags']) ? $library_data['type_tags'] : []);
		// return (!empty($library_data['type_tags']) ? $library_data['type_tags'] : [
		// 	'section' => ['tag-1', 'tag-2', 'tag-3'],
		// 	'page' => ['tag-1', 'tag-2', 'tag-3'],
		// ]);
	}


	private function prepare_template(array $template_data) {
		return [
			'template_id' => $template_data['template_id'],
			'title'       => $template_data['title'],
			'type'        => $template_data['type'],
			'thumbnail'   => $template_data['thumbnail'],
			'date'        => $template_data['created_at'],
			'tags'        => $template_data['tags'],
			'isPro'       => $template_data['is_pro'],
			'url'         => $template_data['liveurl'],
			'liveurl'     => $template_data['liveurl'],
			'favorite' 	  => !empty($template_data['template_id']),
			'json_url'    => $template_data['json_url'],
		];
	}


	private static function request_library_data($force_update = false) {
		$data = get_option(self::LIBRARY_OPTION_KEY);

		$elementor_update_timestamp = get_option('_transient_timeout_elementor_remote_info_api_data_' . ELEMENTOR_VERSION);
		$update_timestamp = get_transient(self::LIBRARY_TIMESTAMP_CACHE_KEY);

		if ($force_update || false === $data || !$update_timestamp || $update_timestamp != $elementor_update_timestamp) {
			$timeout = ($force_update) ? 25 : 8;

			$apiUrl = self::API_INFO_URL . '?' . http_build_query([
				'action' => 'get_layouts',
				'tab' => ''
			]);

			$response = wp_remote_get($apiUrl, [
				'timeout' => $timeout,
			]);

			if (is_wp_error($response) || 200 !== (int) wp_remote_retrieve_response_code($response)) {
				update_option(self::LIBRARY_OPTION_KEY, []);
				return false;
			}

			$data = json_decode(wp_remote_retrieve_body($response), true);

			if (empty($data) || !is_array($data)) {
				update_option(self::LIBRARY_OPTION_KEY, []);
				set_transient(self::LIBRARY_TIMESTAMP_CACHE_KEY, [], 2 * HOUR_IN_SECONDS);
				return false;
			}

			/**
			 * Update Data when Press Reload
			 */
			update_option(self::LIBRARY_OPTION_KEY, $data, 'yes');
		}
		return $data;
	}

	/**
	 * Get templates data.
	 *
	 * Retrieve the templates data from a remote server.
	 *
	 * @access public
	 * @static
	 *
	 * @param bool $force_update Optional. Whether to force the data update or
	 *                                     not. Default is false.
	 *
	 * @return array The templates data.
	 */

	public static function get_library_data($force_update = false) {
		self::request_library_data($force_update);
		$library_data = get_option(self::LIBRARY_OPTION_KEY);
		if (empty($library_data)) {
			return [];
		}
		return $library_data;
	}

	public function get_item($template_id) {
		$templates = $this->get_items();
		return $templates[$template_id];
	}

	public function save_item($template_data) {
		return new \WP_Error('invalid_request', 'Sorry, can\'t save the template to Sky Addons Library.');
	}

	public function update_item($new_data) {
		return new \WP_Error('invalid_request', 'Sorry, can\'t update the template to Sky Addons Library.');
	}

	public function delete_template($template_id) {
		return new \WP_Error('invalid_request', 'Sorry, can\'t delete the template from Sky Addons Library.');
	}

	public function export_template($template_id) {
		return new \WP_Error('invalid_request', 'Sorry, can\'t export the template from Sky Addons Library.');
	}

	/**
	 * Get template content.
	 *
	 * Retrieve the templates content received from a remote server.
	 *
	 * @access public
	 * @static
	 *
	 * @param int $template_id The template ID.
	 * @param int $json_url The template JSON URL.
	 *
	 * @return array The template content.
	 */

	public static function request_template_data($template_id, $json_url) {
		if (empty($template_id)) {
			return;
		}

		$body = [
			'site_lang' => get_bloginfo('language'),
			'home_url' => trailingslashit(home_url()),
			'template_version' => SKY_ADDONS_VERSION,
		];

		/**
		 * API: Template body args.
		 *
		 * Filters the body arguments send with the GET request when fetching the content.
		 *
		 * @param array $body_args Body arguments.
		 */

		$body_args = apply_filters('elementor/api/get_templates/body_args', $body);

		$apiUrl = self::API_INFO_URL . '?' . http_build_query([
			'action' => 'get_layout_data',
			'id' => $template_id,
		]);

		// $apiUrl = sprintf(self::API_DATA_URL, $template_id); //another way

		$apiUrl = $json_url;
		$response = wp_remote_get(
			$apiUrl,
			[
				'body' => $body_args,
				'timeout' => 10
			]
		);

		return wp_remote_retrieve_body($response);
	}

	public function get_data(array $args, $context = 'display') {
		$data = self::request_template_data($args['template_id'], $args['json_url']);

		$data = json_decode($data, true);
		if (empty($data) || empty($data['content'])) {
			throw new \Exception(esc_html__('Sorry, this Template does not have any content.', 'sky-elementor-addons'));
		}

		$data['content'] = $this->replace_elements_ids($data['content']);
		$data['content'] = $this->process_export_import_content($data['content'], 'on_import');

		$post_id = $args['editor_post_id'];
		$document = Plugin::$instance->documents->get($post_id);
		if ($document) {
			$data['content'] = $document->get_elements_raw_data($data['content'], true);
		}
		return $data;
	}
}
