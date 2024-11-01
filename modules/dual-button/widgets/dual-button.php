<?php

namespace Sky_Addons\Modules\DualButton\Widgets;

//use Elementor\Utils;
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

class Dual_Button extends Widget_Base {

	public function get_name() {
		return 'sky-dual-button';
	}

	public function get_title() {
		return esc_html__( 'Dual Button', 'sky-elementor-addons' );
	}

	public function get_icon() {
		return 'sky-icon-dual-button';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'sky', 'dual', 'buttons' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'dual_buttons_layout',
			[ 
				'label' => esc_html__( 'Dual Buttons', 'sky-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'dual_button_alignment',
			[ 
				'label'     => esc_html__( 'Alignment', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [ 
					'flex-start' => [ 
						'title' => esc_html__( 'Left', 'sky-elementor-addons' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center'     => [ 
						'title' => esc_html__( 'Center', 'sky-elementor-addons' ),
						'icon'  => 'eicon-h-align-center',
					],
					'flex-end'   => [ 
						'title' => esc_html__( 'Right', 'sky-elementor-addons' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'   => 'center',
				'toggle'    => false,
				'selectors' => [ 
					'{{WRAPPER}} .sa-dual-button' => 'justify-content: {{VALUE}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'dual_button_width',
			[ 
				'label'      => esc_html__( 'Width', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ '%' ],
				'range'      => [ 
					'%' => [ 
						'min' => 25,
						'max' => 100,
					],
				],
				'default'    => [ 
					'unit' => '%',
					//                        'size' => 50,
				],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-dual-button-container' => 'width: {{SIZE}}%;',
				],
			]
		);

		$this->add_responsive_control(
			'button_space_between',
			[ 
				'label'      => esc_html__( 'Space Between', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range'      => [ 
					'px' => [ 
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],
					'%'  => [ 
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-btn-a' => 'margin-right: calc({{SIZE}}{{UNIT}}/2);',
					'{{WRAPPER}} .sa-btn-b' => 'margin-left: calc({{SIZE}}{{UNIT}}/2);',
				],
			]
		);

		$this->add_control(
			'show_separator',
			[ 
				'label'     => esc_html__( 'Show Separator', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'separator_content_type',
			[ 
				'label'          => esc_html__( 'Content Type', 'sky-elementor-addons' ),
				'type'           => Controls_Manager::CHOOSE,
				'label_block'    => false,
				'options'        => [ 
					'text' => [ 
						'title' => esc_html__( 'Text', 'sky-elementor-addons' ),
						'icon'  => 'fas fa-text-height',
					],
					'icon' => [ 
						'title' => esc_html__( 'Icon', 'sky-elementor-addons' ),
						'icon'  => 'far fa-heart',
					],
				],
				'default'        => 'text',
				'toggle'         => false,
				'style_transfer' => true,
				'condition'      => [ 
					'show_separator' => 'yes'
				]
			]
		);

		$this->add_control(
			'separator_content_text',
			[ 
				'label'     => esc_html__( 'Text', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__( 'or', 'sky-elementor-addons' ),
				'dynamic'   => [ 'active' => true ],
				'condition' => [ 
					'separator_content_type' => 'text',
					'show_separator'         => 'yes'
				]
			]
		);

		$this->add_control(
			'separator_content_icon',
			[ 
				'type'        => Controls_Manager::ICONS,
				'label'       => 'Icon',
				'label_block' => true,
				'default'     => [ 
					'value'   => 'fab fa-youtube',
					'library' => 'fa-brands',
				],
				'condition'   => [ 
					'separator_content_type' => 'icon',
					'show_separator'         => 'yes'
				],
				//                'render_type' => 'content',
			]
		);

		$this->end_controls_section();

		// start button A

		$this->start_controls_section(
			'section_button_a',
			[ 
				'label' => esc_html__( 'Button A', 'sky-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'button_a_text',
			[ 
				'label'   => esc_html__( 'Button Text', 'sky-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'ABOUT US', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'button_a_link',
			[ 
				'label'         => esc_html__( 'Link', 'sky-elementor-addons' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'sky-elementor-addons' ),
				'show_external' => true,
				'default'       => [ 
					'url'         => '',
					'is_external' => false,
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_responsive_control(
			'button_a_alignment',
			[ 
				'label'     => esc_html__( 'Alignment', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [ 
					'flex-start' => [ 
						'title' => esc_html__( 'Left', 'sky-elementor-addons' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'     => [ 
						'title' => esc_html__( 'Center', 'sky-elementor-addons' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end'   => [ 
						'title' => esc_html__( 'Right', 'sky-elementor-addons' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'toggle'    => false,
				'default'   => 'center',
				'selectors' => [ 
					'{{WRAPPER}} .sa-btn-a' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_a_icon',
			[ 
				'label' => esc_html__( 'Icon', 'sky-elementor-addons' ),
				'type'  => Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'button_a_icon_position',
			[ 
				'label'          => esc_html__( 'Icon Position', 'sky-elementor-addons' ),
				'type'           => Controls_Manager::CHOOSE,
				'label_block'    => false,
				'options'        => [ 
					'before' => [ 
						'title' => esc_html__( 'Before', 'sky-elementor-addons' ),
						'icon'  => 'eicon-h-align-left',
					],
					// need to implement top and bottom
					//                        'top' => [
					//                                'title' => esc_html__('Top', 'sky-elementor-addons'),
					//                                'icon'  => 'eicon-h-align-left',
					//                        ],
					'after'  => [ 
						'title' => esc_html__( 'After', 'sky-elementor-addons' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'        => 'before',
				'toggle'         => false,
				'condition'      => [ 
					'button_a_icon[value]!' => ''
				],
				'style_transfer' => true,
			]
		);

		$this->add_responsive_control(
			'button_a_icon_spacing',
			[ 
				'label'      => esc_html__( 'Icon Spacing', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
					],
				],
				'condition'  => [ 
					'button_a_icon[value]!' => ''
				],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-btn-a .sa-icon-wrap + .sa-button-text'                    => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sa-btn-a.sa-flex-icon-after .sa-icon-wrap + .sa-button-text' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		// start button B

		$this->start_controls_section(
			'section_button_b',
			[ 
				'label' => esc_html__( 'Button B', 'sky-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'button_b_text',
			[ 
				'label'   => esc_html__( 'Button Text', 'sky-elementor-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'READ MORE', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'button_b_link',
			[ 
				'label'         => esc_html__( 'Link', 'sky-elementor-addons' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => esc_html__( 'https://your-link.com', 'sky-elementor-addons' ),
				'show_external' => true,
				'default'       => [ 
					'url'         => '',
					'is_external' => false,
				],
				'dynamic'       => [ 'active' => true ],
			]
		);

		$this->add_responsive_control(
			'button_b_alignment',
			[ 
				'label'     => esc_html__( 'Alignment', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [ 
					'flex-start' => [ 
						'title' => esc_html__( 'Left', 'sky-elementor-addons' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'     => [ 
						'title' => esc_html__( 'Center', 'sky-elementor-addons' ),
						'icon'  => 'eicon-text-align-center',
					],
					'flex-end'   => [ 
						'title' => esc_html__( 'Right', 'sky-elementor-addons' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'center',
				'toggle'    => false,
				'selectors' => [ 
					'{{WRAPPER}} .sa-btn-b' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_b_icon',
			[ 
				'label' => esc_html__( 'Icon', 'sky-elementor-addons' ),
				'type'  => Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'button_b_icon_position',
			[ 
				'label'          => esc_html__( 'Icon Position', 'sky-elementor-addons' ),
				'type'           => Controls_Manager::CHOOSE,
				'label_block'    => false,
				'options'        => [ 
					'before' => [ 
						'title' => esc_html__( 'Before', 'sky-elementor-addons' ),
						'icon'  => 'eicon-h-align-left',
					],
					'after'  => [ 
						'title' => esc_html__( 'After', 'sky-elementor-addons' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'        => 'before',
				'toggle'         => false,
				'condition'      => [ 
					'button_b_icon[value]!' => ''
				],
				'style_transfer' => true,
			]
		);

		$this->add_responsive_control(
			'button_b_icon_spacing',
			[ 
				'label'      => esc_html__( 'Icon Spacing', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
					],
				],
				'condition'  => [ 
					'button_b_icon[value]!' => ''
				],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-btn-b .sa-icon-wrap + .sa-button-text'                    => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sa-btn-b.sa-flex-icon-after .sa-icon-wrap + .sa-button-text' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'dual_buttons_style',
			[ 
				'label' => esc_html__( 'Dual Buttons', 'sky-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'dual_buttons_padding',
			[ 
				'label'      => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name'     => 'dual_buttons_typo',
				'label'    => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => 'dual_buttons_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-btn',
			]
		);

		$this->end_controls_section();

		// button A Style

		$this->start_controls_section(
			'button_a_style',
			[ 
				'label' => esc_html__( 'Button A', 'sky-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'button_a_padding',
			[ 
				'label'      => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-btn.sa-btn-a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name'     => 'button_a_typography',
				'label'    => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-btn.sa-btn-a',
			]
		);

		$this->start_controls_tabs( 'tabs_button_a_style' );

		$this->start_controls_tab(
			'tab_button_a_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_a_color',
			[ 
				'label'     => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-btn-a'       => 'color: {{VALUE}}',
					'{{WRAPPER}} .sa-btn-a svg *' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'     => 'button_a_background',
				'label'    => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-btn-a',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name'     => 'button_a_border',
				'label'    => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-btn-a',
			]
		);

		$this->add_responsive_control(
			'button_a_border_radius',
			[ 
				'label'      => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-btn-a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name'     => 'button_a_text_shadow',
				'label'    => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-btn-a',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => 'button_a_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-btn.sa-btn-a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_a_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);


		$this->add_control(
			'button_a_color_hover',
			[ 
				'label'     => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-btn-a:hover'       => 'color: {{VALUE}}',
					'{{WRAPPER}} .sa-btn-a:hover svg *' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'     => 'button_a_background_hover',
				'label'    => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-btn-a:hover',
			]
		);

		//        $this->add_group_control(
		//            Group_Control_Border::get_type(), [
		//                'name'     => 'button_a_border_hover',
		//                'label'    => esc_html__('Border', 'sky-elementor-addons'),
		//                'selector' => '{{WRAPPER}} .sa-btn-a:hover',
		//            ]
		//        );

		$this->add_control(
			'button_a_border_hover',
			[ 
				'label'     => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}}  .sa-btn-a:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'button_a_border_border!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'button_a_border_radius_hover',
			[ 
				'label'      => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-btn-a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name'     => 'button_a_text_shadow_hover',
				'label'    => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-btn-a:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => 'button_a_box_shadow_hover',
				'label'    => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-btn.sa-btn-a:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		// button B Style

		$this->start_controls_section(
			'button_b_style',
			[ 
				'label' => esc_html__( 'Button B', 'sky-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'button_b_padding',
			[ 
				'label'      => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-btn.sa-btn-b' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name'     => 'button_b_typography',
				'label'    => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-btn.sa-btn-b',
			]
		);

		$this->start_controls_tabs( 'tabs_button_b_style' );

		$this->start_controls_tab(
			'tab_button_b_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_b_color',
			[ 
				'label'     => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-btn-b'       => 'color: {{VALUE}}',
					'{{WRAPPER}} .sa-btn-b svg *' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'     => 'button_b_background',
				'label'    => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-btn-b',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name'     => 'button_b_border',
				'label'    => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-btn-b',
			]
		);

		$this->add_responsive_control(
			'button_b_border_radius',
			[ 
				'label'      => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-btn-b' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name'     => 'button_b_text_shadow',
				'label'    => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-btn-b',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => 'button_b_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-btn.sa-btn-b',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_b_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);


		$this->add_control(
			'button_b_color_hover',
			[ 
				'label'     => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-btn-b:hover'       => 'color: {{VALUE}}',
					'{{WRAPPER}} .sa-btn-b:hover svg *' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'     => 'button_b_background_hover',
				'label'    => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-btn-b:hover',
			]
		);

		//        $this->add_group_control(
		//            Group_Control_Border::get_type(), [
		//                'name'     => 'button_b_border_hover',
		//                'label'    => esc_html__('Border', 'sky-elementor-addons'),
		//                'selector' => '{{WRAPPER}} .sa-btn-b:hover',
		//            ]
		//        );

		$this->add_control(
			'button_b_border_hover',
			[ 
				'label'     => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}}  .sa-btn-b:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'button_b_border_border!' => '',
				],
			]
		);


		$this->add_responsive_control(
			'button_b_border_radius_hover',
			[ 
				'label'      => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-btn-b:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name'     => 'button_b_text_shadow_hover',
				'label'    => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-btn-b:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => 'button_b_box_shadow_hover',
				'label'    => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-btn.sa-btn-b:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// start separator

		$this->start_controls_section(
			'separator_style',
			[ 
				'label'     => esc_html__( 'Separator', 'sky-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_separator' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'separator_size',
			[ 
				'label'      => esc_html__( 'Separator Size', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [ 
					'px' => [ 
						'min' => 30,
						'max' => 50,
					],
				],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-separator' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'separator_color',
			[ 
				'label'     => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-separator' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'     => 'separator_background',
				'label'    => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-separator',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name'     => 'separator_typography',
				'label'    => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-separator',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name'     => 'separator_border',
				'label'    => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-separator',
			]
		);

		$this->add_responsive_control(
			'separator_border_radius',
			[ 
				'label'      => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-separator' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => 'separator_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-separator',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'icon_a_style',
			[ 
				'label'     => esc_html__( 'Icon A', 'sky-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'button_a_icon[value]!' => ''
				],
			]
		);

		$this->add_responsive_control(
			'icon_a_size',
			[ 
				'label'      => esc_html__( 'Size', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [ 
					'px' => [ 
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-btn-a .sa-icon-wrap' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_a_padding',
			[ 
				'label'      => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-btn-a .sa-icon-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name'     => 'icon_a_border',
				'label'    => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-btn-a .sa-icon-wrap',
			]
		);

		$this->add_responsive_control(
			'icon_a_border_radius',
			[ 
				'label'      => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-btn-a .sa-icon-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'icon_a_tabs' );

		$this->start_controls_tab(
			'icon_a_tab_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'icon_a_color',
			[ 
				'label'     => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-btn-a .sa-icon-wrap' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'     => 'icon_a_background',
				'label'    => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-btn-a .sa-icon-wrap',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => 'icon_a_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-btn-a .sa-icon-wrap',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_a_tab_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'icon_a_color_hover',
			[ 
				'label'     => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-btn-a:hover .sa-icon-wrap' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'     => 'icon_a_hover_background',
				'label'    => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-btn-a:hover .sa-icon-wrap',
			]
		);

		$this->add_control(
			'icon_a_hover_border_color',
			[ 
				'label'     => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-btn-a:hover .sa-icon-wrap' => 'border-color: {{VALUE}}',
				],
				'condition' => [ 
					'icon_a_border_border!' => ''
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => 'icon_a_hover_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-btn-a:hover .sa-icon-wrap',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();



		$this->start_controls_section(
			'icon_b_style',
			[ 
				'label'     => esc_html__( 'Icon B', 'sky-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'button_b_icon[value]!' => ''
				],
			]
		);

		$this->add_responsive_control(
			'icon_b_size',
			[ 
				'label'      => esc_html__( 'Size', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [ 
					'px' => [ 
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-btn-b .sa-icon-wrap' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_b_padding',
			[ 
				'label'      => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-btn-b .sa-icon-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name'     => 'icon_b_border',
				'label'    => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-btn-b .sa-icon-wrap',
			]
		);

		$this->add_responsive_control(
			'icon_b_border_radius',
			[ 
				'label'      => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-btn-b .sa-icon-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'icon_b_tabs' );

		$this->start_controls_tab(
			'icon_b_tab_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'icon_b_color',
			[ 
				'label'     => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-btn-b .sa-icon-wrap' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'     => 'icon_b_background',
				'label'    => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-btn-b .sa-icon-wrap',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => 'icon_b_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-btn-b .sa-icon-wrap',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_b_tab_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'icon_b_color_hover',
			[ 
				'label'     => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-btn-b:hover .sa-icon-wrap' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'     => 'icon_b_hover_background',
				'label'    => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-btn-b:hover .sa-icon-wrap',
			]
		);

		$this->add_control(
			'icon_b_hover_border_color',
			[ 
				'label'     => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-btn-b:hover .sa-icon-wrap' => 'border-color: {{VALUE}}',
				],
				'condition' => [ 
					'icon_b_border_border!' => ''
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => 'icon_b_hover_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-btn-b:hover .sa-icon-wrap',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function button_icon( $btn ) {
		$settings = $this->get_settings_for_display();
		?>
		<div class="sa-icon-wrap sa-text-center">
			<?php
			Icons_Manager::render_icon( $settings[ $btn ], [ 
				'aria-hidden' => 'true',
			] );
			?>
		</div>
		<?php
	}

	//sa-button-icon
	protected function render() {
		$settings = $this->get_settings_for_display();

		// button A
		$this->add_link_attributes( 'button_a', $settings['button_a_link'] );
		$icon_position_a = ! empty( $settings['button_a_icon']['value'] ) ? 'sa-flex-icon-' . $settings['button_a_icon_position'] : '';
		$this->add_render_attribute( 'button_a', 'class', 'sa-btn sa-btn-a sa-d-flex sa-text-decoration-none sa-align-items-center sa-justify-content-center ' . $icon_position_a );


		// button B
		$this->add_link_attributes( 'button_b', $settings['button_b_link'] );
		$icon_position_b = ! empty( $settings['button_b_icon']['value'] ) ? 'sa-flex-icon-' . $settings['button_b_icon_position'] : '';
		$this->add_render_attribute( 'button_b', 'class', 'sa-btn sa-btn-b sa-d-flex sa-text-decoration-none sa-align-items-center sa-justify-content-center ' . $icon_position_b );
		?>
		<div class="sa-dual-button sa-d-flex sa-justify-content-center sa-align-items-center">
			<div class="sa-dual-button-container sa-d-flex sa-align-items-center">
				<?php
				if ( ! empty( $settings['button_a_text'] ) ) :
					$this->add_render_attribute( 'button_a', 'class', 'sa-button-icon-' . $settings['button_a_icon_position'] );
				endif;
				?>
				<a <?php $this->print_render_attribute_string( 'button_a' ); ?>>
					<?php
					if ( ! empty( $settings['button_a_icon']['value'] ) ) {
						$this->button_icon( 'button_a_icon' );
					}

					if ( ! empty( $settings['button_a_text'] ) ) {
						printf(
							'<span class="sa-button-text">%1$s</span>',
							esc_html( $settings['button_a_text'] )
						);
					}
					?>
				</a>

				<?php
				if ( ! empty( $settings['button_b_text'] ) ) :
					$this->add_render_attribute( 'button_b', 'class', 'sa-button-icon-' . $settings['button_b_icon_position'] );
				endif;
				?>

				<a <?php $this->print_render_attribute_string( 'button_b' ); ?>>
					<?php
					if ( ! empty( $settings['button_b_icon']['value'] ) ) {
						$this->button_icon( 'button_b_icon' );
					}
					if ( ! empty( $settings['button_b_text'] ) ) {
						printf(
							'<span class="sa-button-text">%1$s</span>',
							esc_html( $settings['button_b_text'] )
						);
					}
					?>
				</a>
				<?php if ( $settings['show_separator'] == 'yes' ) : ?>
					<span class="sa-separator">
						<?php
						if ( $settings['separator_content_type'] == 'icon' ) {
							Icons_Manager::render_icon( $settings['separator_content_icon'], [ 
								'aria-hidden' => 'true', 'class' => 'sa--'
							] );
						} else {
							echo esc_html( $settings['separator_content_text'] );
						}
						?>
					</span>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
