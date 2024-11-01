<?php

namespace Sky_Addons\Modules\AnimatedGradientBg;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Sky_Addons\Base\Module_Base;

if (!defined('ABSPATH')) {
    exit;
}

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();
        $this->add_actions();
    }

    public function get_name() {
        return 'sky-animated-gradient-bg';
    }

    public function register_section($element) {

        $tab = Controls_Manager::TAB_ADVANCED;

        if ('section' === $element->get_name() || 'column' === $element->get_name() || 'container' === $element->get_name()) {
            $tab = Controls_Manager::TAB_STYLE;
        } else {
            $tab = Controls_Manager::TAB_ADVANCED;
        }

        $element->start_controls_section(
            'section_sky_addons_agbg_controls',
            [
                'tab'                  => $tab,
                'label'                => esc_html__('Animated Gradient Background', 'sky-elementor-addons') . sky_addons_get_icon(),
            ]
        );

        $element->end_controls_section();
    }

    public function register_controls($element, $args) {

        $element->add_control(
            'sa_agbg_enable',
            [
                'label'              => esc_html__('Enable', 'sky-elementor-addons'),
                'type'               => Controls_Manager::SWITCHER,
                'render_type'        => 'template',
                'frontend_available' => true,
            ]
        );

        $sa_agbg_direction_value = sky_addons_init_pro() == true ? true : false;

        $element->add_control(
            'sa_agbg_direction',
            [
                'label'              => esc_html__('Direction', 'sky-elementor-addons') . sky_addons_control_indicator_pro(),
                'type'               => Controls_Manager::SELECT,
                'default'            => 'left-right',
                'options'            => [
                    'left-right' => esc_html__('Left to Right', 'sky-elementor-addons'),
                    'diagonal'   => esc_html__('Diagonal', 'sky-elementor-addons'),
                    'top-bottom' => esc_html__('Top to Bottom', 'sky-elementor-addons'),
                    'radial'     => esc_html__('Radial', 'sky-elementor-addons'),
                    // 'custom'  => esc_html__('custom', 'sky-elementor-addons'), // todo
                ],
                'frontend_available' => $sa_agbg_direction_value,
                'condition'          => [
                    'sa_agbg_enable' => 'yes',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'sa_agbg_start_color',
            [
                'label'     => esc_html__('Start Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
            ]
        );

        $repeater->add_control(
            'sa_agbg_end_color',
            [
                'label'     => esc_html__('End Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
            ]
        );

        $element->add_control(
            'sa_agbg_color_list',
            [
                'label'              => __('Colors', 'sky-elementor-addons'),
                'type'               => Controls_Manager::REPEATER,
                'fields'             => $repeater->get_controls(),
                'prevent_empty'      => false,
                'title_field'        => '{{{ sa_agbg_start_color }}} - {{{ sa_agbg_end_color }}}',
                'default'            => [
                    [

                        'sa_agbg_start_color' => '#8441A4',
                        'sa_agbg_end_color'   => '#E0528D',
                    ],
                    [

                        'sa_agbg_start_color' => '#00F260',
                        'sa_agbg_end_color'   => '#0575E6',
                    ],
                    [

                        'sa_agbg_start_color' => '#e1eec3',
                        'sa_agbg_end_color'   => '#f05053',
                    ],
                ],
                'condition'          => [
                    'sa_agbg_enable' => 'yes',
                ],
                'render_type'        => 'template',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'sa_agbg_transition_speed',
            [
                'label'              => esc_html__('Transition Speed (ms)', 'sky-elementor-addons'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px'             => [
                        'min'        => 1000,
                        'max'        => 10000,
                        'step'       => 500,
                    ],
                ],
                'condition'          => [
                    'sa_agbg_enable' => 'yes',
                ],
                'separator'          => 'before',
                'render_type'        => 'template',
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'sa_agbg_z_index',
            [
                'label'              => esc_html__('Z-index', 'sky-elementor-addons'),
                'type'               => Controls_Manager::NUMBER,
                'dynamic'            => ['active' => true],
                'condition'          => [
                    'sa_agbg_enable' => 'yes'
                ],
                // 'render_type'        => 'template',
                'selectors' => [
                    '#sa-agbg-{{ID}}' => 'z-index: {{VALUE}}',
                ],
                'frontend_available' => true,
            ]
        );

        $element->add_control(
            'sa_agbg_opacity',
            [
                'label'     => esc_html__('Opacity', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '#sa-agbg-{{ID}}' => 'opacity: {{SIZE}}',
                ],
                'condition' => [
                    'sa_agbg_enable' => 'yes'
                ],
            ]
        );
    }

    public function widget_agbg_before_render($widget) {
        $settings                      =  $widget->get_settings_for_display();
        if ($settings['sa_agbg_enable'] == 'yes') {
            wp_enqueue_script('granim');
        }
    }

    protected function add_actions() {

        // section
        add_action(
            'elementor/element/section/section_background/after_section_end',
            [
                $this,
                'register_section'
            ]
        );

        add_action(
            'elementor/element/section/section_sky_addons_agbg_controls/before_section_end',
            [
                $this,
                'register_controls'
            ],
            10,
            2
        );

        // container
        add_action(
            'elementor/element/container/section_background/after_section_end',
            [
                $this,
                'register_section'
            ]
        );

        add_action(
            'elementor/element/container/section_sky_addons_agbg_controls/before_section_end',
            [
                $this,
                'register_controls'
            ],
            10,
            2
        );

        // column
        add_action('elementor/element/column/section_style/after_section_end', [$this, 'register_section']);
        add_action(
            'elementor/element/column/section_sky_addons_agbg_controls/before_section_end',
            [
                $this,
                'register_controls'
            ],
            10,
            2
        );

        // widget
        add_action('elementor/element/common/_section_background/after_section_end', [$this, 'register_section']);
        add_action(
            'elementor/element/common/section_sky_addons_agbg_controls/before_section_end',
            [
                $this,
                'register_controls'
            ],
            10,
            2
        );

        add_action('elementor/frontend/section/before_render', [$this, 'widget_agbg_before_render'], 10, 1);
        add_action('elementor/frontend/container/before_render', [$this, 'widget_agbg_before_render'], 10, 1);
        add_action('elementor/frontend/column/before_render', [$this, 'widget_agbg_before_render'], 10, 1);
        add_action('elementor/frontend/widget/before_render', [$this, 'widget_agbg_before_render'], 10, 1);
    }
}
