<?php

namespace Sky_Addons\Modules\EqualHeight;

use Elementor\Controls_Manager;
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
        return 'sky-equal-height';
    }

    public function register_section($element) {
        $element->start_controls_section(
            'section_sky_addons_equal_height_controls',
            [
                'tab'                  => Controls_Manager::TAB_ADVANCED,
                'label'                => esc_html__('Equal Height ', 'sky-elementor-addons') . sky_addons_get_icon(),
            ]
        );
        $element->end_controls_section();
    }

    public function register_controls($widget, $args) {

        $widget->add_control(
            'sa_eqh_enable',
            [
                'label'                => esc_html__('Enable', 'sky-elementor-addons'),
                'type'                 => Controls_Manager::SWITCHER,
                'render_type'          => 'template',
                'frontend_available'   => true,
            ]
        );

        $widget->add_control(
            'sa_eqh_apply_elements',
            [
                'label'                => esc_html__('Apply Elements', 'sky-elementor-addons'),
                'type'                 => Controls_Manager::SELECT,
                'default'              => 'widgets',
                'options'              => [
                    'widgets'     => esc_html__('Widgets', 'sky-elementor-addons'),
                    'widgets_1st' => esc_html__('Widgets > 1st Element', 'sky-elementor-addons'),
                    'widgets_1st_2nd' => esc_html__('Widgets > 2nd Element', 'sky-elementor-addons'),
                    'widgets_1st_3rd' => esc_html__('Widgets > 3rd Element', 'sky-elementor-addons'),
                    'widgets_2nd' => esc_html__('Widgets > Child > 1st Element', 'sky-elementor-addons'),
                    'widgets_2nd_2nd' => esc_html__('Widgets > Child > 2nd Element', 'sky-elementor-addons'),
                    'widgets_3rd' => esc_html__('Widgets > Child > Child > 1st Element', 'sky-elementor-addons'),
                    'custom'     => esc_html__('Custom', 'sky-elementor-addons'),
                ],
                'frontend_available'   => true,
                'condition'            => [
                    'sa_eqh_enable'    => 'yes'
                ]
            ]
        );

        $widget->add_control(
            'sa_eqh_apply_elements_custom',
            [
                'label' => esc_html__('Custom Selector', 'sky-elementor-addons'),
                'type' => Controls_Manager::TEXT,
                'description' => esc_html__('Example - .class-name', 'sky-elementor-addons'),
                'frontend_available'   => true,
                'condition' => [
                    'sa_eqh_enable'    => 'yes',
                    'sa_eqh_apply_elements' => 'custom'
                ]
            ]
        );

        $widget->add_control(
            'sa_eqh_css_property',
            [
                'label'                => esc_html__('CSS Property', 'sky-elementor-addons'),
                'type'                 => Controls_Manager::SELECT,
                'default'              => 'height',
                'options'              => [
                    'height'           => esc_html__('Height (Default)', 'sky-elementor-addons'),
                    'min_height'       => esc_html__('Min-Height', 'sky-elementor-addons'),
                ],
                'frontend_available'   => true,
                'condition'            => [
                    'sa_eqh_enable'    => 'yes'
                ]
            ]
        );

        $widget->add_control(
            'sa_eqh_disable_on_tablet',
            [
                'label'              => esc_html__('Disable on Tablet', 'sky-elementor-addons'),
                'type'               => Controls_Manager::SWITCHER,
                'render_type'        => 'template',
                'default'            => 'no',
                'frontend_available' => true,
                'condition'         => [
                    'sa_eqh_enable'  => 'yes'
                ]
            ]
        );

        $widget->add_control(
            'sa_eqh_disable_on_mobile',
            [
                'label'                => esc_html__('Disable on Mobile', 'sky-elementor-addons'),
                'type'                 => Controls_Manager::SWITCHER,
                'render_type'          => 'template',
                'default'      => 'yes',
                'frontend_available'   => true,
                'condition'            => [
                    'sa_eqh_enable'    => 'yes'
                ]
            ]
        );
    }

    public function widget_equal_height_before_render($widget) {
        $settings                      =  $widget->get_settings_for_display();
        if ($settings['sa_eqh_enable'] == 'yes') {
            wp_enqueue_script('equal-height');
        }
    }

    protected function add_actions() {

        add_action('elementor/element/section/section_advanced/after_section_end', [$this, 'register_section']);
        add_action('elementor/element/section/section_sky_addons_equal_height_controls/before_section_end', [$this, 'register_controls'], 10, 2);
        add_action('elementor/frontend/section/before_render', [$this, 'widget_equal_height_before_render'], 10, 1);

        add_action('elementor/element/container/section_layout/after_section_end', [$this, 'register_section']);
        add_action('elementor/element/container/section_sky_addons_equal_height_controls/before_section_end', [$this, 'register_controls'], 10, 2);
        add_action('elementor/frontend/container/before_render', [$this, 'widget_equal_height_before_render'], 10, 1);
    }
}
