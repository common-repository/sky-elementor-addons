<?php

namespace Sky_Addons\Includes\Controls\SelectInput;

use Exception;
use WP_Query;
use Sky_Addons\Sky_Addons_Plugin;

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

/**
 * Class to handle input module
 * @since  1.1.0
 */

class Dynamic_Input_Module
{

	/**
	 * constant declare ACTION
	 */
	const ACTION = '';

	/**
	 * Instance set default null
	 */

	private static $instance = null;

	/**
	 * Returns the instance.
	 *
	 * @return object
	 * @since  1.0.0
	 */
	public static function get_instance()
	{
		/**
		 * Check if the instance is null then fire a instance
		 */
		if (null == self::$instance) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Init the action
	 */

	public function init()
	{
		add_action('wp_ajax_sky_addons_dynamic_select_input_data', array($this, 'get_select_input_data'));
	}

	/**
	 * Get Data by Ajax Call
	 */
	public function get_select_input_data()
	{
		$nonce = isset($_POST['security']) ? sanitize_text_field($_POST['security']) : '';

		try {
			/**
			 * Verify nonce
			 */
			if (!wp_verify_nonce($nonce, 'sky_dynamic_select')) {
				throw new Exception('Request Invalid!');
			}

			/**
			 * Verify User Role
			 * Role require - At least Editor Role
			 */
			if (!current_user_can('edit_posts')) {
				throw new Exception('Request Unauthorized!');
			}

			$query = isset($_POST['query']) ? sanitize_text_field($_POST['query']) : '';

			/**
			 * Select query need
			 */

			switch ($query) {
				case 'terms':
					$data = $this->get_terms();
					break;
				case 'authors':
					$data = $this->get_authors();
					break;
				case 'authors_role':
					$data = $this->get_author_roles();
					break;
				case 'only_post':
					$data = $this->get_only_posts();
					break;
				case 'elementor_template':
					$data = $this->get_elementor_templates();
					break;
				case 'anywhere_template':
					$data = $this->get_anywhere_templates();
					break;
				case 'elementor_dynamic_loop_template':
					$data = $this->get_dynamic_templates();
					break;

				default:
					$data = $this->get_posts();
					break;
			}

			/**
			 * Send data as JSON
			 */
			wp_send_json_success($data);
		} catch (Exception $e) {
			wp_send_json_error($e->getMessage());
		}

		/**
		 * Exit from here
		 */

		die();
	}

	/**
	 * Get the Post Type
	 * @return string
	 */
	protected function get_post_type()
	{
		return isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : '';
	}

	/**
	 * Get all Post with Public type
	 * @return string[]|\WP_Post_Type[]
	 */
	protected function get_all_public_post_types()
	{
		return array_values(get_post_types(['public' => true]));
	}

	/**
	 * Get search query input
	 * @return string
	 */
	protected function get_search_query()
	{
		return isset($_POST['search_text']) ? sanitize_text_field($_POST['search_text']) : '';
	}

	/**
	 * Get all ids which selected
	 * @return array|mixed
	 */
	protected function get_seleced_ids()
	{
		return isset($_POST['ids']) ? sanitize_text_field($_POST['ids']) : [];
	}


	/**
	 * @param string $taxonomy
	 *
	 * @return mixed|string
	 */
	public function get_taxonomy_name($taxonomy = '')
	{
		$taxonomies = get_taxonomies(['public' => true], 'objects');
		$taxonomies = array_column($taxonomies, 'label', 'name');

		return isset($taxonomies[$taxonomy]) ? $taxonomies[$taxonomy] : '';
	}

	/**
	 * Get all Public Taxonomies
	 * @return string[]|\WP_Taxonomy[]
	 */
	protected function get_all_public_taxonomies()
	{
		return array_values(get_taxonomies(['public' => true]));
	}

	/**
	 * Get Posts By Query Data
	 *
	 * @return array
	 */
	public function get_posts()
	{
		$include    = $this->get_seleced_ids();
		$searchText = $this->get_search_query();

		$args = [];

		if ($this->get_post_type() && $this->get_post_type() !== '_related_post_type') {
			$args['post_type'] = $this->get_post_type();
		} else {
			$args['post_type'] = $this->get_all_public_post_types();
		}

		if (!empty($include)) {
			$args['post__in']       = $include;
			$args['posts_per_page'] = count($include);
		} else {
			$args['posts_per_page'] = 20;
		}

		if ($searchText) {
			$args['s'] = $searchText;
		}

		$query   = new WP_Query($args);
		$results = [];
		foreach ($query->posts as $post) {
			$post_type_obj = get_post_type_object($post->post_type);
			if (!empty($data['include_type'])) {
				$text = $post_type_obj->labels->name . ': ' . $post->post_title;
			} else {
				$text = ($post_type_obj->hierarchical) ? $this->get_post_name_with_parents($post) : $post->post_title;
			}

			$results[] = [
				'id'   => $post->ID,
				'text' => esc_html($text),
			];
		}

		return $results;
	}

	/**
	 * Get dynamic Templates
	 *
	 */
	public function get_dynamic_templates()
	{
		$searchText = $this->get_search_query();
		$args = [];
		$args['post_type'] = 'elementor_library';
		if ($searchText) {
			$args['s'] = $searchText;
		}
		$query   = new WP_Query($args);
		$results = [];
		foreach ($query->posts as $post) {
			$post_type_obj = get_post_type_object($post->post_type);
			$text = ($post_type_obj->hierarchical) ? $this->get_post_name_with_parents($post) : $post->post_title;
			$results[] = [
				'id'   => $post->ID,
				'text' => esc_html($text),
			];
		}
		return $results;
	}

	/**
	 * Get only Posts
	 *
	 */
	public function get_only_posts()
	{
		$include    = $this->get_seleced_ids();
		$searchText = $this->get_search_query();

		$args = [];

		$args['post_type'] = 'post';


		if (!empty($include)) {
			$args['post__in']       = $include;
			$args['posts_per_page'] = count($include);
		} else {
			$args['posts_per_page'] = 20;
		}

		if ($searchText) {
			$args['s'] = $searchText;
		}

		$query   = new WP_Query($args);
		$results = [];
		foreach ($query->posts as $post) {
			$post_type_obj = get_post_type_object($post->post_type);
			if (!empty($data['include_type'])) {
				$text = $post_type_obj->labels->name . ': ' . $post->post_title;
			} else {
				$text = ($post_type_obj->hierarchical) ? $this->get_post_name_with_parents($post) : $post->post_title;
			}

			$results[] = [
				'id'   => $post->ID,
				'text' => esc_html($text),
			];
		}

		return $results;
	}

	private function get_post_name_with_parents($post, $max = 3)
	{
		if (0 === $post->post_parent) {
			return $post->post_title;
		}
		$separator = is_rtl() ? ' < ' : ' > ';
		$test_post = $post;
		$names     = [];
		while ($test_post->post_parent > 0) {
			$test_post = get_post($test_post->post_parent);
			if (!$test_post) {
				break;
			}
			$names[] = $test_post->post_title;
		}

		$names = array_reverse($names);
		if (count($names) < ($max)) {
			return implode($separator, $names) . $separator . $post->post_title;
		}

		$name_string = '';
		for ($i = 0; $i < ($max - 1); $i++) {
			$name_string .= $names[$i] . $separator;
		}

		return $name_string . '...' . $separator . $post->post_title;
	}

	/**
	 * Get Terms by query data
	 *
	 * @return array
	 */
	public function get_terms()
	{
		$search_text = $this->get_search_query();
		$taxonomies  = $this->get_all_public_taxonomies();
		$include     = $this->get_seleced_ids();

		if ($this->get_post_type() == '_related_post_type') {
			$post_type = 'any';
		} elseif ($this->get_post_type()) {
			$post_type = $this->get_post_type();
		}
		$post_taxonomies = get_object_taxonomies($post_type);
		$taxonomies      = array_intersect($post_taxonomies, $taxonomies);
		$data            = [];

		if (empty($taxonomies)) {
			return $data;
		}

		$args = [
			'taxonomy'   => $taxonomies,
			'hide_empty' => false,
		];

		if (!empty($include)) {
			$args['include'] = $include;
		}

		if ($search_text) {
			$args['number'] = 20;
			$args['search'] = $search_text;
		}
		$terms = get_terms($args);

		if (is_wp_error($terms) || empty($terms)) {
			return $data;
		}

		foreach ($terms as $term) {
			$label         = $term->name;
			$taxonomy_name = $this->get_taxonomy_name($term->taxonomy);

			if ($taxonomy_name) {
				$label = "{$taxonomy_name}: {$label}";
			}

			$data[] = [
				'id'   => $term->term_taxonomy_id,
				'text' => $label,
			];
		}

		return $data;
	}

	/**
	 * Get the List of Authors by query Data
	 *
	 * @return array
	 */
	public function get_authors()
	{
		$include     = $this->get_seleced_ids();
		$search_text = $this->get_search_query();

		$args = [
			'fields'  => ['ID', 'display_name'],
			'orderby' => 'display_name',
		];

		if (!empty($include)) {
			$args['include'] = $include;
		}

		if ($search_text) {
			$args['number'] = 20;
			$args['search'] = "*$search_text*";
		}

		$users = get_users($args);

		$data = [];

		if (empty($users)) {
			return $data;
		}

		foreach ($users as $user) {
			$data[] = [
				'id'   => $user->ID,
				'text' => $user->display_name,
			];
		}

		return $data;
	}

	/**
	 * Get The Authors Roles by query Data
	 *
	 * @return array
	 */
	public function get_author_roles()
	{
		global $wp_roles;

		$all_roles = $wp_roles->roles;
		$roles     = [];
		foreach ($all_roles as $key => $role) {
			$roles[] = [
				'id'   => $key,
				'text' => $role['name'],
			];
		}

		return $roles;
	}
	/**
	 * @return array of elementor template
	 */
	public function get_elementor_templates()
	{
		$searchText = $this->get_search_query();
		if ($searchText) {
			$args['s'] = $searchText;
		}
		$templates = Sky_Addons_Plugin::elementor()->templates_manager->get_source('local')->get_items($args);
		$results     = [];

		if (empty($templates)) {
			$results = ['0' => esc_html__('Sorry, Templates Not Found!', 'sky-elementor-addons')];
		} else {
			foreach ($templates as $template) {
				$results[] = [
					'id'   => $template['template_id'],
					'text' => $template['title'],
				];
			}
		}
		return $results;
	}

	/**
	 * @return array of anywhere template
	 */
	/**
	 * @return array of anywhere templates
	 */
	public function get_anywhere_templates()
	{
		$search_text = $this->get_search_query();
		$results = [];
		if (post_type_exists('ae_global_templates')) {
			$anywhere = get_posts(array(
				'fields'         => 'ids',
				'posts_per_page' => -1,
				'post_type'      => 'ae_global_templates',
				's' 			 => $search_text
			));
			foreach ($anywhere as $key => $value) {
				$results[] = [
					'id'   => $value,
					'text' => get_the_title($value)
				];
			}
		} else {
			$results = ['0' => esc_html__('Sorry, AE Plugin is Not Installed!', 'sky-elementor-addons')];
		}

		return $results;
	}
}

// kick the class
function Dynamic_Input_Module()
{
	return Dynamic_Input_Module::get_instance();
}

Dynamic_Input_Module()->init();
