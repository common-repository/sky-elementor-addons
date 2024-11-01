<?php

namespace Sky_Addons\Includes\Controls\GroupQuery;

use Elementor\Controls_Manager;
use Sky_Addons\Includes\Controls\SelectInput\Dynamic_Select;

if (!defined('ABSPATH'))
	exit; // Exit if accessed directly

trait Group_Control
{

	public function register_query_builder_controls()
	{

		$this->add_control(
			'posts_source',
			[
				'label'     => esc_html__('Source', 'sky-elementor-addons'),
				'type'      => Controls_Manager::SELECT,
				'options'   => $this->getGroupControlQueryPostTypes(),
				'default'   => 'post',

			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label'   => esc_html__('Limit', 'sky-elementor-addons'),
				'type'    => Controls_Manager::NUMBER,
				'default' => 6,
			]
		);

		$this->add_control(
			'posts_selected_ids',
			[
				'label'       => esc_html__('Search & Select', 'sky-elementor-addons'),
				'type'        => Dynamic_Select::TYPE,
				'multiple'    => true,
				'label_block' => true,
				'query_args'  => [
					'query' => 'posts',
				],
				'condition'   => [
					'posts_source'	=> 'manual_selection',
				]
			]
		);

		$this->start_controls_tabs(
			'tabs_posts_include_exclude',
			[
				'condition' => [
					'posts_source!'	=> ['manual_selection', 'current_query'],
				]
			]
		);

		$this->start_controls_tab(
			'tab_posts_include',
			[
				'label'     => esc_html__('Include', 'sky-elementor-addons'),
				'condition' => [
					'posts_source!'	=> ['manual_selection', 'current_query'],
				]
			]
		);

		$this->add_control(
			'posts_include_by',
			[
				'label'       => esc_html__('Include By', 'sky-elementor-addons'),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options'     => [
					'authors' => esc_html__('Authors', 'sky-elementor-addons'),
					'terms'   => esc_html__('Terms', 'sky-elementor-addons'),
				],
				'condition'   => [
					'posts_source!' => ['manual_selection', 'current_query'],
				]
			]
		);

		$this->add_control(
			'posts_include_author_ids',
			[
				'label'       => esc_html__('Authors', 'sky-elementor-addons'),
				'type'        => Dynamic_Select::TYPE,
				'multiple'    => true,
				'label_block' => true,
				'query_args'  => [
					'query' => 'authors',
				],
				'condition'   => [
					'posts_include_by' => 'authors',
					'posts_source!'    => ['manual_selection', 'current_query'],
				]
			]
		);

		$this->add_control(
			'posts_include_term_ids',
			[
				'label'       => esc_html__('Terms', 'sky-elementor-addons'),
				'description' => esc_html__('Terms are items within a taxonomy. Currently we have the following taxonomies: Categories, Tags, Formats and custom taxonomies.', 'sky-elementor-addons'),
				'type'        => Dynamic_Select::TYPE,
				'multiple'    => true,
				'label_block' => true,
				'placeholder' => esc_html__('Type and select terms', 'sky-elementor-addons'),
				'query_args'  => [
					'query'        => 'terms',
					'widget_props' => [
						'post_type' => 'posts_source'
					]
				],
				'condition'   => [
					'posts_include_by' => 'terms',
					'posts_source!'    => ['manual_selection', 'current_query'],
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_posts_exclude',
			[
				'label'     => esc_html__('Exclude', 'sky-elementor-addons'),
				'condition' => [
					'posts_source!' => ['manual_selection', 'current_query'],
				]
			]
		);

		$this->add_control(
			'posts_exclude_by',
			[
				'label'       => esc_html__('Exclude By', 'sky-elementor-addons'),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options'     => [
					'authors'          => esc_html__('Authors', 'sky-elementor-addons'),
					'current_post'     => esc_html__('Current Post', 'sky-elementor-addons'),
					'manual_selection' => esc_html__('Manual Selection', 'sky-elementor-addons'),
					'terms'            => esc_html__('Terms', 'sky-elementor-addons'),
				],
				'condition'   => [
					'posts_source!' => ['manual_selection', 'current_query'],
				]
			]
		);

		$this->add_control(
			'posts_exclude_ids',
			[
				'label'       => esc_html__('Search & Select', 'sky-elementor-addons'),
				'type'        => Dynamic_Select::TYPE,
				'multiple'    => true,
				'label_block' => true,
				'query_args'  => [
					'query'        => 'posts',
					'widget_props' => [
						'post_type' => 'posts_source'
					]
				],
				'condition'   => [
					'posts_source!'    => ['manual_selection', 'current_query'],
					'posts_exclude_by' => 'manual_selection',
				]
			]
		);

		$this->add_control(
			'posts_exclude_author_ids',
			[
				'label'       => esc_html__('Authors', 'sky-elementor-addons'),
				'type'        => Dynamic_Select::TYPE,
				'multiple'    => true,
				'label_block' => true,
				'query_args'  => [
					'query' => 'authors',
				],
				'condition'   => [
					'posts_exclude_by' => 'authors',
					'posts_source!'    => ['manual_selection', 'current_query'],
				]
			]
		);

		$this->add_control(
			'posts_exclude_term_ids',
			[
				'label'       => esc_html__('Terms', 'sky-elementor-addons'),
				'description' => esc_html__('Terms are items in a taxonomy. The available taxonomies are: Categories, Tags, Formats and custom taxonomies.', 'sky-elementor-addons'),
				'type'        => Dynamic_Select::TYPE,
				'multiple'    => true,
				'label_block' => true,
				'placeholder' => esc_html__('Type and select terms', 'sky-elementor-addons'),
				'query_args'  => [
					'query'        => 'terms',
					'widget_props' => [
						'post_type' => 'posts_source'
					]
				],
				'condition'   => [
					'posts_exclude_by' => 'terms',
					'posts_source!'    => ['manual_selection', 'current_query', '_related_post_type'],
				]
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
			'posts_divider',
			[
				'type'      => Controls_Manager::DIVIDER,
				'condition' => [
					'posts_source!'	=> 'current_query',
				]
			]
		);
		$this->add_control(
			'product_show_product_type',
			[
				'label'   => esc_html__('Show Product', 'sky-elementor-addons'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'all',
				'options' => [
					'all'      => esc_html__('All Products', 'sky-elementor-addons'),
					'onsale'   => esc_html__('On Sale', 'sky-elementor-addons'),
					'featured' => esc_html__('Featured', 'sky-elementor-addons'),
				],
				'condition' => [
					'posts_source'	=> 'product',
				]
			]
		);

		$this->add_control(
			'posts_offset',
			[
				'label'   => esc_html__('Offset', 'sky-elementor-addons'),
				'type'    => Controls_Manager::NUMBER,
				'default' => 0,

			]
		);

		$this->add_control(
			'posts_select_date',
			[
				'label'     => esc_html__('Date', 'sky-elementor-addons'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'anytime',
				'options'   => [
					'anytime' => esc_html__('All', 'sky-elementor-addons'),
					'today'   => esc_html__('Past Day', 'sky-elementor-addons'),
					'week'    => esc_html__('Past Week', 'sky-elementor-addons'),
					'month'   => esc_html__('Past Month', 'sky-elementor-addons'),
					'quarter' => esc_html__('Past Quarter', 'sky-elementor-addons'),
					'year'    => esc_html__('Past Year', 'sky-elementor-addons'),
					'exact'   => esc_html__('Custom', 'sky-elementor-addons'),
				],
				'condition' => [
					'posts_source!'	=> 'current_query',
				]
			]
		);

		$this->add_control(
			'posts_date_before',
			[
				'label'       => esc_html__('Before', 'sky-elementor-addons'),
				'type'        => Controls_Manager::DATE_TIME,
				'description' => esc_html__('Setting a ‘Before’ date will show all the posts published up to the selected date (inclusive).', 'sky-elementor-addons'),
				'condition'   => [
					'posts_select_date' => 'exact',
					'posts_source!'     => 'current_query',
				]
			]
		);

		$this->add_control(
			'posts_date_after',
			[
				'label'       => esc_html__('After', 'sky-elementor-addons'),
				'type'        => Controls_Manager::DATE_TIME,
				'description' => esc_html__('Setting an ‘After’ date will show all posts published on or after the chosen date (inclusive).', 'sky-elementor-addons'),
				'condition'   => [
					'posts_select_date' => 'exact',
					'posts_source!'     => 'current_query',
				]
			]
		);

		$this->add_control(
			'posts_orderby',
			[
				'label'     => esc_html__('Order By', 'sky-elementor-addons'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'date',
				'options'   => [
					'title'         => esc_html__('Title', 'sky-elementor-addons'),
					'ID'            => esc_html__('ID', 'sky-elementor-addons'),
					'date'          => esc_html__('Date', 'sky-elementor-addons'),
					'author'        => esc_html__('Author', 'sky-elementor-addons'),
					'comment_count' => esc_html__('Comment Count', 'sky-elementor-addons'),
					'menu_order'    => esc_html__('Menu Order', 'sky-elementor-addons'),
					'rand'          => esc_html__('Random', 'sky-elementor-addons'),
				],
				'condition' => [
					'posts_source!'	=> ['current_query', 'product'],
				]
			]
		);
		$this->add_control(
			'posts_order',
			[
				'label'     => esc_html__('Order', 'sky-elementor-addons'),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'desc',
				'options'   => [
					'asc'  => esc_html__('ASC', 'sky-elementor-addons'),
					'desc' => esc_html__('DESC', 'sky-elementor-addons'),
				],
				'condition' => [
					'posts_source!'	=> 'current_query',
				]
			]
		);

		$this->add_control(
			'product_hide_free',
			[
				'label'   => esc_html__('Hide Free Product', 'sky-elementor-addons'),
				'type'    => Controls_Manager::SWITCHER,
				'condition' => [
					'posts_source' => 'product',
				]
			]
		);
		$this->add_control(
			'product_hide_out_stock',
			[
				'label'   => esc_html__('Hide Out of Stock', 'sky-elementor-addons'),
				'type'    => Controls_Manager::SWITCHER,
				'condition' => [
					'posts_source' => 'product',
				]
			]
		);

		$this->add_control(
			'posts_ignore_sticky_posts',
			[
				'label'        => esc_html__('Ignore Sticky Posts', 'sky-elementor-addons'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'posts_source'	=> ['post'],
				]
			]
		);

		$this->add_control(
			'posts_only_with_featured_image',
			[
				'label'        => esc_html__('Only Featured Image Post', 'sky-elementor-addons') . sky_addons_control_indicator_pro(),
				'description'  => esc_html__('Hide posts without a featured image.', 'sky-elementor-addons'),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'condition'    => [
					'posts_source!'	=> 'current_query',
				]
			]
		);

		$this->add_control(
			'query_id',
			[
				'label'       => esc_html__('Query ID', 'sky-elementor-addons') . sky_addons_control_indicator_pro(),
				'description' => esc_html__('Give your Query a custom unique id to allow server side filtering', 'sky-elementor-addons'),
				'type'        => Controls_Manager::TEXT,
				'separator'   => 'before',
			]
		);
	}

	private function setMetaQueryArgs()
	{

		$args = [];

		if ('current_query' === $this->getGroupControlQueryPostType()) {
			return [];
		}

		$args['order']   = $this->get_settings_for_display('posts_order');
		$args['orderby'] = $this->get_settings_for_display('posts_orderby');

		/**
		 * Feature Images
		 */
		if ($this->get_settings_for_display('posts_only_with_featured_image') === 'yes') {
			$args['meta_key'] = '_thumbnail_id';
		}

		/**
		 * Date
		 */

		$selected_date = $this->get_settings_for_display('posts_select_date');

		if (!empty($selected_date)) {
			$date_query = [];

			switch ($selected_date) {
				case 'today':
					$date_query['after'] = '-1 day';
					break;

				case 'week':
					$date_query['after'] = '-1 week';
					break;

				case 'month':
					$date_query['after'] = '-1 month';
					break;

				case 'quarter':
					$date_query['after'] = '-3 month';
					break;

				case 'year':
					$date_query['after'] = '-1 year';
					break;

				case 'exact':
					$after_date = $this->get_settings_for_display('posts_date_after');
					if (!empty($after_date)) {
						$date_query['after'] = $after_date;
					}

					$before_date = $this->get_settings_for_display('posts_date_before');
					if (!empty($before_date)) {
						$date_query['before'] = $before_date;
					}

					$date_query['inclusive'] = true;
					break;
			}

			if (!empty($date_query)) {
				$args['date_query'] = $date_query;
			}
		}

		return $args;
	}

	protected function getGroupControlQueryArgs()
	{

		$settings = $this->get_settings_for_display();
		$args     = $this->setMetaQueryArgs();

		$args['post_status']      = 'publish';
		$args['suppress_filters'] = false;
		$exclude_by               = $this->getGroupControlQueryParamBy('exclude');

		if (0 < $settings['posts_offset']) {
			$args['_post_offset'] = $settings['posts_offset'];
		}

		/**
		 * WooCommerce Based Query
		 */
		if ($this->getGroupControlQueryPostType() === 'product') {

			$product_visibility_term_ids = wc_get_product_visibility_term_ids();
			if ('yes' == $settings['product_hide_free']) {
				$args['meta_query'][] = [
					'key'     => '_price',
					'value'   => 0,
					'compare' => '>',
					'type'    => 'DECIMAL',
				];
			}

			if ('yes' == $settings['product_hide_out_stock']) {
				$args['tax_query'][] = [
					[
						'taxonomy' => 'product_visibility',
						'field'    => 'term_taxonomy_id',
						'terms'    => $product_visibility_term_ids['outofstock'],
						'operator' => 'NOT IN',
					],
				]; // WPCS: slow query ok.
			}

			switch ($settings['product_show_product_type']) {
				case 'featured':
					$args['tax_query'][] = [
						'taxonomy' => 'product_visibility',
						'field'    => 'term_taxonomy_id',
						'terms'    => $product_visibility_term_ids['featured'],
					];
					break;
				case 'onsale':
					$product_ids_on_sale    = wc_get_product_ids_on_sale();
					$product_ids_on_sale[]  = 0;
					$args['post__in'] = $product_ids_on_sale;
					break;
			}
			switch ($settings['posts_orderby']) {
				case 'price':
					$args['meta_key'] = '_price'; // WPCS: slow query ok.
					$args['orderby']  = 'meta_value_num';
					break;
				case 'sales':
					$args['meta_key'] = 'total_sales'; // WPCS: slow query ok.
					$args['orderby']  = 'meta_value_num';
					break;
				default:
					$args['orderby'] = $settings['posts_orderby'];
			}
		}

		/**
		 * Set Sticky Ignore 
		 */
		if (
			$this->getGroupControlQueryPostType() === 'post'
			&& $this->get_settings_for_display('posts_ignore_sticky_posts') === 'yes'
		) {
			$args['ignore_sticky_posts'] = true;

			if (in_array('current_post', $exclude_by)) {
				$args['post__not_in'] = [get_the_ID()];
			}
		}


		if ($this->getGroupControlQueryPostType() === 'manual_selection') {
			/**
			 * Set Including Manually
			 */
			$selected_ids      = $this->get_settings_for_display('posts_selected_ids');
			$selected_ids      = wp_parse_id_list($selected_ids);
			$args['post_type'] = 'any';
			if (!empty($selected_ids)) {
				$args['post__in'] = $selected_ids;
			}
			$args['ignore_sticky_posts'] = 1;
		} elseif ('current_query' === $this->getGroupControlQueryPostType()) {
			/**
			 * Make Current Query
			 */
			$args = $GLOBALS['wp_query']->query_vars;
			$args = apply_filters('sky_addons/query/get_query_args/current_query', $args);
		} elseif ('_related_post_type' === $this->getGroupControlQueryPostType()) {
			/**
			 * Set Related Query
			 */
			$post_id           = get_queried_object_id();
			$related_post_id   = is_singular() && (0 !== $post_id) ? $post_id : null;
			$args['post_type'] = get_post_type($related_post_id);

			$include_by = $this->getGroupControlQueryParamBy('include');
			if (in_array('authors', $include_by)) {
				$args['author__in'] = wp_parse_id_list($settings['posts_include_author_ids']);
			} else {
				$args['author__in'] = get_post_field('post_author', $related_post_id);
			}

			$exclude_by = $this->getGroupControlQueryParamBy('exclude');
			if (in_array('authors', $exclude_by)) {
				$args['author__not_in'] = wp_parse_id_list($settings['posts_exclude_author_ids']);
			}

			if (in_array('current_post', $exclude_by)) {
				$args['post__not_in'] = [get_the_ID()];
			}

			$args['ignore_sticky_posts'] = 1;
			$args                        = apply_filters('sky_addons/query/get_query_args/related_query', $args);
		} else {

			/**
			 * Set Post Type
			 */
			$args['post_type'] = $this->getGroupControlQueryPostType();

			/**
			 * Set Exclude Post
			 */
			$exclude_by   = $this->getGroupControlQueryParamBy('exclude');
			$current_post = [];

			if (in_array('current_post', $exclude_by) && is_singular()) {
				$current_post = [get_the_ID()];
			}

			if (in_array('manual_selection', $exclude_by)) {
				$exclude_ids          = $settings['posts_exclude_ids'];
				$args['post__not_in'] = array_merge($current_post, wp_parse_id_list($exclude_ids));
			}
			/**
			 * Set Authors
			 */
			$include_by    = $this->getGroupControlQueryParamBy('include');
			$exclude_by    = $this->getGroupControlQueryParamBy('exclude');
			$include_users = [];
			$exclude_users = [];

			if (in_array('authors', $include_by)) {
				$include_users = wp_parse_id_list($settings['posts_include_author_ids']);
			}

			if (in_array('authors', $exclude_by)) {
				$exclude_users = wp_parse_id_list($settings['posts_exclude_author_ids']);
				$include_users = array_diff($include_users, $exclude_users);
			}

			if (!empty($include_users)) {
				$args['author__in'] = $include_users;
			}

			if (!empty($exclude_users)) {
				$args['author__not_in'] = $exclude_users;;
			}

			/**
			 * Set Taxonomy
			 */
			$include_by    = $this->getGroupControlQueryParamBy('include');
			$exclude_by    = $this->getGroupControlQueryParamBy('exclude');
			$include_terms = [];
			$exclude_terms = [];
			$terms_query   = [];

			if (in_array('terms', $include_by)) {
				$include_terms = wp_parse_id_list($settings['posts_include_term_ids']);
			}

			if (in_array('terms', $exclude_by)) {
				$exclude_terms = wp_parse_id_list($settings['posts_exclude_term_ids']);
				$include_terms = array_diff($include_terms, $exclude_terms);
			}

			if (!empty($include_terms)) {
				$tax_terms_map = $this->mapGroupControlQuery($include_terms);

				foreach ($tax_terms_map as $tax => $terms) {
					$terms_query[] = [
						'taxonomy' => $tax,
						'field'    => 'term_id',
						'terms'    => $terms,
						'operator' => 'IN',
					];
				}
			}

			if (!empty($exclude_terms)) {
				$tax_terms_map = $this->mapGroupControlQuery($exclude_terms);

				foreach ($tax_terms_map as $tax => $terms) {
					$terms_query[] = [
						'taxonomy' => $tax,
						'field'    => 'term_id',
						'terms'    => $terms,
						'operator' => 'NOT IN',
					];
				}
			}

			if (!empty($terms_query)) {
				$args['tax_query']             = $terms_query;
				$args['tax_query']['relation'] = 'AND';
			}
		}

		if ($this->get_settings_for_display('query_id')) {
			add_action('pre_get_posts', [$this, 'pre_get_posts_query_filter']);
		}

		add_action('pre_get_posts', [$this, '_query_offset'], 1);
		add_filter('found_posts', [$this, 'prefix_adjust_offset_pagination'], 1, 2);

		return $args;
	}

	/**
	 * @return mixed
	 */
	private function getGroupControlQueryPostType()
	{
		return $this->get_settings_for_display('posts_source');
	}


	/**
	 * Get Query Params by args
	 *
	 * @param string $by
	 *
	 * @return array|mixed
	 */
	private function getGroupControlQueryParamBy($by = 'exclude')
	{
		$mapBy = [
			'exclude' => 'posts_exclude_by',
			'include' => 'posts_include_by',
		];

		$setting = $this->get_settings_for_display($mapBy[$by]);

		return (!empty($setting) ? $setting : []);
	}

	/**
	 * @param array $term_ids
	 *
	 * @return array
	 */
	private function mapGroupControlQuery($term_ids = [])
	{
		$terms = get_terms(
			[
				'term_taxonomy_id' => $term_ids,
				'hide_empty'       => false,
			]
		);

		$tax_terms_map = [];

		foreach ($terms as $term) {
			$taxonomy                     = $term->taxonomy;
			$tax_terms_map[$taxonomy][] = $term->term_id;
		}

		return $tax_terms_map;
	}

	/**
	 * @return array|string[]|\WP_Post_Type[]
	 */
	private function getGroupControlQueryPostTypes()
	{
		$post_types = get_post_types(['public' => true], 'objects');
		$post_types = array_column($post_types, 'label', 'name');

		$ignorePostTypes = [
			'elementor_library'    => '',
			'attachment'           => '',
			'sky_custom_template_manager' => '',
			'sky-custom-template'  => ''
		];

		$post_types = array_diff_key($post_types, $ignorePostTypes);

		$extra_types = [
			'manual_selection'   => esc_html__('Manual Selection', 'sky-elementor-addons'),
			'current_query'      => esc_html__('Current Query', 'sky-elementor-addons'),
			'_related_post_type' => esc_html__('Related', 'sky-elementor-addons'),
		];

		$post_types = array_merge($post_types, $extra_types);

		return $post_types;
	}

	/**
	 * @param WP_Query $query
	 */

	function _query_offset(&$query)
	{

		if (isset($query->query_vars['_post_offset'])) {
			if ($query->is_paged) {
				$page_offset = $query->query_vars['_post_offset'] + (($query->query_vars['paged'] - 1) * $query->query_vars['posts_per_page']);
				$query->set('offset', $page_offset);
			} else {
				$query->set('offset', $query->query_vars['_post_offset']);
			}
		}
	}


	function prefix_adjust_offset_pagination($found_posts, $query)
	{

		if (isset($query->query_vars['_post_offset'])) {
			$_post_offset = intval($query->query_vars['_post_offset']);

			if ($_post_offset) {
				$found_posts -= $_post_offset;
			}
		}

		return $found_posts;
	}



	public function pre_get_posts_query_filter($wp_query)
	{
		if ($this) {
			$query_id = $this->get_settings_for_display('query_id');
			do_action("sky_addons/query/{$query_id}", $wp_query, $this);
		}
	}
}
