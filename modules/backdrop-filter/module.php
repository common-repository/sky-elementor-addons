<?php

namespace Sky_Addons\Modules\BackdropFilter;

use Elementor\Controls_Manager;
use Sky_Addons\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Module extends Module_Base {

	public $element_selector = '.sa-backdrop-filter-yes > .elementor-widget-container';

	public function __construct() {
		parent::__construct();
		$this->add_actions();
	}

	public function get_name() {
		return 'sky-backdrop-filter';
	}

	public function register_section( $element ) {

		$tab = Controls_Manager::TAB_ADVANCED;

		if ( 'section' === $element->get_name() || 'column' === $element->get_name() || 'container' === $element->get_name() ) {
			$tab                    = Controls_Manager::TAB_STYLE;
			$this->element_selector = '';
		} else {
			$tab                    = Controls_Manager::TAB_ADVANCED;
			$this->element_selector = '.sa-backdrop-filter-yes > .elementor-widget-container';
		}

		if ( 'section' === $element->get_name() ) {
			$this->element_selector = '.sa-backdrop-filter-yes > .elementor-container';
		}

		if ( 'column' === $element->get_name() ) {
			$this->element_selector = '.sa-backdrop-filter-yes > .elementor-element-populated';
		}

		if ( 'container' === $element->get_name() ) {
			$this->element_selector = '.sa-backdrop-filter-yes > .e-con-inner, .sa-backdrop-filter-yes > .elementor-element';
		}

		$element->start_controls_section(
			'section_sky_addons_bf_controls',
			[ 
				'tab'   => $tab,
				'label' => esc_html__( 'Backdrop Filter', 'sky-elementor-addons' ) . sky_addons_get_icon(),
			]
		);

		$element->end_controls_section();
	}

	public function register_controls( $element, $args ) {

		$element->add_control(
			'sa_bf_enable',
			[ 
				'label'        => esc_html__( 'Enable', 'sky-elementor-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'render_type'  => 'template',
				'prefix_class' => 'sa-backdrop-filter-',
			]
		);

		$element->add_control(
			'sa_bf_blur',
			[ 
				'label'     => esc_html__( 'Blur', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 
					'px' => [ 
						'max'  => 200,
						'min'  => 0,
						'step' => .5
					],
				],
				// 'render_type'  => 'template',
				'condition' => [ 
					'sa_bf_enable' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}}' => '--sky-bf-blur: {{SIZE}}px;'
				],
			]
		);

		$element->add_control(
			'sa_bf_brightness',
			[ 
				'label'     => esc_html__( 'Brightness', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 
					'px' => [ 
						'max' => 200,
						'min' => 0,
					],
				],
				// 'render_type' => 'template',
				'condition' => [ 
					'sa_bf_enable' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}}' => '--sky-bf-brightness: {{SIZE}}%;'
				],
			]
		);

		$element->add_control(
			'sa_bf_contrast',
			[ 
				'label'     => esc_html__( 'Contrast', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 
					'px' => [ 
						'max'  => 2,
						'min'  => 0,
						'step' => 0.1,
					],
				],
				// 'render_type'  => 'template',
				'condition' => [ 
					'sa_bf_enable' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}}' => '--sky-bf-contrast: {{SIZE}};'
				],
			]
		);

		$element->add_control(
			'sa_bf_grayscale',
			[ 
				'label'     => esc_html__( 'Grayscale', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 
					'px' => [ 
						'max'  => 1,
						'min'  => 0,
						'step' => 0.1,
					],
				],
				// 'render_type'  => 'template',
				'condition' => [ 
					'sa_bf_enable' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}}' => '--sky-bf-grayscale: {{SIZE}};'
				],
			]
		);

		$element->add_control(
			'sa_bf_hue_rotate',
			[ 
				'label'     => esc_html__( 'Hue Rotate', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 
					'px' => [ 
						'max' => 180,
						'min' => 0,
					],
				],
				// 'render_type' => 'template',
				'condition' => [ 
					'sa_bf_enable' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}}' => '--sky-bf-hue-rotate: {{SIZE}}deg;'
				],
			]
		);

		$element->add_control(
			'sa_bf_invert',
			[ 
				'label'     => esc_html__( 'Invert', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 
					'px' => [ 
						'max'  => 1,
						'min'  => 0,
						'step' => 0.1,
					],
				],
				// 'render_type'  => 'template',
				'condition' => [ 
					'sa_bf_enable' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}}' => '--sky-bf-invert: {{SIZE}};'
				],
			]
		);

		$element->add_control(
			'sa_bf_opacity',
			[ 
				'label'     => esc_html__( 'Opacity', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 
					'px' => [ 
						'max'  => 1,
						'min'  => 0,
						'step' => 0.1,
					],
				],
				// 'render_type'  => 'template',
				'condition' => [ 
					'sa_bf_enable' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}}' => '--sky-bf-opacity: {{SIZE}};'
				],
			]
		);

		$element->add_control(
			'sa_bf_sepia',
			[ 
				'label'     => esc_html__( 'Sepia', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 
					'px' => [ 
						'max'  => 1,
						'min'  => 0,
						'step' => 0.1,
					],
				],
				// 'render_type'  => 'template',
				'condition' => [ 
					'sa_bf_enable' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}}' => '--sky-bf-sepia: {{SIZE}};'
				],
			]
		);

		$element->add_control(
			'sa_bf_saturate',
			[ 
				'label'     => esc_html__( 'Saturate', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [ 
					'px' => [ 
						'max'  => 2,
						'min'  => 0,
						'step' => 0.1,
					],
				],
				// 'render_type'  => 'template',
				'condition' => [ 
					'sa_bf_enable' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}}' => '--sky-bf-saturate: {{SIZE}};'
				],
			]
		);

		if ( 'section' !== $element->get_name() && 'container' !== $element->get_name() ) {
			$element->add_control(
				'sa_bf_output',
				[ 
					'type'        => Controls_Manager::HIDDEN,
					'default'     => '1',
					'selectors'   => [ 
						'{{WRAPPER}}' . $this->element_selector => '-webkit-backdrop-filter: blur(var(--sky-bf-blur, 0)) brightness(var(--sky-bf-brightness, 100%)) contrast(var(--sky-bf-contrast, 1)) grayscale(var(--sky-bf-grayscale, 0)) invert(var(--sky-bf-invert, 0)) opacity(var(--sky-bf-opacity, 1)) sepia(var(--sky-bf-sepia, 0)) saturate(var(--sky-bf-saturate, 1)) hue-rotate(var(--sky-bf-hue-rotate, 0));
      backdrop-filter: blur(var(--sky-bf-blur, 0)) brightness(var(--sky-bf-brightness, 100%)) contrast(var(--sky-bf-contrast, 1)) grayscale(var(--sky-bf-grayscale, 0)) invert(var(--sky-bf-invert, 0)) opacity(var(--sky-bf-opacity, 1)) sepia(var(--sky-bf-sepia, 0)) saturate(var(--sky-bf-saturate, 1)) hue-rotate(var(--sky-bf-hue-rotate, 0));'
					],
					'render_type' => 'template',
					'condition'   => [ 
						'sa_bf_enable' => 'yes',
					],
				]
			);
		}

		if ( 'section' === $element->get_name() || 'container' === $element->get_name() ) {

			$element->add_control(
				'sa_bf_selector',
				[ 
					'label'       => esc_html__( 'Creative Selector', 'sky-elementor-addons' ) . sky_addons_control_indicator_pro(),
					// 'description' => esc_html__('Default option is free and the Pro preview will work on Editor only.', 'sky-elementor-addons'),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'default',
					'options'     => [ 
						'default'    => esc_html__( 'Default', 'sky-elementor-addons' ),
						'bg_overlay' => esc_html__( 'Background Overlay', 'sky-elementor-addons' ),
					],
					'separator'   => 'before',
					'render_type' => 'template',
					'condition'   => [ 
						'sa_bf_enable' => 'yes'
					],
				]
			);

			$element->add_control(
				'sa_bf_selector_note',
				[ 
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => esc_html__( 'Note: This feature is little tricky to use. At first, set the Background of Section, then go Background Overlay of the same Section. Select Background Type Color, and then set the color transparent and set the Opacity 1. That\'s all.', 'sky-elementor-addons' ),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
					'condition'       => [ 
						'sa_bf_enable'   => 'yes',
						'sa_bf_selector' => 'bg_overlay'
					],
				]
			);

			$element->add_control(
				'sa_bf_output_1',
				[ 
					'type'        => Controls_Manager::HIDDEN,
					'default'     => '1',
					'selectors'   => [ 
						'{{WRAPPER}}' . $this->element_selector => '-webkit-backdrop-filter: blur(var(--sky-bf-blur, 0)) brightness(var(--sky-bf-brightness, 100%)) contrast(var(--sky-bf-contrast, 1)) grayscale(var(--sky-bf-grayscale, 0)) invert(var(--sky-bf-invert, 0)) opacity(var(--sky-bf-opacity, 1)) sepia(var(--sky-bf-sepia, 0)) saturate(var(--sky-bf-saturate, 1)) hue-rotate(var(--sky-bf-hue-rotate, 0));
      backdrop-filter: blur(var(--sky-bf-blur, 0)) brightness(var(--sky-bf-brightness, 100%)) contrast(var(--sky-bf-contrast, 1)) grayscale(var(--sky-bf-grayscale, 0)) invert(var(--sky-bf-invert, 0)) opacity(var(--sky-bf-opacity, 1)) sepia(var(--sky-bf-sepia, 0)) saturate(var(--sky-bf-saturate, 1)) hue-rotate(var(--sky-bf-hue-rotate, 0));'
					],
					'render_type' => 'template',
					'condition'   => [ 
						'sa_bf_enable'   => 'yes',
						'sa_bf_selector' => 'default'
					],
				]
			);

			/**
			 * Will works for Section Overlay Only
			 */

			// if (sky_addons_init_pro() == true || sky_editor_mode() == true) {
			$element->add_control(
				'sa_bf_output_2',
				[ 
					'type'        => Controls_Manager::HIDDEN,
					'default'     => '1',
					'selectors'   => [ 
						'{{WRAPPER}}.sa-backdrop-filter-yes > .elementor-background-overlay' => '-webkit-backdrop-filter: blur(var(--sky-bf-blur, 0)) brightness(var(--sky-bf-brightness, 100%)) contrast(var(--sky-bf-contrast, 1)) grayscale(var(--sky-bf-grayscale, 0)) invert(var(--sky-bf-invert, 0)) opacity(var(--sky-bf-opacity, 1)) sepia(var(--sky-bf-sepia, 0)) saturate(var(--sky-bf-saturate, 1)) hue-rotate(var(--sky-bf-hue-rotate, 0)) !important;
              backdrop-filter: blur(var(--sky-bf-blur, 0)) brightness(var(--sky-bf-brightness, 100%)) contrast(var(--sky-bf-contrast, 1)) grayscale(var(--sky-bf-grayscale, 0)) invert(var(--sky-bf-invert, 0)) opacity(var(--sky-bf-opacity, 1)) sepia(var(--sky-bf-sepia, 0)) saturate(var(--sky-bf-saturate, 1)) hue-rotate(var(--sky-bf-hue-rotate, 0)) !important;'
					],
					'render_type' => 'template',
					'condition'   => [ 
						'sa_bf_enable'   => 'yes',
						'sa_bf_selector' => 'bg_overlay'
					],
				]
			);
			// }

			// if ((sky_addons_init_pro() == true || sky_editor_mode() == true) && 'container' == $element->get_name()) {
			if ( 'container' == $element->get_name() ) {
				$element->add_control(
					'sa_bf_output_3',
					[ 
						'type'        => Controls_Manager::HIDDEN,
						'default'     => '1',
						'selectors'   => [ 
							'{{WRAPPER}}.sa-backdrop-filter-yes > .e-con-inner' => 'z-index: 1;',
							'{{WRAPPER}}.sa-backdrop-filter-yes > .e-con'       => 'z-index: 1;',
							'{{WRAPPER}}.sa-backdrop-filter-yes::after'         => 'content: ""; position: absolute; height: 100%; width: 100%; backdrop-filter: blur(10px); z-index: 0;-webkit-backdrop-filter: blur(var(--sky-bf-blur, 0)) brightness(var(--sky-bf-brightness, 100%)) contrast(var(--sky-bf-contrast, 1)) grayscale(var(--sky-bf-grayscale, 0)) invert(var(--sky-bf-invert, 0)) opacity(var(--sky-bf-opacity, 1)) sepia(var(--sky-bf-sepia, 0)) saturate(var(--sky-bf-saturate, 1)) hue-rotate(var(--sky-bf-hue-rotate, 0)) !important;
              backdrop-filter: blur(var(--sky-bf-blur, 0)) brightness(var(--sky-bf-brightness, 100%)) contrast(var(--sky-bf-contrast, 1)) grayscale(var(--sky-bf-grayscale, 0)) invert(var(--sky-bf-invert, 0)) opacity(var(--sky-bf-opacity, 1)) sepia(var(--sky-bf-sepia, 0)) saturate(var(--sky-bf-saturate, 1)) hue-rotate(var(--sky-bf-hue-rotate, 0)) !important;'
						],
						'render_type' => 'template',
						'condition'   => [ 
							'sa_bf_enable'   => 'yes',
							'sa_bf_selector' => 'bg_overlay'
						],
					]
				);
			}
		}
	}

	protected function add_actions() {

		// section
		add_action( 'elementor/element/section/section_background/after_section_end', [ $this, 'register_section' ] );
		add_action( 'elementor/element/section/section_sky_addons_bf_controls/before_section_end', [ $this, 'register_controls' ], 10, 2 );

		// container
		add_action( 'elementor/element/container/section_background/after_section_end', [ $this, 'register_section' ] );
		add_action( 'elementor/element/container/section_sky_addons_bf_controls/before_section_end', [ $this, 'register_controls' ], 10, 2 );

		// column
		add_action( 'elementor/element/column/section_style/after_section_end', [ $this, 'register_section' ] );
		add_action( 'elementor/element/column/section_sky_addons_bf_controls/before_section_end', [ $this, 'register_controls' ], 10, 2 );

		// widget
		add_action( 'elementor/element/common/_section_background/after_section_end', [ $this, 'register_section' ] );
		add_action( 'elementor/element/common/section_sky_addons_bf_controls/before_section_end', [ $this, 'register_controls' ], 10, 2 );
	}
}