<?php

namespace Sky_Addons\Traits;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

trait Global_Swiper_Controls
{
    protected function register_navigation_controls()
    {

        $this->add_control(
            'show_navigation',
            [
                'label'     => esc_html__('Show Navigation', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'prev_icon',
            [
                'label' => esc_html__('Prev Icon', 'sky-elementor-addons'),
                'type'  => Controls_Manager::ICONS,
                'condition' => ['show_navigation' => 'yes']
            ]
        );

        $this->add_control(
            'next_icon',
            [
                'label' => esc_html__('Next Icon', 'sky-elementor-addons'),
                'type'  => Controls_Manager::ICONS,
                'condition' => ['show_navigation' => 'yes']
            ]
        );

    }

    protected function register_pagination_controls($name)
    {

        $this->add_control(
            'pagination_type',
            [
                'label'   => esc_html__('Type', 'sky-elementor-addons'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'bullets',
                'options' => [
                    'none'        => esc_html__('None', 'sky-elementor-addons'),
                    'bullets'     => esc_html__('Bullets', 'sky-elementor-addons'),
                    'fraction'    => esc_html__('Fraction', 'sky-elementor-addons'),
                    'progressbar' => esc_html__('Progress Bar', 'sky-elementor-addons'),
                    // 'thumbs'      => esc_html__('Thumbs', 'sky-elementor-addons'),
                ],
            ]
        );

        $this->add_control(
            'dynamic_bullets',
            [
                'label'     => esc_html__('Dynamic Bullets', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'pagination_type' => 'bullets',
                    'pagination_type!' => 'none'
                ]
            ]
        );

        $this->add_control(
            'progressbar_position',
            [
                'label'                => esc_html__('Progress Bar Position', 'sky-elementor-addons'),
                'type'                 => Controls_Manager::SELECT,
                'default'              => 'bottom',
                'options'              => [
                    'bottom' => esc_html__('Bottom', 'sky-elementor-addons'),
                    // 'top'    => esc_html__('Top', 'sky-elementor-addons'), //todo
                ],
                'selectors'            => [
                    '{{WRAPPER}} .sa-' . $name . ' .swiper-pagination-progressbar' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'bottom' => '',
                    'top'    => 'top: 0; bottom: unset;',
                ],
                'condition'            => [
                    'pagination_type' => 'progressbar',
                    'direction'       => 'horizontal',
                    'pagination_type!' => 'none'
                ]
            ]
        );

        $this->add_control(
            'progressbar_position_vertical',
            [
                'label'                => esc_html__('Progress Bar Position', 'sky-elementor-addons'),
                'type'                 => Controls_Manager::SELECT,
                'default'              => 'left',
                'options'              => [
                    'left'  => esc_html__('Left', 'sky-elementor-addons'),
                    'right' => esc_html__('Right', 'sky-elementor-addons'),
                ],
                'selectors'            => [
                    '{{WRAPPER}} .sa-' . $name . ' .swiper-vertical > .swiper-pagination-progressbar' => '{{VALUE}}',
                ],
                'selectors_dictionary' => [
                    'left'  => '',
                    'right' => 'right: 0; left: unset;',
                ],
                'condition'            => [
                    'pagination_type' => 'progressbar',
                    'direction'       => 'vertical',
                    'pagination_type!' => 'none'
                ]
            ]
        );

        $this->add_responsive_control(
            'pagination_alignment',
            [
                'label'     => esc_html__('Alignment', 'sky-elementor-addons'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [
                        'title' => esc_html__('Left', 'sky-elementor-addons'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => esc_html__('Center', 'sky-elementor-addons'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => esc_html__('Right', 'sky-elementor-addons'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'conditions' => [
                    'relation' => 'and',
                    'terms' => [
                        [
                            'name' => 'pagination_type',
                            'operator' => '!=',
                            'value' => 'progressbar'
                        ],
                        [
                            'name' => 'pagination_type',
                            'operator' => '!=',
                            'value' => 'none'
                        ],
                        [
                            'name' => 'pagination_type',
                            'operator' => '!=',
                            'value' => 'none'
                        ]
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-' . $name . ' .swiper-pagination' => 'text-align: {{VALUE}};',
                ],
            ]
        );

    }

    protected function register_item_style_controls($name)
    {
    }

    protected function register_navigation_style_controls($name)
    {
        $this->start_controls_section(
            'section_carousel_navigation_style',
            [
                'label'     => esc_html__('Navigation', 'sky-elementor-addons'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_navigation' => 'yes'
                ]
            ]
        );


        $this->add_responsive_control(
            'navigation_size',
            [
                'label'      => esc_html__('Size', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 5,
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-' . $name => '--sa-navigation-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'navigation_position',
            [
                'label'        => esc_html__('Position', 'sky-elementor-addons'),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'navigation_horizontal',
            [
                'label'      => esc_html__('Horizontal', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => -100,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-' . $name => '--sa-navigation-h-spacing: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'navigation_vertical',
            [
                'label'      => esc_html__('Vertical', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => -100,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-prev, {{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-next' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_popover();

        $this->add_responsive_control(
            'navigation_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-prev, {{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'navigation_border',
                'label'    => esc_html__('Border', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-prev, {{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-next',
            ]
        );

        $this->add_responsive_control(
            'navigation_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-prev, {{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->start_controls_tabs('navigation_tabs');

        $this->start_controls_tab(
            'navigation_tab_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons'),
            ]
        );

        $this->add_control(
            'navigation_color',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-prev, {{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-next'             => 'color: {{VALUE}}',
                    '{{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-prev svg *, {{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-next svg *' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'navigation_bg',
                'label'    => esc_html__('Background', 'sky-elementor-addons'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-prev, {{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-next',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'navigation_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-prev, {{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-next',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'navigation_box_shadow',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-prev, {{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-next',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'navigation_tab_hover',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons'),
            ]
        );

        $this->add_control(
            'navigation_color_hover',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-next:hover'             => 'color: {{VALUE}}',
                    '{{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-prev:hover svg *, {{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-next:hover svg *' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'navigation_bg_hover',
                'label'    => esc_html__('Background', 'sky-elementor-addons'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-next:hover',
            ]
        );

        $this->add_control(
            'navigation_border_color_hover',
            [
                'label'     => esc_html__('Border Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-next:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation_border_border!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'navigation_text_shadow_hover',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-next:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'navigation_box_shadow_hover',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-' . $name . ' .sa-swiper-button-next:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function register_pagination_style_controls($name)
    {
        $this->start_controls_section(
            'section_carousel_pagination_style',
            [
                'label'     => esc_html__('Pagination', 'sky-elementor-addons'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'pagination_type!' => 'none'
                ]
            ]
        );

        $this->add_responsive_control(
            'pagination_position_vertical',
            [
                'label'      => esc_html__('Vertical Position', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -50,
                        'max'  => 100,
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-' . $name . ' .swiper-pagination' => '--sa-pagination-v-spacing: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'bullet_size_height',
            [
                'label'      => esc_html__('Bullet Height', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 50,
                        'step' => .5,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-' . $name => '--sa-pagination-bullet-height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => ['pagination_type' => 'bullets']
            ]
        );

        $this->add_responsive_control(
            'bullet_size_width',
            [
                'label'      => esc_html__('Bullet Width', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 50,
                        'step' => .5,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-' . $name => '--sa-pagination-bullet-width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => ['pagination_type' => 'bullets']
            ]
        );

        $this->add_responsive_control(
            'bullet_radius',
            [
                'label'      => esc_html__('Bullet Radius(%)', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range'      => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-' . $name => '--sa-pagination-bullet-radius: {{SIZE}}%;',
                ],
                'condition'  => ['pagination_type' => 'bullets']
            ]
        );

        $this->add_responsive_control(
            'bullet_spacing',
            [
                'label'      => esc_html__('Bullet Spacing', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min'  => 4,
                        'max'  => 20,
                        'step' => .5,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-' . $name . ' .swiper-pagination-bullets .swiper-pagination-bullet' => 'margin: 0px {{SIZE}}{{UNIT}};',
                ],
                'condition'  => ['pagination_type' => 'bullets']
            ]
        );


        $this->add_responsive_control(
            'pagination_progress_size',
            [
                'label'      => esc_html__('Progress Size', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 10,
                        'step' => .5,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-' . $name => '--sa-pagination-progress-size: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => ['pagination_type' => 'progressbar']
            ]
        );

        $this->add_control(
            'pagination_color',
            [
                'label'     => esc_html__('Pagination Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-' . $name => '--sa-pagination-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'pagination_active_color',
            [
                'label'     => esc_html__('Pagination Active Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-' . $name => '--sa-pagination-active-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'pagination_fraction_typography',
                'label'     => esc_html__('Typography', 'sky-elementor-addons'),
                'selector'  => '{{WRAPPER}} .sa-' . $name . ' .swiper-pagination-fraction',
                'condition' => ['pagination_type' => 'fraction']
            ]
        );

        $this->end_controls_section();
    }

    protected function register_carousel_settings_controls($name)
    {

        /*
        $this->add_responsive_control(
            'carousel_height',
            [
                'label'      => esc_html__('Height', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min'  => 100,
                        'max'  => 500,
                        'step' => 5,
                    ]
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-' . $name . ' .swiper' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .sa-' . $name . ' .swiper' => 'height: {{SIZE}}{{UNIT}};',
                ],
                // 'render_type'     => 'template',
            ]
        );
        */

        $this->add_responsive_control(
            'item_gap',
            [
                'label'   => esc_html__('Item Gap', 'sky-elementor-addons'),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 20,
                ],
                'tablet_default' => [
                    'size' => 20,
                ],
                'mobile_default' => [
                    'size' => 10,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
            ]
        );

        $this->add_control(
            'direction',
            [
                'label'   => esc_html__('Direction', 'sky-elementor-addons'),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'horizontal',
                'options' => [
                    'horizontal' => esc_html__('Horizontal', 'sky-elementor-addons'),
                    // 'vertical'   => esc_html__('Vertical', 'sky-elementor-addons'),
                ],
                'render_type'     => 'template',
            ]
        );

        $this->add_control(
            'transition_effect',
            [
                'label'   => esc_html__('Transition Effect', 'sky-elementor-addons'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => [
                    'slide'     => esc_html__('Slide', 'sky-elementor-addons'),
                    'coverflow' => esc_html__('Coverflow', 'sky-elementor-addons'),
                ],
            ]
        );

        // $this->add_control(
        //     'cross_fade',
        //     [
        //         'label'     => esc_html__('Cross Fade', 'sky-elementor-addons'),
        //         'type'      => Controls_Manager::SWITCHER,
        //         'default'   => 'yes',
        //         'condition' => [
        //             'transition_effect' => 'fade',
        //         ],
        //     ]
        // );

        $this->add_control(
            'coverflow_toggle',
            [
                'label'        => esc_html__('Coverflow Effect', 'sky-elementor-addons'),
                'type'         => Controls_Manager::POPOVER_TOGGLE,
                'return_value' => 'yes',
                'condition'    => [
                    'transition_effect' => 'coverflow'
                ]
            ]
        );

        $this->start_popover();

        $this->add_control(
            'coverflow_depth',
            [
                'label'     => esc_html__('Depth', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 10,
                    ],
                ],
                'default'   => [
                    'unit' => 'px',
                    'size' => 100,
                ],
                'render_type' => 'template',
                'condition' => [
                    'coverflow_toggle' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'coverflow_modifier',
            [
                'label'     => esc_html__('Modifier', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 10,
                    ],
                ],
                'default'   => [
                    'unit' => 'px',
                    'size' => 1,
                ],
                'render_type' => 'template',
                'condition' => [
                    'coverflow_toggle' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'coverflow_rotate',
            [
                'label'     => esc_html__('Rotate', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 5,
                    ],
                ],
                'default'   => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'render_type' => 'template',
                'condition' => [
                    'coverflow_toggle' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'coverflow_stretch',
            [
                'label'     => esc_html__('Stretch', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                    ],
                ],
                'default'   => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'render_type' => 'template',
                'condition' => [
                    'coverflow_toggle' => 'yes',
                ],
            ]
        );

        $this->end_popover();

        $this->add_control(
            'slide_shadows',
            [
                'label'     => esc_html__('Slide Shadows', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'transition_effect' => ['coverflow'],
                ],
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'   => esc_html__('Autoplay', 'sky-elementor-addons'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'     => esc_html__('Autoplay Speed (ms)', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 1000,
                        'max'  => 10000,
                    ],
                ],
                'default'   => [
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
                'label'   => esc_html__('Loop', 'sky-elementor-addons'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'speed',
            [
                'label'   => esc_html__('Slide Speed (ms)', 'sky-elementor-addons'),
                'type'    => Controls_Manager::SLIDER,
                'range'   => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 5000,
                        'step' => 500,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 500,
                ],
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => esc_html__('Pause On Hover', 'sky-elementor-addons'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_responsive_control(
            'slides_per_group',
            [
                'label'           => esc_html__('Slides Per Group', 'sky-elementor-addons'),
                'type'            => Controls_Manager::SELECT,
                'options'         => [
                    1 => esc_html__('1', 'sky-elementor-addons'),
                    2 => esc_html__('2', 'sky-elementor-addons'),
                    3 => esc_html__('3', 'sky-elementor-addons'),
                    4 => esc_html__('4', 'sky-elementor-addons'),
                    5 => esc_html__('5', 'sky-elementor-addons'),
                    6 => esc_html__('6', 'sky-elementor-addons'),
                ],
                'default' => 1,
                'tablet_default'  => 1,
                'mobile_default'  => 1,
                'render_type'     => 'template',
            ]
        );

        $this->add_control(
            'observer',
            [
                'label'       => esc_html__('Observer', 'sky-elementor-addons'),
                'type'        => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'separator'   => 'before',
                'description' => esc_html__('Note: Please use it when you using slider on a hidden element.', 'sky-elementor-addons'),
            ]
        );

        $this->add_control(
            'centered_slides',
            [
                'label'       => esc_html__('Centered Slides', 'sky-elementor-addons'),
                'type'        => Controls_Manager::SWITCHER,
                'default'   => 'no',
            ]
        );

        $this->add_control(
            'grab_cursor',
            [
                'label'       => esc_html__('Grab Cursor', 'sky-elementor-addons'),
                'type'        => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'free_mode',
            [
                'label'       => esc_html__('Free Mode', 'sky-elementor-addons'),
                'type'        => Controls_Manager::SWITCHER,
            ]
        );

    }

    protected function render_header_attributes($widget_name)
    {
        $settings = $this->get_settings_for_display();
        $id       = 'sa-' . $widget_name . '-' . $this->get_id();

        // $test  = !empty($settings["item_gap"]["size"]) || ($settings["item_gap"]["size"] === 0)  ? (int)$settings["item_gap"]["size"] : 16;
        // print_r($test);

        $elementor_vp_lg = get_option('elementor_viewport_lg');
        $elementor_vp_md = get_option('elementor_viewport_md');
        $viewport_lg     = !empty($elementor_vp_lg) ? $elementor_vp_lg - 1 : 1023;
        $viewport_md     = !empty($elementor_vp_md) ? $elementor_vp_md - 1 : 767;

        $columns_mobile = isset($settings["columns_mobile"]) ? (int)$settings["columns_mobile"] : 1;
        $columns_tablet = isset($settings["columns_tablet"]) ? (int)$settings["columns_tablet"] : 2;
        $columns        = isset($settings["columns"]) ? (int)$settings["columns"] : 3;


        /**
         * todo
         * Below Columns specially design for decimal/float views
         * Will ne use later
         * Need to test in panel slider widget
         */
        // $columns_mobile = isset($settings["columns_mobile"]) && is_float($settings["columns_mobile"]) ? $settings["columns_mobile"] : $columns_mobile;
        // $columns_tablet = isset($settings["columns_tablet"]) && is_float($settings["columns_tablet"]) ? $settings["columns_tablet"] : $columns_tablet;
        // $columns = isset($settings["columns"]) && is_float($settings["columns"]) ? $settings["columns"] : $columns;

        $pagination_type = $settings['pagination_type'] != 'none' ? $settings['pagination_type'] : false;

        $this->add_render_attribute(
            [
                'carousel' => [
                    'data-settings' => [
                        wp_json_encode(array_filter([
                            'direction'      => $settings["direction"],
                            'autoplay'       => $settings["autoplay"] == 'yes' ? [
                                "delay"      => $settings["autoplay_speed"]['size']
                            ]                :  false,
                            'loop'           => ($settings['loop'] == 'yes') ? true : false,
                            'speed'          => (!empty($settings['speed']['size'])) ? $settings['speed']['size'] : 500,
                            'pauseOnHover'   => ($settings["autoplay"] == 'yes' && $settings["pause_on_hover"] == 'yes') ? true : false,
                            "slidesPerView"  => $columns_mobile,
                            "slidesPerGroup" => isset($settings["slides_per_group_mobile"]) ? (int)$settings["slides_per_group_mobile"] : 1,
                            "spaceBetween"   => !empty($settings["item_gap_mobile"]["size"]) || ($settings["item_gap"]["size"] === 0) ? (int)$settings["item_gap_mobile"]["size"] : 10,
                            'centeredSlides' => $settings['centered_slides'] == 'yes' ? true : false,
                            "grabCursor"     => $settings["grab_cursor"] == "yes"  ? true : false,
                            "freeMode"     => $settings["free_mode"] == "yes"  ? true : false,

                            // start effect
                            'effect'          => $settings['transition_effect'],
                            // 'fadeEffect'      => (isset($settings['cross_fade']) && $settings['cross_fade'] == 'yes') ? true : false,
                            'coverflowEffect' => [
                                'depth'    => ($settings['coverflow_toggle'] == 'yes' && (!empty($settings['coverflow_depth']['size']) && $settings['coverflow_depth']['size'] === 0)) ? $settings['coverflow_depth']['size'] : 100,
                                'modifier' => ($settings['coverflow_toggle'] == 'yes' && (!empty($settings['coverflow_modifier']['size']) && $settings['coverflow_modifier']['size'] === 0)) ? $settings['coverflow_modifier']['size'] : 1,
                                'rotate'   => ($settings['coverflow_toggle'] == 'yes' && (!empty($settings['coverflow_rotate']['size']) || $settings['coverflow_rotate']['size'] === 0)) ? $settings['coverflow_rotate']['size'] : 50,
                                'stretch'  => ($settings['coverflow_toggle'] == 'yes' && (!empty($settings['coverflow_stretch']['size']) || $settings['coverflow_stretch']['size'] === 0)) ? $settings['coverflow_stretch']['size'] : 0,

                                'slideShadows' => (isset($settings['slide_shadows']) && $settings['slide_shadows'] == 'yes') ? true : false,
                            ],
                            'flipEffect'      => [
                                'slideShadows' => (isset($settings['slide_shadows']) && $settings['slide_shadows'] == 'yes') ? true : false,
                            ],
                            'cubeEffect'      => [
                                'slideShadows' => (isset($settings['slide_shadows']) && $settings['slide_shadows'] == 'yes') ? true : false,
                            ],
                            // end effect

                            'observer'        => $settings['observer'] == 'yes' ? true : false,
                            "observeParents"  => $settings["observer"] == 'yes' ? true : false,
                            "watchSlidesVisibility" => true,
                            "watchSlidesProgress"   => true,

                            "breakpoints"           => [
                                (int) $viewport_md => [
                                    "slidesPerView"  => $columns_tablet,
                                    "spaceBetween"   => !empty($settings["item_gap_tablet"]["size"]) || ($settings["item_gap"]["size"] === 0) ? (int)$settings["item_gap_tablet"]["size"] : 16,
                                    "slidesPerGroup" => isset($settings["slides_per_group_tablet"]) ? (int)$settings["slides_per_group_tablet"] : 1,
                                ],
                                (int) $viewport_lg => [
                                    "slidesPerView"  => $columns,
                                    "spaceBetween"   => !empty($settings["item_gap"]["size"]) || ($settings["item_gap"]["size"] === 0) ? (int)$settings["item_gap"]["size"] : 16,
                                    "slidesPerGroup" => isset($settings["slides_per_group"]) ? (int)$settings["slides_per_group"] : 1,
                                ]
                            ],
                            'navigation'      => [
                                'nextEl' => "#$id .sa-swiper-button-next",
                                'prevEl' => "#$id .sa-swiper-button-prev",
                            ],
                            'pagination'      => [
                                'el'             => "#$id .swiper-pagination",
                                'clickable'      => true,
                                'type'           => $pagination_type,
                                'dynamicBullets' => (isset($settings['dynamic_bullets']) && ($settings['dynamic_bullets'] == 'yes')) ? true : false,
                            ],
                            "scrollbar"             => [
                                "el"   => "#$id .swiper-scrollbar",
                                "hide" => "true",
                            ],
                        ]))
                    ]
                ]
            ]
        );
    }

    public function render_pagination()
    {
?>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>
    <?php
    }

    public function render_navigation()
    {
        $settings = $this->get_settings_for_display();
    ?>
        <!-- If we need navigation buttons -->
        <div class="sa-swiper-button-prev sa-slider-navigation sa-icon-wrap">
            <?php
            if (!empty($settings['prev_icon']['value'])) :
                Icons_Manager::render_icon($settings['prev_icon'], [
                    'aria-hidden' => 'true',
                    'class'       => 'fa-fw'
                ]);
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
            if (!empty($settings['next_icon']['value'])) :
                Icons_Manager::render_icon($settings['next_icon'], [
                    'aria-hidden' => 'true',
                    'class'       => 'fa-fw'
                ]);
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

    public function render_footer()
    {
        $settings = $this->get_settings_for_display();
    ?>
        </div>
        </div>

        <?php
        if (isset($settings['show_navigation']) && $settings['show_navigation'] == 'yes') :
            $this->render_navigation();
        endif;

        if (isset($settings['pagination_type']) && $settings['pagination_type'] != 'none') :
            $this->render_pagination();
        endif;
        ?>
        </div>
<?php }
}
