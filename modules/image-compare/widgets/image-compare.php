<?php

namespace Sky_Addons\Modules\ImageCompare\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Widget_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Image_Compare extends Widget_Base
{

    public function get_name()
    {
        return 'sky-image-compare';
    }

    public function get_title()
    {
        return esc_html__('Image Compare', 'sky-elementor-addons');
    }

    public function get_icon()
    {
        return 'sky-icon-image-compare';
    }

    public function get_categories()
    {
        return ['sky-elementor-addons'];
    }

    public function get_keywords()
    {
        return ['sky', 'image', 'compare'];
    }

    public function get_script_depends()
    {
        return ['sa-image-compare'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'section_ic_layout',
            [
                'label' => esc_html__('Image Compare', 'sky-elementor-addons'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image_before',
            [
                'label'   => esc_html__('Before Image', 'sky-elementor-addons'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => ['active' => true],
            ]
        );

        $this->add_control(
            'image_after',
            [
                'label'   => esc_html__('After Image', 'sky-elementor-addons'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => ['active' => true],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
                'default'   => 'large',
                'separator' => 'none',
            ]
        );


        $this->add_control(
            'show_labels',
            [
                'label'     => esc_html__('Show Labels', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'before_text',
            [
                'label'     => esc_html__('Before Text', 'sky-elementor-addons'),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__('Before', 'sky-elementor-addons'),
                'dynamic'   => ['active' => true],
                'condition' => [
                    'show_labels' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'after_text',
            [
                'label'     => esc_html__('After Text', 'sky-elementor-addons'),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__('After', 'sky-elementor-addons'),
                'dynamic'   => ['active' => true],
                'condition' => [
                    'show_labels' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'label_options_on_hover',
            [
                'label'        => esc_html__('Show Label Options on Hover', 'sky-elementor-addons'),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'sa-labels-on-hover-',
                'condition'    => [
                    'show_labels' => 'yes',
                ],
                'render_type'  => 'template'
            ]
        );

        //vertical_mode

        $this->add_control(
            'labels_position',
            [
                'label'          => esc_html__('Labels Position', 'sky-elementor-addons'),
                'type'           => Controls_Manager::CHOOSE,
                'label_block'    => false,
                'options'        => [
                    'top'    => [
                        'title' => esc_html__('Top', 'sky-elementor-addons'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => esc_html__('Middle', 'sky-elementor-addons'),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'sky-elementor-addons'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'style_transfer' => true,
                'toggle'         => false,
                'default'        => 'bottom',
                //                'desktop_default'      => 'bottom',
                //                'tablet_default'       => 'bottom',
                //                'mobile_default'       => 'bottom',
                //                'selectors'            => [
                //                        '{{WRAPPER}} .icv__label' => '{{VALUE}};',
                //                ],
                //                'prefix_class'         => 'sa-list-layout-%s-',
                'prefix_class'   => 'sa-labels-position-',
                //                'selectors_dictionary' => [
                //                        'top'  => 'top: 1rem; bottom: unset;',
                //                        'middle' => 'top: 50%; transform: translateY(-50%); bottom: unset;',
                //                        'bottom' => 'bottom: 1rem; top:unset;',
                //                ],
                'condition'      => [
                    'vertical_mode!' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'labels_position_vertical',
            [
                'label'          => esc_html__('Labels Position Vertical', 'sky-elementor-addons'),
                'type'           => Controls_Manager::CHOOSE,
                'label_block'    => false,
                'options'        => [
                    'left'   => [
                        'title' => esc_html__('Left', 'sky-elementor-addons'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'sky-elementor-addons'),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'sky-elementor-addons'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'style_transfer' => true,
                'toggle'         => true,
                'default'        => 'left',
                'prefix_class'   => 'sa-labels-position-vertical-',
                'condition'      => [
                    'vertical_mode' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'show_content',
            [
                'label'     => esc_html__('Show Content', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SWITCHER,
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_ic_content',
            [
                'label'     => esc_html__('Content', 'sky-elementor-addons'),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'show_content' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label'   => esc_html__('Title', 'sky-elementor-addons'),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__('Before & After', 'sky-elementor-addons'),
                'dynamic' => ['active' => true],
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'   => esc_html__('Title HTML Tag', 'sky-elementor-addons'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => sky_title_tags(),
            ]
        );

        $this->add_control(
            'content',
            [
                'label'       => esc_html__('Content', 'sky-elementor-addons'),
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 5,
                'default'     => esc_html__('-Lorem ipsum dolor sit amet, consectetur adipiscing elit-', 'sky-elementor-addons'),
                'placeholder' => esc_html__('Type your content here', 'sky-elementor-addons'),
                'dynamic'     => ['active' => true],
            ]
        );

        $this->add_responsive_control(
            'content_wrapper_position',
            [
                'label'                => esc_html__('Content Area Position', 'sky-elementor-addons'),
                'type'                 => Controls_Manager::CHOOSE,
                'label_block'          => false,
                'options'              => [
                    'top'    => [
                        'title' => esc_html__('Top', 'sky-elementor-addons'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'middle' => [
                        'title' => esc_html__('Middle', 'sky-elementor-addons'),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'sky-elementor-addons'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'style_transfer'       => true,
                'toggle'               => false,
                //                'desktop_default'      => 'middle',
                //                'tablet_default'       => 'middle',
                //                'mobile_default'       => 'middle',
                'default'              => 'middle',
                'selectors'            => [
                    '{{WRAPPER}} .sa-content-wrapper' => '{{VALUE}};',
                ],
                //                'prefix_class'         => 'sa-list-layout-%s-',
                // 'prefix_class'   => 'sa-labels-position-',
                'selectors_dictionary' => [
                    'top'    => 'top: 1.5em;left: 50%;transform: translateX(-50%); bottom: unset;',
                    'middle' => 'top: 50%;transform: translate(-50%, -50%);left: 50%; bottom: unset;',
                    'bottom' => 'bottom: 1.5em;left: 50%;transform: translateX(-50%); top: unset;',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_ic_settings',
            [
                'label' => esc_html__('Settings', 'sky-elementor-addons'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'vertical_mode',
            [
                'label' => esc_html__('Vertical Mode', 'sky-elementor-addons'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        // UI Theme Defaults

        $this->add_control(
            'ui_options_heading',
            [
                'label'     => esc_html__('UI Options', 'sky-elementor-addons'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'control_color',
            [
                'label' => esc_html__('Control Color', 'sky-elementor-addons'),
                'type'  => Controls_Manager::COLOR,
            ]
        );

        $this->add_control(
            'control_shadow',
            [
                'label'   => esc_html__('Control Shadow', 'sky-elementor-addons'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'add_circle',
            [
                'label' => esc_html__('Add Circle', 'sky-elementor-addons'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'add_circle_blur',
            [
                'label'     => esc_html__('Add Circle Blur', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SWITCHER,
                'condition' => [
                    'add_circle' => 'yes',
                ]
            ]
        );

        //Smoothing

        $this->add_control(
            'smoothing_option_heading',
            [
                'label'     => esc_html__('Smoothing', 'sky-elementor-addons'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'smoothing',
            [
                'label'   => esc_html__('Smoothing', 'sky-elementor-addons'),
                'type'    => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'smoothing_amount',
            [
                'label'     => esc_html__('Smoothing Amount', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'default'   => [
                    'unit' => 'px',
                    'size' => 100,
                ],
                'condition' => [
                    'smoothing' => 'yes',
                ]
            ]
        );


        // Other options

        $this->add_control(
            'other_options_heading',
            [
                'label'     => esc_html__('Other Options', 'sky-elementor-addons'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'hover_start',
            [
                'label' => esc_html__('Hover Start', 'sky-elementor-addons'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'starting_point',
            [
                'label'   => esc_html__('Starting Point', 'sky-elementor-addons'),
                'type'    => Controls_Manager::SLIDER,
                'range'   => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
            ]
        );

        $this->add_control(
            'starting_point_note',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => esc_html__('The percentage to show of the before image.', 'sky-elementor-addons'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ]
        );

        $this->add_control(
            'fluid_mode',
            [
                'label' => esc_html__('Fluid Mode', 'sky-elementor-addons'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'fluid_mode_note',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => esc_html__('While by default a viewers height is set by the image, you must set your own height when using fluid mode.', 'sky-elementor-addons'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition'       => [
                    'fluid_mode' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'fluid_mode_height',
            [
                'label'      => esc_html__('Height', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 600,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 300,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-image-compare' => ' width: 100%; height: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'fluid_mode' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_ic_overlay_style',
            [
                'label' => esc_html__('Overlay', 'sky-elementor-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'overlay',
            [
                'label'        => esc_html__('Overlay', 'sky-elementor-addons'),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'sa-overlay-',
            ]
        );

        $this->add_control(
            'overlay_color',
            [
                'label'     => esc_html__('Overlay Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-image-compare:before' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'overlay' => 'yes',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_ic_labels_style',
            [
                'label'     => esc_html__('Labels', 'sky-elementor-addons'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_labels' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'labels_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .icv__label',
            ]
        );

        $this->add_control(
            'labels_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .icv__label' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'labels_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons'),
                'types'    => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .icv__label',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'labels_border',
                'label'    => esc_html__('Border', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .icv__label',
            ]
        );

        $this->add_responsive_control(
            'labels_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .icv__label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'labels_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .icv__label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            [
                'label'     => esc_html__('Content', 'sky-elementor-addons'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_content' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'content_wrapper_width',
            [
                'label'     => esc_html__('Width', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 40,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'unit' => 'px',
                    'size' => 70,
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-content-wrapper' => 'width: {{SIZE}}%;',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label'      => esc_html__('Spacing', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-content-wrapper  .sa-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_wrapper_align',
            [
                'label'                => esc_html__('Alignment', 'sky-elementor-addons'),
                'type'                 => Controls_Manager::CHOOSE,
                'label_block'          => false,
                'options'              => [
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
                    'justify' => [
                        'title' => esc_html__('Justify', 'sky-elementor-addons'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'toggle'               => false,
                'desktop_default'      => 'top',
                'tablet_default'       => 'top',
                'mobile_default'       => 'top',
                //                'prefix_class'         => 'sa-card-%s-',
                'style_transfer'       => true,
                'selectors'            => [
                    '{{WRAPPER}} .sa-content-wrapper' => '{{VALUE}};',
                ],
                'selectors_dictionary' => [
                    'left'    => 'text-align: left;',
                    'center'  => 'text-align: center;',
                    'right'   => 'text-align: right;',
                    'justify' => 'text-align: justify;'
                ]
            ]
        );


        $this->add_responsive_control(
            'content_wrapper_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_wrapper_margin',
            [
                'label'      => esc_html__('Margin', 'sky-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-content-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'content_wrapper_background',
                'label'    => esc_html__('Background', 'sky-elementor-addons'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-content-wrapper',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'content_wrapper_border',
                'label'    => esc_html__('Border', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-content-wrapper',
            ]
        );

        $this->add_responsive_control(
            'content_wrapper_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'content_wrapper_box_shadow',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-content-wrapper',
            ]
        );

        $this->start_controls_tabs('content_tabs');

        $this->start_controls_tab(
            'content_tab_title',
            [
                'label' => esc_html__('Title', 'sky-elementor-addons'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-content-wrapper .sa-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_background',
            [
                'label'     => esc_html__('Background', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-content-wrapper  .sa-title' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-content-wrapper  .sa-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-content-wrapper  .sa-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'title_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-content-wrapper  .sa-title',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'content_tab_text',
            [
                'label' => esc_html__('Text', 'sky-elementor-addons'),
            ]
        );


        $this->add_control(
            'content_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-content-wrapper .sa-content' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'content_background',
            [
                'label'     => esc_html__('Background', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-content-wrapper .sa-content' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-content-wrapper .sa-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-content-wrapper .sa-content',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'content_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-content-wrapper  .sa-content',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function content()
    {
        $settings = $this->get_settings_for_display();
?>
        <div class="keep sa-content-wrapper sa-p-3">
            <?php
            if (!empty($settings['title'])) {
                printf(
                    '<%1$s class="%2$s">%3$s</%1$s>',
                    esc_attr(Utils::validate_html_tag($settings['title_tag'])),
					'sa--title sa-title sa-fs-2 sa-fw-bolder sa-mt-0 sa-mb-2',
                    wp_kses_post($settings['title'])
                );
            }
            ?>
            <?php if (!empty($settings['content'])) : ?>
                <div class="sa-content sa-fw-bolder">
                    <?php echo esc_html($settings['content']); ?>
                </div>
            <?php endif; ?>
        </div>
    <?php
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute(
            [
                'image-compare' => [
                    'id'            => 'image-compare-' . $this->get_id(),
                    'class'         => 'sa-image-compare',
                    'data-settings' => [
                        wp_json_encode(
                            [
                                'id'                  => 'image-compare-' . $this->get_id(),
                                // Label Defaults
                                'showLabels'          => ($settings['show_labels'] == 'yes' ? true : false),
                                'labelBefore'         => isset($settings['before_text']) ? (!empty($settings['before_text']) ? $settings['before_text'] : 'Before') : false,
                                'labelAfter'          => isset($settings['after_text']) ? (!empty($settings['after_text']) ? $settings['after_text'] : 'After') : false,
                                'labelOptionsonHover' => $settings['label_options_on_hover'] == 'yes' ? true : false,
                                // UI Theme Defaults
                                'controlColor'        => !empty($settings['control_color']) ? $settings['control_color'] : '#FFFFFF',
                                'controlShadow'       => $settings['control_shadow'] == 'yes' ? true : false,
                                'addCircle'           => $settings['add_circle'] == 'yes' ? true : false,
                                'addCircleBlur'       => (isset($settings['add_circle_blur']) && $settings['add_circle_blur'] == 'yes') ? true : false,
                                // Smoothing
                                'smoothing'           => ($settings['smoothing'] == 'yes' ? true : false),
                                'smoothingAmount'     => ($settings['smoothing'] == 'yes' && !empty($settings['smoothing_amount']['size'])) ? $settings['smoothing_amount']['size'] : 100,
                                // Other options
                                'hoverStart'          => $settings['hover_start'] == 'yes' ? true : false,
                                'verticalMode'        => $settings['vertical_mode'] == 'yes' ? true : false,
                                'startingPoint'       => !empty($settings['starting_point']['size']) ? $settings['starting_point']['size'] : 50,
                                'fluidMode'           => $settings['fluid_mode'] == 'yes' ? true : false,
                            ]
                        ),
                    ],
                ],
            ]
        );

    ?>
        <div <?php $this->print_render_attribute_string('image-compare'); ?>>
            <?php
            if ($settings['show_content'] == 'yes') {
                $this->content();
            }
            echo wp_kses_post(Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image_before'));
            echo wp_kses_post(Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image_after'));
            ?>
        </div>
<?php
    }
}
