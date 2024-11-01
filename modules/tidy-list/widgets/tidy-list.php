<?php

namespace Sky_Addons\Modules\TidyList\Widgets;

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

class Tidy_List extends Widget_Base {

	public function get_name() {
		return 'sky-tidy-list';
	}

	public function get_title() {
		return esc_html__( 'Tidy List', 'sky-elementor-addons' );
	}

	public function get_icon() {
		return 'sky-icon-tidy-list';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'sky', 'list', 'listgroup' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_tidy_list',
			[ 
				'label' => esc_html__( 'Tidy List', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'list_layout',
			[ 
				'label' => esc_html__( 'Layout', 'sky-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [ 
					'block' => [ 
						'title' => esc_html__( 'Block', 'sky-elementor-addons' ),
						'icon' => 'eicon-editor-list-ul',
					],
					'inline' => [ 
						'title' => esc_html__( 'Inline', 'sky-elementor-addons' ),
						'icon' => 'eicon-navigation-horizontal',
					],
				],
				'style_transfer' => true,
				'toggle' => false,
				'desktop_default' => 'block',
				'tablet_default' => 'block',
				'mobile_default' => 'block',
				'selectors' => [ 
					'{{WRAPPER}} .sa-list-item' => '{{VALUE}};',
				],
				'prefix_class' => 'sa-list-layout-%s-',
				'selectors_dictionary' => [ 
					'block' => 'display: block; width: 100%;',
					'inline' => 'display: inline-block; width: auto;',
				]
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
				'default' => 'icon',
				'toggle' => true,
				'style_transfer' => true,
			]
		);

		$repeater->add_control(
			'list_icon',
			[ 
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
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
				'condition' => [ 
					'media_type' => 'image'
				],
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'list_number',
			[ 
				'label' => esc_html__( 'Number', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '1', 'sky-elementor-addons' ),
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
				'default' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'sky-elementor-addons' ),
				'label_block' => true,
				'dynamic' => [ 'active' => true ],
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
						'list_icon' =>
							[ 
								'value' => 'fas fa-check',
								'library' => 'fa-solid'
							],
					],
					[ 
						'list_title' => esc_html__( 'List Title #2', 'sky-elementor-addons' ),
						'list_text' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'sky-elementor-addons' ),
						'list_icon' =>
							[ 
								'value' => 'fas fa-check',
								'library' => 'fa-solid'
							],
					],
					[ 
						'list_title' => esc_html__( 'List Title #3', 'sky-elementor-addons' ),
						'list_text' => esc_html__( 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'sky-elementor-addons' ),
						'list_icon' =>
							[ 
								'value' => 'fas fa-check',
								'library' => 'fa-solid'
							],
					],
				],
				'title_field' => '{{{ list_title }}}',
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
			'media_position',
			[ 
				'label' => esc_html__( 'Media Position', 'sky-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [ 
					'left' => [ 
						'title' => esc_html__( 'Left', 'sky-elementor-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [ 
						'title' => esc_html__( 'Top', 'sky-elementor-addons' ),
						'icon' => 'eicon-v-align-top',
					],
					'bottom' => [ 
						'title' => esc_html__( 'Bottom', 'sky-elementor-addons' ),
						'icon' => 'eicon-v-align-bottom',
					],
					'right' => [ 
						'title' => esc_html__( 'Right', 'sky-elementor-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'style_transfer' => true,
				'toggle' => true,
				'default' => 'left',
				'prefix_class' => 'sa-media-position-%s-',
				'selectors' => [ 
					'{{WRAPPER}} .sa-list-wrapper' => '{{VALUE}};',
				],
				'selectors_dictionary' => [ 
					'top' => 'flex-direction: column; align-items: initial;',
					'bottom' => 'flex-direction: column-reverse; align-items: initial;',
					'left' => 'flex-direction: initial; align-items: center;',
					'right' => 'flex-direction: row-reverse; align-items: initial;',
				]
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
				'default' => 'left',
				'selectors' => [ 
					'{{WRAPPER}} .sa-link' => '{{VALUE}};',
					'{{WRAPPER}} .sa-tidy-list .sa-media-wrapper' => '{{VALUE}};',
				],
				//'prefix_class'         => 'sa-align-%s-',
				'selectors_dictionary' => [ 
					'left' => 'justify-content: flex-start; text-align: left;',
					'center' => 'justify-content: center; text-align: center;',
					'right' => 'justify-content: flex-end; text-align: right;'
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
			'list_alignment',
			[ 
				'label' => esc_html__( 'Alignment', 'sky-elementor-addons' ),
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
				'default' => 'left',
				'selectors' => [ 
					'{{WRAPPER}} .sa-list-ul' => '{{VALUE}};',
				],
				//'prefix_class'         => 'sa-align-%s-',
				'selectors_dictionary' => [ 
					'left' => 'text-align: left; justify-content: flex-start;',
					'center' => 'text-align: center; justify-content: center;',
					'right' => 'text-align: right; justify-content: flex-end;'
				],
				'condition' => [ 
					'list_layout' => 'inline'
				]
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
					'{{WRAPPER}} .sa-tidy-list ' => '--list-space-between: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .sa-tidy-list' => '--media-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .sa-tidy-list' => '--tidy-media-spacing: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .sa-link:hover .sa-number, {{WRAPPER}} .sa-link:hover .sa-media-wrapper .sa-icon-wrap' => 'color: {{VALUE}};',
					'{{WRAPPER}} .sa-link:hover .sa-media-wrapper .sa-icon-wrap *' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'num_icon_background_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
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
				'name' => 'text_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-text',
			]
		);

		$this->add_control(
			'text_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'text_color_hover',
			[ 
				'label' => esc_html__( 'Hover Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-link:hover .sa-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="sa-tidy-list">

			<ul class="sa-list-ul sa-d-flex sa-flex-wrap">
				<?php
				foreach ( $settings['list'] as $item ) {

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
					<li class="sa-list-item">
						<<?php echo esc_attr( $tag ); ?>
							<?php $this->print_render_attribute_string( 'link_attr' ); ?>>
							<div class="sa-list-wrapper sa-d-flex sa-align-items-center">

								<?php if ( ! empty( $item['media_type'] ) ) : ?>
									<div class="sa-me-3 sa-media-wrapper sa-align-items-center sa-d-flex">
									<?php endif; ?>

									<?php if ( $item['media_type'] == 'icon' && ! empty( $item['list_icon']['value'] ) ) : ?>

										<div class="sa-icon-wrap sa-text-center sa-align-items-center sa-d-flex">
											<?php
											Icons_Manager::render_icon( $item['list_icon'], [ 
												'aria-hidden' => 'true'
											] );
											?>
										</div>

									<?php elseif ( $item['media_type'] == 'image' && ! empty( $item['list_image']['url'] ) ) : ?>
										<div class="sa-img-wrap sa-d-inline-block sa-align-items-center sa-d-flex">
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

										<span class="sa-number sa-align-items-center sa-d-flex">
											<?php
											echo esc_html( $item['list_number'] );
											?>
										</span>

									<?php else : ?>

									<?php endif; ?>

									<?php if ( ! empty( $item['media_type'] ) ) : ?>
									</div>
								<?php endif; ?>

								<div class="sa-content-wrapper">
									<?php
									if ( ! empty( $item['list_title'] ) ) :
										printf( '<%s class="sa--title sa--text-title sa-title sa-mt-0 sa-mb-0"> %s </%s>', esc_attr( Utils::validate_html_tag( $settings['title_tag'] ) ), wp_kses_post( $item['list_title'] ), esc_attr( Utils::validate_html_tag( $settings['title_tag'] ) ) );
									endif;

									if ( ! empty( $item['list_text'] ) && ( $settings['show_text'] == 'yes' ) ) : ?>
										<div class="sa--text sa--text-info sa-text">
											<?php echo wp_kses_post( $item['list_text'] ); ?>
										</div>
									<?php endif; ?>
								</div>
							</div>
						</<?php echo esc_attr( $tag ); ?>>
					</li>
				<?php } ?>
			</ul>

		</div>
		<?php
	}
}
