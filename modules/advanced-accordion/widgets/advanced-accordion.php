<?php

namespace Sky_Addons\Modules\AdvancedAccordion\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;
use Sky_Addons\Sky_Addons_Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Advanced_Accordion extends Widget_Base {

	public function get_name() {
		return 'sky-advanced-accordion';
	}

	public function get_title() {
		return esc_html__( 'Advanced Accordion', 'sky-elementor-addons' );
	}

	public function get_icon() {
		return 'sky-icon-advanced-accordion';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'sky', 'advanced', 'accordion', 'collapse' ];
	}

	public function get_style_depends() {
		return [ 
			'sa-accordion',
			'elementor-icons-fa-solid',
		];
	}

	public function get_script_depends() {
		return [ 'sa-accordion' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_ad_acc',
			[ 
				'label' => esc_html__( 'Layout', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[ 
				'label' => esc_html__( 'Title', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 2,
				'default' => esc_html__( 'Accordion Title', 'sky-elementor-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'title_icon',
			[ 
				'label' => esc_html__( 'Title Icon', 'sky-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
				'skin' => 'inline',
				'label_block' => false,
				'separator' => 'before',
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
			'custom_content',
			[ 
				'label' => esc_html__( 'Custom Content', 'sky-elementor-addons' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sky-elementor-addons' ),
				'placeholder' => esc_html__( 'Type your description here', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
				'condition' => [ 'content_source' => 'custom' ],
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

		$this->add_control(
			'acc_list',
			[ 
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [ 
					[ 
						'title' => esc_html__( 'Add Your Title Here #1', 'sky-elementor-addons' ),
					],
					[ 
						'title' => esc_html__( 'Add Your Title Here #2', 'sky-elementor-addons' ),
					],
					[ 
						'title' => esc_html__( 'Add Your Title Here #3', 'sky-elementor-addons' ),
					],
					[ 
						'title' => esc_html__( 'Add Your Title Here #4', 'sky-elementor-addons' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_control(
			'title_tag',
			[ 
				'label' => esc_html__( 'Title HTML Tag', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => sky_title_tags(),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_title_icon',
			[ 
				'label' => esc_html__( 'Show Title Icon?', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'icon_align',
			[ 
				'label' => esc_html__( 'Icon Alignment', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [ 
					'left' => [ 
						'title' => esc_html__( 'Start', 'elementor' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [ 
						'title' => esc_html__( 'End', 'elementor' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => is_rtl() ? 'right' : 'left',
				'toggle' => false,
				'separator' => 'before',
				'prefix_class' => 'sa-icon-direction-',
			]
		);

		$this->add_control(
			'selected_icon',
			[ 
				'label' => esc_html__( 'Icon', 'elementor' ),
				'type' => Controls_Manager::ICONS,
				'default' => [ 
					'value' => 'fas fa-plus',
					'library' => 'fa-solid',
				],
				'recommended' => [ 
					'fa-solid' => [ 
						'chevron-down',
						'angle-down',
						'angle-double-down',
						'caret-down',
						'caret-square-down',
						'plus',
					],
					'fa-regular' => [ 
						'caret-square-down',
					],
				],
				'skin' => 'inline',
				'label_block' => false,
			]
		);

		$this->add_control(
			'selected_active_icon',
			[ 
				'label' => esc_html__( 'Active Icon', 'elementor' ),
				'type' => Controls_Manager::ICONS,
				'default' => [ 
					'value' => 'fas fa-minus',
					'library' => 'fa-solid',
				],
				'recommended' => [ 
					'fa-solid' => [ 
						'chevron-up',
						'angle-up',
						'angle-double-up',
						'caret-up',
						'caret-square-up',
						'minus',
					],
					'fa-regular' => [ 
						'caret-square-up',
					],
				],
				'skin' => 'inline',
				'label_block' => false,
				'condition' => [ 
					'selected_icon[value]!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_acc_settings',
			[ 
				'label' => esc_html__( 'Settings', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'acc_duration',
			[ 
				'label' => esc_html__( 'Duration', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 400,
						'max' => 1000,
					],
				],
				'default' => [ 
					'unit' => 'px',
					'size' => 400,
				],
			]
		);

		$this->add_control(
			'acc_collapse',
			[ 
				'label' => esc_html__( 'Collapse', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'acc_show_multiple',
			[ 
				'label' => esc_html__( 'Show Multiple?', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'acc_open_default',
			[ 
				'label' => esc_html__( 'Open Item Default', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__( '1 or 1, 2, 3', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_item_style',
			[ 
				'label' => esc_html__( 'Item', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_spacing',
			[ 
				'label' => esc_html__( 'Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} ' => '--sa-acc-item-spacing: {{SIZE}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'item_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-ac-item',
			]
		);

		$this->add_responsive_control(
			'item_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-ac-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'item_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-ac-item',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'item_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-ac-item',
			]
		);

		$this->start_controls_tabs( 'item_tabs' );

		$this->start_controls_tab(
			'item_tab_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'item_border_color_hover',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-ac-item:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'item_border_border!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'item_box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-ac-item:hover',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'item_tab_active',
			[ 
				'label' => esc_html__( 'Active', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'item_border_color_active',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-ac-item.is-active' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'item_border_border!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'item_box_shadow_active',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-ac-item.is-active',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[ 
				'label' => esc_html__( 'Title', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa--title:not(.sa-ac-panel .sa--titler)',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'title_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa--title:not(.sa-ac-panel .sa--titler)',
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-ac-item .sa-ac-trigger:not(.sa-ac-panel .sa-ac-trigger)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'title_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-ac-item .sa-ac-trigger:not(.sa-ac-panel .sa-ac-trigger)',
			]
		);

		$this->add_responsive_control(
			'title_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-ac-item .sa-ac-trigger:not(.sa-ac-panel .sa-ac-trigger)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'title_tabs' );

		$this->start_controls_tab(
			'title_tab_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'title_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa--title:not(.sa-ac-panel .sa--title)' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'title_bg',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-ac-item .sa-ac-trigger:not(.sa-ac-panel .sa-ac-trigger)',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'title_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-ac-item .sa-ac-trigger:not(.sa-ac-panel .sa-ac-trigger)',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_tab_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'title_color_hover',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-ac-trigger:hover .sa--title:not(.sa-ac-panel .sa--title)' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_border_color_hover',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-ac-trigger:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'title_border_border!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'title_bg_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-ac-item .sa-ac-trigger:hover:not(.sa-ac-panel .sa-ac-trigger)',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'title_box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-ac-item .sa-ac-trigger:hover',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_tab_active',
			[ 
				'label' => esc_html__( 'Active', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'title_color_active',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-ac-item.is-active .sa-ac-trigger .sa--title:not(.sa-ac-panel .sa--title)' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_border_color_active',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-ac-item.is-active .sa-ac-trigger:not(.sa-ac-panel .sa-ac-trigger)' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'title_border_border!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'title_bg_active',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-ac-item.is-active .sa-ac-trigger:not(.sa-ac-panel .sa-ac-trigger)',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'title_box_shadow_active',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-ac-item.is-active .sa-ac-trigger:not(.sa-ac-panel .sa-ac-trigger)',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_icon_style',
			[ 
				'label' => esc_html__( 'Title Icon', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 'show_title_icon' => 'yes' ],
			]
		);

		$this->add_responsive_control(
			'title_icon_size',
			[ 
				'label' => esc_html__( 'Size', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 6,
						'max' => 40,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-title-icon.sa-icon-wrap' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_icon_spacing',
			[ 
				'label' => esc_html__( 'Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					// '{{WRAPPER}} .sa-title-icon.sa-icon-wrap' => '--sa-acc-icon-spacing: {{SIZE}}px;',
					'{{WRAPPER}} .sa-title-icon.sa-icon-wrap' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_icon_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-title-icon.sa-icon-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'title_icon_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-title-icon.sa-icon-wrap',
			]
		);

		$this->add_responsive_control(
			'title_icon_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-title-icon.sa-icon-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'title_icon_tabs' );

		$this->start_controls_tab(
			'title_icon_tab_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'title_icon_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-title-icon.sa-icon-wrap' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'title_icon_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-title-icon.sa-icon-wrap',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'title_icon_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-title-icon.sa-icon-wrap',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_icon_tab_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'title_icon_color_hover',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-ac-item:hover .sa-title-icon.sa-icon-wrap' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_icon_border_color_hover',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-ac-item:hover .sa-title-icon.sa-icon-wrap' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'title_icon_border_border!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'title_icon_bg_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-ac-item:hover .sa-title-icon.sa-icon-wrap',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'title_icon_box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-ac-item:hover .sa-title-icon.sa-icon-wrap',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'title_icon_tab_active',
			[ 
				'label' => esc_html__( 'Active', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'title_icon_color_active',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-ac-item.is-active .sa-title-icon.sa-icon-wrap' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_icon_border_color_active',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-ac-item.is-active .sa-title-icon.sa-icon-wrap' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'title_icon_border_border!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'title_icon_bg_active',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-ac-item.is-active .sa-title-icon.sa-icon-wrap',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'title_icon_box_shadow_active',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-ac-item.is-active .sa-title-icon.sa-icon-wrap',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[ 
				'label' => esc_html__( 'Icon', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[ 
				'label' => esc_html__( 'Size', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 6,
						'max' => 40,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-trigger-icon .sa-icon-wrap' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_spacing',
			[ 
				'label' => esc_html__( 'Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} ' => '--sa-acc-icon-spacing: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-trigger-icon.sa-icon-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'icon_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-trigger-icon.sa-icon-wrapper',
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-trigger-icon.sa-icon-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'icon_tabs' );

		$this->start_controls_tab(
			'icon_tab_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'icon_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-trigger-icon.sa-icon-wrapper' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'icon_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-trigger-icon.sa-icon-wrapper',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'icon_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-trigger-icon.sa-icon-wrapper',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_tab_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'icon_color_hover',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-ac-item:hover .sa-trigger-icon.sa-icon-wrapper' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_border_color_hover',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-ac-item:hover .sa-trigger-icon.sa-icon-wrapper' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'icon_border_border!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'icon_bg_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-ac-item:hover .sa-trigger-icon.sa-icon-wrapper',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'icon_box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-ac-item:hover .sa-trigger-icon.sa-icon-wrapper',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_tab_active',
			[ 
				'label' => esc_html__( 'Active', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'icon_color_active',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-ac-item.is-active .sa-trigger-icon.sa-icon-wrapper' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_border_color_active',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-ac-item.is-active .sa-trigger-icon.sa-icon-wrapper' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'icon_border_border!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'icon_bg_active',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-ac-item.is-active .sa-trigger-icon.sa-icon-wrapper',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'icon_box_shadow_active',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-ac-item.is-active .sa-trigger-icon.sa-icon-wrapper',
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
					'{{WRAPPER}} .sa-ac-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-ac-content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'content_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .sa-ac-content',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'content_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-ac-content',
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-ac-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'content_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-ac-panel',
			]
		);

		$this->add_responsive_control(
			'content_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-ac-panel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'content_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-ac-panel',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		//        acc_open_default
		$acc_open = explode( ',', $settings['acc_open_default'] );

		$open_init_arr = [];
		foreach ( $acc_open as $open_init ) {
			$open_init_arr[] = (int) $open_init - 1;
		}

		$this->add_render_attribute(
			[ 
				'advanced-accordion' => [ 
					'id' => 'sa-advanced-acc-' . $this->get_id(),
					'class' => 'sa-advanced-accordion',
					'data-settings' => [ 
						wp_json_encode(
							[ 
								'id' => 'sa-advanced-acc-' . $this->get_id(),
								'duration' => ( ! empty( $settings['acc_duration']['size'] ) ) ? $settings['acc_duration']['size'] : 400,
								'collapse' => ( isset( $settings['acc_collapse'] ) && ( $settings['acc_collapse'] == 'yes' ) ) ? true : false,
								'showMultiple' => ( isset( $settings['acc_show_multiple'] ) && ( $settings['acc_show_multiple'] == 'yes' ) ) ? true : false,
								'openOnInit' => ( ! empty( $settings['acc_open_default'] ) ) ? $open_init_arr : [],
							]
						),
					],
				],
			]
		);

		?>

		<div <?php $this->print_render_attribute_string( 'advanced-accordion' ); ?>>

			<?php foreach ( $settings['acc_list'] as $index => $item ) : ?>

				<div class="sa-ac-item">
					<div class="sa-ac-trigger">

						<div class="sa-title-wrapper">
							<?php if ( 'yes' == $settings['show_title_icon'] && ! empty( $item['title_icon']['value'] ) ) : ?>
								<div class="sa-title-icon sa-icon-wrap sa-me-2">
									<?php
									Icons_Manager::render_icon( $item['title_icon'] );
									?>
								</div>
							<?php endif; ?>
							<?php
							printf(
								'<%1$s class="sa--title sa--text-title sa-ac-title sa-m-0 sa-p-0"> %2$s </%1$s>',
								esc_attr( Utils::validate_html_tag( $settings['title_tag'] ) ),
								esc_html( $item['title'] )
							);
							?>
						</div>
						<span class="sa-trigger-icon sa-icon-wrapper sa-ac-icon-<?php echo esc_attr( $settings['icon_align'] ); ?>">
							<span class="sa-ac-icon-closed sa-icon-wrap">
								<?php
								if ( ! empty( $settings['selected_icon']['value'] ) ) {
									Icons_Manager::render_icon( $settings['selected_icon'] );
								}
								?>
							</span>
							<span class="sa-ac-icon-opened sa-icon-wrap">
								<?php
								if ( ! empty( $settings['selected_active_icon']['value'] ) ) {
									Icons_Manager::render_icon( $settings['selected_active_icon'] );
								}
								?>
							</span>
						</span>
					</div>
					<div class="sa-ac-panel">
						<div class="sa-ac-content">
							<?php
							if ( 'custom' == $item['content_source'] && ! empty( $item['content_source'] ) ) :
								echo wp_kses_post( $this->parse_text_editor( $item['custom_content'] ) );
							elseif ( 'elementor' == $item['content_source'] && ! empty( $item['template_id'] ) ) :
								echo Sky_Addons_Plugin::elementor()->frontend->get_builder_content_for_display( $item['template_id'] );
							elseif ( 'anywhere' == $item['content_source'] && ! empty( $item['anywhere_id'] ) ) :
								echo Sky_Addons_Plugin::elementor()->frontend->get_builder_content_for_display( $item['anywhere_id'] );
							else :
								esc_html_e( 'Sorry, You are doing something wrong!', 'sky-elementor-addons' );
							endif;
							// TODO modify link
							// echo sky_template_modify_link(520);
							// $item['template_id']
							?>
						</div>
					</div>
				</div>

			<?php endforeach; ?>

		</div>

		<?php
	}
}
