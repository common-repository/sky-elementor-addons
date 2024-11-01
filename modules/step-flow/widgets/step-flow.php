<?php

namespace Sky_Addons\Modules\StepFlow\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Step_Flow extends Widget_Base {

	public function get_name() {
		return 'sky-step-flow';
	}

	public function get_title() {
		return esc_html__( 'Step Flow', 'sky-elementor-addons' );
	}

	public function get_icon() {
		return 'sky-icon-step-flow';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'card', 'sky', 'step', 'flow' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_step_flow_layout',
			[ 
				'label' => esc_html__( 'Layout', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'icon',
			[ 
				'label' => esc_html__( 'Icon', 'sky-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'default' => [ 
					'value' => 'fas fa-laptop',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'title',
			[ 
				'label' => esc_html__( 'Title', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Your Step Heading', 'sky-elementor-addons' ),
				'placeholder' => esc_html__( 'Type your title here', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'title_tag',
			[ 
				'label' => esc_html__( 'Title HTML Tag', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => sky_title_tags(),
			]
		);

		$this->add_control(
			'desc',
			[ 
				'label' => esc_html__( 'Description', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus luctus nec.' ),
				'placeholder' => esc_html__( 'Type your description here', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'link',
			[ 
				'label' => esc_html__( 'Link', 'sky-elementor-addons' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'sky-elementor-addons' ),
				'show_external' => true,
				'default' => [ 
					'url' => '',
					'is_external' => false,
				],
				'dynamic' => [ 'active' => true ],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'show_badge',
			[ 
				'label' => esc_html__( 'Show Badge', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'badge_text',
			[ 
				'label' => esc_html__( 'Badge Text', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Step 1', 'sky-elementor-addons' ),
				'placeholder' => esc_html__( 'Badge Text', 'sky-elementor-addons' ),
				'condition' => [ 
					'show_badge' => 'yes'
				]
			]
		);

		$this->add_control(
			'badge_position',
			[ 
				'label' => esc_html__( 'Badge Position', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'top-left',
				'options' => [ 
					'top-left' => esc_html__( 'Top Left', 'sky-elementor-addons' ),
					'top-right' => esc_html__( 'Top Right', 'sky-elementor-addons' ),
					'bottom-left' => esc_html__( 'Bottom Left', 'sky-elementor-addons' ),
					'bottom-right' => esc_html__( 'Bottom Right', 'sky-elementor-addons' ),
					'top-center' => esc_html__( 'Top Center', 'sky-elementor-addons' ),
					'bottom-center' => esc_html__( 'Bottom Center', 'sky-elementor-addons' ),
				],
				'condition' => [ 
					'show_badge' => 'yes'
				]
			]
		);

		$this->add_control(
			'show_direction',
			[ 
				'label' => esc_html__( 'Show Direction', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'direction_type',
			[ 
				'label' => esc_html__( 'Direction Type', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'style-arrow',
				'options' => [ 
					'style-arrow' => esc_html__( 'Arrow', 'sky-elementor-addons' ),
					'style-line' => esc_html__( 'Line', 'sky-elementor-addons' ),
				],
				'prefix_class' => 'sa-direction-',
				'condition' => [ 
					'show_direction' => 'yes'
				]
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_step_flow_style',
			[ 
				'label' => esc_html__( 'Step Flow', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'step_flow_alignment',
			[ 
				'label' => esc_html__( 'Alignment', 'sky-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [ 
					'left' => [ 
						'title' => esc_html__( 'Left', 'sky-elementor-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [ 
						'title' => esc_html__( 'Center', 'sky-elementor-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [ 
						'title' => esc_html__( 'Right', 'sky-elementor-addons' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [ 
						'title' => esc_html__( 'Justified', 'sky-elementor-addons' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow' => 'text-align: {{VALUE}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[ 
				'label' => esc_html__( 'Content Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow .sa-content-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[ 
				'label' => esc_html__( 'Icon', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
			[ 
				'label' => esc_html__( 'Bottom Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
					'%' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow .sa-icon-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}}!important;',
				],
			]
		);


		$this->add_responsive_control(
			'icon_size',
			[ 
				'label' => esc_html__( 'Icon Size', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 200,
					],
					'%' => [ 
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow .sa-icon-wrap i' => 'font-size: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .sa-step-flow .sa-icon-wrap svg' => 'width: {{SIZE}}{{UNIT}}; height: auto;',
				],
			]
		);

		$this->add_control(
			'icon_offset_popover',
			[ 
				'label' => esc_html__( 'Offset', 'sky-elementor-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => esc_html__( 'Default', 'sky-elementor-addons' ),
				'label_on' => esc_html__( 'Custom', 'sky-elementor-addons' ),
				'return_value' => 'yes',
			]
		);


		$this->start_popover();

		$this->add_responsive_control(
			'icon_horizontal_offset',
			[ 
				'label' => esc_html__( 'Horizontal Offset', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [ 
					'size' => 0,
				],
				'tablet_default' => [ 
					'size' => 0,
				],
				'mobile_default' => [ 
					'size' => 0,
				],
				'range' => [ 
					'px' => [ 
						'min' => -300,
						'step' => 2,
						'max' => 300,
					],
				],
				'render_type' => 'ui',
				'condition' => [ 
					'icon_offset_popover' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow' => '--sky-step-flow-media-h-offset: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'icon_vertical_offset',
			[ 
				'label' => esc_html__( 'Vertical Offset', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [ 
					'size' => 0,
				],
				'tablet_default' => [ 
					'size' => 0,
				],
				'mobile_default' => [ 
					'size' => 0,
				],
				'range' => [ 
					'px' => [ 
						'min' => -300,
						'step' => 2,
						'max' => 300,
					],
				],
				'render_type' => 'ui',
				'condition' => [ 
					'icon_offset_popover' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow' => '--sky-step-flow-media-v-offset: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'icon_rotate',
			[ 
				'label' => esc_html__( 'Rotate', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => [ 
					'size' => 0,
				],
				'tablet_default' => [ 
					'size' => 0,
				],
				'mobile_default' => [ 
					'size' => 0,
				],
				'range' => [ 
					'px' => [ 
						'min' => -360,
						'max' => 360,
						'step' => 5,
					],
				],
				'condition' => [ 
					'icon_offset_popover' => 'yes'
				],
				'render_type' => 'ui',
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow' => '--sky-step-flow-media-rotate: {{SIZE}}deg;'
				],
			]
		);

		$this->end_popover();

		$this->add_responsive_control(
			'icon_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow .sa-icon-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'icon_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-step-flow .sa-icon-wrap',
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow .sa-icon-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 
					'show_adv_border_radius!' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_adv_border_radius',
			[ 
				'label' => esc_html__( 'Advanced Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'adv_border_radius',
			[ 
				'label' => esc_html__( 'Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '30% 70% 70% 30% / 30% 30% 70% 70% ', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow .sa-icon-wrap' => 'border-radius: {{VALUE}};',
				],
				'condition' => [ 
					'show_adv_border_radius' => 'yes',
				],
			]
		);

		$this->add_control(
			'adv_border_radius_note',
			[ 
				'type' => Controls_Manager::RAW_HTML,
				'raw' => sprintf( esc_html__( "You can easily generate Radius value from this link <a href='%1s' target='_blank'> Go </a>.", 'sky-elementor-addons' ), "https://9elements.github.io/fancy-border-radius/" ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				'condition' => [ 
					'show_adv_border_radius' => 'yes',
				],
			]
		);


		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab(
			'tab_icon_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'icon_color',
			[ 
				'label' => esc_html__( 'Icon Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow .sa-icon-wrap' => 'color: {{VALUE}}',
				],
				'condition' => [ 
					'icon_is_svg!' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'icon_bg',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-step-flow .sa-icon-wrap',
			]
		);


		$this->add_control(
			'icon_opacity',
			[ 
				'label' => esc_html__( 'Opacity', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow .sa-icon-wrap i, svg' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'icon_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-step-flow .sa-icon-wrap',
			]
		);

		$this->add_control(
			'icon_is_svg',
			[ 
				'label' => esc_html__( 'SVG Using?', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'icon_is_svg_note',
			[ 
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'Please activate this option if you are using SVG image as a Icon.', 'sky-elementor-addons' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				'condition' => [ 
					'icon_is_svg!' => 'yes'
				]
			]
		);

		$this->add_control(
			'icon_svg_fill_color',
			[ 
				'label' => esc_html__( 'Fill Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow .sa-icon-wrap *' => 'fill: {{VALUE}}',
				],
				'condition' => [ 
					'icon_is_svg' => 'yes'
				]
			]
		);

		$this->add_control(
			'icon_svg_stroke_color',
			[ 
				'label' => esc_html__( 'Stroke Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow .sa-icon-wrap *' => 'stroke: {{VALUE}}',
				],
				'condition' => [ 
					'icon_is_svg' => 'yes'
				]
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'icon_color_hover',
			[ 
				'label' => esc_html__( 'Icon Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} > .elementor-widget-container:hover  .sa-step-flow .sa-icon-wrap' => 'color: {{VALUE}}',
				],
				'condition' => [ 
					'icon_is_svg!' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'icon_bg_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}}  .elementor-widget-container:hover .sa-step-flow .sa-icon-wrap',
			]
		);

		$this->add_control(
			'icon_opacity_hover',
			[ 
				'label' => esc_html__( 'Opacity', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .elementor-widget-container:hover .sa-step-flow .sa-icon-wrap i, svg' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'icon_box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}}  .elementor-widget-container:hover .sa-step-flow .sa-icon-wrap',
			]
		);

		$this->add_control(
			'icon_is_svg_hover',
			[ 
				'label' => esc_html__( 'SVG Using?', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'icon_is_svg_hover_note_hover',
			[ 
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'Please activate this option if you are using SVG image as a Icon.', 'sky-elementor-addons' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				'condition' => [ 
					'icon_is_svg_hover!' => 'yes'
				]
			]
		);

		$this->add_control(
			'icon_svg_fill_color_hover',
			[ 
				'label' => esc_html__( 'Fill Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .elementor-widget-container:hover .sa-icon-wrap *' => 'fill: {{VALUE}}',
				],
				'condition' => [ 
					'icon_is_svg_hover' => 'yes'
				]
			]
		);

		$this->add_control(
			'icon_svg_stroke_color_hover',
			[ 
				'label' => esc_html__( 'Stroke Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .elementor-widget-container:hover .sa-icon-wrap *' => 'stroke: {{VALUE}}',
				],
				'condition' => [ 
					'icon_is_svg_hover' => 'yes'
				]
			]
		);

		$this->add_control(
			'icon_transition',
			[ 
				'label' => esc_html__( 'Transition Duration (s)', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow .sa-icon-wrap i, svg' => 'transition-duration: {{SIZE}}s',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_badge_style',
			[ 
				'label' => esc_html__( 'Badge', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_badge' => 'yes'
				]
			]
		);


		$this->add_control(
			'badge_offset_popover',
			[ 
				'label' => esc_html__( 'Offset', 'sky-elementor-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => esc_html__( 'Default', 'sky-elementor-addons' ),
				'label_on' => esc_html__( 'Custom', 'sky-elementor-addons' ),
				'return_value' => 'yes',
			]
		);


		$this->start_popover();

		$this->add_responsive_control(
			'badge_horizontal_offset',
			[ 
				'label' => esc_html__( 'Horizontal Offset', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [ 
					'size' => 0,
				],
				'tablet_default' => [ 
					'size' => 0,
				],
				'mobile_default' => [ 
					'size' => 0,
				],
				'range' => [ 
					'px' => [ 
						'min' => -300,
						'step' => 2,
						'max' => 300,
					],
				],
				'render_type' => 'ui',
				'condition' => [ 
					'badge_offset_popover' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}}' => '--sky-step-flow-badge-h-offset: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'badge_vertical_offset',
			[ 
				'label' => esc_html__( 'Vertical Offset', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [ 
					'size' => 0,
				],
				'tablet_default' => [ 
					'size' => 0,
				],
				'mobile_default' => [ 
					'size' => 0,
				],
				'range' => [ 
					'px' => [ 
						'min' => -300,
						'step' => 2,
						'max' => 300,
					],
				],
				'render_type' => 'ui',
				'condition' => [ 
					'badge_offset_popover' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow .sa-badge' => '--sky-step-flow-badge-v-offset: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'badge_rotate',
			[ 
				'label' => esc_html__( 'Rotate', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => [ 
					'size' => 0,
				],
				'tablet_default' => [ 
					'size' => 0,
				],
				'mobile_default' => [ 
					'size' => 0,
				],
				'range' => [ 
					'px' => [ 
						'min' => -360,
						'max' => 360,
						'step' => 5,
					],
				],
				'render_type' => 'ui',
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow .sa-badge' => '--sky-step-flow-badge-rotate: {{SIZE}}deg;'
				],
			]
		);

		$this->end_popover();

		$this->add_responsive_control(
			'badge_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow .sa-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'badge_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow .sa-badge' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'badge_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-step-flow .sa-badge',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'badge_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-step-flow .sa-badge',
			]
		);

		$this->add_responsive_control(
			'badge_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow .sa-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'badge_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-step-flow .sa-badge',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'badge_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-step-flow .sa-badge',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[ 
				'label' => esc_html__( 'Title', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'title!' => '',
				]
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[ 
				'label' => esc_html__( 'Bottom Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow .sa-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-step-flow .sa-title',
			]
		);

		$this->start_controls_tabs( 'tabs_title_style' );

		$this->start_controls_tab(
			'tab_title_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'title_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow .sa-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'title_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-step-flow .sa-title',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'title_color_hover',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow .sa-title:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'title_text_shadow_hover',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-step-flow .sa-title:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_desc_style',
			[ 
				'label' => esc_html__( 'Description', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'desc!' => '',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'desc_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-step-flow .sa-desc',
			]
		);

		$this->start_controls_tabs( 'tabs_desc_style' );

		$this->start_controls_tab(
			'tab_desc_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'desc_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow .sa-desc' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_desc_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'desc_color_hover',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow .sa-desc:hover' => 'color: {{VALUE}}',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_direction_style',
			[ 
				'label' => esc_html__( 'Direction', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_direction' => 'yes'
				]
			]
		);

		$this->add_control(
			'direction_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow' => '--sky-step-flow-arrow-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'direction_style',
			[ 
				'label' => esc_html__( 'Style', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [ 
					'solid' => esc_html__( 'Solid', 'sky-elementor-addons' ),
					'dotted' => esc_html__( 'Dotted', 'sky-elementor-addons' ),
					'dashed' => esc_html__( 'Dashed', 'sky-elementor-addons' ),
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow' => '--sky-step-flow-arrow-style: {{VALUE}};',
				],
			]
		);


		$this->add_responsive_control(
			'direction_thickness',
			[ 
				'label' => esc_html__( 'Thickness', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 5,
						'step' => 1,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow' => '--sky-step-flow-arrow-thickness: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'direction_width',
			[ 
				'label' => esc_html__( 'Width', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 150,
						'step' => 1,
					],
					'%' => [ 
						'min' => 0,
						'max' => 150,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow .sa-icon-wrap .sa-step-arrow' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'direction_offset_popover',
			[ 
				'label' => esc_html__( 'Offset', 'sky-elementor-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => esc_html__( 'Default', 'sky-elementor-addons' ),
				'label_on' => esc_html__( 'Custom', 'sky-elementor-addons' ),
				'return_value' => 'yes',
			]
		);


		$this->start_popover();

		$this->add_responsive_control(
			'direction_top_offset',
			[ 
				'label' => esc_html__( 'Offset Top', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'tablet_default' => [ 
					'size' => 0,
				],
				'mobile_default' => [ 
					'size' => 0,
				],
				'range' => [ 
					'px' => [ 
						'min' => -100,
						'step' => 2,
						'max' => 100,
					],
				],
				'render_type' => 'ui',
				'condition' => [ 
					'direction_offset_popover' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow' => '--sky-step-flow-direction-top-offset: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'direction_left_offset',
			[ 
				'label' => esc_html__( 'Offset Left', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'tablet_default' => [ 
					'size' => 0,
				],
				'mobile_default' => [ 
					'size' => 0,
				],
				'range' => [ 
					'px' => [ 
						'min' => -100,
						'step' => 2,
						'max' => 100,
					],
				],
				'render_type' => 'ui',
				'condition' => [ 
					'direction_offset_popover' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow' => '--sky-step-flow-direction-left-offset: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'direction_rotate',
			[ 
				'label' => esc_html__( 'Rotate', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => [ 
					'size' => 0,
				],
				'tablet_default' => [ 
					'size' => 0,
				],
				'mobile_default' => [ 
					'size' => 0,
				],
				'range' => [ 
					'px' => [ 
						'min' => -360,
						'max' => 360,
						'step' => 5,
					],
				],
				'condition' => [ 
					'direction_offset_popover' => 'yes'
				],
				'render_type' => 'ui',
				'selectors' => [ 
					'{{WRAPPER}} .sa-step-flow' => '--sky-step-flow-direction-rotate: {{SIZE}}deg;'
				],
			]
		);

		$this->end_popover();


		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'badge_text', 'class', 'sa-badge' );
		$this->add_render_attribute( 'badge_text', 'class', ( $settings['show_badge'] == 'yes' ) ? $settings['badge_position'] : '' );
		$this->add_inline_editing_attributes( 'badge_text', 'none' );
		$this->add_render_attribute( 'link_attr', 'class', 'sa-text-decoration-none' );
		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'link_attr', 'href', esc_url( $settings['link']['url'] ) );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'link_attr', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'link_attr', 'rel', 'nofollow' );
			}
		} else {
			$this->add_render_attribute( 'link_attr', 'href', 'javascript:void(0);' );
		}
		?>
		<div class="sa-step-flow sa-text-center">
			<?php if ( ! empty( $settings['icon']['value'] ) || ! empty( $settings['badge_text'] ) || $settings['show_direction'] == 'yes' ) : ?>
				<div class="sa-icon-wrap">
					<?php
					if ( $settings['show_badge'] == 'yes' && ! empty( $settings['badge_text'] ) ) :
						printf(
							'<span %1$s>%2$s</span>',
							wp_kses_post( $this->get_render_attribute_string( 'badge_text' ) ),
							esc_html( $settings['badge_text'] )
						);
					endif;

					if ( ! empty( $settings['icon']['value'] ) ) :
						Icons_Manager::render_icon( $settings['icon'], [ 
							'aria-hidden' => 'true',
						] );
					endif;

					if ( $settings['show_direction'] == 'yes' ) : ?>
						<span class="sa-step-arrow"></span>
					<?php endif; ?>

				</div>
			<?php endif; ?>

			<div class="sa-content-area">
				<?php if ( ! empty( $settings['title'] ) ) : ?>
					<<?php echo esc_attr( Utils::validate_html_tag( $settings['title_tag'] ) ); ?> class="sa-title sa--title
						sa--text-title sa-fs-4 sa-mt-0 sa-mb-3">
						<a <?php $this->print_render_attribute_string( 'link_attr' ); ?>>
							<?php echo wp_kses_post( $settings['title'] ); ?>
						</a>
					</<?php echo esc_attr( Utils::validate_html_tag( $settings['title_tag'] ) ); ?>>
				<?php endif; ?>

				<?php if ( ! empty( $settings['desc'] ) ) : ?>
					<div class="sa-desc sa--text sa--text-info">
						<?php echo wp_kses_post( $settings['desc'] ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
