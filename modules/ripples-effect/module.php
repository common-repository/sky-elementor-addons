<?php

namespace Sky_Addons\Modules\RipplesEffect;

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
		return 'sky-ripples-effect';
	}

	public function register_section( $element ) {

		$tab = Controls_Manager::TAB_ADVANCED;

		if ( 'section' === $element->get_name() || 'column' === $element->get_name() || 'container' === $element->get_name() ) {
			$tab = Controls_Manager::TAB_STYLE;
		} else {
			$tab = Controls_Manager::TAB_ADVANCED;
		}

		$element->start_controls_section(
			'section_sky_addons_rf_controls',
			[ 
				'tab' => $tab,
				'label' => esc_html__( 'Ripples Effect', 'sky-elementor-addons' ) . sky_addons_get_icon(),
			]
		);

		$element->end_controls_section();
	}

	public function register_controls( $element, $args ) {

		$element->add_control(
			'sa_rf_enable',
			[ 
				'label' => esc_html__( 'Enable', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'render_type' => 'template',
				'frontend_available' => true,
			]
		);



		$element->add_control(
			'sa_rf_drop_radius',
			[ 
				'label' => esc_html__( 'Drop Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'description' => esc_html__( 'The size of the drop that results by clicking or moving the mouse over the canvas. Default - 20', 'sky-elementor-addons' ),
				'range' => [ 
					'px' => [ 
						'max' => 20,
						'min' => 1,
					],
				],
				'frontend_available' => true,
				'render_type' => 'template',
				'condition' => [ 
					'sa_rf_enable' => 'yes'
				],
			]
		);

		$element->add_control(
			'sa_rf_perturbance',
			[ 
				'label' => esc_html__( 'Perturbance', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'description' => esc_html__( 'Basically the amount of refraction caused by a ripple. 0 means there is no refraction. Default - 0.03', 'sky-elementor-addons' ),
				'range' => [ 
					'px' => [ 
						'max' => 1,
						'min' => 0.01,
						'step' => 0.01,
					],
				],
				'frontend_available' => true,
				'render_type' => 'template',
				'condition' => [ 
					'sa_rf_enable' => 'yes'
				],
			]
		);

		$element->add_control(
			'sa_rf_resolution',
			[ 
				'label' => esc_html__( 'Resolution', 'sky-elementor-addons' ),
				'type' => Controls_Manager::NUMBER,
				'description' => esc_html__( 'The width and height of the WebGL texture to render to. The larger this value, the smoother the rendering and the slower the ripples will propagate. Default - 256', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
				'condition' => [ 
					'sa_rf_enable' => 'yes'
				],
				'frontend_available' => true,
				'render_type' => 'template',
			]
		);

		$element->add_control(
			'sa_rf_z_index',
			[ 
				'label' => esc_html__( 'Z-index', 'sky-elementor-addons' ),
				'type' => Controls_Manager::NUMBER,
				'render_type' => 'template',
				'condition' => [ 
					'sa_rf_enable' => 'yes',
				],
				'selectors' => [ 
					'.elementor-element-{{ID}} canvas' => 'z-index: {{VALUE}} !important;',
				],
			]
		);
	}

	public function widget_rf_before_render( $widget ) {
		$settings = $widget->get_settings_for_display();
		if ( $settings['sa_rf_enable'] == 'yes' ) {
			wp_enqueue_script( 'ripples' );
		}
	}

	protected function add_actions() {

		// section
		add_action( 'elementor/element/section/section_background/after_section_end', [ $this, 'register_section' ] );
		add_action( 'elementor/element/section/section_sky_addons_rf_controls/before_section_end', [ $this, 'register_controls' ], 10, 2 );

		// container
		add_action( 'elementor/element/container/section_background/after_section_end', [ $this, 'register_section' ] );
		add_action( 'elementor/element/container/section_sky_addons_rf_controls/before_section_end', [ $this, 'register_controls' ], 10, 2 );

		// column
		add_action( 'elementor/element/column/section_style/after_section_end', [ $this, 'register_section' ] );
		add_action( 'elementor/element/column/section_sky_addons_rf_controls/before_section_end', [ $this, 'register_controls' ], 10, 2 );

		// widget
		add_action( 'elementor/element/common/_section_background/after_section_end', [ $this, 'register_section' ] );
		add_action( 'elementor/element/common/section_sky_addons_rf_controls/before_section_end', [ $this, 'register_controls' ], 10, 2 );

		add_action( 'elementor/frontend/section/before_render', [ $this, 'widget_rf_before_render' ], 10, 1 );
		add_action( 'elementor/frontend/container/before_render', [ $this, 'widget_rf_before_render' ], 10, 1 );
		add_action( 'elementor/frontend/column/before_render', [ $this, 'widget_rf_before_render' ], 10, 1 );
		add_action( 'elementor/frontend/widget/before_render', [ $this, 'widget_rf_before_render' ], 10, 1 );
	}
}
