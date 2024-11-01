<?php

namespace Sky_Addons\Modules\MateSlider\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;

use Sky_Addons\Includes\Controls\GroupQuery\Group_Control;
use Sky_Addons\Traits\Global_Widget_Functions;
use Sky_Addons\Traits\Global_Widget_Controls;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Mate_Slider extends Widget_Base {

	use Group_Control;
	use Global_Widget_Functions;
	use Global_Widget_Controls;

	private $_query = null;

	public function get_name() {
		return 'sky-mate-slider';
	}

	public function get_title() {
		return esc_html__( 'Mate Slider', 'sky-elementor-addons' );
	}

	public function get_icon() {
		return 'sky-icon-mate-slider';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'sky', 'post', 'blogs', 'bloggers', 'mate', 'sliders', 'carousel' ];
	}

	public function get_query() {
		return $this->_query;
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_mate_slider_layout',
			[ 
				'label' => esc_html__( 'Layout', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		// $this->add_responsive_control(
		//     'height',
		//     [
		//         'label'      => esc_html__('Slider Height', 'sky-elementor-addons'),
		//         'type'       => Controls_Manager::SLIDER,
		//         'size_units' => ['px', 'em', '%', 'vh'],
		//         'range'      => [
		//             'px' => [
		//                 'min' => 350,
		//                 'max' => 1000,
		//             ],
		//             '%'  => [
		//                 'min' => 0,
		//                 'max' => 100,
		//             ],
		//         ],
		//         'selectors'  => [
		//             '{{WRAPPER}} .swiper' => 'height: {{SIZE}}{{UNIT}};',
		//         ],
		//     ]
		// );

		$this->add_responsive_control(
			'column_gap',
			[ 
				'label' => esc_html__( 'Column Gap', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [ 
					'unit' => 'px',
					'size' => 36,
				],
				'tablet_default' => [ 
					'unit' => 'px',
					'size' => 18,
				],
				'mobile_default' => [ 
					'unit' => 'px',
					'size' => 24,
				],
				'render_type' => 'template',
				'selectors' => [ 
					'{{WRAPPER}} .sa-mate-slider' => 'grid-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[ 
				'name' => 'primary_thumbnail',
				'exclude' => [ 'custom' ],
				'default' => 'large',
			]
		);

		// $this->add_responsive_control(
		//     'content_layout',
		//     [
		//         'label'           => esc_html__('Select Layout', 'sky-elementor-addons'),
		//         'type'            => Controls_Manager::SELECT,
		//         'options'         => [
		//             'default'  => esc_html__('Default', 'sky-elementor-addons'),
		//             'layout_1' => esc_html__('Layout 1', 'sky-elementor-addons'),
		//         ],
		//         'default'         => 'default',
		//         'tablet_default'  => 'default',
		//         'mobile_default'  => 'default',
		//         'selectors'       => [
		//             '{{WRAPPER}} .sa-mate-slider' => '{{VALUE}};',
		//         ],
		//         'selectors_dictionary' => [
		//             'default'  => 'flex-direction: unset;',
		//             'layout_1' => 'flex-direction: row-reverse;',
		//         ],
		//     ]
		// );

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
					'{{WRAPPER}} .sa-item' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .sa-post-meta, {{WRAPPER}} .sa-post-category' => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} .sa-post-text' => 'max-width: 100%;',
				],
			]
		);

		$this->end_controls_section();

		/**
		 * Global Query Builder Settings
		 */
		$this->start_controls_section(
			'section_post_query_builder',
			[ 
				'label' => __( 'Query', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->register_query_builder_controls();

		// $this->update_control(
		//     'posts_per_page',
		//     [
		//         'default' => 2,
		//     ]
		// );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional',
			[ 
				'label' => esc_html__( 'Additional', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
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
			'title_tag',
			[ 
				'label' => esc_html__( 'Title HTML Tag', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => sky_title_tags(),
				'condition' => [ 
					'show_title' => 'yes',
				],
			]
		);

		/** Made this option Hidden */
		$this->add_control(
			'show_image',
			[ 
				'label' => esc_html__( 'Show Image', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_category',
			[ 
				'label' => esc_html__( 'Show Category', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_author',
			[ 
				'label' => esc_html__( 'Show Author', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_excerpt',
			[ 
				'label' => esc_html__( 'Show Text', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'excerpt_length',
			[ 
				'label' => esc_html__( 'Text Limit', 'sky-elementor-addons' ),
				'description' => esc_html__( 'This is for the main content, but not for excerpts. If you set the offset to 0, then you\'ll get the full text instead.', 'sky-elementor-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 15,
				'condition' => [ 
					'show_excerpt' => 'yes',
				],
			]
		);

		$this->add_control(
			'strip_shortcode',
			[ 
				'label' => esc_html__( 'Strip ShortCode', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [ 
					'show_excerpt' => 'yes',
				],
			]
		);

		/**
		 * Global Date Controls
		 */

		$this->add_control(
			'show_date',
			[ 
				'label' => esc_html__( 'Show Date', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->register_post_date_controls();

		$this->add_control(
			'show_video',
			[ 
				'label' => esc_html__( 'Show Video', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
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
				'label' => esc_html__( 'Autoplay Speed (ms)', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 1000,
						'max' => 10000,
						'step' => 500,
					],
				],
				'default' => [ 
					'unit' => 'px',
					'size' => 5000,
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
				'label' => esc_html__( 'Slide Speed (ms)', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 1000,
						'max' => 10000,
						'step' => 500,
					],
				],
				'default' => [ 
					'unit' => 'px',
					'size' => 1500,
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
				'separator' => 'before',
				'description' => esc_html__( 'Note: Please use it when you using slider on a hidden element.', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'show_navigation',
			[ 
				'label' => esc_html__( 'Show Navigation', 'sky-elementor-addons-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_navigation_always',
			[ 
				'label' => esc_html__( 'Show Navigation always', 'sky-elementor-addons-pro' ),
				'type' => Controls_Manager::SWITCHER,
				'selectors' => [ 
					'{{WRAPPER}} .sa-nav' => 'opacity: 1; visibility: visible;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_navigation',
			[ 
				'label' => esc_html__( 'Navigation', 'sky-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [ 'show_navigation' => 'yes' ],
			]
		);

		$this->add_control(
			'prev_icon',
			[ 
				'label' => esc_html__( 'Prev Icon', 'sky-elementor-addons-pro' ),
				'type' => Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'next_icon',
			[ 
				'label' => esc_html__( 'Next Icon', 'sky-elementor-addons-pro' ),
				'type' => Controls_Manager::ICONS,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			[ 
				'label' => esc_html__( 'Image', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				// 'condition' => [
				//     'show_image' => 'yes'
				// ]
			]
		);

		// $this->add_responsive_control(
		//     'img_height',
		//     [
		//         'label'      => esc_html__('Height', 'sky-elementor-addons'),
		//         'type'       => Controls_Manager::SLIDER,
		//         'size_units' => ['px', 'em'],
		//         'range'      => [
		//             'px' => [
		//                 'min' => 300,
		//                 'max' => 600,
		//             ],
		//         ],
		//         'selectors'  => [
		//             '{{WRAPPER}} .sa-post-img-wrapper' => 'height: {{SIZE}}{{UNIT}};',
		//         ],
		//     ]
		// );

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
					'{{WRAPPER}} .sa-post-img-wrapper' => 'min-width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .sa-post-img-wrapper' => 'min-height: {{SIZE}}{{UNIT}}; max-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'img_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'img_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-img',
			]
		);

		$this->add_responsive_control(
			'img_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[ 
				'name' => 'img_css_filters',
				'selector' => '{{WRAPPER}} .sa-post-img',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_post_video_settings',
			[ 
				'label' => esc_html__( 'Video Settings', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [ 
					'show_video' => 'yes',
				],
			]
		);

		/**
		 * Global Video Lightbox Control
		 */
		$this->video_lightbox_controls();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[ 
				'label' => esc_html__( 'Title', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_title' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'title_spacing',
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
					'{{WRAPPER}} .sa-post-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		/**
		 * Global Title
		 */
		$this->register_post_title_controls_style();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			[ 
				'label' => esc_html__( 'Text', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 'show_excerpt' => 'yes' ],
			]
		);

		/**
		 * Global Text Controls
		 */
		$this->register_post_text_controls_style();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_category_style',
			[ 
				'label' => esc_html__( 'Category', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_category' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'category_spacing',
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
					'{{WRAPPER}} .sa-post-category' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'category_space_between',
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
					'{{WRAPPER}}' => '--sa-post-category-spacing: {{SIZE}}{{UNIT}};',
				],
			]
		);

		/**
		 * Global Category
		 */

		$this->register_post_category_controls_style();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_meta_style',
			[ 
				'label' => esc_html__( 'Meta', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'conditions' => [ 
					'relation' => 'or',
					'terms' => [ 
						[ 
							'name' => 'show_author',
							'value' => 'yes',
						],
						[ 
							'name' => 'show_date',
							'value' => 'yes',
						],
					],
				],
			]
		);

		$this->add_responsive_control(
			'meta_spacing',
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
					'{{WRAPPER}} .sa-post-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'meta_space_between',
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
					'{{WRAPPER}} .sa-post-meta' => 'grid-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		/**
		 * Global Controls Meta
		 */

		$this->register_post_meta_controls_style();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_author_style',
			[ 
				'label' => esc_html__( 'Author', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_author' => 'yes',
				],
			]
		);

		$this->add_control(
			'author_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-author-text a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'author_color_hover',
			[ 
				'label' => esc_html__( 'Color Hover', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-author-text:hover  a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'author_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-author-text',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'author_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-author-text',
			]
		);

		$this->add_control(
			'author_heading_style',
			[ 
				'label' => esc_html__( 'Image', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'author_img_width',
			[ 
				'label' => esc_html__( 'Size', 'sky-elementor-addons' ),
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
					'{{WRAPPER}} .sa-post-author-thumb' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'author_img_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-author-thumb',
			]
		);

		$this->add_responsive_control(
			'author_img_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-author-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'author_img_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-author-thumb',
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[ 
				'name' => 'author_img_css_filters',
				'selector' => '{{WRAPPER}} .sa-post-author-thumb',
			]
		);

		$this->add_control(
			'author_date_heading_style',
			[ 
				'label' => esc_html__( 'Date', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'author_date_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}}' => '--sa-post-author-date-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'author_date_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-date, {{WRAPPER}} .sa-icon-wrap',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'author_date_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-date, {{WRAPPER}} .sa-icon-wrap',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_navigation_style',
			[ 
				'label' => esc_html__( 'Navigation', 'sky-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_navigation' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'navigation_size',
			[ 
				'label' => esc_html__( 'Size', 'sky-elementor-addons-pro' ),
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
				'label' => esc_html__( 'Spacing', 'sky-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 1,
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
				'label' => esc_html__( 'Padding', 'sky-elementor-addons-pro' ),
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
				'label' => esc_html__( 'Border', 'sky-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next',
			]
		);

		$this->add_responsive_control(
			'navigation_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons-pro' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'navigation_tabs' );

		$this->start_controls_tab(
			'navigation_tab_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons-pro' ),
			]
		);

		$this->add_control(
			'navigation_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons-pro' ),
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
				'label' => esc_html__( 'Background', 'sky-elementor-addons-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'navigation_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'navigation_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'navigation_tab_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons-pro' ),
			]
		);

		$this->add_control(
			'navigation_color_hover',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons-pro' ),
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
				'label' => esc_html__( 'Background', 'sky-elementor-addons-pro' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover',
			]
		);

		$this->add_control(
			'navigation_border_color_hover',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons-pro' ),
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
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'navigation_box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'play_btn_style',
			[ 
				'label' => esc_html__( 'Play Button', 'sky-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_video' => 'yes',
				],
			]
		);

		/**
		 * Global Controls
		 */
		$this->player_button_style( [ 
			'prefix' => 'play_button',
			'selector' => '.sa-post-play-button',
		] );

		$this->end_controls_section();
	}

	public function get_taxonomies() {
		$taxonomies = get_taxonomies( [ 'show_in_nav_menus' => true ], 'objects' );

		$options = [ '' => '' ];

		foreach ( $taxonomies as $taxonomy ) {
			$options[ $taxonomy->name ] = $taxonomy->label;
		}

		return $options;
	}

	public function get_posts_tags() {
		$taxonomy = $this->get_settings( 'taxonomy' );

		foreach ( $this->_query->posts as $post ) {
			if ( ! $taxonomy ) {
				$post->tags = [];

				continue;
			}

			$tags = wp_get_post_terms( $post->ID, $taxonomy );

			$tags_slugs = [];

			foreach ( $tags as $tag ) {
				$tags_slugs[ $tag->term_id ] = $tag;
			}

			$post->tags = $tags_slugs;
		}
	}

	/**
	 * Get post query builder arguments
	 */
	public function query_posts( $posts_per_page ) {
		$settings = $this->get_settings();

		$args = [];
		if ( $posts_per_page ) {
			$args['posts_per_page'] = $posts_per_page;
			$args['paged'] = max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );
		}

		$default = $this->getGroupControlQueryArgs();
		$args = array_merge( $default, $args );

		$this->_query = new \WP_Query( $args );
	}

	protected function render_navigation() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="sa-nav">
			<!-- If we need navigation buttons -->
			<button type="button" class="sa-swiper-button-prev sa-slider-navigation sa-icon-wrap sa-rounded">
				<?php
				if ( ! empty( $settings['prev_icon']['value'] ) ) :
					Icons_Manager::render_icon( $settings['prev_icon'], [ 
						'aria-hidden' => 'true',
						'class' => 'fa-fw',
					] );
				else :
					?>
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 44">
						<path d="M0,22L22,0l2.1,2.1L4.2,22l19.9,19.9L22,44L0,22L0,22L0,22z">
					</svg>
					<?php
				endif;
				?>

			</button>
			<button type="button" class="sa-swiper-button-next sa-slider-navigation sa-icon-wrap sa-rounded">
				<?php
				if ( ! empty( $settings['next_icon']['value'] ) ) :
					Icons_Manager::render_icon( $settings['next_icon'], [ 
						'aria-hidden' => 'true',
						'class' => 'fa-fw',
					] );
				else :
					?>
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 44">
						<path d="M27,22L27,22L5,44l-2.1-2.1L22.8,22L2.9,2.1L5,0L27,22L27,22z">
					</svg>
					<?php
				endif;
				?>
			</button>
		</div>
		<?php
	}

	protected function render_item_thumbnail( $post_id, $image_size = 'full' ) {
		$settings = $this->get_settings_for_display();

		// if ('yes' !== $settings['show_image']) {
		//     return;
		// }
		?>
		<div class="swiper-slide">
			<?php $this->render_post_thumb_with_video( $post_id, $image_size = 'full' ); ?>
		</div>
		<?php
	}

	protected function render_author_thumb() {
		$settings = $this->get_settings_for_display();
		if ( 'yes' !== $settings['show_author'] ) {
			return;
		}

		?>
		<div class="sa-post-author-wrapper sa-d-flex" data-swiper-parallax="-350">
			<div class="sa-d-inline-flex sa-align-items-center">
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
					<div class="sa-post-author-thumb sa-me-3 sa-rounded-circle sa-overflow-hidden">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?>
					</div>
				</a>
				<div>
					<div class="sa-post-author-text">
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
							<?php echo get_the_author(); ?>
						</a>
					</div>
					<?php $this->render_date(); ?>
				</div>
			</div>
		</div>
		<?php
	}

	protected function render_date() {
		$settings = $this->get_settings_for_display();
		if ( 'yes' !== $settings['show_date'] ) {
			return;
		}
		?>
		<div class="sa-post-date-wrapper sa-d-flex sa-align-items-center">
			<div class="sa-icon-wrap sa-me-1">
				<i class="eicon-calendar"></i>
			</div>
			<?php
			$this->render_post_date();
			?>
		</div>
		<?php
	}

	protected function render_excerpt( $length ) {
		$settings = $this->get_settings_for_display();

		if ( ! isset( $settings['show_excerpt'] ) || 'yes' !== $settings['show_excerpt'] ) {
			return;
		}
		$strip_shortcode = ( $settings['strip_shortcode'] ) ? true : false;
		$excerpt = '';

		if ( has_excerpt() ) {
			$excerpt = the_excerpt();
		} else {
			$excerpt = sky_post_custom_excerpt( $length, $strip_shortcode );
		}

		printf(
			'<div class="%1$s" data-swiper-parallax="-250">%2$s</div>',
			'sa-post-text',
			wp_kses_post( $excerpt )
		);
	}

	protected function render_item( $post_id, $excerpt_length ) {
		// global $post;
		$settings = $this->get_settings_for_display();
		$_title_id = $post_id . $this->get_id();
		?>
		<div class="swiper-slide sa-h-100">
			<div class="sa-item sa-d-flex sa-p-4 sa-h-100">

				<div class="sa-post-content-wrapper sa-d-flex sa-flex-column sa-justify-content-center">
					<?php

					// $this->render_post_category([
					//     'wrapper_class' => 'sa-post-category sa-post-category-style-1 sa-mb-3'
					// ]);
			
					$cat_attr = [ 
						'class' => 'sa-post-category sa-post-category-style-1 sa-mb-3',
						'data-swiper-parallax' => -150,
					];

					$this->render_post_category_attr( 'cat' . $_title_id, $cat_attr );

					// $this->render_post_title([
					//     'wrapper_class' => 'sa-mb-4',
					// ]);
			
					$title_attr = [ 
						'class' => 'sa-post-title sa-mb-4',
						'data-swiper-parallax' => -200,
					];

					$this->render_post_title_attr( 'title' . $_title_id, $title_attr );

					$this->render_excerpt( $excerpt_length );
					?>
					<div class="sa-post-meta sa-d-flex">

						<?php $this->render_author_thumb(); ?>

					</div>
				</div>
			</div>
		</div>
		<?php
	}

	protected function render_mate_thumb( $wp_query ) {
		$settings = $this->get_settings_for_display();
		while ( $wp_query->have_posts() ) :
			$wp_query->the_post();

			$thumbnail_size = $settings['primary_thumbnail_size'];

			$this->render_item_thumbnail( get_the_ID(), $thumbnail_size );

		endwhile;
	}

	protected function render_mate_content( $wp_query ) {
		$settings = $this->get_settings_for_display();
		while ( $wp_query->have_posts() ) :
			$wp_query->the_post();

			$this->get_posts_tags();

			$this->render_item( get_the_ID(), $settings['excerpt_length'] );

		endwhile;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$id = 'sa-mate-slider-' . $this->get_id();

		$this->add_render_attribute(
			[ 
				'mate-slider' => [ 
					'class' => 'sa-mate-slider sa-d-flex  sa-align-items-center',
					'id' => $id,
					'data-primary-settings' => [ 
						wp_json_encode( array_filter( [ 
							// 'autoHeight'    => true,
							'direction' => 'horizontal',
							'loop' => ( $settings['loop'] == 'yes' ) ? true : false,
							'autoplay' => $settings['autoplay'] == 'yes' ? [ 'delay' => $settings['autoplay_speed']['size'] ] : false,
							'speed' => ( ! empty( $settings['speed']['size'] ) ) ? $settings['speed']['size'] : 1500,
							'pauseOnHover' => ( $settings['autoplay'] == 'yes' && $settings['pause_on_hover'] == 'yes' ) ? true : false,
							'effect' => 'slide',
							'slidesPerView' => 1,
							'loopedSlides' => 4,
							'spaceBetween' => 20,
							'navigation' => [ 
								'nextEl' => "#$id .sa-swiper-button-next",
								'prevEl' => "#$id .sa-swiper-button-prev",
							],
						] ) ),
					],
					'data-secondary-settings' => [ 
						wp_json_encode( array_filter( [ 
							// 'autoHeight'            => true,
							'direction' => 'horizontal',
							'loop' => ( $settings['loop'] == 'yes' ) ? true : false,
							'speed' => ( ! empty( $settings['speed']['size'] ) ) ? $settings['speed']['size'] : 1500,
							'slidesPerView' => 1,
							'loopedSlides' => 4,
							'spaceBetween' => 0,
							'mousewheel' => false,
							'freeMode' => false, //($settings['playlist_free_mode'] == 'yes') ? true : false,
							'watchSlidesVisibility' => true,
							'watchSlidesProgress' => true,
							'parallax' => true,
						] ) ),
					],
				],
			]
		);

		$this->query_posts( $settings['posts_per_page'] );
		$wp_query = $this->get_query();

		if ( ! $wp_query->found_posts ) {
			return;
		}
		?>
		<div <?php $this->print_render_attribute_string( 'mate-slider' ); ?>>
			<div class="sa-mate-primary swiper sa-h-100">
				<div class="swiper-wrapper">
					<?php
					$this->render_mate_thumb( $wp_query );
					?>
				</div>
				<?php
				if ( $settings['show_navigation'] == 'yes' ) :
					$this->render_navigation();
				endif;
				?>
			</div>
			<div class="sa-mate-secondary swiper sa-h-100X">
				<div class="swiper-wrapper">
					<?php
					$this->render_mate_content( $wp_query );
					?>
				</div>
			</div>
		</div>
		<?php
		wp_reset_postdata();
	}
}
