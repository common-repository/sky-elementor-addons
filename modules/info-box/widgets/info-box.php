<?php

namespace Sky_Addons\Modules\InfoBox\Widgets;

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

class Info_Box extends Widget_Base {

	public function get_name() {
		return 'sky-info-box';
	}

	public function get_title() {
		return esc_html__( 'Info Box', 'sky-elementor-addons' );
	}

	public function get_icon() {
		return 'sky-icon-info-box';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'card', 'informations', 'box', 'sky' ];
	}

	public function get_style_depends() {
		return [ 
			'elementor-icons-fa-solid',
			'elementor-icons-fa-regular',
		];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_info_box_layout',
			[ 
				'label' => esc_html__( 'Layout', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
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
				],
				'default' => 'icon',
				'toggle' => false,
				'style_transfer' => true,
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
				'condition' => [ 
					'media_type' => 'image'
				],
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[ 
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'medium_large',
				'separator' => 'none',
				'condition' => [ 
					'media_type' => 'image'
				]
			]
		);

		$this->add_control(
			'icon',
			[ 
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'default' => [ 
					'value' => 'fas fa-desktop',
					'library' => 'fa-solid',
				],
				'condition' => [ 
					'media_type' => 'icon'
				]
			]
		);

		$this->add_control(
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
				'default' => 'top',
				'prefix_class' => 'sa-info-box-media-',
			]
		);


		$this->add_control(
			'media_v_align',
			[ 
				'label' => esc_html__( 'Vertical Alignment', 'sky-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [ 
					'top' => [ 
						'title' => esc_html__( 'Top', 'sky-elementor-addons' ),
						'icon' => 'eicon-v-align-top',
					],
					'center' => [ 
						'title' => esc_html__( 'Center', 'sky-elementor-addons' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [ 
						'title' => esc_html__( 'Bottom', 'sky-elementor-addons' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'default' => 'top',
				'toggle' => false,
				'condition' => [ 
					'media_position!' => 'top',
				],
				'style_transfer' => true,
				'selectors_dictionary' => [ 
					'center' => '    -webkit-align-self: center; -ms-flex-item-align: center; align-self: center;',
					'bottom' => '    -webkit-align-self: flex-end; -ms-flex-item-align: end; align-self: flex-end;',
				],
				'selectors' => [ 
					'{{WRAPPER}}.sa-info-box-media-left .sa-infobox-figure' => '{{VALUE}};',
					'{{WRAPPER}}.sa-info-box-media-right .sa-infobox-figure' => '{{VALUE}};'
				]
			]
		);

		$this->add_control(
			'title',
			[ 
				'label' => esc_html__( 'Title', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Your Info Box Title', 'sky-elementor-addons' ),
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
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' ),
				'placeholder' => esc_html__( 'Type your description here', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
				'separator' => 'before'
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

		//        $this->add_control(
		//            'module_link', [
		//                'label'     => esc_html__('Module Link', 'sky-elementor-addons'),
		//                'type'      => Controls_Manager::SWITCHER,
		//                'separator' => 'before'
		//            ]
		//        );

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
			'link',
			[ 
				'label' => esc_html__( 'Link', 'sky-elementor-addons' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'sky-elementor-addons' ),
				'show_external' => true,
				'default' => [ 
					'url' => '',
				],
				'dynamic' => [ 'active' => true ],
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
					'{{WRAPPER}} .sa-info-box .sa-button' => 'text-align: {{VALUE}};',
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
						'step' => 1,
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
			'section_info_box_style',
			[ 
				'label' => esc_html__( 'Info Box', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'info_box_alignment',
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
					'{{WRAPPER}} .sa-info-box' => 'text-align: {{VALUE}} !important;',
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
					'{{WRAPPER}} .sa-info-box .sa-infobox-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_media_style',
			[ 
				'label' => esc_html__( 'Image / Icon', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
						'max' => 100,
						'step' => 1,
					],
					'%' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'condition' => [ 
					'media_type' => 'icon',
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-infobox-figure.sa-icon-wrap' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_spacing',
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
					'{{WRAPPER}}' => '--sa-icon-spacing: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .sa-info-box .sa-media-image' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 
					'media_type' => 'image',
				],
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
						'max' => 1000,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-info-box .sa-media-image' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sa-info-box .sa-icon-wrap' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 
					'media_type' => 'image',
				],
			]
		);

		$this->add_control(
			'media_offset_popover',
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
			'media_horizontal_offset',
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
					'media_offset_popover' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-info-box ' => '--sky-media-h-offset: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'media_vertical_offset',
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
					'media_offset_popover' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-info-box' => '--sky-media-v-offset: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'media_rotate',
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
					'media_offset_popover' => 'yes'
				],
				'render_type' => 'ui',
				'selectors' => [ 
					'{{WRAPPER}} .sa-info-box' => '--sky-media-rotate: {{SIZE}}deg;',
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
					'{{WRAPPER}} .sa-info-box .sa-infobox-figure' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'img_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-info-box .sa-infobox-figure',
			]
		);

		$this->add_responsive_control(
			'img_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-info-box .sa-infobox-figure' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .sa-info-box .sa-infobox-figure' => 'border-radius: {{VALUE}};',
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


		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'img_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-info-box .sa-infobox-figure',
			]
		);


		$this->start_controls_tabs( 'tabs_media_style' );

		$this->start_controls_tab(
			'tab_media_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'icon_color',
			[ 
				'label' => esc_html__( 'Icon Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [ 
					'media_type' => 'icon'
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-infobox-figure.sa-icon-wrap' => 'color: {{VALUE}}',
					'{{WRAPPER}} .sa-infobox-figure.sa-icon-wrap svg *' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'icon_bg',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'condition' => [ 
					'media_type' => 'icon'
				],
				'selector' => '{{WRAPPER}} .sa-infobox-figure.sa-icon-wrap',
			]
		);

		$this->add_control(
			'media_opacity',
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
					'{{WRAPPER}} .sa-info-box .sa-infobox-figure' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[ 
				'name' => 'img_css_filters',
				'selector' => '{{WRAPPER}} .sa-info-box .sa-infobox-figure',
				'condition' => [ 
					'media_type' => 'image'
				]
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_media_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'icon_color_hover',
			[ 
				'label' => esc_html__( 'Icon Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'condition' => [ 
					'media_type' => 'icon'
				],
				'selectors' => [ 
					'{{WRAPPER}}  > .elementor-widget-container:hover .sa-icon-wrap' => 'color: {{VALUE}}',
					'{{WRAPPER}}  > .elementor-widget-container:hover .sa-icon-wrap svg *' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'img_border_color_hover',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .elementor-widget-container:hover .sa-info-box .sa-infobox-figure' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'img_border_border!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'icon_bg_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'condition' => [ 
					'media_type' => 'icon'
				],
				'selector' => '{{WRAPPER}}  > .elementor-widget-container:hover .sa-icon-wrap',
			]
		);

		$this->add_control(
			'media_opacity_hover',
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
					'{{WRAPPER}} .sa-info-box  .sa-infobox-figure:hover' => 'opacity: {{SIZE}};',
					'{{WRAPPER}}  > .elementor-widget-container:hover .sa-infobox-figure' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[ 
				'name' => 'img_css_filters_hover',
				'selector' => '{{WRAPPER}} .sa-info-box .sa-infobox-figure:hover',
				'condition' => [ 
					'media_type' => 'image'
				]
			]
		);

		$this->add_control(
			'media_transition',
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
					'{{WRAPPER}} .sa-info-box .sa-infobox-figure' => 'transition-duration: {{SIZE}}s',
				],
			]
		);


		$this->add_control(
			'img_hover_animation',
			[ 
				'label' => esc_html__( 'Hover Animation', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
				'condition' => [ 
					'media_type' => 'image'
				],
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
					'desc!' => '',
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
					'{{WRAPPER}} .sa-info-box .sa-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'button_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-info-box .sa-button',
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
					'{{WRAPPER}} .sa-info-box .sa-button' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'button_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-info-box .sa-button',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'button_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-info-box .sa-button',
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-info-box .sa-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'button_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-info-box .sa-button',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'button_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-info-box .sa-button',
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
					'{{WRAPPER}} .sa-info-box .sa-button:hover, {{WRAPPER}} .sa-info-box .sa-button:focus' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'button_background_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-info-box .sa-button:hover, {{WRAPPER}} .sa-info-box .sa-button:focus',
			]
		);

		$this->add_control(
			'button_border_color_hover',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-info-box .sa-button:hover' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .sa-info-box .sa-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'button_text_shadow_hover',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-info-box .sa-button:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'button_box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-info-box .sa-button:hover',
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
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( ! empty( $settings['image']['url'] ) ) {
			$this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
			$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
			$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );

			if ( $settings['img_hover_animation'] ) {
				$settings['hover_animation'] = $settings['img_hover_animation'];
				$this->add_render_attribute( 'image', 'class', 'elementor-animation-' . $settings['hover_animation'] );
			}

			//$image_html = Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image');

			// TODO future
			//			if ( ! empty( $settings['link']['url'] ) ) {
			//				$image_html = '<a ' . $this->get_render_attribute_string( 'link' ) . '>' . $image_html . '</a>';
			//			}
			//			$html .= '<figure class="elementor-image-box-img">' . $image_html . '</figure>';
		}

		// TODO future
		//        if ( $settings[ 'module_link' ] == 'yes' ) :
		//            $this->add_render_attribute('wrapper-link', 'class', 'sa-link sa-info-box-module-link');
		//        endif;
		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'wrapper-link', 'href', esc_url( $settings['link']['url'] ) );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'wrapper-link', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'wrapper-link', 'rel', 'nofollow' );
			}
		} else {
			$this->add_render_attribute( 'wrapper-link', 'href', 'javascript:void(0);' );
		}
		?>

		<div class="sa-info-box">
			<?php
			// TODO future
			//            if ( $settings[ 'module_link' ] == 'yes' ) :
			//                echo '<a ' . $this->get_render_attribute_string('wrapper-link') . ' ></a>';
			//            endif;
			?>
			<?php if ( ! empty( $settings['image']['url'] ) && $settings['media_type'] == 'image' ) : ?>
				<figure class="sa-infobox-figure sa-media-image">
					<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ) ); ?>
				</figure>
			<?php endif; ?>

			<?php if ( ! empty( $settings['icon']['value'] ) && $settings['media_type'] == 'icon' ) : ?>
				<figure class="sa-infobox-figure sa-icon-wrap sa-text-center">
					<?php
					Icons_Manager::render_icon( $settings['icon'], [ 
						'aria-hidden' => 'true',
					] );
					?>
				</figure>
			<?php endif; ?>

			<div class="sa-infobox-body">
				<?php
				if ( ! empty( $settings['desc'] ) ) {
					$desc_exists = '  sa-mb-4';
				} else {
					$desc_exists = '  sa-mb-0';
				}
				if ( ! empty( $settings['title'] ) ) {
					$this->add_render_attribute( 'title', 'class', 'sa-title sa--title sa--text-title sa-mt-0 sa-fs-4' . $desc_exists );
					$this->add_inline_editing_attributes( 'title', 'none' );

					printf(
						'<%1$s %2$s>%3$s</%1$s>',
						esc_attr( Utils::validate_html_tag( $settings['title_tag'] ) ),
						wp_kses_post( $this->get_render_attribute_string( 'title' ) ),
						wp_kses_post( $settings['title'] )
					);
				}

				if ( ! empty( $settings['desc'] ) ) {
					$this->add_render_attribute( 'desc', 'class', 'sa-desc sa--text sa--text-info sa-fs-6' );
					if ( $settings['show_button'] == 'yes' ) {
						$this->add_render_attribute( 'desc', 'class', 'sa-mb-4 sa-button-exists' );
					}

					$this->add_inline_editing_attributes( 'desc', 'none' );

					printf(
						'<div %1$s>%2$s</div>',
						wp_kses_post( $this->get_render_attribute_string( 'desc' ) ),
						wp_kses_post( $settings['desc'] )
					);
				}
				?>

				<?php
				if ( $settings['show_button'] == 'yes' ) :

					$this->add_render_attribute( 'btn-link', 'class', 'sa-button sa-d-inline-flex sa-text-decoration-none sa-align-items-center' );
					$this->add_render_attribute( 'btn-link', 'class', ( $settings['button_full_width'] == 'yes' ) ? ' sa-d-flex' : '' );

					if ( ! empty( $settings['link']['url'] ) ) {
						$this->add_render_attribute( 'btn-link', 'href', esc_url( $settings['link']['url'] ) );

						if ( $settings['link']['is_external'] ) {
							$this->add_render_attribute( 'btn-link', 'target', '_blank' );
						}

						if ( $settings['link']['nofollow'] ) {
							$this->add_render_attribute( 'btn-link', 'rel', 'nofollow' );
						}
					} else {
						$this->add_render_attribute( 'btn-link', 'href', 'javascript:void(0);' );
					}

					if ( $settings['button_hover_animation'] ) {
						$this->add_render_attribute( 'btn-link', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
					}

					if ( ! empty( $settings['button_text'] ) ) :
						$this->add_render_attribute( 'btn-link', 'class', 'sa-button-icon-' . $settings['button_icon_position'] );
					endif;
					?>
					<a <?php $this->print_render_attribute_string( 'btn-link' ); ?>>
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
