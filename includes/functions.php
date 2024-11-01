<?php

defined( 'ABSPATH' ) || exit;

use Sky_Addons\Sky_Addons_Plugin;

if ( ! function_exists( 'sky_addons_core' ) ) {

	function sky_addons_core() {
		$obj = new \stdClass();
		$obj->templates_dir = Sky_Addons_Plugin::sky_addons_dir() . 'includes/views/';
		$obj->includes_dir = Sky_Addons_Plugin::sky_addons_dir() . 'includes/';
		$obj->controls_dir = Sky_Addons_Plugin::sky_addons_dir() . 'controls/';
		$obj->images = Sky_Addons_Plugin::sky_addons_url() . 'assets/images/';
		$obj->traits_dir = Sky_Addons_Plugin::sky_addons_dir() . 'traits/';
		return $obj;
	}
}

if ( ! function_exists( 'sky_addons_get_icon' ) ) {
	function sky_addons_get_icon() {
		return '<span class="sky-ctrl-section-icon-wrapper"><img src="' . sky_addons_core()->images . 'sky-logo-color.svg" class="sky-ctrl-section-icon" alt="Sky Addons" title="Sky Addons"></span>';
	}
}

if ( ! function_exists( 'sky_addons_init_pro' ) ) {
	function sky_addons_init_pro() {
		return apply_filters( 'sky_addons_pro_init', false );
	}
}


if ( ! function_exists( 'sky_addons_control_indicator_pro' ) ) {
	function sky_addons_control_indicator_pro() {
		if ( sky_addons_init_pro() !== true ) {
			return '<span class="sa-control-indicator-badge sa-pro-badge">' . esc_html( 'Pro', 'sky-elementor-addons' ) . '<span>';
		}
	}
}

/**
 * @param $suffix
 */
function sky_addons_dashboard_link( $suffix = '' ) {
	return add_query_arg( [ 'page' => 'sky-elementor-addons' . $suffix ], admin_url( 'admin.php' ) );
}

function sa_elementor() {
	return \Elementor\Plugin::instance();
}


if ( ! function_exists( 'sky_title_tags' ) ) {
	function sky_title_tags() {

		$title_tags = [ 
			'h1' => 'H1',
			'h2' => 'H2',
			'h3' => 'H3',
			'h4' => 'H4',
			'h5' => 'H5',
			'h6' => 'H6',
			'div' => 'div',
			'span' => 'span',
			'p' => 'p',
		];

		return $title_tags;
	}
}

/**
 * Check you are in Editor
 * 
 */

if ( ! function_exists( 'sky_editor_mode' ) ) {
	function sky_editor_mode() {
		if ( Sky_Addons_Plugin::elementor()->preview->is_preview_mode() || Sky_Addons_Plugin::elementor()->editor->is_edit_mode() ) {
			return true;
		}
		return false;
	}
}

/**
 * Disable unserializing of the class
 *
 * @since 1.0.0
 * @return void
 */
if ( ! function_exists( 'sky_template_modify_link' ) ) {
	function sky_template_modify_link( $template_id ) {
		if ( Sky_Addons_Plugin::elementor()->editor->is_edit_mode() ) {

			$final_url = add_query_arg( [ 'elementor' => '' ], get_permalink( $template_id ) );

			$output = sprintf( '<a class="sa-elementor-template-modify-link" href="%s" title="%s" target="_blank"><i class="eicon-edit"></i></a>', esc_url( $final_url ), esc_html__( 'Edit Template', 'sky-elementor-addons' ) );

			return $output;
		}
	}
}

/**
 * @return array of elementor template
 */
if ( ! function_exists( 'sky_elementor_template_settings' ) ) {
	function sky_elementor_template_settings() {

		$templates = Sky_Addons_Plugin::elementor()->templates_manager->get_source( 'local' )->get_items();
		$types = [];

		if ( empty( $templates ) ) {
			$template_settings = [ '0' => esc_html__( 'Template Not Found!', 'sky-elementor-addons' ) ];
		} else {
			$template_settings = [ '0' => esc_html__( 'Select Template', 'sky-elementor-addons' ) ];

			foreach ( $templates as $template ) {
				$template_settings[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
				$types[ $template['template_id'] ] = $template['type'];
			}
		}

		return $template_settings;
	}
}

/**
 * @return array of anywhere templates
 */
if ( ! function_exists( 'sky_anywhere_template_settings' ) ) {
	function sky_anywhere_template_settings() {

		if ( post_type_exists( 'ae_global_templates' ) ) {
			$anywhere = get_posts( array(
				'fields' => 'ids', // Only get post IDs
				'posts_per_page' => -1,
				'post_type' => 'ae_global_templates',
			) );

			$anywhere_settings = [ '0' => esc_html__( 'Select Template', 'sky-elementor-addons' ) ];

			foreach ( $anywhere as $key => $value ) {
				$anywhere_settings[ $value ] = get_the_title( $value );
			}
		} else {
			$anywhere_settings = [ '0' => esc_html__( 'AE Plugin Not Installed', 'sky-elementor-addons' ) ];
		}

		return $anywhere_settings;
	}
}
if ( ! function_exists( 'sky_get_post_category' ) ) {
	function sky_get_post_category( $post_type ) {
		switch ( $post_type ) {
			case 'campaign':
				$taxonomy = 'campaign_category';
				break;
			case 'give_forms':
				$taxonomy = 'give_forms_category';
				break;
			case 'lightbox_library':
				$taxonomy = 'ngg_tag';
				break;
			case 'product':
				$taxonomy = 'product_cat';
				break;
			case 'tribe_events':
				$taxonomy = 'tribe_events_cat';
				break;
			case 'knowledge-base':
				$taxonomy = 'knowledge-base-category';
				break;

			default:
				$taxonomy = 'category';
				break;
		}

		$categories = get_the_terms( get_the_ID(), $taxonomy );
		$_categories = [];
		if ( $categories ) {
			foreach ( $categories as $category ) {
				$link = '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . wp_kses_post( $category->name ) . '</a>';
				$_categories[ $category->slug ] = $link;
			}
		}
		return implode( ' ', $_categories );
	}
}

if ( ! function_exists( 'sky_post_time_ago_kit' ) ) {
	function sky_post_time_ago_kit( $from, $to = '' ) {
		$diff = human_time_diff( $from, $to );
		$replace = array(
			' hour' => 'h',
			' hours' => 'h',
			' day' => 'd',
			' days' => 'd',
			' minute' => 'm',
			' minutes' => 'm',
			' second' => 's',
			' seconds' => 's',
		);

		return strtr( $diff, $replace );
	}
}

if ( ! function_exists( 'sky_post_time_ago' ) ) {
	function sky_post_time_ago( $format = '' ) {
		$display_ago = esc_html__( 'ago', 'sky-elementor-addons' );

		if ( $format == 'short' ) {
			$output = sky_post_time_ago_kit( strtotime( get_the_date() ), current_time( 'timestamp' ) );
		} else {
			$output = human_time_diff( strtotime( get_the_date() ), current_time( 'timestamp' ) );
		}

		$output = $output . ' ' . $display_ago;

		return $output;
	}
}
if ( ! function_exists( 'sky_post_custom_excerpt' ) ) {
	function sky_post_custom_excerpt( $limit = 25, $strip_shortcode = false, $trail = '' ) {

		$output = get_the_content();

		if ( $limit ) {
			$output = wp_trim_words( $output, $limit, $trail );
		}

		if ( $strip_shortcode ) {
			$output = strip_shortcodes( $output );
		}

		return wpautop( $output );
	}
}

if ( ! function_exists( 'sky_post_user_role' ) ) {
	function sky_post_user_role( $id ) {

		$user = new WP_User( $id );

		return array_shift( $user->roles );
	}
}

if ( ! function_exists( 'sky_post_pagination' ) ) {
	function sky_post_pagination( $wp_query, $widget_id = '' ) {

		/**
		 * Check if Page only 1
		 * Pause the execution
		 */
		if ( $wp_query->max_num_pages <= 1 ) {
			return;
		}

		if ( is_front_page() ) {
			$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
		} else {
			$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
		}
		$max = intval( $wp_query->max_num_pages );

		/**
		 * Inject the Current Page
		 */
		if ( $paged >= 1 ) {
			$links[] = $paged;
		}

		/**
		 * Add Middle Pages
		 */
		if ( $paged >= 3 ) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}

		if ( ( $paged + 2 ) <= $max ) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}

		printf(
			'<ul class="%1$s" data-widget-id="%2$s" role="navigation">' . "\n",
			'sa-post-pagination sa-list-style-none sa-d-flex sa-my-5 sa-mx-0 sa-justify-content-center',
			wp_kses_post( $widget_id )
		);

		/**
		 * Previous Link
		 */
		if ( get_previous_posts_link() ) {
			$prev_arrow = '<i class="sa-post-icon-arrow-left" aria-hidden="true"></i>';
			printf(
				'<li class="sa-post-page-previous">%s</li>' . "\n",
				wp_kses_post( get_previous_posts_link( '<span data-sa-post-page-previous>' . $prev_arrow . '</span>' ) )
			);
		}

		if ( ! in_array( 1, $links ) ) {
			$class = ( 1 == $paged ) ? 'current' : 'sa';

			printf(
				'<li class="%s"><a class="sa-post-page-link sa-d-block" href="%s">%s</a></li>' . "\n",
				esc_attr( $class ),
				esc_url( get_pagenum_link( 1 ) ),
				'1'
			);

			if ( ! in_array( 2, $links ) ) {
				printf( '<li class="sa-post-page-dot-dot"><span>...</span></li>' );
			}
		}

		sort( $links );
		foreach ( (array) $links as $link ) {
			$class = ( $paged == $link ) ? 'sa-post-page-active' : 'sa';
			printf(
				'<li class="%s"><a class="sa-post-page-link sa-d-block" href="%s">%s</a></li>' . "\n",
				esc_attr( $class ),
				esc_url( get_pagenum_link( $link ) ),
				wp_kses_post( $link )
			);
		}

		if ( ! in_array( $max, $links ) ) {
			if ( ! in_array( $max - 1, $links ) ) {
				printf( '<li class="sa-post-page-dot-dot"><span>...</span></li>' . "\n" );
			}

			$class = ( $paged == $max ) ? 'sa-post-page-active' : 'sa';
			printf(
				'<li class="%s"><a class="sa-post-page-link sa-d-block" href="%s">%s</a></li>' . "\n",
				esc_attr( $class ),
				esc_url( get_pagenum_link( $max ) ),
				wp_kses_post( $max )
			);
		}

		/**
		 * Next Link
		 */
		if ( get_next_posts_link( null, $paged ) ) {
			$next_arrow = '<i class="sa-post-icon-arrow-right" aria-hidden="true"></i>';
			printf(
				'<li class="sa-post-page-next">%s</li>' . "\n",
				wp_kses_post( get_next_posts_link( '<span data-sa-post-page-next>' . $next_arrow . '</span>' ) )
			);
		}

		printf( '</ul>' . "\n" );
	}
}


/**
 * @return array
 */
if ( ! function_exists( 'sa_wp_get_menu' ) ) {
	function sa_wp_get_menu() {
		$menus = wp_get_nav_menus();
		$items = [ 0 => esc_html__( 'Select Menu', 'sky-elementor-addons' ) ];
		foreach ( $menus as $menu ) {
			$items[ $menu->slug ] = $menu->name;
		}
		return $items;
	}
}
