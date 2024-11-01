<?php

namespace Sky_Addons\Modules\FellowSlider\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Widget_Base;

use Elementor\Embed;
use Elementor\Plugin;

use Sky_Addons\Includes\Controls\GroupQuery\Group_Control;
use Sky_Addons\Traits\Global_Widget_Functions;
use Sky_Addons\Traits\Global_Widget_Controls;



if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Fellow_Slider extends Widget_Base {

	use Group_Control;
	use Global_Widget_Functions;
	use Global_Widget_Controls;

	private $_query = null;

	public function get_name() {
		return 'sky-fellow-slider';
	}

	public function get_title() {
		return esc_html__( 'Fellow Slider', 'sky-elementor-addons' );
	}

	public function get_icon() {
		return 'sky-icon-fellow-slider';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'sky', 'post', 'list', 'blogs', 'fellow', 'slider', 'video' ];
	}

	public function get_query() {
		return $this->_query;
	}

	public function get_style_depends() {
		return [ 
			'elementor-icons-fa-solid',
		];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_fellow_slider_layout',
			[ 
				'label' => esc_html__( 'Layout', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'column_gap',
			[ 
				'label' => esc_html__( 'Column Gap', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
					]
				],
				'default' => [ 
					'unit' => 'px',
					'size' => 20,
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-fellow-slider' => 'grid-gap: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .sa-post-item' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .sa-post-meta, {{WRAPPER}} .sa-post-author-wrapper' => 'justify-content: {{VALUE}};',
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
		//         'default' => 8,
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
				'type' => Controls_Manager::HIDDEN,
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
			]
		);

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
				'separator' => 'before'
			]
		);

		$this->add_control(
			'excerpt_length',
			[ 
				'label' => esc_html__( 'Text Limit', 'sky-elementor-addons' ),
				'description' => esc_html__( 'This is for the main content, but not for excerpts. If you set the offset to 0, then you\'ll get the full text instead.', 'sky-elementor-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 20, //30
				'condition' => [ 
					'show_excerpt' => 'yes'
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
			'section_playlist_settings',
			[ 
				'label' => esc_html__( 'Slider Settings', 'sky-elementor-addons' ),
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
					// 'vertical'   => esc_html__('Vertical', 'sky-elementor-addons'),
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
				'label' => esc_html__( 'Autoplay Speed (ms)', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 1000,
						'max' => 10000,
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
				// 'default' => 'yes',
			]
		);

		$this->add_control(
			'speed',
			[ 
				'label' => esc_html__( 'Slide Speed (ms)', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 500,
						'max' => 5000,
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
					// 'fade'      => esc_html__('Fade', 'sky-elementor-addons'),
					'coverflow' => esc_html__( 'Coverflow', 'sky-elementor-addons' ),
				],
			]
		);

		// $this->add_control(
		//     'show_play_button_on_hover',
		//     [
		//         'label'        => esc_html__('Show Play Button On Hover', 'sky-elementor-addons'),
		//         'type'         => Controls_Manager::SWITCHER,
		//         'prefix_class' => 'sa-play-button-on-hover-'
		//     ]
		// );

		$this->add_control(
			'playlist_mouse_wheel',
			[ 
				'label' => esc_html__( 'Mouse Wheel', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'playlist_free_mode',
			[ 
				'label' => esc_html__( 'Free Mode', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'playlist_show_scrollbar',
			[ 
				'label' => esc_html__( 'Show Scrollbar', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'description' => esc_html__( 'The scrollbar is not supported with loop mode, You should deactivate the Loop.', 'sky-elementor-addons' ),
				'default' => 'yes',
			]
		);

		// $this->add_control(
		//     'playlist_show_navigation',
		//     [
		//         'label'   => esc_html__('Show Navigation', 'sky-elementor-addons'),
		//         'type'    => Controls_Manager::SWITCHER,
		//         'default' => 'yes',
		//     ]
		// );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_post_video_settings',
			[ 
				'label' => esc_html__( 'Video Settings', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [ 
					'show_video' => 'yes'
				]
			]
		);

		/**
		 * Global Video Lightbox Control
		 */
		$this->video_lightbox_controls();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_fellow_slider_style',
			[ 
				'label' => esc_html__( 'Fellow Slider', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_spacing',
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
					'{{WRAPPER}} .sa-fellow .sa-fellow-slider' => 'grid-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'item_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'fields_options' => [ 
					'border' => [ 
						'default' => 'solid',
					],
					'width' => [ 
						'default' => [ 
							'top' => '1',
							'right' => '1',
							'bottom' => '1',
							'left' => '1',
							'unit' => 'px',
							'isLinked' => false,
						],
					],
					'color' => [ 
						'default' => '#eaeaea',
					],
				],
				'selector' => '{{WRAPPER}} .sa-post-item',
			]
		);

		$this->add_responsive_control(
			'item_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [ 
					'top' => '.25',
					'right' => '.25',
					'bottom' => '.25',
					'left' => '.25',
					'unit' => 'em',
					'isLinked' => true,
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->start_controls_tabs(
			'item_style_tabs'
		);

		$this->start_controls_tab(
			'item_style_normal_tab',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'item_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-post-item',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'item_style_hover_tab',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'item_background_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-post-item:hover',
			]
		);

		$this->add_control(
			'item_border_color_hover',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-item:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'item_border_border!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			[ 
				'label' => esc_html__( 'Image', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_image' => 'yes'
				]
			]
		);

		$this->start_controls_tabs(
			'style_img_tabs'
		);

		$this->start_controls_tab(
			'style_img_tab',
			[ 
				'label' => esc_html__( 'Feature Image', 'sky-elementor-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'img_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-fellow .sa-post-img',
			]
		);

		$this->add_responsive_control(
			'img_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-fellow .sa-post-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'img_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-fellow .sa-post-img',
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[ 
				'name' => 'img_css_filters',
				'selector' => '{{WRAPPER}} .sa-fellow .sa-post-img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_list_img_tab',
			[ 
				'label' => esc_html__( 'List Image', 'sky-elementor-addons' ),
			]
		);

		$this->add_responsive_control(
			'list_img_width',
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
					'{{WRAPPER}} .sa-fellow-items .sa-post-img-wrapper' => 'min-width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'list_img_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-fellow-items .sa-post-img',
			]
		);

		$this->add_responsive_control(
			'list_img_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-fellow-items .sa-post-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'list_img_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-fellow-items .sa-post-img',
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[ 
				'name' => 'list_img_css_filters',
				'selector' => '{{WRAPPER}} .sa-fellow-items .sa-post-img',
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

		$this->start_controls_tabs(
			'style_title_tabs'
		);

		$this->start_controls_tab(
			'style_title_tab',
			[ 
				'label' => esc_html__( 'Title', 'sky-elementor-addons' ),
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
					'{{WRAPPER}} .sa-fellow .sa-post-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-fellow .sa-post-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[ 
				'label' => esc_html__( 'Text Color Hover', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-fellow .sa-post-title a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-fellow .sa-post-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'title_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-fellow .sa-post-title a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_list_title_tab',
			[ 
				'label' => esc_html__( 'List Title', 'sky-elementor-addons' ),
			]
		);

		$this->add_responsive_control(
			'list_title_spacing',
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
					'{{WRAPPER}} .sa-fellow-items .sa-post-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'list_title_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-fellow-items .sa-post-title a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'list_title_color_hover',
			[ 
				'label' => esc_html__( 'Text Color Hover', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-fellow-items .sa-post-title a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'list_title_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-fellow-items .sa-post-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'list_title_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-fellow-items .sa-post-title a',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			[ 
				'label' => esc_html__( 'Text', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 'show_excerpt' => 'yes' ]
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
					'show_category' => 'yes'
				]
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
							'value' => 'yes'
						],
						[ 
							'name' => 'show_date',
							'value' => 'yes'
						]
					]
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
					'show_author' => 'yes'
				]
			]
		);

		$this->add_control(
			'author_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-fellow .sa-post-author-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'author_color_hover',
			[ 
				'label' => esc_html__( 'Color Hover', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-fellow .sa-post-author-wrapper:hover .sa-post-author-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'author_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-fellow .sa-post-author-text',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'author_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-fellow .sa-post-author-text',
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
					'{{WRAPPER}} .sa-fellow .sa-post-author-thumb' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'author_img_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-fellow .sa-post-author-thumb',
			]
		);

		$this->add_responsive_control(
			'author_img_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-fellow .sa-post-author-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'author_img_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-fellow .sa-post-author-thumb',
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[ 
				'name' => 'author_img_css_filters',
				'selector' => '{{WRAPPER}} .sa-fellow .sa-post-author-thumb',
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
				'selector' => '{{WRAPPER}} .sa-fellow .sa-post-date, {{WRAPPER}} .sa-fellow .sa-icon-wrap',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'author_date_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-fellow .sa-post-date, {{WRAPPER}} .sa-fellow .sa-icon-wrap',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'list_scrollbar_style',
			[ 
				'label' => esc_html__( 'Scrollbar', 'sky-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'playlist_show_scrollbar' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'list_scrollbar_size',
			[ 
				'label' => esc_html__( 'Size', 'sky-elementor-addons-pro' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 1,
						'max' => 10,
						'step' => .5,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-swiper-scrollbar' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'list_scrollbar_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-swiper-scrollbar' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'list_scrollbar_drag_color',
			[ 
				'label' => esc_html__( 'Drag Color', 'sky-elementor-addons-pro' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .swiper-scrollbar-drag' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'play_btn_style',
			[ 
				'label' => esc_html__( 'Play Button', 'sky-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_video' => 'yes'
				]
			]
		);

		/**
		 * Global Controls
		 */
		$this->player_button_style( [ 
			'prefix' => 'play_button',
			'selector' => '.sa-fellow .sa-play-button',
		] );

		$this->end_controls_section();

		$this->start_controls_section(
			'item_play_btn_style',
			[ 
				'label' => esc_html__( 'Play Button Items', 'sky-elementor-addons-pro' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_video' => 'yes'
				]
			]
		);

		/**
		 * Global Controls
		 */
		$this->player_button_style( [ 
			'prefix' => 'play_button_item',
			'selector' => '.sa-fellow-items .sa-play-button',
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

	public function get_embed_params() {
		$settings = $this->get_settings_for_display();

		$params = [];
		$params['autoplay'] = '0';

		if ( 'yes' == $settings['video_autoplay'] ) {
			$params['autoplay'] = '1';
			$params['mute'] = 1;
		}

		if ( $settings['mute'] ) {
			$params['mute'] = 1;
		}

		return $params;
	}

	public function get_embed_options() {
		$settings = $this->get_settings_for_display();
		$embed_options = [];
		$embed_options['lazy_load'] = ! empty( $settings['lazy_load'] );

		return $embed_options;
	}

	public function render_video_lightbox( $video_url, $id ) {
		$settings = $this->get_settings_for_display();

		if ( empty( $video_url ) ) {
			return;
		}

		$embed_params = $this->get_embed_params();
		$embed_options = $this->get_embed_options();

		$lightbox_url = Embed::get_embed_url( $video_url, $embed_params, $embed_options );

		if ( $settings['video_open'] !== 'file' ) {

			$lightbox_options = [ 
				'type' => 'video',
				// 'videoType' => $settings['video_type'],
				'url' => $lightbox_url,
				'modalOptions' => [ 
					'id' => 'elementor-lightbox-' . $id,
					'entranceAnimation' => $settings['lightbox_content_animation'],
					'entranceAnimation_tablet' => isset( $settings['lightbox_content_animation_tablet'] ) ? $settings['lightbox_content_animation_tablet'] : '',
					'entranceAnimation_mobile' => isset( $settings['lightbox_content_animation_mobile'] ) ? $settings['lightbox_content_animation_mobile'] : '',
					'videoAspectRatio' => $settings['aspect_ratio'],
				],
			];

			$this->add_render_attribute( 'lightbox-attr-' . $id, [ 
				'data-elementor-open-lightbox' => 'yes',
				'data-elementor-lightbox' => wp_json_encode( $lightbox_options ),
				'e-action-hash' => Plugin::instance()->frontend->create_action_hash( 'lightbox', $lightbox_options ),
			] );
		} else {
			$this->add_render_attribute( 'lightbox-attr-' . $id, [ 
				'href' => $lightbox_url,
			] );
			if ( 'yes' == $settings['file_new_tab'] ) {
				$this->add_render_attribute( 'lightbox-attr-' . $id, [ 
					'target' => '_blank',
				] );
			}
		}

		if ( Plugin::$instance->editor->is_edit_mode() ) {
			$this->add_render_attribute( 'lightbox-attr-' . $id, [ 
				'class' => 'elementor-clickable',
			] );
		}
	}

	protected function render_item_thumbnail( $post_id, $image_size = 'full', $feature = '' ) {
		$settings = $this->get_settings_for_display();

		if ( 'yes' !== $settings['show_image'] ) {
			return;
		}

		/**
		 * Video Feature enabled
		 */

		$video_url = get_post_meta( $post_id, 'sky_video_link_meta', true );

		if ( 'yes' == $settings['show_video'] ) {
			$tag = 'div';
			$id = $this->get_id() . '-' . $post_id . $feature;

			/**
			 * Lightbox
			 */

			$this->render_video_lightbox( $video_url, $id );

			if ( $settings['video_open'] == 'file' ) {
				$tag = 'a';
			}
		}

		?>
		<div class="sa-post-img-wrapper sa-d-inline-block sa-overflow-hidden">
			<?php if ( ( 'fellow' == $feature ) && ( 'yes' != $settings['show_video'] || empty( $video_url ) ) ) : ?>
				<!-- Extra - Link added in Image -->
				<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_html( get_the_title() ); ?>">
					<?php
					$this->render_post_image( [ 
						'image_id' => get_post_thumbnail_id( $post_id ),
						'thumbnail_size' => $image_size,
					] );
					?>
				</a>
			<?php else : ?>
				<?php
				$this->render_post_image( [ 
					'image_id' => get_post_thumbnail_id( $post_id ),
					'thumbnail_size' => $image_size,
				] );
				?>
			<?php endif; ?>

			<?php
			if ( 'yes' == $settings['show_video'] && ! empty( $video_url ) ) :
				$this->add_render_attribute( 'lightbox-attr-' . $id, [ 
					'class' => 'sa-play-button sa-icon-wrap sa-link',
				] );
				?>
				<div class="sa-play-button-wrapper">
					<<?php echo esc_attr( $tag ); ?>
						<?php $this->print_render_attribute_string( 'lightbox-attr-' . $id ); ?>>
						<!-- <i class="fas fa-play"></i> -->
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
							<path
								d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z" />
						</svg>
					</<?php echo esc_attr( $tag ); ?>>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}

	protected function render_author() {
		$settings = $this->get_settings_for_display();
		if ( 'yes' !== $settings['show_author'] ) {
			return;
		}

		?>
		<div class="sa-post-author-wrapper sa-d-flex">
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
				class="sa-d-inline-flex sa-align-items-center">
				<div class="sa-icon-wrap sa-me-1">
					<i class="eicon-user-circle-o"></i>
				</div>
				<span class="sa-post-author-text">
					<?php echo wp_kses_post( get_the_author() ); ?>
				</span>
			</a>
		</div>
		<?php
	}

	protected function render_author_with_thumb() {
		$settings = $this->get_settings_for_display();
		if ( 'yes' !== $settings['show_author'] ) {
			return;
		}

		?>
		<div class="sa-post-author-wrapper sa-d-flex">
			<a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"
				class="sa-d-inline-flex sa-align-items-center">
				<div class="sa-post-author-thumb sa-me-3 sa-rounded-circle sa-overflow-hidden">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?>
				</div>
				<div>
					<div class="sa-post-author-text">
						<?php echo get_the_author(); ?>
					</div>
					<?php $this->render_date(); ?>
				</div>
			</a>
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

	protected function render_item( $post_id, $image_size ) {
		// global $post;
		$settings = $this->get_settings_for_display();
		?>
		<div class="swiper-slide">
			<div class="sa-post-item sa-d-flex sa-p-4">

				<?php $this->render_item_thumbnail( $post_id, $image_size, 'item' ); ?>

				<div class="sa-post-content-wrapper">
					<?php
					$this->render_post_category( [ 
						'wrapper_class' => 'sa-post-category-style-1 sa-mb-2'
					] );

					$this->render_post_title( [ 
						'wrapper_class' => 'sa-mb-2'
					] );
					?>
					<div class="sa-post-meta sa-d-flex">

						<?php $this->render_author(); ?>

						<?php $this->render_date(); ?>

					</div>
				</div>
			</div>
		</div>
		<?php
	}

	protected function render_item_feature( $post_id, $image_size, $excerpt_length ) {
		$settings = $this->get_settings_for_display();

		?>
		<div class="swiper-slide">
			<div class="sa-post-item sa-d-flex sa-p-4">

				<?php
				$this->render_item_thumbnail( $post_id, $image_size, 'fellow' );
				?>

				<div class="sa-post-content-wrapper" data-swiper-parallax="-200">
					<?php
					$this->render_post_category( [ 
						'wrapper_class' => 'sa-post-category-style-1 sa-mb-2'
					] );

					$this->render_post_title( [ 
						'wrapper_class' => 'sa-mb-2'
					] );

					$this->render_post_excerpt( $excerpt_length );
					$this->render_author_with_thumb();
					?>
				</div>
			</div>
		</div>
		<?php
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$id = 'sa-fellow-slider-' . $this->get_id();

		$this->query_posts( $settings['posts_per_page'] );
		$wp_query = $this->get_query();

		if ( ! $wp_query->found_posts ) {
			return;
		}

		$this->add_render_attribute(
			[ 
				'fellow-slider' => [ 
					'class' => 'sa-fellow-slider',
					'id' => $id,
					'data-player-settings' => [ 
						wp_json_encode( array_filter( [ 
							// 'autoHeight'    => true,
							'direction' => $settings["direction"],
							'loop' => ( $settings['loop'] == 'yes' ) ? true : false,
							'autoplay' => $settings["autoplay"] == 'yes' ? [ "delay" => $settings["autoplay_speed"]['size'] ] : false,
							'speed' => ( ! empty( $settings['speed']['size'] ) ) ? $settings['speed']['size'] : 1500,
							'pauseOnHover' => ( $settings["autoplay"] == 'yes' && $settings["pause_on_hover"] == 'yes' ) ? true : false,
							'effect' => $settings['transition_effect'],
							'slidesPerView' => 1,
							'loopedSlides' => 4,
							'spaceBetween' => 0,

							'parallax' => true
						] ) )
					],
					'data-playlist-settings' => [ 
						wp_json_encode( array_filter( [ 
							'direction' => 'vertical',
							'loop' => ( $settings['loop'] == 'yes' ) ? true : false,
							'speed' => ( ! empty( $settings['speed']['size'] ) ) ? $settings['speed']['size'] : 1500,
							'slidesPerView' => 3,
							'loopedSlides' => 4,
							'spaceBetween' => 20,
							'mousewheel' => ( $settings['playlist_mouse_wheel'] == 'yes' ) ? true : false,
							'freeMode' => false, //($settings['playlist_free_mode'] == 'yes') ? true : false,
							'watchSlidesVisibility' => true,
							'watchSlidesProgress' => true,
							'slideToClickedSlide' => true,
							// 'navigation'         => [
							//     'nextEl'         => $settings['playlist_show_navigation'] == 'yes' ? "#$id .sa-swiper-button-next" : false,
							//     'prevEl'         => $settings['playlist_show_navigation'] == 'yes' ? "#$id .sa-swiper-button-prev" : false
							// ],
							'scrollbar' => [ 
								'el' => $settings['playlist_show_scrollbar'] == 'yes' ? "#$id .sa-swiper-scrollbar" : false,
								'draggable' => $settings['playlist_show_scrollbar'] == 'yes' ? true : false
							],
							'breakpoints' => [ 
								'320' => [ 
									'direction' => "vertical",
									'slidesPerView' => 2
								],
								'768' => [ 
									'direction' => "vertical",
									'slidesPerView' => 3
								],
								'991' => [ 
									'direction' => 'vertical',
									'slidesPerView' => 3,
								]
							]
						] ) )
					]
				]
			]
		);
		?>
		<div <?php $this->print_render_attribute_string( 'fellow-slider' ); ?>>
			<div class="sa-fellow swiper sa-w-100">
				<div class="swiper-wrapper sa-w-100 sa-h-100">
					<?php
					while ( $wp_query->have_posts() ) :
						$wp_query->the_post();

						$thumbnail_size = $settings['primary_thumbnail_size'];

						$this->get_posts_tags();

						$this->render_item_feature( get_the_ID(), $thumbnail_size, $settings['excerpt_length'] );

					endwhile;
					?>
				</div>
			</div>
			<div class="sa-fellow-items swiper sa-w-100 sa-h-100">
				<div class="swiper-wrapper sa-w-100 sa-h-100">
					<?php
					while ( $wp_query->have_posts() ) :
						$wp_query->the_post();

						$thumbnail_size = $settings['primary_thumbnail_size'];

						$this->get_posts_tags();

						$this->render_item( get_the_ID(), $thumbnail_size );

					endwhile;
					?>
				</div>
				<?php if ( $settings['playlist_show_scrollbar'] == 'yes' ) : ?>
					<div class="sa-swiper-scrollbar"></div>
				<?php endif; ?>
			</div>
		</div>

		<?php

		wp_reset_postdata();
	}
}
