<?php

namespace Sky_Addons\Modules\Review\Widgets;

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
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Review extends Widget_Base {

	public function get_name() {
		return 'sky-review';
	}

	public function get_title() {
		return esc_html__( 'Review', 'sky-elementor-addons' );
	}

	public function get_icon() {
		return 'sky-icon-review';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'sky', 'card', 'review', 'testimonial', 'clients' ];
	}

	public function get_script_depends() {
		return [ 'script-handle' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_review_layout',
			[ 
				'label' => esc_html__( 'Layout', 'sky-elementor-addons' ),
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
				//                'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[ 
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'large',
				'separator' => 'none',
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
					'right' => [ 
							'title' => esc_html__( 'Right', 'sky-elementor-addons' ),
							'icon' => 'eicon-h-align-right',
						],
				],
				'toggle' => false,
				'desktop_default' => 'top',
				'tablet_default' => 'top',
				'mobile_default' => 'top',
				'prefix_class' => 'sa-review-media-%s-',
				'style_transfer' => true,
				'selectors' => [ 
					'{{WRAPPER}} .elementor-widget-container .sa-review' => '{{VALUE}};',
				],
				'selectors_dictionary' => [ 
						'left' => 'display: flex; flex-direction: row; text-align: left;',
						'top' => 'text-align: left; display: block; flex-direction: unset; flex-flow: unset;',
						'right' => 'display: flex; flex-direction: row-reverse; text-align: right;'
					]
			]
		);

		$this->add_responsive_control(
			'review_alignment',
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
					'{{WRAPPER}} .sa-review' => 'text-align: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'name',
			[ 
				'label' => esc_html__( 'Name', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Name Surname', 'sky-elementor-addons' ),
				'placeholder' => esc_html__( 'Type your Name here', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'name_tag',
			[ 
				'label' => esc_html__( 'Name HTML Tag', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => sky_title_tags(),
			]
		);

		$this->add_control(
			'show_designation',
			[ 
				'label' => esc_html__( 'Show Designation', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'designation',
			[ 
				'label' => esc_html__( 'Designation', 'sky-elementor-addons' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'POSITION', 'sky-elementor-addons' ),
				'placeholder' => esc_html__( 'Type your Designation here', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
				'condition' => [ 
					'show_designation' => 'yes'
				]
			]
		);

		$this->add_control(
			'designation_tag',
			[ 
				'label' => esc_html__( 'Designation HTML Tag', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h6',
				'options' => sky_title_tags(),
				'condition' => [ 
					'show_designation' => 'yes'
				]
			]
		);

		$this->add_control(
			'review',
			[ 
				'label' => esc_html__( 'Review', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus.' ),
				'placeholder' => esc_html__( 'Type your review here', 'sky-elementor-addons' ),
				'description' => esc_html__( 'You can also put basic html tags on this input field.', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
				'separator' => 'before'
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_rating',
			[ 
				'label' => esc_html__( 'Rating', 'elementor' ),
			]
		);

		$this->add_control(
			'rating_scale',
			[ 
				'label' => esc_html__( 'Rating Scale', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [ 
					'5' => '0-5',
					'10' => '0-10',
				],
				'default' => '5',
			]
		);

		$this->add_control(
			'rating',
			[ 
				'label' => esc_html__( 'Rating', 'elementor' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 0,
				'max' => 10,
				'step' => 0.1,
				'default' => 5,
				'dynamic' => [ 
					'active' => true,
				],
			]
		);

		$this->add_control(
			'star_style',
			[ 
				'label' => esc_html__( 'Icon', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'options' => [ 
					'star_fontawesome' => 'Font Awesome',
					'star_unicode' => 'Unicode',
				],
				'default' => 'star_fontawesome',
				'render_type' => 'template',
				'prefix_class' => 'elementor--star-style-',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'unmarked_star_style',
			[ 
				'label' => esc_html__( 'Unmarked Style', 'elementor' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [ 
					'solid' => [ 
						'title' => esc_html__( 'Solid', 'elementor' ),
						'icon' => 'eicon-star',
					],
					'outline' => [ 
						'title' => esc_html__( 'Outline', 'elementor' ),
						'icon' => 'eicon-star-o',
					],
				],
				'default' => 'solid',
			]
		);

		$this->add_control(
			'review_position',
			[ 
				'label' => esc_html__( 'Review Position', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'after',
				'options' => [ 
					'before' => esc_html__( 'Before Rating', 'sky-elementor-addons' ),
					'after' => esc_html__( 'After Rating', 'sky-elementor-addons' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_review_style',
			[ 
				'label' => esc_html__( 'Review', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[ 
				'label' => esc_html__( 'Text Box Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-review .sa-review-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_img_style',
			[ 
				'label' => esc_html__( 'Photo', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'img_height',
			[ 
				'label' => esc_html__( 'Height', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 50,
						'max' => 200,
						'step' => 1,
					],
				],
				'selectors' => [ 
						'{{WRAPPER}} .sa-review-figure' => 'height: {{SIZE}}{{UNIT}};',
					],
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
						'max' => 200,
						'step' => 1,
					],
					'%' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					//                        '{{WRAPPER}} .sa-review-figure' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} ' => '--sa-review-media-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'img_offset_popover',
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
					'{{WRAPPER}} .sa-review' => '--sky-media-h-offset: {{SIZE}}px;'
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
					'{{WRAPPER}} .sa-review' => '--sky-media-v-offset: {{SIZE}}px;'
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
					'{{WRAPPER}} .sa-review' => '--sky-media-rotate: {{SIZE}}deg;'
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
					'{{WRAPPER}} .sa-review .sa-review-figure img ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'img_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-review .sa-review-figure img',
			]
		);

		$this->add_responsive_control(
			'img_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-review .sa-review-figure img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'img_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-review .sa-review-figure img',
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
						'{{WRAPPER}} .sa-review .sa-review-figure img' => 'opacity: {{SIZE}};',
					],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[ 
				'name' => 'img_css_filters',
				'selector' => '{{WRAPPER}} .sa-review .sa-review-figure img',
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
						'{{WRAPPER}} .sa-review .sa-review-figure img:hover' => 'opacity: {{SIZE}};',
					],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[ 
				'name' => 'img_css_filters_hover',
				'selector' => '{{WRAPPER}} .sa-review .sa-review-figure img:hover',
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
						'{{WRAPPER}} .sa-review .sa-review-figure img' => 'transition-duration: {{SIZE}}s',
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
			'section_name_style',
			[ 
				'label' => esc_html__( 'Name', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'name!' => '',
				]
			]
		);


		$this->add_responsive_control(
			'name_spacing',
			[ 
				'label' => esc_html__( 'Spacing', 'sky-elementor-addons' ),
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
					'{{WRAPPER}} .sa-review .sa-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'name_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-review .sa-name',
			]
		);

		$this->start_controls_tabs( 'tabs_name_style' );

		$this->start_controls_tab(
			'tab_name_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'name_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-review .sa-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'name_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-review .sa-name',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_name_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'name_color_hover',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .elementor-widget-container:hover .sa-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'name_text_shadow_hover',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .elementor-widget-container:hover .sa-name',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_designation_style',
			[ 
				'label' => esc_html__( 'Designation', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'designation!' => '',
					'show_designation' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'designation_spacing',
			[ 
				'label' => esc_html__( 'Spacing', 'sky-elementor-addons' ),
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
					'{{WRAPPER}} .sa-review .sa-designation' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'designation_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-review .sa-designation',
			]
		);

		$this->start_controls_tabs( 'tabs_designation_style' );

		$this->start_controls_tab(
			'tab_designation_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'designation_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-review .sa-designation' => 'color: {{VALUE}}',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'designation_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-review .sa-designation',
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_designation_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'designation_color_hover',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .elementor-widget-container:hover .sa-designation' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'designation_text_shadow_hover',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .elementor-widget-container:hover .sa-designation',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_review_text_style',
			[ 
				'label' => esc_html__( 'Review', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'review!' => '',
				]
			]
		);

		$this->add_responsive_control(
			'review_spacing',
			[ 
				'label' => esc_html__( 'Spacing', 'sky-elementor-addons' ),
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
					'{{WRAPPER}} .sa-review .sa-review-desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'review_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-review .sa-review-desc',
			]
		);

		$this->start_controls_tabs( 'review_tabs' );

		$this->start_controls_tab(
			'review_tab_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'review_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-review .sa-review-desc' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'review_tab_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'review_color_hover',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .elementor-widget-container:hover .sa-review-desc' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_rating_style',
			[ 
				'label' => esc_html__( 'Rating', 'elementor' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'rating_spacing',
			[ 
				'label' => esc_html__( 'Spacing', 'sky-elementor-addons' ),
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
					'{{WRAPPER}} .review-star-rating' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'rating_size',
			[ 
				'label' => esc_html__( 'Size', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
						'{{WRAPPER}} .review-star-rating' => 'font-size: {{SIZE}}{{UNIT}}',
					],
			]
		);

		$this->add_responsive_control(
			'rating_icon_space',
			[ 
				'label' => esc_html__( 'Space Between', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [ 
						'body:not(.rtl) {{WRAPPER}} .review-star-rating i:not(:last-of-type)' => 'margin-right: {{SIZE}}{{UNIT}}',
						'body.rtl {{WRAPPER}} .review-star-rating i:not(:last-of-type)' => 'margin-left: {{SIZE}}{{UNIT}}',
					],
			]
		);

		$this->add_control(
			'stars_color',
			[ 
				'label' => esc_html__( 'Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .review-star-rating i:before' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'stars_unmarked_color',
			[ 
				'label' => esc_html__( 'Unmarked Color', 'elementor' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .review-star-rating i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'rating_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .review-star-rating',
			]
		);

		$this->add_responsive_control(
			'rating_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .review-star-rating' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'rating_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .review-star-rating',
			]
		);

		$this->add_responsive_control(
			'rating_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .review-star-rating' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function get_rating() {
		$settings = $this->get_settings_for_display();
		$rating_scale = (int) $settings['rating_scale'];
		$rating = (float) $settings['rating'] > $rating_scale ? $rating_scale : $settings['rating'];

		return [ $rating, $rating_scale ];
	}

	protected function render_stars( $icon ) {
		$rating_data = $this->get_rating();
		$rating = (float) $rating_data[0];
		$floored_rating = floor( $rating );
		$stars_html = '';

		for ( $stars = 1.0; $stars <= $rating_data[1]; $stars++ ) {
			if ( $stars <= $floored_rating ) {
				$stars_html .= '<i class="review-star-full">' . $icon . '</i>';
			} elseif ( $floored_rating + 1 === $stars && $rating !== $floored_rating ) {
				$stars_html .= '<i class="review-star-' . ( $rating - $floored_rating ) * 10 . '">' . $icon . '</i>';
			} else {
				$stars_html .= '<i class="review-star-empty">' . $icon . '</i>';
			}
		}

		return $stars_html;
	}

	protected function render() {
		$settings = $this->get_settings();

		if ( ! empty( $settings['image']['url'] ) ) {
			$this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
			$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
			$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );

			if ( $settings['img_hover_animation'] ) {
				$settings['hover_animation'] = $settings['img_hover_animation'];
				$this->add_render_attribute( 'image', 'class', 'elementor-animation-' . $settings['hover_animation'] );
			}

			$image_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' );
		}

		//star rating
		$rating_data = $this->get_rating();
		$textual_rating = $rating_data[0] . '/' . $rating_data[1];
		$icon = '&#xE934;';

		if ( 'star_fontawesome' === $settings['star_style'] ) {
			if ( 'outline' === $settings['unmarked_star_style'] ) {
				$icon = '&#xE933;';
			}
		} elseif ( 'star_unicode' === $settings['star_style'] ) {
			$icon = '&#9733;';

			if ( 'outline' === $settings['unmarked_star_style'] ) {
				$icon = '&#9734;';
			}
		}

		$this->add_render_attribute( 'icon_wrapper', [ 
			'class' => 'review-star-rating',
			'title' => $textual_rating,
			'itemtype' => 'http://schema.org/Rating',
			'itemscope' => '',
			'itemprop' => 'reviewRating',
		] );

		$schema_rating = '<span itemprop="ratingValue" class="elementor-screen-only">' . $textual_rating . '</span>';
		$stars_element = '<div ' . $this->get_render_attribute_string( 'icon_wrapper' ) . '>' . $this->render_stars( $icon ) . ' ' . $schema_rating . '</div>';

		?>
		<div class="sa-review">
			<?php if ( ! empty( $settings['image']['url'] ) ) : ?>
				<figure class="sa-review-figure">
					<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ) ); ?>
				</figure>
			<?php endif; ?>

			<div class="sa-review-body">
				<?php
				if ( $settings['review_position'] == 'before' ) :
					if ( ! empty( $settings['review'] ) ) : ?>
						<div class="sa-review-desc sa-mt-4">
							<?php echo wp_kses_post( $settings['review'] ); ?>
						</div>
						<?php
					endif;
				endif;
				?>
				<div class="sa-reviewer sa-mt-3">
					<?php

					if ( ! empty( $settings['name'] ) ) {
						printf(
							'<%1$s class="%2$s">%3$s</%1$s>',
							esc_attr( Utils::validate_html_tag( $settings['name_tag'] ) ),
							'sa-name sa-mb-2 sa--text-title sa-mt-0',
							wp_kses_post( $settings['name'] )
						);
					}

					if ( $settings['show_designation'] == 'yes' && ! empty( $settings['designation'] ) ) {
						printf(
							'<%1$s class="%2$s">%3$s</%1$s>',
							esc_attr( Utils::validate_html_tag( $settings['designation_tag'] ) ),
							'sa-designation sa-mt-0 sa-mb-2',
							esc_html( $settings['designation'] )
						);
					}
					echo wp_kses_post( $stars_element );
					?>


				</div>

				<?php

				if ( $settings['review_position'] == 'after' ) :
					if ( ! empty( $settings['review'] ) ) :
						?>
						<div class="sa-review-desc sa-mt-4">
							<?php echo wp_kses_post( $settings['review'] ); ?>
						</div>
						<?php
					endif;
				endif;
				?>

			</div>
		</div>
		<?php
	}
}
