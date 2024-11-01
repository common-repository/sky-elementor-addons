<?php

namespace Sky_Addons\Modules\PanelSlider\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Widget_Base;

use Sky_Addons\Traits\Global_Swiper_Controls;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Panel_Slider extends Widget_Base {

	use Global_Swiper_Controls;

	public function get_name() {
		return 'sky-panel-slider';
	}

	public function get_title() {
		return esc_html__( 'Panel Slider', 'sky-elementor-addons' );
	}

	public function get_icon() {
		return 'sky-icon-panel-slider';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'creative', 'panel', 'slider', 'carousel', 'portfolio', 'sky' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_sliders',
			[ 
				'label' => esc_html__( 'Sliders', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'columns',
			[ 
				'label' => esc_html__( 'Columns', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [ 
					1 => esc_html__( '1 Column', 'sky-elementor-addons' ),
					2 => esc_html__( '2 Columns', 'sky-elementor-addons' ),
					3 => esc_html__( '3 Columns', 'sky-elementor-addons' ),
					4 => esc_html__( '4 Columns', 'sky-elementor-addons' ),
					5 => esc_html__( '5 Columns', 'sky-elementor-addons' ),
					6 => esc_html__( '6 Columns', 'sky-elementor-addons' ),
				],
				'default' => 3,
				'tablet_default' => 2,
				'mobile_default' => 1,
				'render_type' => 'template',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[ 
				'label' => esc_html__( 'Title', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 2,
				'default' => esc_html__( 'Slide Title', 'sky-elementor-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'text',
			[ 
				'label' => esc_html__( 'Text', 'sky-elementor-addons' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sky-elementor-addons' ),
				'placeholder' => esc_html__( 'Type your description here', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'image',
			[ 
				'label' => esc_html__( 'Image', 'sky-elementor-addons' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [ 'active' => true ],
				'default' => [ 
					'url' => Utils::get_placeholder_image_src()
				]
			]
		);

		$repeater->add_control(
			'link',
			[ 
				'label' => esc_html__( 'Link', 'sky-elementor-addons' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'sky-elementor-addons' ),
				'show_external' => true,
				'default' => [ 
					'url' => '',
					'is_external' => false,
					'nofollow' => false,
				],
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'slider_list',
			[ 
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [ 
					[ 
						'title' => esc_html__( 'Title #1', 'sky-elementor-addons' ),
						'text' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'sky-elementor-addons' ),
					],
					[ 
						'title' => esc_html__( 'Title #2', 'sky-elementor-addons' ),
						'text' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'sky-elementor-addons' ),
					],
					[ 
						'title' => esc_html__( 'Title #3', 'sky-elementor-addons' ),
						'text' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'sky-elementor-addons' ),
					],
					[ 
						'title' => esc_html__( 'Title #4', 'sky-elementor-addons' ),
						'text' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'sky-elementor-addons' ),
					],
					[ 
						'title' => esc_html__( 'Title #5', 'sky-elementor-addons' ),
						'text' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'sky-elementor-addons' ),
					],
					[ 
						'title' => esc_html__( 'Title #6', 'sky-elementor-addons' ),
						'text' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'sky-elementor-addons' ),
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
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[ 
				'name' => 'thumbnail',
				'default' => 'full',
				'separator' => 'none',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_slider_additional',
			[ 
				'label' => esc_html__( 'Additional', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'content_position',
			[ 
				'label' => esc_html__( 'Content Position', 'sky-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [ 
					'top' => [ 
						'title' => esc_html__( 'Top', 'sky-elementor-addons' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [ 
						'title' => esc_html__( 'Middle', 'sky-elementor-addons' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [ 
						'title' => esc_html__( 'Bottom', 'sky-elementor-addons' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'desktop_default' => 'bottom',
				'tablet_default' => 'bottom',
				'mobile_default' => 'bottom',
				'style_transfer' => true,
				'selectors' => [ 
					'{{WRAPPER}} .sa-content' => '{{VALUE}};',
				],
				'selectors_dictionary' => [ 
					'top' => 'top: 0%; left: 0; transform: translate(0%, 0%);right: auto;',
					'middle' => 'bottom: auto; left: 0; transform: translate(0%, -50%); top: 50%;',
					'bottom' => 'bottom: 0; left: 0%; transform: translate(0%, 0%);top: auto;',
				]
			]
		);

		$this->add_responsive_control(
			'content_alignment',
			[ 
				'label' => esc_html__( 'Text Alignment', 'sky-elementor-addons' ),
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
					'{{WRAPPER}} .sa-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'show_title',
			[ 
				'label' => esc_html__( 'Show Title', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_text',
			[ 
				'label' => esc_html__( 'Show Text', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_content',
			[ 
				'label' => esc_html__( 'Show Content', 'sky-elementor-addons' ) . sky_addons_control_indicator_pro(),
				'type' => Controls_Manager::SELECT,
				'default' => 'hover',
				'options' => [ 
					'hover' => 'On Hover',
					'active' => 'Active Item',
					'active_hover' => 'Active & Hover',
					'always' => 'Always'
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'img_cover',
			[ 
				'label' => esc_html__( 'Image Cover', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'link_on',
			[ 
				'label' => esc_html__( 'Link On', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'default' => [ 
					'title',
				],
				'options' => [ 
					'title' => esc_html__( 'Title', 'sky-elementor-addons' ),
					'item' => esc_html__( 'Item', 'sky-elementor-addons' ),
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'link_on_note',
			[ 
				'label' => esc_html__( '', 'sky-elementor-addons' ),
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'Note: Links will work on Buttons normally but if you want extra more link options like as on Title or Full Item, you can use this option easily.', 'sky-elementor-addons' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		$this->add_control(
			'show_button',
			[ 
				'label' => esc_html__( 'Show Button / Link', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			[ 
				'label' => esc_html__( 'Button / Link', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [ 
					'show_button' => 'yes'
				]
			]
		);


		$this->add_control(
			'button_text',
			[ 
				'label' => esc_html__( 'Button Text', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Learn more', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'button_icon',
			[ 
				'label' => esc_html__( 'Icon', 'sky-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'button_icon_position',
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
					'button_icon[value]!' => ''
				],
				'style_transfer' => true,
			]
		);

		$this->add_responsive_control(
			'button_icon_spacing',
			[ 
				'label' => esc_html__( 'Icon Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 20,
						'step' => 1,
					],
				],
				'condition' => [ 
					'button_icon[value]!' => ''
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-button-left' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sa-button-right' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		/**
		 * Global Carousel Settings
		 */

		$this->start_controls_section(
			'section_carousel_settings',
			[ 
				'label' => esc_html__( 'Carousel Settings', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'carousel_height',
			[ 
				'label' => esc_html__( 'Height', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 100,
						'max' => 500,
						'step' => 5,
					]
				],
				'selectors' => [ 
					'{{WRAPPER}} .swiper' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->register_carousel_settings_controls( 'panel-slider' );

		$this->end_controls_section();

		/**
		 * Global Navigation Controls
		 */

		$this->start_controls_section(
			'section_carousel_navigation',
			[ 
				'label' => esc_html__( 'Navigation', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->register_navigation_controls();

		$this->end_controls_section();


		/**
		 * Global Pagination Controls
		 */

		$this->start_controls_section(
			'section_carousel_pagination',
			[ 
				'label' => esc_html__( 'Pagination', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->register_pagination_controls( 'panel-slider' );

		$this->end_controls_section();


		$this->start_controls_section(
			'section_slider_style',
			[ 
				'label' => esc_html__( 'Slider', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'slider_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .swiper-slide',
			]
		);

		$this->add_responsive_control(
			'slider_padding',
			[ 
				'label' => esc_html__( 'Content Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'overlay_heading',
			[ 
				'label' => esc_html__( 'O V E R L A Y', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs(
			'style_overlay_tabs'
		);

		$this->start_controls_tab(
			'style_overlay_normal_tab',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'slider_overlay',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-img-wrapper::after',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_overlay_hover_tab',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'slider_overlay_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [ 
					'background' => [ 
						'default' => 'gradient',
					],
					'color' => [ 
						'default' => '#FFFFFF00'
					],
					'color_b' => [ 
						'default' => '#2626261C'
					],
					'color_b_stop' => [ 
						'default' => [ 
							'unit' => '%',
							'size' => 30,
						],
					],
				],
				'selector' => '{{WRAPPER}} .swiper-slide:hover .sa-img-wrapper::after',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_overlay_active_tab',
			[ 
				'label' => esc_html__( 'Active', 'sky-elementor-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'slider_overlay_active',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .swiper-slide-active .sa-img-wrapper::after',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();


		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_title',
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
						'max' => 100,
						'step' => 1,
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
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[ 
				'label' => esc_html__( 'Hover Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-title:hover a' => 'color: {{VALUE}}',
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

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[ 
				'name' => 'title_text_stroke',
				'selector' => '{{WRAPPER}} .sa-title',
			]
		);


		$this->end_controls_section();


		$this->start_controls_section(
			'section_slider_text',
			[ 
				'label' => esc_html__( 'Text', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_responsive_control(
			'text_spacing',
			[ 
				'label' => esc_html__( 'Bottom Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'text_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-text' => 'color: {{VALUE}}',
				],
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

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'text_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-text',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_button_style',
			[ 
				'label' => esc_html__( 'Button / Link', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_button' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'button_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-button',
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'button_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-button',
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-button' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'button_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-button',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'button_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-button',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'button_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_color_hover',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-button:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'button_background_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-button:hover',
			]
		);

		$this->add_control(
			'button_border_color_hover',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-button:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'button_border_border!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'button_border_radius_hover',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'button_text_shadow_hover',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-button:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'button_box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-button:hover',
			]
		);

		$this->add_control(
			'button_hover_animation',
			[ 
				'label' => esc_html__( 'Animation', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		/**
		 * Global Navigation Style Controls
		 */
		$this->register_navigation_style_controls( 'panel-slider' );


		/**
		 * Global Pagination Controls
		 */
		$this->register_pagination_style_controls( 'panel-slider' );
	}

	protected function render_button( $link ) {
		$settings = $this->get_settings_for_display();

		if ( 'yes' !== $settings['show_button'] ) {
			return;
		}

		$this->add_render_attribute( 'link_attr', 'class', 'sa-button sa-d-inline-flex sa-align-items-center sa-text-decoration-none sa-fw-bold', true );

		if ( ! empty( $link['url'] ) ) {
			$this->add_render_attribute( 'link_attr', 'href', esc_url( $link['url'] ), true );

			if ( $link['is_external'] ) {
				$this->add_render_attribute( 'link_attr', 'target', '_blank', true );
			}

			if ( $link['nofollow'] ) {
				$this->add_render_attribute( 'link_attr', 'rel', 'nofollow', true );
			}
		} else {
			$this->add_render_attribute( 'link_attr', 'target', '_self', true );
			$this->add_render_attribute( 'link_attr', 'rel', 'follow', true );
			$this->add_render_attribute( 'link_attr', 'href', 'javascript:void(0);', true );
		}

		if ( $settings['button_hover_animation'] ) {
			$this->add_render_attribute( 'link_attr', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
		}
		?>
		<a <?php $this->print_render_attribute_string( 'link_attr' ); ?>>
			<?php
			if ( ! empty( $settings['button_icon']['value'] ) && $settings['button_icon_position'] == 'before' ) {
				echo '<span class="sa-icon-wrap sa-button-icon">';
				Icons_Manager::render_icon( $settings['button_icon'], [ 
					'aria-hidden' => 'true',
					'class' => 'sa-button-left sa-me-2'
				] );
				echo '</span>';
			}

			$this->add_inline_editing_attributes( 'button_text', 'none' );

			printf(
				'<span %1$s>%2$s</span>',
				wp_kses_post( $this->get_render_attribute_string( 'button_text' ) ),
				esc_html( $settings['button_text'] )
			);

			if ( ! empty( $settings['button_icon']['value'] ) && $settings['button_icon_position'] == 'after' ) {
				echo '<span class="sa-icon-wrap sa-button-icon">';
				Icons_Manager::render_icon( $settings['button_icon'], [ 
					'aria-hidden' => 'true', 'class' => 'sa-button-right sa-ms-2'
				] );
				echo '</span>';
			}
			?>
		</a>
		<?php
	}

	protected function render_title( $item, $index ) {
		$settings = $this->get_settings_for_display();

		if ( 'yes' !== $settings['show_title'] ) {
			return;
		}

		$this->add_render_attribute( 'title-link-attr' . $index, 'class', 'sa-link', true );
		$this->add_render_attribute( 'title-link-attr' . $index, 'href', 'javascript:void(0);', true );

		$title_content = ( isset( $item['title'] ) && ! empty( $item['title'] ) ) ? wp_kses_post( $item['title'] ) : wp_kses_post( $item['title'] );

		$__title_content = '<a ' . $this->get_render_attribute_string( 'title-link-attr' . $index ) . '>' . $title_content . '</a>';

		if ( isset( $item['link']['url'] ) && ! empty( $item['link']['url'] ) ) :
			$this->add_render_attribute( 'title-link-attr' . $index, 'href', esc_url( $item['link']['url'] ), true );

			if ( $item['link']['is_external'] ) {
				$this->add_render_attribute( 'title-link-attr' . $index, 'target', '_blank', true );
			}

			if ( $item['link']['nofollow'] ) {
				$this->add_render_attribute( 'title-link-attr' . $index, 'rel', 'nofollow', true );
			}
			$__title_content = '<a ' . $this->get_render_attribute_string( 'title-link-attr' . $index ) . '>' . $title_content . '</a>';
		endif;
		printf(
			'<%1$s class="sa-title">%2$s</%1$s>',
			esc_attr( Utils::validate_html_tag( $settings['title_tag'] ) ),
			wp_kses_post( $__title_content )
		);
	}

	protected function render_text( $item, $index ) {
		$settings = $this->get_settings_for_display();

		if ( 'yes' !== $settings['show_text'] ) {
			return;
		}

		?>
		<div class="sa-text sa-my-2">
			<?php echo wp_kses_post( $item['text'] ); ?>
		</div>
		<?php
	}

	protected function render_item() {
		$settings = $this->get_settings_for_display();
		$id = 'sa-panel-slider-' . $this->get_id();

		$item_link_on = false;
		if ( ! empty( $settings['link_on'] ) ) {
			if ( in_array( "item", $settings['link_on'] ) ) {
				$item_link_on = true;
			}
		}

		foreach ( $settings['slider_list'] as $index => $item ) :
			?>
			<div class="swiper-slide">
				<?php
				if ( $item_link_on === true ) {
					if ( ! empty( $item['link']['url'] ) ) {
						$this->add_render_attribute( 'link_attr' . $index, 'class', 'sa-link sa-link-item', true );
						$this->add_render_attribute( 'link_attr' . $index, 'href', esc_url( $item['link']['url'] ), true );

						if ( $item['link']['is_external'] ) {
							$this->add_render_attribute( 'link_attr' . $index, 'target', '_blank', true );
						}

						if ( $item['link']['nofollow'] ) {
							$this->add_render_attribute( 'link_attr' . $index, 'rel', 'nofollow', true );
						}
						?>
						<a <?php $this->print_render_attribute_string( 'link_attr' . $index ); ?>></a>
						<?php
					}
				}
				?>
				<?php
				if ( ! empty( $item['image']['url'] ) ) :
					?>
					<div class="sa-img-wrapper" data-swiper-parallax="-100">
						<?php

						$placeholder_image_src = Utils::get_placeholder_image_src();
						$image_url = Group_Control_Image_Size::get_attachment_image_src( $item['image']['id'], 'thumbnail', $settings );

						if ( ! $image_url ) {
							printf( '<img src="%1$s" alt="%2$s" class="%3$s">', esc_url( $placeholder_image_src ), esc_html( $item['title'] ), 'sa-cover' );
						} else {
							print ( wp_get_attachment_image(
								$item['image']['id'],
								$settings['thumbnail_size'],
								false,
								[ 
									'class' => ( 'yes' == $settings['img_cover'] ) ? 'sa-cover' : 'sa-',
									'alt' => ! empty( $item['title'] ) ? esc_html( $item['title'] ) : Control_Media::get_image_alt( $item['image'] )
								]
							) );
						}

						?>
					</div>
				<?php endif; ?>
				<div class="sa-slide-wrapper sa-w-100 sa-h-100">
					<div class="sa-content sa-w-100">
						<?php $this->render_title( $item, $index ); ?>
						<?php $this->render_text( $item, $index ); ?>
						<?php $this->render_button( $item['link'] ); ?>
					</div>
				</div>
			</div>
		<?php endforeach;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->render_header();

		$this->render_item();

		/**
		 * global function
		 */
		$this->render_footer();
	}

	public function render_header() {
		$settings = $this->get_settings_for_display();
		$id = 'sa-panel-slider-' . $this->get_id();

		/**
		 * global function
		 */
		$this->render_header_attributes( 'panel-slider' );


		$show_content = ( sky_addons_init_pro() == true ) ? $settings['show_content'] : 'hover';

		$this->add_render_attribute(
			[ 
				'carousel' => [ 
					'class' => [ 'sa-panel-slider', 'sa-swiper-global-carousel' ],
					'id' => $id,
					'data-slider-settings' => [ 
						wp_json_encode( array_filter( [ 
							'showContent' => $show_content,
						] ) )
					]
				]
			]
		);

		?>

		<div <?php $this->print_render_attribute_string( 'carousel' ); ?>>
			<div class="swiper">
				<div class="swiper-wrapper">

					<?php
	}
}
