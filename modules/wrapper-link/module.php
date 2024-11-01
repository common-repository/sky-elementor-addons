<?php

namespace Sky_Addons\Modules\WrapperLink;

use Sky_Addons;
use Elementor\Controls_Manager;
use Sky_Addons\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Module extends Module_Base {

	public function __construct() {
		parent::__construct();
		$this->add_actions();
	}

	public function get_name() {
		return 'sky-wrapper-link';
	}

	public function register_section( $element ) {
		$tabs = Controls_Manager::TAB_CONTENT;

		if ( 'section' === $element->get_name() || 'column' === $element->get_name() || 'container' === $element->get_name() ) {
			$tabs = Controls_Manager::TAB_LAYOUT;
		}

		$element->start_controls_section(
			'section_sky_addons_wrapper_link_controls',
			[ 
				'tab' => $tabs,
				'label' => esc_html__( 'Wrapper Links', 'sky-elementor-addons' ) . sky_addons_get_icon(),
			]
		);
		$element->end_controls_section();
	}

	public function register_controls( $widget, $args ) {
		$widget->add_control(
			'sky_wrapper_link',
			[ 
				'label' => esc_html__( 'Link', 'sky-elementor-addons' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'sky-elementor-addons' ),
				'show_external' => true,
				'default' => [ 
					'url' => '',
				],
				'dynamic' => [ 'active' => true ],
				'render_type' => 'none',
			]
		);
	}

	public function widget_wrapper_link_before_render( $widget ) {
		$wrapper_link = $widget->get_settings_for_display( 'sky_wrapper_link' );
		if ( $wrapper_link && ! empty( $wrapper_link['url'] ) ) {
			$wrapper_link['url'] = esc_url( $wrapper_link['url'] );

			$widget->add_render_attribute(
				'_wrapper',
				[ 
					'data-sa-element-link' => wp_json_encode( $wrapper_link, true ),
					'class' => 'sa-element-link',
					'style' => 'cursor: pointer',
				]
			);
		}
	}

	protected function add_actions() {

		//section
		add_action( 'elementor/element/section/section_advanced/after_section_end', [ $this, 'register_section' ] );
		add_action( 'elementor/element/section/section_sky_addons_wrapper_link_controls/before_section_end', [ $this, 'register_controls' ], 10, 2 );

		//container
		add_action( 'elementor/element/container/section_layout_container/after_section_end', [ $this, 'register_section' ] );
		add_action( 'elementor/element/container/section_sky_addons_wrapper_link_controls/before_section_end', [ $this, 'register_controls' ], 10, 2 );

		// widget
		add_action( 'elementor/element/common/_section_style/after_section_end', [ $this, 'register_section' ] );
		add_action( 'elementor/element/common/section_sky_addons_wrapper_link_controls/before_section_end', [ $this, 'register_controls' ], 10, 2 );

		// column
		add_action( 'elementor/element/column/section_advanced/after_section_end', [ $this, 'register_section' ] );
		add_action( 'elementor/element/column/section_sky_addons_wrapper_link_controls/before_section_end', [ $this, 'register_controls' ], 10, 2 );

		// script part
		add_action( 'elementor/frontend/before_render', [ $this, 'widget_wrapper_link_before_render' ] );
	}
}
