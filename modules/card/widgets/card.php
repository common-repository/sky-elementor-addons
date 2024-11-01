<?php

namespace Sky_Addons\Modules\Card\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Card extends Widget_Base {

	public function get_name() {
		return 'sky-card';
	}

	public function get_title() {
		return esc_html__( 'Card', 'sky-elementor-addons' );
	}

	public function get_icon() {
		return 'sky-icon-card';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'sky', 'card', 'box', 'informations', 'modern' ];
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/Ib9jDrC2caQ';
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_card_layout',
			[ 
				'label' => esc_html__( 'Card', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'image',
			[ 
				'label' => esc_html__( 'Choose Image', 'sky-elementor-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [ 
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[ 
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
			]
		);

		$this->add_responsive_control(
			'image_position',
			[ 
				'label' => esc_html__( 'Image Position', 'sky-elementor-addons' ),
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
					'right' => [ 
						'title' => esc_html__( 'Right', 'sky-elementor-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'toggle' => false,
				'desktop_default' => 'top',
				'tablet_default' => 'top',
				'mobile_default' => 'top',
				'prefix_class' => 'sa-card-%s-',
				'style_transfer' => true,
				'selectors' => [ 
					'{{WRAPPER}} .elementor-widget-container .sa-card' => '{{VALUE}};',
				],
				'selectors_dictionary' => [ 
					'left' => 'display: flex; flex-direction: row; text-align: left;',
					'top' => 'text-align: left; display: block; flex-direction: unset; flex-flow: unset;',
					'right' => 'display: flex; flex-direction: row-reverse; text-align: right;'
				]
			]
		);

		$this->add_control(
			'title',
			[ 
				'label' => esc_html__( 'Title', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Your Card Title', 'sky-elementor-addons' ),
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
			'show_sub_title',
			[ 
				'label' => esc_html__( 'Show Sub Title', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'sub_title',
			[ 
				'label' => esc_html__( 'Sub Title', 'sky-elementor-addons' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Sub Title', 'sky-elementor-addons' ),
				'placeholder' => esc_html__( 'Type your sub title here', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
				'condition' => [ 
					'show_sub_title' => 'yes'
				]
			]
		);

		$this->add_control(
			'sub_title_tag',
			[ 
				'label' => esc_html__( 'Sub Title HTML Tag', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h6',
				'options' => sky_title_tags(),
				'condition' => [ 
					'show_sub_title' => 'yes'
				]
			]
		);

		$this->add_control(
			'description',
			[ 
				'label' => esc_html__( 'Description', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis.' ),
				'placeholder' => esc_html__( 'Type your description here', 'sky-elementor-addons' ),
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
				'default' => esc_html__( 'Badge', 'sky-elementor-addons' ),
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
					'top-center' => esc_html__( 'Top Center', 'sky-elementor-addons' ),
					'top-right' => esc_html__( 'Top Right', 'sky-elementor-addons' ),
					'middle-left' => esc_html__( 'Middle Left', 'sky-elementor-addons' ),
					'middle-center' => esc_html__( 'Middle Center', 'sky-elementor-addons' ),
					'middle-right' => esc_html__( 'Middle Right', 'sky-elementor-addons' ),
					'bottom-left' => esc_html__( 'Bottom Left', 'sky-elementor-addons' ),
					'bottom-center' => esc_html__( 'Bottom Center', 'sky-elementor-addons' ),
					'bottom-right' => esc_html__( 'Bottom Right', 'sky-elementor-addons' ),
				],
				'condition' => [ 
					'show_badge' => 'yes'
				]
			]
		);


		$this->add_control(
			'show_button',
			[ 
				'label' => esc_html__( 'Show Button', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_button',
			[ 
				'label' => esc_html__( 'Button', 'sky-elementor-addons' ),
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
				'default' => esc_html__( 'Click here', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
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
			]
		);

		$this->add_control(
			'button_full_width',
			[ 
				'label' => esc_html__( 'Full Width', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'button_alignment',
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
				'condition' => [ 
					'button_full_width' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-card .sa-button' => 'text-align: {{VALUE}};',
				],
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
					],
				],
				'condition' => [ 
					'button_icon[value]!' => ''
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-button-icon-before .sa-button-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sa-button-icon-after .sa-button-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_card_style',
			[ 
				'label' => esc_html__( 'Card', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'card_alignment',
			[ 
				'label' => esc_html__( 'Card Alignment', 'sky-elementor-addons' ),
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
					'{{WRAPPER}} .sa-card' => 'text-align: {{VALUE}} !important;',
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
					'{{WRAPPER}} .sa-card .sa-content-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'widget_overflow_hidden',
			[ 
				'label' => esc_html__( 'Overflow Hidden?', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'selectors' => [ 
					'{{WRAPPER}} .elementor-widget-container' => 'overflow:hidden;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_img_style',
			[ 
				'label' => esc_html__( 'Image', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'img_width',
			[ 
				'label' => esc_html__( 'Width', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [ 
					'px' => [ 
						'min' => 50,
						'max' => 500,
					],
					'%' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-card' => '--sa-card-img-area-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'img_height',
			[ 
				'label' => esc_html__( 'Height', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [ 
					'px' => [ 
						'min' => 50,
						'max' => 1000,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-img-area' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'img_offset_popover',
			[ 
				'label' => esc_html__( 'Offset', 'sky-elementor-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
			]
		);


		$this->start_popover();

		$this->add_responsive_control(
			'img_horizontal_offset',
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
					'img_offset_popover' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-card' => '--sky-media-h-offset: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'img_vertical_offset',
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
					'img_offset_popover' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-card' => '--sky-media-v-offset: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'img_rotate',
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
					'img_offset_popover' => 'yes'
				],
				'render_type' => 'ui',
				'selectors' => [ 
					'{{WRAPPER}} .sa-card' => '--sky-media-rotate: {{SIZE}}deg;'
				],
			]
		);

		$this->end_popover();

		$this->add_responsive_control(
			'img_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-img-area img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'img_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-img-area img',
			]
		);

		$this->add_responsive_control(
			'img_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-img-area img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'img_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-img-area img',
			]
		);

		$this->add_control(
			'img_obj_contain',
			[ 
				'label' => esc_html__( 'Object-Fit Contain?', 'sky-elementor-addons' ),
				'description' => esc_html__( 'Default Cover', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'prefix_class' => 'sa-img-contain-',
			]
		);

		$this->start_controls_tabs( 'tabs_img_style' );

		$this->start_controls_tab(
			'tab_img_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'img_opacity',
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
					'{{WRAPPER}} .sa-img-area img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[ 
				'name' => 'img_css_filters',
				'selector' => '{{WRAPPER}} .sa-img-area img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_img_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'img_opacity_hover',
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
					'{{WRAPPER}} .sa-img-area img:hover' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[ 
				'name' => 'img_css_filters_hover',
				'selector' => '{{WRAPPER}} .sa-img-area img:hover',
			]
		);

		$this->add_control(
			'img_transition',
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
					'{{WRAPPER}} .sa-img-area img' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->add_control(
			'img_hover_animation',
			[ 
				'label' => esc_html__( 'Hover Animation', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
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
					'{{WRAPPER}}' => '--sky-badge-h-offset: {{SIZE}}px;'
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
					'{{WRAPPER}}' => '--sky-badge-v-offset: {{SIZE}}px;'
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
				'condition' => [ 
					'badge_offset_popover' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}}' => '--sky-badge-rotate: {{SIZE}}deg;'
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
					'{{WRAPPER}} .sa-img-area .sa-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'badge_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-img-area .sa-badge',
			]
		);

		$this->add_control(
			'badge_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-img-area .sa-badge' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'badge_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-img-area .sa-badge',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'badge_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-img-area .sa-badge',
			]
		);

		$this->add_responsive_control(
			'badge_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-img-area .sa-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'badge_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-img-area .sa-badge',
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_sub_title_style',
			[ 
				'label' => esc_html__( 'Sub Title', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'sub_title!' => '',
					'show_sub_title' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'sub_title_spacing',
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
					'{{WRAPPER}} .sa-sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'sub_title_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-sub-title',
			]
		);

		$this->start_controls_tabs( 'tabs_sub_title_style' );

		$this->start_controls_tab(
			'tab_sub_title_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'sub_title_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-sub-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'sub_title_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-sub-title',
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_sub_title_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'sub_title_color_hover',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .elementor-widget-container:hover .sa-sub-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'sub_title_text_shadow_hover',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .elementor-widget-container:hover .sa-sub-title',
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
					'{{WRAPPER}} .sa-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .sa-title' => 'color: {{VALUE}}',
				],
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
					'{{WRAPPER}} .elementor-widget-container:hover .sa-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'title_text_shadow_hover',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .elementor-widget-container:hover .sa-title',
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
					'description!' => '',
				]
			]
		);

		$this->add_responsive_control(
			'desc_spacing',
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
					'{{WRAPPER}} .sa-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'desc_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-desc',
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
					'{{WRAPPER}} .sa-desc' => 'color: {{VALUE}}',
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
					'{{WRAPPER}} .elementor-widget-container:hover .sa-desc' => 'color: {{VALUE}}',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[ 
				'label' => esc_html__( 'Button', 'sky-elementor-addons' ),
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
					'{{WRAPPER}} .sa-button, {{WRAPPER}} .sa-button:focus' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'button_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-button, {{WRAPPER}} .sa-button:focus',
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

		$this->add_control(
			'card_h_btn_color_change',
			[ 
				'label' => esc_html__( 'Color Change on Card Hover?', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'description' => esc_html__( 'If you enable this setting, you will able to change the Button color on hover Card. It\'s only for extend design. ', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'card_h_btn_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .elementor-widget-container:hover .sa-button' => 'color: {{VALUE}}',
				],
				'condition' => [ 
					'card_h_btn_color_change' => 'yes'
				]
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'badge_text', 'class', 'sa-badge sa-px-3 sa-py-2' );
		$this->add_render_attribute( 'badge_text', 'class', ( $settings['show_badge'] == 'yes' ) ? 'sa-' . $settings['badge_position'] : '' );


		if ( ! empty( $settings['image']['url'] ) ) {
			$this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
			$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
			$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );

			if ( $settings['img_hover_animation'] ) {
				$settings['hover_animation'] = $settings['img_hover_animation'];
				$this->add_render_attribute( 'image', 'class', 'elementor-animation-' . $settings['img_hover_animation'] );
			}

			$image_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );
		}
		?>
		<div class="sa-card">

			<?php if ( ! empty( $settings['image']['url'] ) ) : ?>
				<figure class="sa-img-area">
					<?php
					if ( ! empty( $settings['link']['url'] ) ) {
						$this->add_render_attribute( 'link', 'class', 'sa-text-decoration-none' );
						$this->add_link_attributes( 'link', $settings['link'] );
						printf(
							'<a %1$s>%2$s</a>',
							wp_kses_post( $this->get_render_attribute_string( 'link' ) ),
							wp_kses_post( $image_html )
						);
					} else {
						printf(
							'<a %1$s>%2$s</a>',
							wp_kses_post( $this->get_render_attribute_string( 'link' ) ),
							wp_kses_post( $image_html )
						);
					}

					if ( $settings['show_badge'] == 'yes' && ! empty( $settings['badge_text'] ) ) {
						$this->add_inline_editing_attributes( 'badge_text', 'none' );

						printf(
							'<span %1$s>%2$s</span>',
							wp_kses_post( $this->get_render_attribute_string( 'badge_text' ) ),
							esc_html( $settings['badge_text'] )
						);
					}

					?>
				</figure>
			<?php endif; ?>

			<div class="sa-content-area">
				<?php
				if ( $settings['show_sub_title'] == 'yes' && ! empty( $settings['sub_title'] ) ) {
					printf(
						'<%1$s class="%2$s">%3$s</%1$s>',
						esc_attr( Utils::validate_html_tag( $settings['sub_title_tag'] ) ),
						'sa--text-sub-title sa--sub-title sa-sub-title sa-mt-0 sa-mb-1 sa-fs-6',
						wp_kses_post( $settings['sub_title'] )
					);
				}

				if ( ! empty( $settings['title'] ) ) {
					printf(
						'<%1$s class="%2$s">%3$s</%1$s>',
						esc_attr( Utils::validate_html_tag( $settings['title_tag'] ) ),
						'sa-title sa--title sa--text-title sa-mt-0 sa-mb-1 sa-fs-4',
						wp_kses_post( $settings['title'] )
					);
				}

				if ( ! empty( $settings['description'] ) ) {
					printf(
						'<div class="%1$s">%2$s</div>',
						'sa-desc sa--text-info sa-mb-3 sa-fs-6',
						wp_kses_post( $settings['description'] )
					);
				}
				?>

				<?php
				if ( $settings['show_button'] == 'yes' ) :

					$this->add_render_attribute( 'link_attr', 'class', 'sa-button sa-d-inline-flex sa-text-decoration-none sa-p-3 sa-rounded sa-align-items-center' );
					$this->add_render_attribute( 'link_attr', 'class', ( $settings['button_full_width'] == 'yes' ) ? 'sa-d-flex' : '' );

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

					if ( $settings['button_hover_animation'] ) {
						$this->add_render_attribute( 'link_attr', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
					}

					if ( ! empty( $settings['button_text'] ) ) :
						$this->add_render_attribute( 'link_attr', 'class', 'sa-button-icon-' . $settings['button_icon_position'] );
					endif;
					?>
					<a <?php $this->print_render_attribute_string( 'link_attr' ); ?>>

						<?php
						if ( ! empty( $settings['button_icon']['value'] ) && $settings['button_icon_position'] == 'before' ) {
							echo '<span class="sa-icon-wrap sa-button-icon">';
							Icons_Manager::render_icon( $settings['button_icon'], [ 
								'aria-hidden' => 'true',
							] );
							echo '</span>';
						}

						if ( ! empty( $settings['button_text'] ) ) :
							$this->add_render_attribute( 'button_text', 'class', 'sa-button-text' );
							$this->add_inline_editing_attributes( 'button_text', 'none' );

							printf(
								'<span %1$s>%2$s</span>',
								wp_kses_post( $this->get_render_attribute_string( 'button_text' ) ),
								esc_html( $settings['button_text'] )
							);

						endif;

						if ( ! empty( $settings['button_icon']['value'] ) && $settings['button_icon_position'] == 'after' ) {
							echo '<span class="sa-icon-wrap sa-button-icon">';
							Icons_Manager::render_icon( $settings['button_icon'], [ 
								'aria-hidden' => 'true',
							] );
							echo '</span>';
						}
						?>
					</a>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
