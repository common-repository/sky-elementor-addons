<?php

namespace Sky_Addons\Modules\ListGroup\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class List_Group extends Widget_Base {

	public function get_name() {
		return 'sky-list-group';
	}

	public function get_title() {
		return esc_html__( 'List Group', 'sky-elementor-addons' );
	}

	public function get_icon() {
		return 'sky-icon-list-group';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'sky', 'listgroup', 'group' ];
	}

	public function get_style_depends() {
		return [ 
			'elementor-icons-fa-solid',
		];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_tidy_list',
			[ 
				'label' => esc_html__( 'List Group', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'media_type',
			[ 
				'label' => esc_html__( 'Media Type', 'sky-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [ 
					'icon' => [ 
						'title' => esc_html__( 'Icon', 'sky-elementor-addons' ),
						'icon' => 'eicon-check',
					],
					'image' => [ 
						'title' => esc_html__( 'Image', 'sky-elementor-addons' ),
						'icon' => 'eicon-image',
					],
					'number' => [ 
						'title' => esc_html__( 'Number', 'sky-elementor-addons' ),
						'icon' => 'fas fa-sort-numeric-down',
					],
				],
				'toggle' => true,
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'list_icon',
			[ 
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'default' => [ 
					'value' => 'fas fa-check',
					'library' => 'fa-solid',
				],
				'condition' => [ 
					'media_type' => 'icon'
				]
			]
		);

		$repeater->add_control(
			'list_image',
			[ 
				'label' => esc_html__( 'Choose Image', 'sky-elementor-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [ 
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [ 'active' => true ],
				'condition' => [ 
					'media_type' => 'image'
				],
			]
		);

		$repeater->add_control(
			'list_number',
			[ 
				'label' => esc_html__( 'Number', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => '1',
				'dynamic' => [ 'active' => true ],
				'condition' => [ 
					'media_type' => 'number'
				],
			]
		);

		$repeater->add_control(
			'list_title',
			[ 
				'label' => esc_html__( 'Title', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'List Title', 'sky-elementor-addons' ),
				'label_block' => true,
				'dynamic' => [ 'active' => true ],
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'list_text',
			[ 
				'label' => esc_html__( 'Text', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'dynamic' => [ 'active' => true ],
			]
		);


		$repeater->add_control(
			'list_direction',
			[ 
				'label' => esc_html__( 'Direction Icon', 'sky-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'separator' => 'before',
				'default' => [ 
					'value' => 'fas fa-angle-right',
					'library' => 'fa-solid',
				]
			]
		);

		$repeater->add_control(
			'item_customize',
			[ 
				'label' => esc_html__( 'Customize?', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
			]
		);


		$repeater->add_control(
			'item_title_color',
			[ 
				'label' => esc_html__( 'Title Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-list-item{{CURRENT_ITEM}} .sa-title' => 'color: {{VALUE}}',
				],
				'condition' => [ 
					'item_customize' => 'yes'
				]
			]
		);

		$repeater->add_control(
			'item_text_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-list-item{{CURRENT_ITEM}} .sa-text' => 'color: {{VALUE}}',
				],
				'condition' => [ 
					'item_customize' => 'yes'
				]
			]
		);

		$repeater->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'item_customize_bg',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-list-item{{CURRENT_ITEM}} .sa-link',
			]
		);


		$repeater->add_control(
			'list_link',
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
			]
		);

		$this->add_control(
			'list',
			[ 
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [ 
					[ 
						'list_title' => esc_html__( 'List Title #1', 'sky-elementor-addons' ),
						'list_text' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'sky-elementor-addons' ),
					],
					[ 
						'list_title' => esc_html__( 'List Title #2', 'sky-elementor-addons' ),
						'list_text' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'sky-elementor-addons' ),
					],
					[ 
						'list_title' => esc_html__( 'List Title #3', 'sky-elementor-addons' ),
						'list_text' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'sky-elementor-addons' ),
					],
				],
				'title_field' => '{{{ list_title }}}',
			]
		);


		$this->add_control(
			'show_direction',
			[ 
				'label' => esc_html__( 'Show Direction', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_text',
			[ 
				'label' => esc_html__( 'Show Text', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_responsive_control(
			'content_alignment',
			[ 
				'label' => esc_html__( 'Content Alignment', 'sky-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
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
				'style_transfer' => true,
				'desktop_default' => 'justify',
				'tablet_default' => 'justify',
				'mobile_default' => 'justify',
				'selectors' => [ 
					'{{WRAPPER}} .sa-link' => '{{VALUE}};',
				],
				//'prefix_class'         => 'sa-align-%s-',
				'selectors_dictionary' => [ 
					'left' => 'text-align: left;',
					'center' => 'text-align: center;',
					'right' => 'text-align: right;'
				]
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

		$this->end_controls_section();

		$this->start_controls_section(
			'section_list_style',
			[ 
				'label' => esc_html__( 'List', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'space_between',
			[ 
				'label' => esc_html__( 'Space Between', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-list-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'min_height',
			[ 
				'label' => esc_html__( 'Height', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-link' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'list_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'list_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-link',
			]
		);

		$this->add_responsive_control(
			'list_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'list_tabs' );

		$this->start_controls_tab(
			'list_tab_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'list_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-link',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'list_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-link',
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'list_tab_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'list_background_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-link:hover',
			]
		);

		$this->add_control(
			'list_border_color_hover',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-link:hover' => 'border-color: {{VALUE}}',
				],
				'condition' => [ 
					'list_border_border!' => ''
				]
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'list_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-link:hover',
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		$this->start_controls_section(
			'section_list_media_style',
			[ 
				'label' => esc_html__( 'Media', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'media_size',
			[ 
				'label' => esc_html__( 'Size', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-list-group' => '--media-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'media_spacing',
			[ 
				'label' => esc_html__( 'Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-media-wrapper' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'media_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-media-wrapper img, 
                            {{WRAPPER}} .sa-media-wrapper .sa-icon-wrap, 
                            {{WRAPPER}} .sa-media-wrapper .sa-number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'media_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-media-wrapper img, 
                            {{WRAPPER}} .sa-media-wrapper .sa-icon-wrap, 
                            {{WRAPPER}} .sa-media-wrapper .sa-number',
			]
		);

		$this->add_responsive_control(
			'media_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-media-wrapper img, 
                            {{WRAPPER}} .sa-media-wrapper .sa-icon-wrap, 
                            {{WRAPPER}} .sa-media-wrapper .sa-number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'media_number_icon_heading',
			[ 
				'label' => esc_html__( 'Number / Icon', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);


		$this->start_controls_tabs( 'media_tabs' );

		$this->start_controls_tab(
			'media_tab_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'num_icon_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-number, {{WRAPPER}} .sa-media-wrapper .sa-icon-wrap' => 'color: {{VALUE}};',
					'{{WRAPPER}} .sa-media-wrapper .sa-icon-wrap *' => 'fill: {{VALUE}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'media_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-media-wrapper img, 
                            {{WRAPPER}} .sa-media-wrapper .sa-icon-wrap, 
                            {{WRAPPER}} .sa-media-wrapper .sa-number',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'media_tab_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);


		$this->add_control(
			'num_icon_color_hover',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-link:hover .sa-number, {{WRAPPER}} .sa-link:hover .sa-media-wrapper .sa-icon-wrap' => 'color: {{VALUE}}; fill: {{VALUE}};',
					'{{WRAPPER}} .sa-link:hover .sa-media-wrapper .sa-icon-wrap *' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'num_icon_background_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .sa-link:hover .sa-number, {{WRAPPER}} .sa-link:hover .sa-media-wrapper .sa-icon-wrap',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->end_controls_section();


		$this->start_controls_section(
			'section_list_title_style',
			[ 
				'label' => esc_html__( 'Title', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'title_spacing',
			[ 
				'label' => esc_html__( 'Bottom Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
					],
					'%' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[ 
				'label' => esc_html__( 'Hover Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-link:hover .sa-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'title_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-title',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_list_text_style',
			[ 
				'label' => esc_html__( 'Text', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_text' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'sub_title_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-text',
			]
		);

		$this->add_control(
			'sub_title_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'sub_title_color_hover',
			[ 
				'label' => esc_html__( 'Hover Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-link:hover .sa-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// start direction media

		$this->start_controls_section(
			'section_direction_style',
			[ 
				'label' => esc_html__( 'Direction', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_direction' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'direction_size',
			[ 
				'label' => esc_html__( 'Size', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-list-group' => '--direction-icon-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'direction_spacing',
			[ 
				'label' => esc_html__( 'Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-direction-wrapper' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'direction_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-direction-wrapper .sa-direction-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'direction_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-direction-wrapper .sa-direction-icon',
			]
		);

		$this->add_responsive_control(
			'direction_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-direction-wrapper .sa-direction-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'direction_tabs' );

		$this->start_controls_tab(
			'direction_tab_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'direction_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-direction-wrapper .sa-direction-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'direction_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-direction-wrapper .sa-direction-icon',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'direction_tab_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'direction_color_hover',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-link:hover .sa-direction-wrapper .sa-direction-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'direction_border_color_hover',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-link:hover .sa-direction-wrapper .sa-direction-icon' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'direction_background_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-link:hover .sa-direction-wrapper .sa-direction-icon',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->end_controls_section();

		// end direction media
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="sa-list-group">

			<ul class="sa-list-ul">
				<?php
				foreach ( $settings['list'] as $item ) {
					$this->add_render_attribute( 'list_item', 'class', [ 
						'sa-list-item',
						'elementor-repeater-item-' . $item['_id']
					], true );

					$this->add_render_attribute( 'link_attr', 'class', 'sa-link sa-d-block sa-text-decoration-none', true );
					$tag = 'div';
					if ( ! empty( $item['list_link']['url'] ) ) {
						$this->add_render_attribute( 'link_attr', 'href', esc_url( $item['list_link']['url'] ), true );

						if ( $item['list_link']['is_external'] ) {
							$this->add_render_attribute( 'link_attr', 'target', '_blank', true );
						} else {
							$this->remove_render_attribute( 'link_attr', 'target', '' );
						}

						if ( $item['list_link']['nofollow'] ) {
							$this->add_render_attribute( 'link_attr', 'rel', 'nofollow', true );
						}
						$tag = 'a';
					} else {
						$this->remove_render_attribute( 'link_attr', 'target', '' );
						$this->remove_render_attribute( 'link_attr', 'rel', '' );
						$this->remove_render_attribute( 'link_attr', 'href', '' );
						$tag = 'div';
					}
					?>
					<li <?php $this->print_render_attribute_string( 'list_item' ); ?>>
						<<?php echo esc_attr( $tag ); ?>
							<?php $this->print_render_attribute_string( 'link_attr' ); ?>>
							<div class="sa-list-wrapper sa-w-100 sa-d-flex sa-align-items-center">

								<?php if ( ! empty( $item['media_type'] ) ) : ?>
									<div class="sa-me-3 sa-media-wrapper">
									<?php endif; ?>

									<?php if ( $item['media_type'] == 'icon' && ! empty( $item['list_icon']['value'] ) ) : ?>

										<div class="sa-icon-wrap sa-text-center sa-d-flex sa-align-items-center">
											<?php
											Icons_Manager::render_icon( $item['list_icon'], [ 
												'aria-hidden' => 'true'
											] );
											?>
										</div>

									<?php elseif ( $item['media_type'] == 'image' && ! empty( $item['list_image']['url'] ) ) : ?>
										<div class="sa-img-wrap sa-d-inline-block">
											<?php
											if ( $item['list_image']['id'] ) {
												print ( wp_get_attachment_image(
													$item['list_image']['id'],
													'medium',
													false,
													[ 
														'alt' => esc_html( $item['list_title'] )
													]
												) );
											} else {
												printf( '<img src="%1$s" alt="%2$s">', esc_url( $item['list_image']['url'] ), esc_html( $item['list_title'] ) );
											}
											?>
										</div>

									<?php elseif ( $item['media_type'] == 'number' && ! empty( $item['list_number'] ) ) : ?>

										<span class="sa-number">
											<?php
											echo esc_html( $item['list_number'] );
											?>
										</span>

									<?php else : ?>

									<?php endif; ?>

									<?php if ( ! empty( $item['media_type'] ) ) : ?>
									</div>
								<?php endif; ?>

								<div class="sa-content-wrapper sa-w-100">
									<?php
									if ( ! empty( $item['list_title'] ) ) :
										printf(
											'<%s class="sa-title sa--title sa--text-title sa-mt-0 sa-mb-0"> %s </%s>',
											esc_attr( Utils::validate_html_tag( $settings['title_tag'] ) ),
											esc_html( $item['list_title'] ),
											esc_attr( Utils::validate_html_tag( $settings['title_tag'] ) )
										);
									endif;

									if ( ! empty( $item['list_text'] ) && ( $settings['show_text'] == 'yes' ) ) : ?>
										<div class="sa--text sa--text-info sa-text">
											<?php echo wp_kses_post( $item['list_text'] ); ?>
										</div>
									<?php endif; ?>

								</div>

								<!-- start direction icon -->
								<?php
								if ( $settings['show_direction'] == 'yes' ) :
									if ( ! empty( $item['list_direction']['value'] ) ) {
										?>
										<div class="sa-ms-3 sa-direction-wrapper">
											<div class="sa-direction-icon sa-icon-wrap">
												<?php
												Icons_Manager::render_icon( $item['list_direction'], [ 
													'aria-hidden' => 'true'
												] );
												?>
											</div>
										</div>
										<?php
									}
								endif;
								?>
								<!-- end direction icon -->

							</div>
						</<?php echo esc_attr( $tag ); ?>>
					</li>
				<?php } ?>
			</ul>

		</div>
		<?php
	}
}
