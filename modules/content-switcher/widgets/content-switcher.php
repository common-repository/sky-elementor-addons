<?php

namespace Sky_Addons\Modules\ContentSwitcher\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;
use Sky_Addons\Sky_Addons_Plugin;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Content_Switcher extends Widget_Base {

	public function get_name() {
		return 'sky-content-switcher';
	}

	public function get_title() {
		return esc_html__( 'Content Switcher', 'sky-elementor-addons' );
	}

	public function get_icon() {
		return 'sky-icon-content-switcher';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'sky', 'toggle', 'content', 'switcher' ];
	}

	public function get_style_depends() {
		return [ 
			'elementor-icons-fa-solid',
		];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_switcher_layout',
			[ 
				'label' => esc_html__( 'Content Switcher', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'switcher_type',
			[ 
				'label' => esc_html__( 'Switcher Type', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'round',
				'options' => [ 
					'round' => esc_html__( 'Round', 'sky-elementor-addons' ),
					'round-fancy' => esc_html__( 'Round Fancy', 'sky-elementor-addons' ),
					'square' => esc_html__( 'Square', 'sky-elementor-addons' ),
					'square-fancy' => esc_html__( 'Square Fancy', 'sky-elementor-addons' ),
					'button' => esc_html__( 'Button', 'sky-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'switcher_note',
			[ 
				'label' => esc_html__( '', 'sky-elementor-addons' ),
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'Note: Only the first 2 items will be visible.', 'sky-elementor-addons' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				'condition' => [ 
					'switcher_type!' => 'button'
				]
			]
		);


		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[ 
				'label' => esc_html__( 'Title', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Primary', 'sky-elementor-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'content_source',
			[ 
				'label' => esc_html__( 'Choose Source', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'custom',
				'options' => [ 
					'custom' => esc_html__( 'Custom Content', 'sky-elementor-addons' ),
					'elementor' => esc_html__( 'Elementor Template', 'sky-elementor-addons' ),
					'anywhere' => esc_html__( 'AE Template', 'sky-elementor-addons' ),
				],
			]
		);

		$repeater->add_control(
			'custom_text',
			[ 
				'label' => esc_html__( 'Text', 'sky-elementor-addons' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sky-elementor-addons' ),
				'placeholder' => esc_html__( 'Type your description here', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
				'condition' => [ 'content_source' => 'custom' ]
			]
		);

		$repeater->add_control(
			'template_id',
			[ 
				'label' => esc_html__( 'Select Template', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '0',
				'options' => sky_elementor_template_settings(),
				'label_block' => 'true',
				'condition' => [ 'content_source' => 'elementor' ],
			]
		);

		$repeater->add_control(
			'anywhere_id',
			[ 
				'label' => esc_html__( 'Select Template', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '0',
				'options' => sky_anywhere_template_settings(),
				'label_block' => 'true',
				'condition' => [ 'content_source' => 'anywhere' ],
			]
		);

		$repeater->add_control(
			'icon',
			[ 
				'label' => esc_html__( 'Icon', 'sky-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
			]
		);

		$repeater->add_control(
			'icon_position',
			[ 
				'label' => esc_html__( 'Icon Position', 'sky-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [ 
					'before' => [ 
						'title' => esc_html__( 'Before', 'sky-elementor-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'after' => [ 
						'title' => esc_html__( 'After', 'sky-elementor-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'after',
				'toggle' => false,
				'condition' => [ 
					'icon[value]!' => ''
				],
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'item_active',
			[ 
				'label' => esc_html__( 'Active', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'switcher_list',
			[ 
				'label' => esc_html__( '', 'sky-elementor-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [ 
					[ 
						'title' => esc_html__( 'Primary', 'sky-elementor-addons' ),
						'custom_text' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'sky-elementor-addons' ),
						'item_active' => 'yes'
					],
					[ 
						'title' => esc_html__( 'Secondary', 'sky-elementor-addons' ),
						'custom_text' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'sky-elementor-addons' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional_layout',
			[ 
				'label' => esc_html__( 'Additional', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'switcher_alignment',
			[ 
				'label' => esc_html__( 'Switcher Alignment', 'sky-elementor-addons' ),
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
				],
				'selectors_dictionary' => [ 
					'left' => 'justify-content: left;',
					'center' => 'justify-content: center;',
					'right' => 'justify-content: right;'
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-switcher-container' => '{{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_switcher_style',
			[ 
				'label' => esc_html__( 'Switcher', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'switcher_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-switch-item',
			]
		);


		$this->add_responsive_control(
			'switcher_icon_spacing',
			[ 
				'label' => esc_html__( 'Icon Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-content-switcher' => '--sa-switcher-icon-spacing: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'switcher_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-switch-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 
					'switcher_type' => 'button'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'switcher_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-switcher-tabs',
				'condition' => [ 
					'switcher_type' => 'button'
				]
			]
		);

		$this->add_responsive_control(
			'switcher_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-switch-item, {{WRAPPER}} .sa-selector, {{WRAPPER}} .sa-switcher-tabs' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
				'condition' => [ 
					'switcher_type' => 'button'
				]
			]
		);

		$this->start_controls_tabs( 'tabs_switcher_style' );

		$this->start_controls_tab(
			'tab_switcher_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'switcher_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-switch-item, {{WRAPPER}} .sa-switch-item:focus' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'switcher_icon_color',
			[ 
				'label' => esc_html__( 'Icon Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-switch-item .sa-icon-wrapper' => 'color: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'switcher_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-switch-item:not(.sa-active)',
				'condition' => [ 
					'switcher_type' => 'button'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'switcher_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-switch-item',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'switcher_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-switch-item',
				'condition' => [ 
					'switcher_type' => 'button'
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_switcher_active',
			[ 
				'label' => esc_html__( 'Active', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'switcher_color_active',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-switch-item.sa-active' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'switcher_icon_color_active',
			[ 
				'label' => esc_html__( 'Icon Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-switch-item.sa-active .sa-icon-wrapper' => 'color: {{VALUE}}; fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'switcher_background_active',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-selector',
				'condition' => [ 
					'switcher_type' => 'button'
				]
			]
		);

		$this->add_control(
			'switcher_border_color_active',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-switch-item.sa-active' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'switcher_border_border!' => '',
				],
				'condition' => [ 
					'switcher_type' => 'button'
				]
			]
		);

		$this->add_responsive_control(
			'switcher_border_radius_active',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-switch-item.sa-active, {{WRAPPER}} .sa-switch-item.sa-active .sa-selector' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
				'condition' => [ 
					'switcher_type' => 'button'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'switcher_text_shadow_active',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-switch-item.sa-active',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'switcher_box_shadow_active',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-switch-item.sa-active',
				'condition' => [ 
					'switcher_type' => 'button'
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->end_controls_section();

		$this->start_controls_section(
			'section_switcher_bar_style',
			[ 
				'label' => esc_html__( 'Switcher Bar', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'switcher_bar_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-switcher-container',
			]
		);

		$this->add_responsive_control(
			'switcher_bar_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-switcher-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'switcher_bar_margin',
			[ 
				'label' => esc_html__( 'Margin', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-switcher-container' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'switcher_bar_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-switcher-container',
			]
		);

		$this->add_responsive_control(
			'switcher_bar_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-switcher-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_switcher_control_style',
			[ 
				'label' => esc_html__( 'Switcher', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'switcher_type!' => 'button'
				]
			]
		);


		$this->add_responsive_control(
			'switcher_control_size',
			[ 
				'label' => esc_html__( 'Size', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-switcher-toggle' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_switcher_control_style' );

		$this->start_controls_tab(
			'switcher_control_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);


		$this->add_control(
			'switcher_control_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-content-switcher .sa-switcher-slider:before' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'switcher_control_slider_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-switcher-slider',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'switcher_control_active',
			[ 
				'label' => esc_html__( 'Active', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'switcher_control_color_active',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-content-switcher input:checked+.sa-switcher-slider:before' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'switcher_control_slider_background_active',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-switcher-toggle input:checked+.sa-switcher-slider',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[ 
				'label' => esc_html__( 'Content', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_alignment',
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
					'{{WRAPPER}} .sa-switch-content-item' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'content_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-switch-content-item',
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-switch-content-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_margin',
			[ 
				'label' => esc_html__( 'Margin', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-switch-content-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-switch-content-item' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'content_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-switch-content-item',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'content_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-switch-content-item',
			]
		);

		$this->add_responsive_control(
			'content_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-switch-content-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'content_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-switch-content-item',
			]
		);


		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$id = 'sa-content-switcher-' . $this->get_id();
		$this->add_render_attribute( 'content-switcher', [ 
			'class' => [ 'sa-content-switcher', 'sa-style-' . $settings['switcher_type'] ],
			'data-settings' => [ 
				wp_json_encode( array_filter( [ 
					'id' => '#' . $id,
					'checkbox' => '#sa-checkbox-' . $id,
					'type' => $settings['switcher_type'],
					'borderSize' => isset( $settings['switcher_border_width']['right'] ) ? (int) $settings['switcher_border_width']['right'] : false
				] ) )
			]
		] );

		$primary = ( isset( $settings['switcher_list'][0] ) ? $settings['switcher_list'][0] : false );
		$secondary = ( isset( $settings['switcher_list'][1] ) ? $settings['switcher_list'][1] : false );

		$switcher_a_activated = $primary['item_active'] == 'yes' ? ' sa-active' : '';
		$switcher_b_activated = isset( $secondary['item_active'] ) && $secondary['item_active'] == 'yes' ? ' sa-active' : '';
		$switcher_b_checked = isset( $secondary['item_active'] ) && $secondary['item_active'] == 'yes' ? 'checked' : '';

		?>
		<div <?php $this->print_render_attribute_string( 'content-switcher' ); ?>>
			<div class="sa-switcher-container sa-d-flex sa-align-content-center sa-justify-content-center sa-mb-4">
				<div class="sa-switcher-wrap sa-d-inline-flex sa-align-items-center">
					<?php if ( $settings['switcher_type'] != 'button' ) : ?>
						<div
							class="sa-switch-item sa-d-flex sa-align-items-center sa-me-5 sa-primary<?php echo esc_attr( $switcher_a_activated ); ?>	sa-icon-position-<?php echo esc_html( $primary['icon_position'] ); ?>">

							<?php
							if ( ! empty( $primary['icon']['value'] ) ) : ?>
								<div class="sa-icon-wrapper sa-d-flex">
									<span class="sa-icon-wrap">
										<?php
										Icons_Manager::render_icon( $primary['icon'], [ 
											'aria-hidden' => 'true',
											'class' => 'sa-button-icon'
										] );
										?>
									</span>
								</div>
							<?php endif; ?>

							<span>
								<?php
								if ( isset( $primary['title'] ) ) {
									echo esc_html( $primary['title'] );
								}
								?>
							</span>
						</div>
						<div class="sa-switcher-toggle">
							<?php
							printf(
								'<input type="checkbox" id="sa-checkbox-%s"  %s>',
								esc_attr( $id ),
								esc_attr( $switcher_b_checked )
							);
							?>
							<label class="sa-switcher-slider" for="sa-checkbox-<?php echo esc_attr( $id ); ?>"></label>
						</div>
						<div
							class="sa-switch-item sa-d-flex sa-align-items-center sa-ms-5 sa-secondary<?php echo esc_attr( $switcher_b_activated ); ?> sa-icon-position-<?php echo esc_html( $secondary['icon_position'] ); ?>">
							<?php
							if ( ! empty( $secondary['icon']['value'] ) ) : ?>
								<div class="sa-icon-wrapper sa-d-flex">
									<span class="sa-icon-wrap">
										<?php
										Icons_Manager::render_icon( $secondary['icon'], [ 
											'aria-hidden' => 'true',
											'class' => 'sa-button-icon'
										] );
										?>
									</span>
								</div>
							<?php endif; ?>
							<span>
								<?php
								if ( isset( $secondary['title'] ) ) {
									echo esc_html( $secondary['title'] );
								}
								?>
							</span>
						</div>
					<?php else : ?>
						<div class="sa-switcher-tabs sa-d-inline-flex">
							<div class="sa-selector"></div>
							<?php
							foreach ( $settings['switcher_list'] as $index => $item ) :
								$active_item = $item['item_active'] == 'yes' ? ' sa-active' : '';
								$_item_id = $this->get_id() . '-' . $item['_id'];

								$this->add_render_attribute( 'switcher-item' . $index, [ 
									'class' => [ 
										'sa-switch-item sa-d-inline-flex sa-text-decoration-none',
										'sa-align-items-center',
										esc_html( $active_item ),
										'sa-icon-position-' . esc_html( $secondary['icon_position'] )
									],
									'data-id' => esc_attr( $_item_id ),
									'href' => 'javascript:void(0);'
								] );
								?>
								<a <?php $this->print_render_attribute_string( 'switcher-item' . $index ); ?>>
									<?php
									if ( ! empty( $item['icon']['value'] ) ) : ?>
										<div class="sa-icon-wrapper">
											<span class="sa-icon-wrap">
												<?php
												Icons_Manager::render_icon( $item['icon'], [ 
													'aria-hidden' => 'true',
													'class' => 'sa-button-icon'
												] );
												?>
											</span>
										</div>
									<?php endif; ?>
									<span>
										<?php
										if ( isset( $item['title'] ) ) {
											echo esc_html( $item['title'] );
										}
										?>
									</span>
								</a>
								<?php
							endforeach;
							?>
						</div>
					<?php endif; ?>
				</div>
			</div>
			<div class="sa-content-container">
				<div class="sa-content-wrapper">
					<?php if ( $settings['switcher_type'] != 'button' ) : ?>
						<div class="sa-switch-content-item sa-text-center sa-primary<?php echo esc_attr( $switcher_a_activated ); ?>">
							<?php
							if ( $primary['content_source'] == 'custom' && ! empty( $primary['content_source'] ) ) :
								echo wp_kses_post( $this->parse_text_editor( $primary['custom_text'] ) );
							elseif ( $primary['content_source'] == 'elementor' && ! empty( $primary['template_id'] ) ) :
								echo Sky_Addons_Plugin::elementor()->frontend->get_builder_content_for_display( $primary['template_id'] );
							elseif ( $primary['content_source'] == 'anywhere' && ! empty( $primary['anywhere_id'] ) ) :
								echo Sky_Addons_Plugin::elementor()->frontend->get_builder_content_for_display( $primary['anywhere_id'] );
							else :
								echo esc_html__( 'Sorry, You are doing something wrong!', 'sky-elementor-addons' );
							endif;
							?>
						</div>
						<div class="sa-switch-content-item sa-text-center sa-secondary<?php echo esc_attr( $switcher_b_activated ); ?>">
							<?php
							if ( $secondary !== false ) :
								if ( $secondary['content_source'] == 'custom' && ! empty( $secondary['content_source'] ) ) :
									echo wp_kses_post( $this->parse_text_editor( $secondary['custom_text'] ) );
								elseif ( $secondary['content_source'] == 'elementor' && ! empty( $secondary['template_id'] ) ) :
									echo Sky_Addons_Plugin::elementor()->frontend->get_builder_content_for_display( $secondary['template_id'] );
								elseif ( $secondary['content_source'] == 'anywhere' && ! empty( $secondary['anywhere_id'] ) ) :
									echo Sky_Addons_Plugin::elementor()->frontend->get_builder_content_for_display( $secondary['anywhere_id'] );
								else :
									echo esc_html__( 'Sorry, You are doing something wrong!', 'sky-elementor-addons' );
								endif;
							endif;
							?>
						</div>
					<?php else : ?>
						<?php
						foreach ( $settings['switcher_list'] as $index => $item ) :
							$active_item = $item['item_active'] == 'yes' ? ' sa-active' : '';
							$_item_id = $this->get_id() . '-' . $item['_id'];

							$this->add_render_attribute( 'content-item' . $index, [ 
								'class' => [ 
									'sa-switch-content-item sa-text-center',
									esc_html( $active_item ),
									'sa-icon-position-' . esc_html( $secondary['icon_position'] )
								],
								'id' => esc_attr( $_item_id ),
								'href' => 'javascript:void(0);'
							] );

							?>
							<div <?php $this->print_render_attribute_string( 'content-item' . $index ); ?>>
								<?php
								if ( $item['content_source'] == 'custom' && ! empty( $item['content_source'] ) ) :
									echo wp_kses_post( $this->parse_text_editor( $item['custom_text'] ) );
								elseif ( $item['content_source'] == 'elementor' && ! empty( $item['template_id'] ) ) :
									echo Sky_Addons_Plugin::elementor()->frontend->get_builder_content_for_display( $item['template_id'] );
								elseif ( $item['content_source'] == 'anywhere' && ! empty( $item['anywhere_id'] ) ) :
									echo Sky_Addons_Plugin::elementor()->frontend->get_builder_content_for_display( $item['anywhere_id'] );
								else :
									echo esc_html__( 'Sorry, You are doing something wrong!', 'sky-elementor-addons' );
								endif;
								?>
							</div>
							<?php
						endforeach;
						?>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
	}
}
