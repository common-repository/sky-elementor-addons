<?php

namespace Sky_Addons\Traits;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

trait Global_Widget_Controls {
	protected function register_post_date_controls() {
		$this->add_control(
			'show_human_diff_time',
			[ 
				'label'     => esc_html__( 'Human Diff Time', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [ 
					'show_date' => 'yes'
				]
			]
		);

		$this->add_control(
			'human_diff_time_short',
			[ 
				'label'     => esc_html__( 'Time Short?', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [ 
					'show_date'            => 'yes',
					'show_human_diff_time' => 'yes'
				]
			]
		);

		$this->add_control(
			'show_time',
			[ 
				'label'     => esc_html__( 'Show Time', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [ 
					'show_date' => 'yes',
				]
			]
		);
	}

	protected function register_post_title_controls_style( $class = '.sa-post-title' ) {

		$this->add_control(
			'title_color',
			[ 
				'label'     => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					"{{WRAPPER}} $class a" => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[ 
				'label'     => esc_html__( 'Text Color Hover', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					"{{WRAPPER}} $class a:hover" => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => "{{WRAPPER}} $class",
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name'     => 'title_text_shadow',
				'label'    => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => "{{WRAPPER}} $class a",
			]
		);
	}
	protected function register_post_text_controls_style() {

		$this->add_control(
			'text_color',
			[ 
				'label'     => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name'     => 'text_typography',
				'label'    => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-text',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name'     => 'text_text_shadow',
				'label'    => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-text',
			]
		);
	}

	protected function register_post_category_controls_style() {

		$this->add_responsive_control(
			'category_padding',
			[ 
				'label'      => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-post-category a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name'     => 'category_border',
				'label'    => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-category a',
			]
		);

		$this->add_responsive_control(
			'category_border_radius',
			[ 
				'label'      => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-post-category a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name'     => 'category_typography',
				'label'    => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-category',
			]
		);

		$this->start_controls_tabs(
			'category_style_tabs'
		);

		$this->start_controls_tab(
			'category_style_normal_tab',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'category_color',
			[ 
				'label'     => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-category a, {{WRAPPER}} .sa-post-category a:focus' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'     => 'category_background',
				'label'    => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-post-category a, {{WRAPPER}} .sa-post-category a:focus',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name'     => 'category_text_shadow',
				'label'    => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-category a',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => 'category_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-category a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'category_style_hover_tab',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'category_color_hover',
			[ 
				'label'     => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-category a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'     => 'category_background_hover',
				'label'    => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-post-category a:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name'     => 'category_text_shadow_hover',
				'label'    => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-category a:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => 'category_box_shadow_hover',
				'label'    => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-category a:hover',
			]
		);

		$this->add_control(
			'category_border_color_hover',
			[ 
				'label'     => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-category a:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'category_border_border!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	}

	protected function register_post_meta_controls_style() {
		$this->add_control(
			'meta_color',
			[ 
				'label'     => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}}' => '--sa-post-meta-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'meta_color_hover',
			[ 
				'label'     => esc_html__( 'Color Hover', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-meta a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name'     => 'meta_typography',
				'label'    => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-meta span, .sa-post-meta .sa-icon-wrap',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name'     => 'meta_text_shadow',
				'label'    => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-meta span, .sa-post-meta .sa-icon-wrap',
			]
		);
	}
	protected function register_post_pagination_controls_style() {
		/**
		 * Solved conflict between pagination swiper traits
		 * Added prefix 'post'
		 */
		$this->start_controls_section(
			'section_post_pagination_style',
			[ 
				'label'     => esc_html__( 'Pagination', 'sky-elementor-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_pagination' => 'yes'
				],
			]
		);

		$this->add_responsive_control(
			'post_pagination_alignment',
			[ 
				'label'     => esc_html__( 'Alignment', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [ 
					'left'   => [ 
						'title' => esc_html__( 'Left', 'sky-elementor-addons' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [ 
						'title' => esc_html__( 'Center', 'sky-elementor-addons' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [ 
						'title' => esc_html__( 'Right', 'sky-elementor-addons' ),
						'icon'  => 'eicon-text-align-right',
					],
				],

				'selectors' => [ 
					'{{WRAPPER}} .sa-post-pagination' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'post_pagination_spacing',
			[ 
				'label'      => esc_html__( 'Item Spacing', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-post-pagination' => 'grid-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'post_pagination_padding',
			[ 
				'label'      => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-post-page-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'post_pagination_margin',
			[ 
				'label'      => esc_html__( 'Margin', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-post-pagination' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name'     => 'post_pagination_border',
				'label'    => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-page-link',
			]
		);

		$this->add_responsive_control(
			'post_pagination_border_radius',
			[ 
				'label'      => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .sa-post-page-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name'     => 'post_pagination_typography',
				'label'    => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-page-link',
			]
		);

		$this->start_controls_tabs(
			'post_pagination_style_tabs'
		);

		$this->start_controls_tab(
			'post_pagination_style_normal_tab',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'post_pagination_color',
			[ 
				'label'     => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-page-link' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'     => 'post_pagination_background',
				'label'    => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-post-page-link',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'post_pagination_style_hover_tab',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'post_pagination_color_hover',
			[ 
				'label'     => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-page-link:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'     => 'post_pagination_background_hover',
				'label'    => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-post-page-link:hover',
			]
		);

		$this->add_control(
			'post_pagination_border_color_hover',
			[ 
				'label'     => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-page-link:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'post_pagination_border_border!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'post_pagination_style_active_tab',
			[ 
				'label' => esc_html__( 'Active', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'post_pagination_color_active',
			[ 
				'label'     => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-page-active .sa-post-page-link' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'     => 'post_pagination_background_active',
				'label'    => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-post-page-active .sa-post-page-link',
			]
		);

		$this->add_control(
			'post_pagination_border_color_active',
			[ 
				'label'     => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-page-active .sa-post-page-link' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'post_pagination_border_border!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}


	/**
	 * Play Button Style
	 * Used on -
	 * Fellow Slider
	 */

	protected function player_button_style( $settings ) {

		$prefix   = isset( $settings['prefix'] ) && ! empty( $settings['prefix'] ) ? $settings['prefix'] : 'play_button';
		$selector = isset( $settings['selector'] ) && ! empty( $settings['selector'] ) ? $settings['selector'] : '.sa-play-button';

		$this->add_responsive_control(
			$prefix . '_icon_size',
			[ 
				'label'      => esc_html__( 'Icon Size', 'sky-elementor-addons-pro' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [ 
					'px' => [ 
						'min' => 6,
						'max' => 100,
					],
				],
				'selectors'  => [ 
					'{{WRAPPER}} ' . $selector . '' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			$prefix . '_padding',
			[ 
				'label'      => esc_html__( 'Padding', 'sky-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} ' . $selector . '' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name'     => $prefix . '_border',
				'label'    => esc_html__( 'Border', 'sky-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} ' . $selector . '',
			]
		);

		$this->add_responsive_control(
			$prefix . '_border_radius',
			[ 
				'label'      => esc_html__( 'Border Radius', 'sky-elementor-addons-pro' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} ' . $selector . '' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->start_controls_tabs( $prefix . '_tabs_style' );

		$this->start_controls_tab(
			$prefix . '_tab_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons-pro' ),
			]
		);

		$this->add_control(
			$prefix . '_color',
			[ 
				'label'     => esc_html__( 'Text Color', 'sky-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} ' . $selector . '' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'     => $prefix . '_background',
				'label'    => esc_html__( 'Background', 'sky-elementor-addons-pro' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} ' . $selector . '',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name'     => $prefix . '_text_shadow',
				'label'    => esc_html__( 'Text Shadow', 'sky-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} ' . $selector . '',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => $prefix . '_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'sky-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} ' . $selector . '',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			$prefix . '_tab_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons-pro' ),
			]
		);


		$this->add_control(
			$prefix . '_color_hover',
			[ 
				'label'     => esc_html__( 'Text Color', 'sky-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} ' . $selector . ':hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'     => $prefix . '_background_hover',
				'label'    => esc_html__( 'Background', 'sky-elementor-addons-pro' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} ' . $selector . ':hover',
			]
		);

		$this->add_control(
			$prefix . '_border_color_hover',
			[ 
				'label'     => esc_html__( 'Border Color', 'sky-elementor-addons-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} ' . $selector . ':hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					$prefix . '_border_border!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name'     => $prefix . '_text_shadow_hover',
				'label'    => esc_html__( 'Text Shadow', 'sky-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} ' . $selector . ':hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => $prefix . '_box_shadow_hover',
				'label'    => esc_html__( 'Box Shadow', 'sky-elementor-addons-pro' ),
				'selector' => '{{WRAPPER}} ' . $selector . ':hover',
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();
	}

	protected function video_lightbox_controls() {
		/**
		 * Lightbox Added
		 * @since 1.0.10
		 */

		$this->add_control(
			'video_open',
			[ 
				'label'   => esc_html__( 'Video Open', 'sky-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [ 
					'default'  => esc_html__( 'Default', 'sky-elementor-addons' ),
					'lightbox' => esc_html__( 'Lightbox', 'sky-elementor-addons' ),
					'file'     => esc_html__( 'Media File', 'sky-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'file_new_tab',
			[ 
				'label'     => esc_html__( 'File Open in a New Tab?', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [ 
					'video_open' => 'file'
				]
			]
		);

		$this->add_responsive_control(
			'lightbox_content_animation',
			[ 
				'label'     => esc_html__( 'Entrance Animation', 'elementor' ),
				'type'      => Controls_Manager::ANIMATION,
				'condition' => [ 
					'video_open!' => 'file'
				]
			]
		);

		$this->add_control(
			'aspect_ratio',
			[ 
				'label'        => esc_html__( 'Aspect Ratio', 'elementor' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => [ 
					'169' => '16:9',
					'219' => '21:9',
					'43'  => '4:3',
					'32'  => '3:2',
					'11'  => '1:1',
					'916' => '9:16',
				],
				'default'      => '169',
				'prefix_class' => 'elementor-aspect-ratio-',
				'condition'    => [ 
					'video_open!' => 'file'
				]
			]
		);

		$this->add_control(
			'lazy_load',
			[ 
				'label' => esc_html__( 'Lazy Load', 'elementor' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'video_autoplay',
			[ 
				'label' => esc_html__( 'Autoplay', 'elementor' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'mute',
			[ 
				'label' => esc_html__( 'Mute', 'elementor' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);
	}

	protected function general_button_controls_style( $name = 'button', $selector = '.sa-button' ) {
		$this->add_responsive_control(
			$name . '_padding',
			[ 
				'label'      => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					"{{WRAPPER}} $selector" => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name'     => $name . '_typography',
				'label'    => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => "{{WRAPPER}} $selector",
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name'     => $name . '_border',
				'label'    => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => "{{WRAPPER}} $selector",
			]
		);

		$this->add_responsive_control(
			$name . '_border_radius',
			[ 
				'label'      => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					"{{WRAPPER}} $selector" => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->start_controls_tabs( $name . '_tabs_style' );

		$this->start_controls_tab(
			$name . '_tab_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			$name . '_color',
			[ 
				'label'     => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					"{{WRAPPER}} $selector, {{WRAPPER}} $selector:focus" => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'     => $name . '_background',
				'label'    => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => "{{WRAPPER}} $selector, {{WRAPPER}} $selector:focus",
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name'     => $name . '_text_shadow',
				'label'    => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => "{{WRAPPER}} $selector",
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => $name . '_box_shadow',
				'label'    => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => "{{WRAPPER}} $selector",
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			$name . '_tab_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			$name . '_color_hover',
			[ 
				'label'     => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					"{{WRAPPER}} $selector:hover" => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'     => $name . '_background_hover',
				'label'    => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => "{{WRAPPER}} $selector:hover",
			]
		);

		$this->add_control(
			$name . '_border_color_hover',
			[ 
				'label'     => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					"{{WRAPPER}} $selector:hover" => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					$name . '_border_border!' => '',
				],
			]
		);

		$this->add_responsive_control(
			$name . '_border_radius_hover',
			[ 
				'label'      => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [ 
					"{{WRAPPER}} $selector:hover" => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name'     => $name . '_text_shadow_hover',
				'label'    => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => "{{WRAPPER}} $selector:hover",
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => $name . '_box_shadow_hover',
				'label'    => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => "{{WRAPPER}} $selector:hover",
			]
		);

		$this->add_control(
			$name . '_hover_animation',
			[ 
				'label' => esc_html__( 'Animation', 'sky-elementor-addons' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
	}
}
