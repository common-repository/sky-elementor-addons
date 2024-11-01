<?php

namespace Sky_Addons\Modules\AdvancedSlider\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Sky_Addons\Sky_Addons_Plugin;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Advanced_Slider extends Widget_Base {

	public function get_name() {
		return 'sky-advanced-slider';
	}

	public function get_title() {
		return esc_html__( 'Advanced Slider', 'sky-elementor-addons' );
	}

	public function get_icon() {
		return 'sky-icon-advanced-slider';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'sky', 'slider', 'advanced', 'image', 'photo', 'carousel' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_sliders',
			[ 
				'label' => esc_html__( 'Sliders', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

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
			'sub_title',
			[ 
				'label' => esc_html__( 'Sub Title', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 2,
				'label_block' => true,
				'condition' => [ 'content_source' => 'custom' ]
			]
		);

		$repeater->add_control(
			'title',
			[ 
				'label' => esc_html__( 'Title', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'rows' => 2,
				'default' => esc_html__( 'Slide Title', 'sky-elementor-addons' ),
				'label_block' => true,
				'condition' => [ 'content_source' => 'custom' ]
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
			'slider_image',
			[ 
				'label' => esc_html__( 'Image', 'sky-elementor-addons' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [ 'active' => true ],
				'condition' => [ 'content_source' => 'custom' ]
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

		$this->add_control(
			'slider_list',
			[ 
				'label' => '',
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [ 
					[ 
						'title' => esc_html__( 'Slide Title #1', 'sky-elementor-addons' ),
						'custom_text' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sky-elementor-addons' ),
					],
					[ 
						'title' => esc_html__( 'Slide Title #2', 'sky-elementor-addons' ),
						'custom_text' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sky-elementor-addons' ),
					],
					[ 
						'title' => esc_html__( 'Slide Title #3', 'sky-elementor-addons' ),
						'custom_text' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sky-elementor-addons' ),
					],
					[ 
						'title' => esc_html__( 'Slide Title #4', 'sky-elementor-addons' ),
						'custom_text' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'sky-elementor-addons' ),
					],
				],
				'title_field' => '{{{ title }}}',
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

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_layout',
			[ 
				'label' => esc_html__( 'Slider Layout', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'height',
			[ 
				'label' => esc_html__( 'Slider Height', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%', 'vh' ],
				'range' => [ 
					'px' => [ 
						'min' => 200,
						'max' => 1000,
					],
					'%' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .swiper' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_position',
			[ 
				'label' => esc_html__( 'Content Position', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'label_block' => false,
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
				//                'toggle'               => false,
				'default' => 'middle-center',
				//                'desktop_default'       => 'middle-center',
				//                'tablet_default'       => 'middle-center',
				//                'mobile_default'       => 'middle-center',
				//                'prefix_class'         => 'sa-slider-%s-',
				'style_transfer' => true,
				'selectors' => [ 
					'{{WRAPPER}} .sa-advanced-slider .sa-slider-content-wrapper' => '{{VALUE}};',
				],
				'selectors_dictionary' => [ 
					'top-left' => 'top: 0%; left: 0; transform: translate(0%, 0%); bottom: unset;',
					'top-center' => 'top: 0; left: 50%; transform: translate(-50%, 0%); bottom: unset;',
					'top-right' => 'top: 0%; right: 0; transform: translate(0%, 0%); bottom: unset;',
					'middle-left' => 'top: 50%; left: 0; transform: translate(0,-50%); bottom: unset;',
					'middle-center' => 'top: 50%; left: 50%; transform: translate(-50%, -50%); bottom: unset;',
					'middle-right' => 'top: 50%; right: 0; transform: translate(0,-50%); bottom: unset;',
					'bottom-left' => 'bottom: 0%; left: 0%; transform: translate(0%, 0%); top: unset;',
					'bottom-center' => 'bottom: 0%; left: 50%; transform: translate(-50%, 0%); top: unset;',
					'bottom-right' => 'bottom: 0%; right: 0%; transform: translate(0%, 0%); top: unset;',
				]
			]
		);

		$this->add_control(
			'text_effect',
			[ 
				'label' => esc_html__( 'Text Effects', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [ 
					'none' => esc_html__( 'None', 'sky-elementor-addons' ),
					'default' => esc_html__( 'Right To Left', 'sky-elementor-addons' ),
					'l-to-r' => esc_html__( 'Left To Right', 'sky-elementor-addons' ),
					't-to-b' => esc_html__( 'Top To Bottom', 'sky-elementor-addons' ),
					'b-to-t' => esc_html__( 'Bottom To Top', 'sky-elementor-addons' ),
				],
				'prefix_class' => 'sa-slider-text-effect-',
			]
		);

		$this->add_control(
			'link_on',
			[ 
				'label' => esc_html__( 'Link On', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => [ 
					'title' => esc_html__( 'Title', 'sky-elementor-addons' ),
					'item' => esc_html__( 'Item', 'sky-elementor-addons' ),
				],
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
			'show_title',
			[ 
				'label' => esc_html__( 'Show Title', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_tag',
			[ 
				'label' => esc_html__( 'Title HTML Tag', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => sky_title_tags(),
				'condition' => [ 
					'show_title' => 'yes'
				]
			]
		);

		$this->add_control(
			'show_sub_title',
			[ 
				'label' => esc_html__( 'Show Sub Title', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'sub_title_tag',
			[ 
				'label' => esc_html__( 'Sub Title HTML Tag', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h5',
				'options' => sky_title_tags(),
				'condition' => [ 
					'show_sub_title' => 'yes'
				]
			]
		);

		$this->add_control(
			'show_text',
			[ 
				'label' => esc_html__( 'Show Text', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
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

		$this->add_control(
			'show_navigation',
			[ 
				'label' => esc_html__( 'Show Navigation', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_pagination',
			[ 
				'label' => esc_html__( 'Show Pagination', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_settings',
			[ 
				'label' => esc_html__( 'Settings', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'direction',
			[ 
				'label' => esc_html__( 'Direction', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [ 
					'horizontal' => esc_html__( 'Horizontal', 'sky-elementor-addons' ),
					'vertical' => esc_html__( 'Vertical', 'sky-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'transition_effect',
			[ 
				'label' => esc_html__( 'Transition Effect', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [ 
					'slide' => esc_html__( 'Slide', 'sky-elementor-addons' ),
					'fade' => esc_html__( 'Fade', 'sky-elementor-addons' ),
					'flip' => esc_html__( 'Flip', 'sky-elementor-addons' ),
					'cube' => esc_html__( 'Cube', 'sky-elementor-addons' ),
					'coverflow' => esc_html__( 'Coverflow', 'sky-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'cross_fade',
			[ 
				'label' => esc_html__( 'Cross Fade', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [ 
					'transition_effect' => 'fade',
				],
			]
		);

		$this->add_control(
			'coverflow_rotate',
			[ 
				'label' => esc_html__( 'Rotate', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [ 
					'unit' => 'px',
					'size' => 30,
				],
				'condition' => [ 
					'transition_effect' => 'coverflow',
				],
			]
		);

		$this->add_control(
			'slide_shadows',
			[ 
				'label' => esc_html__( 'Slide Shadows', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [ 
					'transition_effect' => [ 'coverflow', 'flip', 'cube' ],
				],
			]
		);

		$this->add_control(
			'autoplay',
			[ 
				'label' => esc_html__( 'Autoplay', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[ 
				'label' => esc_html__( 'Autoplay Speed (sec)', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 10,
						'step' => .5,
					],
				],
				'default' => [ 
					'unit' => 'px',
					'size' => 5,
				],
				'condition' => [ 
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'loop',
			[ 
				'label' => esc_html__( 'Loop', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'speed',
			[ 
				'label' => esc_html__( 'Slide Speed (sec)', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 10,
						'step' => .5,
					],
				],
				'default' => [ 
					'unit' => 'px',
					'size' => .3,
				],
			]
		);

		$this->add_control(
			'pause_on_hover',
			[ 
				'label' => esc_html__( 'Pause On Hover', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [ 
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'observer',
			[ 
				'label' => esc_html__( 'Observer', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
				'description' => esc_html__( 'Note: Please use it when you using slider on a hidden element.', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'hash_navigation',
			[ 
				'label' => esc_html__( 'Hash Navigation', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
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

		$this->start_controls_section(
			'section_navigation',
			[ 
				'label' => esc_html__( 'Navigation', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [ 'show_navigation' => 'yes' ]
			]
		);

		$this->add_control(
			'prev_icon',
			[ 
				'label' => esc_html__( 'Prev Icon', 'sky-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'next_icon',
			[ 
				'label' => esc_html__( 'Next Icon', 'sky-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_pagination',
			[ 
				'label' => esc_html__( 'Pagination', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [ 'show_pagination' => 'yes' ]
			]
		);

		$this->add_control(
			'pagination_type',
			[ 
				'label' => esc_html__( 'Pagination Type', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'bullets',
				'options' => [ 
					'none' => esc_html__( 'None', 'sky-elementor-addons' ),
					'bullets' => esc_html__( 'Bullets', 'sky-elementor-addons' ),
					'fraction' => esc_html__( 'Fraction', 'sky-elementor-addons' ),
					'progressbar' => esc_html__( 'Progress Bar', 'sky-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'dynamic_bullets',
			[ 
				'label' => esc_html__( 'Dynamic Bullets', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [ 'pagination_type' => 'bullets' ]
			]
		);

		$this->add_control(
			'progressbar_position',
			[ 
				'label' => esc_html__( 'Progress Bar Position', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'bottom',
				'options' => [ 
					'bottom' => esc_html__( 'Bottom', 'sky-elementor-addons' ),
					'top' => esc_html__( 'Top', 'sky-elementor-addons' ),
				],
				'selectors' => [ 
					'{{WRAPPER}} .swiper-horizontal > .swiper-pagination-progressbar' => '{{VALUE}}',
				],
				'selectors_dictionary' => [ 
					'bottom' => '',
					'top' => 'top: 0; bottom: unset;',
				],
				'condition' => [ 
					'pagination_type' => 'progressbar',
					'direction' => 'horizontal'
				]
			]
		);

		$this->add_control(
			'progressbar_position_vertical',
			[ 
				'label' => esc_html__( 'Progress Bar Position', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [ 
					'left' => esc_html__( 'Left', 'sky-elementor-addons' ),
					'right' => esc_html__( 'Right', 'sky-elementor-addons' ),
				],
				'selectors' => [ 
					'{{WRAPPER}} .swiper-vertical > .swiper-pagination-progressbar' => '{{VALUE}}',
				],
				'selectors_dictionary' => [ 
					'left' => '',
					'right' => 'right: 0; left: unset;',
				],
				'condition' => [ 
					'pagination_type' => 'progressbar',
					'direction' => 'vertical'
				]
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_sliders_style',
			[ 
				'label' => esc_html__( 'Sliders', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'sliders_bg',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'fields_options' => [ 
					'background' => [ 
						'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
						'default' => 'classic',
					],
					'color' => [ 
						'default' => '#8441A4',
					],
				],
				'selector' => '{{WRAPPER}} .swiper-slide',
			]
		);

		/**
		 * Not able to delete, because used many times
		 */
		$this->add_control(
			'sliders_bg_overlay',
			[ 
				'label' => esc_html__( 'Background Overlay', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .swiper-slide:before' => 'background: {{VALUE}}; z-index: 1;',
					'{{WRAPPER}} .sa-advanced-slider .sa-slider-content-wrapper' => 'z-index: 2;',
				],
			]
		);

		/**
		 * Added late
		 */

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'sliders_adv_bg_overlay',
				'label' => esc_html__( 'Advanced Overlay', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'fields_options' => [ 
					'background' => [ 
						'label' => esc_html__( 'Advanced Overlay', 'sky-elementor-addons' ),
					],
				],
				'selector' => '{{WRAPPER}} .swiper-slide:before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'sliders_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .swiper-slide',
			]
		);

		$this->add_responsive_control(
			'sliders_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .swiper-slide' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();


		$this->start_controls_section(
			'section_content_box',
			[ 
				'label' => esc_html__( 'Content Box', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// $this->add_responsive_control(
		//     'content_wrapper_width',
		//     [
		//         'label'     => esc_html__('Box Width (%)', 'sky-elementor-addons'),
		//         'type'      => Controls_Manager::SLIDER,
		//         'range'     => [
		//             'px' => [
		//                 'min' => 50,
		//                 'max' => 100,
		//             ],
		//         ],
		//         'selectors' => [
		//             '{{WRAPPER}} .sa-slider-content-wrapper' => 'width: {{SIZE}}%;',
		//         ],
		//     ]
		// );

		$this->add_responsive_control(
			'content_wrapper_width',
			[ 
				'label' => esc_html__( 'Box Width (% is Perfect)', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [ 
					'px' => [ 
						'min' => 500,
						'max' => 1300,
					],
					'%' => [ 
						'min' => 50,
						'max' => 100,
					],
				],
				'default' => [ 
					'unit' => '%',
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-slider-content-wrapper' => 'width: {{SIZE}}{{UNIT}};',
				],
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
					'{{WRAPPER}} .sa-slider-content-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'content_wrapper_bg',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-slider-content-wrapper',
			]
		);

		$this->add_responsive_control(
			'content_wrapper_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-slider-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_wrapper_margin',
			[ 
				'label' => esc_html__( 'Margin', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-slider-content-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'content_wrapper_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-slider-content-wrapper',
			]
		);

		$this->add_responsive_control(
			'content_wrapper_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-slider-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_image_style',
			[ 
				'label' => esc_html__( 'Slider Image', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'img_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-slider-img-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'img_tabs' );

		$this->start_controls_tab(
			'img_tab_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_responsive_control(
			'img_opacity',
			[ 
				'label' => esc_html__( 'Image Opacity', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 1,
						'step' => .1,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-advanced-slider .sa-slider-img-wrapper img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[ 
				'name' => 'img_css_filters',
				'selector' => '{{WRAPPER}} .sa-advanced-slider .sa-slider-img-wrapper img',
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'img_tab_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);


		$this->add_responsive_control(
			'img_opacity_hover',
			[ 
				'label' => esc_html__( 'Image Opacity', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 1,
						'step' => .1,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-advanced-slider .sa-slider-img-wrapper:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[ 
				'name' => 'img_css_filters_hover',
				'selector' => '{{WRAPPER}} .sa-advanced-slider .sa-slider-img-wrapper:hover img',
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
			'section_title_style',
			[ 
				'label' => esc_html__( 'Title', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_title' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[ 
				'name' => 'title_text_stroke',
				'selector' => '{{WRAPPER}} .sa-title',
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

		$this->add_control(
			'title_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-title, {{WRAPPER}} .sa-title *' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'title_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
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

		$this->add_responsive_control(
			'title_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'title_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_sub_title_style',
			[ 
				'label' => esc_html__( 'Sub Title', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_sub_title' => 'yes'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[ 
				'name' => 'sub_title_text_stroke',
				'selector' => '{{WRAPPER}} .sa-sub-title',
			]
		);

		$this->add_responsive_control(
			'sub_title_spacing',
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

		$this->add_control(
			'sub_title_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-sub-title, {{WRAPPER}} .sa-sub-title *' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'sub_title_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-sub-title',
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

		$this->add_responsive_control(
			'sub_title_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'sub_title_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-sub-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			[ 
				'label' => esc_html__( 'Text', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_text' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'text_spacing',
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
					'{{WRAPPER}} .sa-content + .sa-link-wrapper' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'text_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-content',
			]
		);

		$this->add_control(
			'text_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-content, {{WRAPPER}} .sa-content *' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'text_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-content',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'text_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-content',
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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

		// $this->start_controls_section(
		//     'section_navigation_style',
		//     [
		//         'label'     => esc_html__('Navigation', 'sky-elementor-addons'),
		//         'tab'       => Controls_Manager::TAB_STYLE,
		//         'condition' => [
		//             'show_navigation' => 'yes'
		//         ]
		//     ]
		// );

		// $this->add_responsive_control(
		//     'navigation_size',
		//     [
		//         'label'      => esc_html__('Size', 'sky-elementor-addons'),
		//         'type'       => Controls_Manager::SLIDER,
		//         'size_units' => ['px', 'em'],
		//         'range'      => [
		//             'px' => [
		//                 'min' => 5,
		//                 'max' => 50,
		//             ],
		//         ],
		//         'selectors'  => [
		//             '{{WRAPPER}} ' => '--sa-navigation-size: {{SIZE}}{{UNIT}};',
		//         ],
		//     ]
		// );

		// $this->add_responsive_control(
		//     'navigation_spacing',
		//     [
		//         'label'      => esc_html__('Spacing', 'sky-elementor-addons'),
		//         'type'       => Controls_Manager::SLIDER,
		//         'size_units' => ['px', 'em'],
		//         'range'      => [
		//             'px' => [
		//                 'min' => 10,
		//                 'max' => 100,
		//             ],
		//         ],
		//         'selectors'  => [
		//             '{{WRAPPER}} ' => '--sa-navigation-spacing: {{SIZE}}{{UNIT}};',
		//         ],
		//     ]
		// );

		// $this->add_responsive_control(
		//     'navigation_padding',
		//     [
		//         'label'      => esc_html__('Padding', 'sky-elementor-addons'),
		//         'type'       => Controls_Manager::DIMENSIONS,
		//         'size_units' => ['px', 'em', '%'],
		//         'selectors'  => [
		//             '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		//         ],
		//     ]
		// );

		// $this->add_group_control(
		//     Group_Control_Border::get_type(),
		//     [
		//         'name'     => 'navigation_border',
		//         'label'    => esc_html__('Border', 'sky-elementor-addons'),
		//         'selector' => '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next',
		//     ]
		// );

		// $this->add_responsive_control(
		//     'navigation_border_radius',
		//     [
		//         'label'      => esc_html__('Border Radius', 'sky-elementor-addons'),
		//         'type'       => Controls_Manager::DIMENSIONS,
		//         'size_units' => ['px', 'em', '%'],
		//         'selectors'  => [
		//             '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		//         ],
		//     ]
		// );


		// $this->start_controls_tabs('navigation_tabs');

		// $this->start_controls_tab(
		//     'navigation_tab_normal',
		//     [
		//         'label' => esc_html__('Normal', 'sky-elementor-addons'),
		//     ]
		// );

		// $this->add_control(
		//     'navigation_color',
		//     [
		//         'label'     => esc_html__('Color', 'sky-elementor-addons'),
		//         'type'      => Controls_Manager::COLOR,
		//         'selectors' => [
		//             '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next'             => 'color: {{VALUE}}',
		//             '{{WRAPPER}} .sa-swiper-button-prev svg *, {{WRAPPER}} .sa-swiper-button-next svg *' => 'fill: {{VALUE}}',
		//         ],
		//     ]
		// );

		// $this->add_group_control(
		//     Group_Control_Background::get_type(),
		//     [
		//         'name'     => 'navigation_bg',
		//         'label'    => esc_html__('Background', 'sky-elementor-addons'),
		//         'types'    => ['classic', 'gradient'],
		//         'selector' => '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next',
		//     ]
		// );

		// $this->add_group_control(
		//     Group_Control_Text_Shadow::get_type(),
		//     [
		//         'name'     => 'navigation_text_shadow',
		//         'label'    => esc_html__('Text Shadow', 'sky-elementor-addons'),
		//         'selector' => '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next',
		//     ]
		// );

		// $this->add_group_control(
		//     Group_Control_Box_Shadow::get_type(),
		//     [
		//         'name'     => 'navigation_box_shadow',
		//         'label'    => esc_html__('Box Shadow', 'sky-elementor-addons'),
		//         'selector' => '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next',
		//     ]
		// );

		// $this->end_controls_tab();

		// $this->start_controls_tab(
		//     'navigation_tab_hover',
		//     [
		//         'label' => esc_html__('Hover', 'sky-elementor-addons'),
		//     ]
		// );

		// $this->add_control(
		//     'navigation_color_hover',
		//     [
		//         'label'     => esc_html__('Color', 'sky-elementor-addons'),
		//         'type'      => Controls_Manager::COLOR,
		//         'selectors' => [
		//             '{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover'             => 'color: {{VALUE}}',
		//             '{{WRAPPER}} .sa-swiper-button-prev:hover svg *, {{WRAPPER}} .sa-swiper-button-next:hover svg *' => 'fill: {{VALUE}}',
		//         ],
		//     ]
		// );

		// $this->add_group_control(
		//     Group_Control_Background::get_type(),
		//     [
		//         'name'     => 'navigation_bg_hover',
		//         'label'    => esc_html__('Background', 'sky-elementor-addons'),
		//         'types'    => ['classic', 'gradient'],
		//         'selector' => '{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover',
		//     ]
		// );

		// $this->add_control(
		//     'navigation_border_color_hover',
		//     [
		//         'label'     => esc_html__('Border Color', 'sky-elementor-addons'),
		//         'type'      => Controls_Manager::COLOR,
		//         'selectors' => [
		//             '{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover' => 'border-color: {{VALUE}};',
		//         ],
		//         'condition' => [
		//             'navigation_border_border!' => '',
		//         ],
		//     ]
		// );

		// $this->add_group_control(
		//     Group_Control_Text_Shadow::get_type(),
		//     [
		//         'name'     => 'navigation_text_shadow_hover',
		//         'label'    => esc_html__('Text Shadow', 'sky-elementor-addons'),
		//         'selector' => '{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover',
		//     ]
		// );

		// $this->add_group_control(
		//     Group_Control_Box_Shadow::get_type(),
		//     [
		//         'name'     => 'navigation_box_shadow_hover',
		//         'label'    => esc_html__('Box Shadow', 'sky-elementor-addons'),
		//         'selector' => '{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover',
		//     ]
		// );

		// $this->end_controls_tab();

		// $this->end_controls_tabs();

		// $this->end_controls_section();


		$this->start_controls_section(
			'section_navigation_style',
			[ 
				'label' => esc_html__( 'Navigation', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_navigation' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'navigation_bottom_spacing',
			[ 
				'label' => esc_html__( 'Bottom Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-navigation-wrapper' => 'bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'navigation_size',
			[ 
				'label' => esc_html__( 'Size', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 5,
						'max' => 50,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} ' => '--sa-navigation-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'navigation_spacing',
			[ 
				'label' => esc_html__( 'Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} ' => '--sa-navigation-spacing: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'navigation_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'navigation_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next',
			]
		);

		$this->start_controls_tabs( 'navigation_tabs' );

		$this->start_controls_tab(
			'navigation_tab_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'navigation_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next' => 'color: {{VALUE}}',
					'{{WRAPPER}} .sa-swiper-button-prev svg *, {{WRAPPER}} .sa-swiper-button-next svg *' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'navigation_bg',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'navigation_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'navigation_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next',
			]
		);

		$this->add_responsive_control(
			'navigation_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'navigation_tab_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'navigation_color_hover',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .sa-swiper-button-prev:hover svg *, {{WRAPPER}} .sa-swiper-button-next:hover svg *' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'navigation_bg_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover',
			]
		);

		$this->add_control(
			'navigation_border_color_hover',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'navigation_border_border!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'navigation_text_shadow_hover',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'navigation_box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover',
			]
		);

		$this->add_responsive_control(
			'navigation_border_radius_hover',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// $this->start_controls_section(
		//     'section_pagination_style',
		//     [
		//         'label'     => esc_html__('Pagination', 'sky-elementor-addons'),
		//         'tab'       => Controls_Manager::TAB_STYLE,
		//         'condition' => [
		//             'show_pagination' => 'yes'
		//         ]
		//     ]
		// );

		// $this->add_responsive_control(
		//     'pagination_bottom_spacing',
		//     [
		//         'label' => esc_html__('Bottom Spacing', 'sky-elementor-addons'),
		//         'type'  => Controls_Manager::SLIDER,
		//         'range' => [
		//             'px' => [
		//                 'min' => 0,
		//                 'max' => 100,
		//             ],
		//         ],
		//         'selectors'      => [
		//             '{{WRAPPER}} .swiper-pagination-fraction, .swiper-pagination-custom, {{WRAPPER}} .swiper-horizontal > .swiper-pagination-bullets' => 'bottom: {{SIZE}}{{UNIT}};'
		//         ],
		//     ]
		// );

		// $this->add_responsive_control(
		//     'bullet_size',
		//     [
		//         'label'      => esc_html__('Bullet Size', 'sky-elementor-addons'),
		//         'type'       => Controls_Manager::SLIDER,
		//         'size_units' => ['px', 'em'],
		//         'range'      => [
		//             'px' => [
		//                 'min'  => 8,
		//                 'max'  => 15,
		//                 'step' => .5,
		//             ],
		//         ],
		//         'selectors'  => [
		//             '{{WRAPPER}}' => '--sa-pagination-bullet-size: {{SIZE}}{{UNIT}};',
		//         ],
		//         'condition' => ['pagination_type' => 'bullets']
		//     ]
		// );

		// $this->add_responsive_control(
		//     'bullet_spacing',
		//     [
		//         'label'      => esc_html__('Bullet Spacing', 'sky-elementor-addons'),
		//         'type'       => Controls_Manager::SLIDER,
		//         'size_units' => ['px', 'em'],
		//         'range'      => [
		//             'px' => [
		//                 'min'  => 4,
		//                 'max'  => 20,
		//                 'step' => .5,
		//             ],
		//         ],
		//         'selectors'  => [
		//             '{{WRAPPER}} .swiper-pagination-bullets .swiper-pagination-bullet' => 'margin: 0px {{SIZE}}{{UNIT}};',
		//         ],
		//         'condition' => ['pagination_type' => 'bullets']
		//     ]
		// );


		// $this->add_responsive_control(
		//     'pagination_progress_size',
		//     [
		//         'label'      => esc_html__('Progress Size', 'sky-elementor-addons'),
		//         'type'       => Controls_Manager::SLIDER,
		//         'size_units' => ['px', 'em'],
		//         'range'      => [
		//             'px' => [
		//                 'min'  => 1,
		//                 'max'  => 10,
		//                 'step' => .5,
		//             ],
		//         ],
		//         'selectors'  => [
		//             '{{WRAPPER}}' => '--sa-pagination-progress-size: {{SIZE}}{{UNIT}};',
		//         ],
		//         'condition' => ['pagination_type' => 'progressbar']
		//     ]
		// );

		// $this->add_responsive_control(
		//     'bullet_radius',
		//     [
		//         'label'      => esc_html__('Bullet Radius(%)', 'sky-elementor-addons'),
		//         'type'       => Controls_Manager::SLIDER,
		//         'size_units' => ['%'],
		//         'range'      => [
		//             '%' => [
		//                 'min' => 0,
		//                 'max' => 100,
		//             ],
		//         ],
		//         'selectors'  => [
		//             '{{WRAPPER}}' => '--sa-pagination-bullet-radius: {{SIZE}}%;',
		//         ],
		//         'condition' => ['pagination_type' => 'bullets']
		//     ]
		// );

		// $this->add_control(
		//     'pagination_color',
		//     [
		//         'label'     => esc_html__('Pagination Color', 'sky-elementor-addons'),
		//         'type'      => Controls_Manager::COLOR,
		//         'selectors' => [
		//             '{{WRAPPER}}' => '--sa-pagination-color: {{VALUE}}',
		//         ],
		//     ]
		// );

		// $this->add_control(
		//     'pagination_active_color',
		//     [
		//         'label'     => esc_html__('Pagination Active Color', 'sky-elementor-addons'),
		//         'type'      => Controls_Manager::COLOR,
		//         'selectors' => [
		//             '{{WRAPPER}}' => '--sa-pagination-active-color: {{VALUE}}',
		//         ],
		//     ]
		// );

		// $this->add_group_control(
		//     Group_Control_Typography::get_type(),
		//     [
		//         'name'      => 'pagination_fraction_typography',
		//         'label'     => esc_html__('Typography', 'sky-elementor-addons'),
		//         'selector'  => '{{WRAPPER}} .swiper-pagination-fraction',
		//         'condition' => ['pagination_type' => 'fraction']
		//     ]
		// );

		// $this->start_controls_tabs(
		//     'style_pagination_tabs'
		// );

		// $this->start_controls_tab(
		//     'style_pagination_normal_tab',
		//     [
		//         'label' => esc_html__('Normal', 'sky-elementor-addons'),
		//     ]
		// );

		// $this->add_group_control(
		//     Group_Control_Border::get_type(),
		//     [
		//         'name'      => 'pagination_border',
		//         'label'     => esc_html__('Border', 'sky-elementor-addons'),
		//         'selector'  => '{{WRAPPER}} .swiper-pagination-bullet',
		//         'condition' => ['pagination_type' => 'bullets'],
		//     ]
		// );

		// $this->add_responsive_control(
		//     'pagination_border_radius',
		//     [
		//         'label'      => esc_html__('Border Radius', 'sky-elementor-addons'),
		//         'type'       => Controls_Manager::DIMENSIONS,
		//         'size_units' => ['px', 'em', '%'],
		//         'selectors'  => [
		//             '{{WRAPPER}} .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		//         ],
		//         'condition' => ['pagination_type' => 'bullets'],
		//     ]
		// );

		// $this->end_controls_tab();

		// $this->start_controls_tab(
		//     'style_pagination_active_tab',
		//     [
		//         'label' => esc_html__('Active', 'sky-elementor-addons'),
		//     ]
		// );

		// $this->add_group_control(
		//     Group_Control_Border::get_type(),
		//     [
		//         'name'      => 'pagination_border_active',
		//         'label'     => esc_html__('Border', 'sky-elementor-addons'),
		//         'selector'  => '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active',
		//         'condition' => ['pagination_type' => 'bullets'],
		//     ]
		// );

		// $this->add_responsive_control(
		//     'pagination_border_radius_active',
		//     [
		//         'label'      => esc_html__('Border Radius', 'sky-elementor-addons'),
		//         'type'       => Controls_Manager::DIMENSIONS,
		//         'size_units' => ['px', 'em', '%'],
		//         'selectors'  => [
		//             '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		//         ],
		//         'condition' => ['pagination_type' => 'bullets'],
		//     ]
		// );

		// $this->end_controls_tab();

		// $this->end_controls_tabs();

		// $this->end_controls_section();

		$this->start_controls_section(
			'section_pagination_style',
			[ 
				'label' => esc_html__( 'Pagination', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_pagination' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'pagination_bottom_spacing',
			[ 
				'label' => esc_html__( 'Bottom Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .swiper-pagination-fraction, .swiper-pagination-custom, .swiper-pagination-progressbar, {{WRAPPER}} .swiper-horizontal > .swiper-pagination-bullets' => 'bottom: {{SIZE}}{{UNIT}} !important;'
				],
			]
		);

		$this->add_responsive_control(
			'bullet_size',
			[ 
				'label' => esc_html__( 'Bullet Height', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 1,
						'max' => 50,
						'step' => .5,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}}' => '--sa-pagination-bullet-height: {{SIZE}}{{UNIT}};',
					// '{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};', // for fix old issue
				],
				'condition' => [ 'pagination_type' => 'bullets' ]
			]
		);

		$this->add_responsive_control(
			'bullet_width',
			[ 
				'label' => esc_html__( 'Bullet Width', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 1,
						'max' => 50,
						'step' => .5,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}}' => '--sa-pagination-bullet-width: {{SIZE}}{{UNIT}};',
					// '{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}} !important;', // for fix old issue
				],
				'condition' => [ 'pagination_type' => 'bullets' ]
			]
		);

		$this->add_responsive_control(
			'bullet_spacing',
			[ 
				'label' => esc_html__( 'Bullet Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 4,
						'max' => 20,
						'step' => .5,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .swiper-pagination-bullets .swiper-pagination-bullet' => 'margin: 0px {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'pagination_type' => 'bullets' ]
			]
		);

		$this->start_controls_tabs(
			'style_pagination_tabs'
		);

		$this->start_controls_tab(
			'style_pagination_normal_tab',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'fraction_color',
			[ 
				'label' => esc_html__( 'Pagination Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ddd',
				'selectors' => [ 
					'{{WRAPPER}} .swiper-pagination.swiper-pagination-fraction' => 'color: {{VALUE}}',
				],
				'condition' => [ 
					'pagination_type' => 'fraction'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'pagination_fraction_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .swiper-pagination-fraction',
				'condition' => [ 'pagination_type' => 'fraction' ]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'pagination_color',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'fields_options' => [ 
					'background' => [ 
						'label' => esc_html__( 'Pagination Color', 'sky-elementor-addons' ),
					],
				],
				'selector' => '{{WRAPPER}} .swiper-pagination-bullet, {{WRAPPER}} .swiper-pagination-progressbar',
				'conditions' => [ 
					'relation' => 'or',
					'terms' => [ 
						[ 'name' => 'pagination_type', 'operator' => '===', 'value' => 'bullets' ],
						[ 'name' => 'pagination_type', 'operator' => '===', 'value' => 'progressbar' ],
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'pagination_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .swiper-pagination-bullet',
				'condition' => [ 'pagination_type' => 'bullets' ],
				// 'fields_options' => [
				//     'border' => [
				//         'default' => 'solid',
				//     ],
				//     'width' => [
				//         'default' => [
				//             'top'      => '8',
				//             'right'    => '8',
				//             'bottom'   => '8',
				//             'left'     => '8',
				//             'unit'     => 'px',
				//             'isLinked' => false,
				//         ],
				//     ],
				//     'color' => [
				//         'default' => '#0A0A0AC4',
				//     ],
				// ],
			]
		);

		$this->add_responsive_control(
			'pagination_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'pagination_type' => 'bullets' ],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_pagination_active_tab',
			[ 
				'label' => esc_html__( 'Active', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'fraction_active_color',
			[ 
				'label' => esc_html__( 'Pagination Active Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [ 
					'{{WRAPPER}} .swiper-pagination-fraction .swiper-pagination-current' => 'color: {{VALUE}}',
				],
				'condition' => [ 'pagination_type' => 'fraction' ]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'pagination_fraction_typography_active',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .swiper-pagination-fraction .swiper-pagination-current',
				'condition' => [ 'pagination_type' => 'fraction' ]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'pagination_active_color',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'fields_options' => [ 
					'background' => [ 
						'label' => esc_html__( 'Pagination Active Color', 'sky-elementor-addons' ),
					],
				],
				'selector' => '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active, {{WRAPPER}} .swiper-pagination-progressbar-fill',
				'conditions' => [ 
					'relation' => 'or',
					'terms' => [ 
						[ 'name' => 'pagination_type', 'operator' => '===', 'value' => 'bullets' ],
						[ 'name' => 'pagination_type', 'operator' => '===', 'value' => 'progressbar' ],
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'pagination_border_active',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active',
				'condition' => [ 'pagination_type' => 'bullets' ],
				// 'fields_options' => [
				//     'border' => [
				//         'default' => 'solid',
				//     ],
				//     'width' => [
				//         'default' => [
				//             'top'      => '6',
				//             'right'    => '6',
				//             'bottom'   => '6',
				//             'left'     => '6',
				//             'unit'     => 'px',
				//             'isLinked' => false,
				//         ],
				//     ],
				//     'color' => [
				//         'default' => '#fff',
				//     ],
				// ],
			]
		);

		$this->add_responsive_control(
			'pagination_border_radius_active',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'pagination_type' => 'bullets' ],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render_title( array $item ) {
		$settings = $this->get_settings_for_display();
		$title_link = false;
		if ( ! empty( $settings['link_on'] ) ) {
			if ( in_array( "title", $settings['link_on'] ) ) {
				$title_link = true;
			}
		}

		$title_tag = Utils::validate_html_tag( $settings['title_tag'] );
		$title_content = $item['title'];

		if ( $title_link === true && isset( $item['link']['url'] ) && ! empty( $item['link']['url'] ) ) :
			$this->add_render_attribute( 'title-link-attr', 'href', esc_url( $item['link']['url'] ), true );

			if ( $item['link']['is_external'] ) {
				$this->add_render_attribute( 'title-link-attr', 'target', '_blank', true );
			}

			if ( $item['link']['nofollow'] ) {
				$this->add_render_attribute( 'title-link-attr', 'rel', 'nofollow', true );
			}
			$title_content = '<a ' . $this->get_render_attribute_string( 'title-link-attr' ) . '>' . $title_content . '</a>';
		endif;
		printf(
			'<%1$s class="sa--title sa-title sa-mt-0 sa-mb-3">%2$s</%1$s>',
			esc_attr( Utils::validate_html_tag( $settings['title_tag'] ) ),
			wp_kses_post( $title_content )
		);
	}

	protected function render_sub_title( array $item ) {
		$settings = $this->get_settings_for_display();

		printf( '<%1$s class="sa--title sa-sub-title sa-mt-0 sa-mb-2">%2$s</%1$s>',
			esc_attr( Utils::validate_html_tag( $settings['sub_title_tag'] ) ),
			wp_kses_post( $item['sub_title'] )
		);
	}

	protected function render_button( $link ) {
		$settings = $this->get_settings_for_display();


		if ( $settings['show_button'] == 'yes' ) :

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
		endif;
	}

	protected function render_pagination() {
		?>
		<!-- If we need pagination -->
		<div class="swiper-pagination"></div>
		<?php
	}

	protected function render_navigation() {
		$settings = $this->get_settings_for_display();
		?>
		<!-- If we need navigation buttons -->
		<div class="sa-swiper-button-prev sa-slider-navigation sa-icon-wrap">
			<?php
			if ( ! empty( $settings['prev_icon']['value'] ) ) :
				Icons_Manager::render_icon( $settings['prev_icon'], [ 
					'aria-hidden' => 'true',
					'class' => 'fa-fw'
				] );
			else :
				?>
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 44">
					<path d="M0,22L22,0l2.1,2.1L4.2,22l19.9,19.9L22,44L0,22L0,22L0,22z">
				</svg>
				<?php
			endif;
			?>

		</div>
		<div class="sa-swiper-button-next sa-slider-navigation sa-icon-wrap">
			<?php
			if ( ! empty( $settings['next_icon']['value'] ) ) :
				Icons_Manager::render_icon( $settings['next_icon'], [ 
					'aria-hidden' => 'true',
					'class' => 'fa-fw'
				] );
			else :
				?>
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 44">
					<path d="M27,22L27,22L5,44l-2.1-2.1L22.8,22L2.9,2.1L5,0L27,22L27,22z">
				</svg>
				<?php
			endif;
			?>
		</div>
		<?php
	}

	protected function render_scrollbar() {
		?>
		<!-- If we need scrollbar -->
		<!--<div class="swiper-scrollbar"></div>-->
		<?php
	}

	protected function render_header() {
		$settings = $this->get_settings_for_display();
		$id = 'sa-' . $this->get_id();
		$this->add_render_attribute(
			[ 
				'slider' => [ 
					'class' => 'sa-advanced-slider',
					'id' => $id,
					'data-settings' => [ 
						wp_json_encode( array_filter( [ 
							'direction' => $settings["direction"],
							'autoplay' => $settings["autoplay"] == 'yes' ? [ 
								"delay" => $settings["autoplay_speed"]['size'] * 1000
							] : false,
							'loop' => ( $settings['loop'] == 'yes' ) ? true : false,
							'speed' => ( ! empty( $settings['speed']['size'] ) ) ? $settings['speed']['size'] * 1000 : 300,
							'pauseOnHover' => ( $settings["autoplay"] == 'yes' && $settings["pause_on_hover"] == 'yes' ) ? true : false,
							'effect' => $settings['transition_effect'],
							'fadeEffect' => ( isset( $settings['cross_fade'] ) && $settings['cross_fade'] == 'yes' ) ? true : false,
							'coverflowEffect' => [ 
								'rotate' => ( isset( $settings['coverflow_rotate'] ) && ! empty( $settings['coverflow_rotate']['size'] ) ) ? $settings['coverflow_rotate']['size'] : false,
								'slideShadows' => ( isset( $settings['slide_shadows'] ) && $settings['slide_shadows'] == 'yes' ) ? true : false,
							],
							'flipEffect' => [ 
								'slideShadows' => ( isset( $settings['slide_shadows'] ) && $settings['slide_shadows'] == 'yes' ) ? true : false,
							],
							'cubeEffect' => [ 
								'slideShadows' => ( isset( $settings['slide_shadows'] ) && $settings['slide_shadows'] == 'yes' ) ? true : false,
							],
							'hashNavigation' => ( $settings['hash_navigation'] == 'yes' ) ? [ 
								'replaceState' => true
							] : false,
							'observer' => $settings['observer'] == 'yes' ? true : false,
							'navigation' => [ 
								'nextEl' => "#$id .sa-swiper-button-next",
								'prevEl' => "#$id .sa-swiper-button-prev",
							],
							'pagination' => [ 
								'el' => "#$id .swiper-pagination",
								'clickable' => true,
								'type' => $settings['pagination_type'] != 'none' ? $settings['pagination_type'] : false,
								'dynamicBullets' => ( isset( $settings['dynamic_bullets'] ) && ( $settings['dynamic_bullets'] == 'yes' ) ) ? true : false,
							],
							//                                                    scrollbar: {
							//                el: '.swiper-scrollbar',
							//            },
						] ) )
					]
				]
			]
		);
		?>
		<div <?php $this->print_render_attribute_string( 'slider' ); ?>>
			<!-- Slider main container -->
			<div class="swiper">
				<?php
	}

	protected function render_footer() {
		?>
			</div>
		</div>
		<?php
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$item_link_on = false;
		if ( ! empty( $settings['link_on'] ) ) {
			if ( in_array( "item", $settings['link_on'] ) ) {
				$item_link_on = true;
				$this->add_render_attribute( '_wrapper', [ 'class' => 'sa-slider-item-link' ] );
			}
		}

		$this->render_header();
		?>

		<!-- Additional required wrapper -->
		<div class="swiper-wrapper">

			<?php
			foreach ( $settings['slider_list'] as $index => $item ) :
				$hash = NULL;
				if ( $settings['hash_navigation'] == 'yes' ) {
					$hash = 'data-hash="' . sanitize_title( $item['title'] ) . '-' . $this->get_id() . $index . '"';
				}

				$item_link = NULL;
				if ( $item_link_on === true && ! empty( $item['link']['url'] ) ) {
					$target = $item['link']['is_external'] ? '_blank' : '_self';
					$item_link = 'onclick="window.open(\'' . esc_url( $item['link']['url'] ) . '\', \'' . $target . '\')"';
				}
				?>

				<!-- Slides -->
				<div class="swiper-slide" <?php echo esc_html( $hash ) . ' ' . wp_kses_post( $item_link ); ?>>
					<?php if ( $item['content_source'] == 'custom' && ! empty( $item['content_source'] ) ) : ?>

						<?php
						if ( ! empty( $item['slider_image']['url'] ) ) {
							?>
							<div class="sa-slider-img-wrapper">
								<?php
								print ( wp_get_attachment_image(
									$item['slider_image']['id'],
									$settings['thumbnail_size'],
									false,
									[ 
										'class' => $settings['img_hover_animation'] ? 'elementor-animation-' . $settings['img_hover_animation'] : 'sa-',
										'alt' => ! empty( $item['title'] ) ? esc_html( $item['title'] ) : Control_Media::get_image_alt( $item['slider_image'] )
									]
								) );
								?>
							</div>
							<?php
						}
						?>

						<div class="sa-slider-content-wrapper">
							<?php
							if ( ( $settings['show_sub_title'] == 'yes' ) && ! empty( $item['sub_title'] ) ) :
								$this->render_sub_title( [ 'sub_title' => $item['sub_title'] ] );
							endif;

							if ( ( $settings['show_title'] == 'yes' ) && ! empty( $item['title'] ) ) :
								if ( ! empty( $item['link']['url'] ) ) :
									$this->render_title( [ 
										'title' => $item['title'],
										'link' => $item['link']
									] );
								else :
									$this->render_title( [ 'title' => $item['title'] ] );
								endif;
							endif;
							?>

							<?php
							if ( ( $settings['show_text'] == 'yes' ) && ! empty( $item['custom_text'] ) ) :
								printf(
									'<div class="sa-content">%1$s</div>',
									wp_kses_post( $this->parse_text_editor( $item['custom_text'] ) )
								);
							endif;
							?>


							<?php if ( $settings['show_button'] == 'yes' ) : ?>
								<div class="sa-link-wrapper">
									<?php $this->render_button( $item['link'] ); ?>
								</div>
							<?php endif; ?>
						</div>
						<?php
					elseif ( $item['content_source'] == 'elementor' && ! empty( $item['template_id'] ) ) :
						echo Sky_Addons_Plugin::elementor()->frontend->get_builder_content_for_display( $item['template_id'] );
					elseif ( $item['content_source'] == 'anywhere' && ! empty( $item['anywhere_id'] ) ) :
						echo Sky_Addons_Plugin::elementor()->frontend->get_builder_content_for_display( $item['anywhere_id'] );
					else :
						echo esc_html__( 'Sorry, You are doing something wrong!', 'sky-elementor-addons' );
					endif;
					?>
				</div>

			<?php endforeach; ?>

		</div>

		<?php
		if ( $settings['show_navigation'] == 'yes' ) :
			$this->render_navigation();
		endif;

		if ( $settings['show_pagination'] == 'yes' ) :
			$this->render_pagination();
		endif;

		$this->render_footer();
	}
}
