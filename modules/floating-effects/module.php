<?php

namespace Sky_Addons\Modules\FloatingEffects;

use Elementor\Controls_Manager;
use Sky_Addons\Base\Module_Base;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
        exit;
}

class Module extends Module_Base
{

        public function __construct()
        {
                parent::__construct();
                $this->add_actions();
        }

        public function get_name()
        {
                return 'sky-floating-effects';
        }

        public function register_section($element)
        {
                $element->start_controls_section(
                        'section_sky_addons_floating_ef_controls',
                        [
                                'tab'   => Controls_Manager::TAB_ADVANCED,
                                'label' => esc_html__('Floating Effects', 'sky-elementor-addons') . sky_addons_get_icon(),
                        ]
                );
                $element->end_controls_section();
        }

        public function register_controls($widget, $args)
        {

                $widget->add_control(
                        'sa_floating_ef_enable',
                        [
                                'label'              => esc_html__('Enable', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::SWITCHER,
                                'render_type'        => 'template',
                                'frontend_available' => true,
                        ]
                );

                $widget->add_control(
                        'sa_floating_ef_translate_toggle',
                        [
                                'label'              => esc_html__('Translate', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::POPOVER_TOGGLE,
                                'condition'          => [
                                        'sa_floating_ef_enable' => 'yes',
                                ],
                                'return_value'       => 'yes',
                                'render_type'        => 'template',
                                'frontend_available' => true,
                        ]
                );

                $widget->start_popover();
                $widget->add_control(
                        'sa_floating_ef_translate_x',
                        [
                                'label'              => esc_html__('Translate X', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::SLIDER,
                                'default'            => [
                                        'sizes' => [
                                                'from' => 0,
                                                'to'   => 10,
                                        ],
                                        'unit'  => 'px',
                                ],
                                'range'              => [
                                        'px' => [
                                                'min' => -100,
                                                'max' => 100,
                                        ]
                                ],
                                'labels'             => [
                                        esc_html__('From', 'sky-elementor-addons'),
                                        esc_html__('To', 'sky-elementor-addons'),
                                ],
                                'scales'             => 1,
                                'handles'            => 'range',
                                'condition'          => [
                                        'sa_floating_ef_enable'           => 'yes',
                                        'sa_floating_ef_translate_toggle' => 'yes',
                                ],
                                'render_type'        => 'none',
                                'frontend_available' => true,
                        ]
                );

                $widget->add_control(
                        'sa_floating_ef_translate_y',
                        [
                                'label'              => esc_html__('Translate Y', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::SLIDER,
                                'default'            => [
                                        'sizes' => [
                                                'from' => 0,
                                                'to'   => 10,
                                        ],
                                        'unit'  => 'px',
                                ],
                                'range'              => [
                                        'px' => [
                                                'min' => -100,
                                                'max' => 100,
                                        ]
                                ],
                                'labels'             => [
                                        esc_html__('From', 'sky-elementor-addons'),
                                        esc_html__('To', 'sky-elementor-addons'),
                                ],
                                'scales'             => 1,
                                'handles'            => 'range',
                                'condition'          => [
                                        'sa_floating_ef_enable'           => 'yes',
                                        'sa_floating_ef_translate_toggle' => 'yes',
                                ],
                                'render_type'        => 'none',
                                'frontend_available' => true,
                        ]
                );

                $widget->add_control(
                        'sa_floating_ef_translate_duration',
                        [
                                'label'              => esc_html__('Duration', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::SLIDER,
                                'range'              => [
                                        'px' => [
                                                'min'  => 0,
                                                'max'  => 10000,
                                                'step' => 100,
                                        ],
                                ],
                                'default'            => [
                                        'unit' => 'px',
                                        'size' => 1000,
                                ],
                                'condition'          => [
                                        'sa_floating_ef_enable'           => 'yes',
                                        'sa_floating_ef_translate_toggle' => 'yes',
                                ],
                                'render_type'        => 'none',
                                'frontend_available' => true,
                        ]
                );

                $widget->add_control(
                        'sa_floating_ef_translate_delay',
                        [
                                'label'              => esc_html__('Delay', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::SLIDER,
                                'range'              => [
                                        'px' => [
                                                'min'  => 0,
                                                'max'  => 5000,
                                                'step' => 100,
                                        ],
                                ],
                                'condition'          => [
                                        'sa_floating_ef_enable'           => 'yes',
                                        'sa_floating_ef_translate_toggle' => 'yes',
                                ],
                                'render_type'        => 'none',
                                'frontend_available' => true,
                        ]
                );

                $widget->end_popover();

                $widget->add_control(
                        'sa_floating_ef_rotate_toggle',
                        [
                                'label'              => esc_html__('Rotate', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::POPOVER_TOGGLE,
                                'return_value'       => 'yes',
                                'condition'          => [
                                        'sa_floating_ef_enable' => 'yes',
                                ],
                                'render_type'        => 'template',
                                'frontend_available' => true,
                        ]
                );

                $widget->start_popover();

                $widget->add_control(
                        'sa_floating_ef_rotate_x',
                        [
                                'label'              => esc_html__('Rotate X', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::SLIDER,
                                'default'            => [
                                        'sizes' => [
                                                'from' => 0,
                                                'to'   => 45,
                                        ],
                                        'unit'  => 'deg',
                                ],
                                'range'              => [
                                        'deg' => [
                                                'min' => -180,
                                                'max' => 180,
                                        ]
                                ],
                                'labels'             => [
                                        esc_html__('From', 'sky-elementor-addons'),
                                        esc_html__('To', 'sky-elementor-addons'),
                                ],
                                'scales'             => 1,
                                'handles'            => 'range',
                                'condition'          => [
                                        'sa_floating_ef_enable'        => 'yes',
                                        'sa_floating_ef_rotate_toggle' => 'yes',
                                ],
                                'render_type'        => 'none',
                                'frontend_available' => true,
                        ]
                );

                $widget->add_control(
                        'sa_floating_ef_rotate_y',
                        [
                                'label'              => esc_html__('Rotate Y', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::SLIDER,
                                'default'            => [
                                        'sizes' => [
                                                'from' => 0,
                                                'to'   => 45,
                                        ],
                                        'unit'  => 'deg',
                                ],
                                'range'              => [
                                        'deg' => [
                                                'min' => -180,
                                                'max' => 180,
                                        ]
                                ],
                                'labels'             => [
                                        esc_html__('From', 'sky-elementor-addons'),
                                        esc_html__('To', 'sky-elementor-addons'),
                                ],
                                'scales'             => 1,
                                'handles'            => 'range',
                                'condition'          => [
                                        'sa_floating_ef_enable'        => 'yes',
                                        'sa_floating_ef_rotate_toggle' => 'yes',
                                ],
                                'render_type'        => 'none',
                                'frontend_available' => true,
                        ]
                );

                $widget->add_control(
                        'sa_floating_ef_rotate_z',
                        [
                                'label'              => esc_html__('Rotate Z', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::SLIDER,
                                'default'            => [
                                        'sizes' => [
                                                'from' => 0,
                                                'to'   => 45,
                                        ],
                                        'unit'  => 'deg',
                                ],
                                'range'              => [
                                        'deg' => [
                                                'min' => -180,
                                                'max' => 180,
                                        ]
                                ],
                                'labels'             => [
                                        esc_html__('From', 'sky-elementor-addons'),
                                        esc_html__('To', 'sky-elementor-addons'),
                                ],
                                'scales'             => 1,
                                'handles'            => 'range',
                                'condition'          => [
                                        'sa_floating_ef_enable'        => 'yes',
                                        'sa_floating_ef_rotate_toggle' => 'yes',
                                ],
                                'render_type'        => 'none',
                                'frontend_available' => true,
                        ]
                );

                $widget->add_control(
                        'sa_floating_ef_rotate_duration',
                        [
                                'label'              => esc_html__('Duration', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::SLIDER,
                                'size_units'         => ['px'],
                                'range'              => [
                                        'px' => [
                                                'min'  => 0,
                                                'max'  => 50000,
                                                'step' => 100,
                                        ],
                                ],
                                'default'            => [
                                        'size' => 1500,
                                ],
                                'condition'          => [
                                        'sa_floating_ef_enable'        => 'yes',
                                        'sa_floating_ef_rotate_toggle' => 'yes',
                                ],
                                'render_type'        => 'none',
                                'frontend_available' => true,
                        ]
                );

                $widget->add_control(
                        'sa_floating_ef_rotate_delay',
                        [
                                'label'              => esc_html__('Delay', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::SLIDER,
                                'unit'               => 'px',
                                'range'              => [
                                        'px' => [
                                                'min'  => 0,
                                                'max'  => 5000,
                                                'step' => 100,
                                        ],
                                ],
                                'condition'          => [
                                        'sa_floating_ef_enable'        => 'yes',
                                        'sa_floating_ef_rotate_toggle' => 'yes',
                                ],
                                'render_type'        => 'none',
                                'frontend_available' => true,
                        ]
                );


                $widget->end_popover();

                $widget->add_control(
                        'sa_floating_ef_scale_toggle',
                        [
                                'label'              => esc_html__('Scale', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::POPOVER_TOGGLE,
                                'return_value'       => 'yes',
                                'render_type'        => 'template',
                                'frontend_available' => true,
                                'condition'          => [
                                        'sa_floating_ef_enable' => 'yes',
                                ],
                        ]
                );

                $widget->start_popover();

                $widget->add_control(
                        'sa_floating_ef_scale_x',
                        [
                                'label'              => esc_html__('Scale X', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::SLIDER,
                                'default'            => [
                                        'sizes' => [
                                                'from' => 1,
                                                'to'   => 1.5,
                                        ],
                                        'unit'  => 'px',
                                ],
                                'range'              => [
                                        'px' => [
                                                'min'  => 0,
                                                'max'  => 5,
                                                'step' => .1
                                        ]
                                ],
                                'labels'             => [
                                        esc_html__('From', 'sky-elementor-addons'),
                                        esc_html__('To', 'sky-elementor-addons'),
                                ],
                                'scales'             => 1,
                                'handles'            => 'range',
                                'condition'          => [
                                        'sa_floating_ef_enable'       => 'yes',
                                        'sa_floating_ef_scale_toggle' => 'yes',
                                ],
                                'render_type'        => 'none',
                                'frontend_available' => true,
                        ]
                );

                $widget->add_control(
                        'sa_floating_ef_scale_y',
                        [
                                'label'              => esc_html__('Scale Y', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::SLIDER,
                                'default'            => [
                                        'sizes' => [
                                                'from' => 1,
                                                'to'   => 1.5,
                                        ],
                                        'unit'  => 'px',
                                ],
                                'range'              => [
                                        'px' => [
                                                'min'  => 0,
                                                'max'  => 5,
                                                'step' => .1
                                        ]
                                ],
                                'labels'             => [
                                        esc_html__('From', 'sky-elementor-addons'),
                                        esc_html__('To', 'sky-elementor-addons'),
                                ],
                                'scales'             => 1,
                                'handles'            => 'range',
                                'condition'          => [
                                        'sa_floating_ef_enable'       => 'yes',
                                        'sa_floating_ef_scale_toggle' => 'yes',
                                ],
                                'render_type'        => 'none',
                                'frontend_available' => true,
                        ]
                );

                $widget->add_control(
                        'sa_floating_ef_scale_duration',
                        [
                                'label'              => esc_html__('Duration', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::SLIDER,
                                'size_units'         => ['px'],
                                'range'              => [
                                        'px' => [
                                                'min'  => 0,
                                                'max'  => 10000,
                                                'step' => 100,
                                        ],
                                ],
                                'default'            => [
                                        'size' => 1000,
                                ],
                                'condition'          => [
                                        'sa_floating_ef_enable'       => 'yes',
                                        'sa_floating_ef_scale_toggle' => 'yes',
                                ],
                                'render_type'        => 'none',
                                'frontend_available' => true,
                        ]
                );

                $widget->add_control(
                        'sa_floating_ef_scale_delay',
                        [
                                'label'              => esc_html__('Delay', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::SLIDER,
                                'size_units'         => ['px'],
                                'range'              => [
                                        'px' => [
                                                'min'  => 0,
                                                'max'  => 5000,
                                                'step' => 100,
                                        ],
                                ],
                                'condition'          => [
                                        'sa_floating_ef_enable'       => 'yes',
                                        'sa_floating_ef_scale_toggle' => 'yes',
                                ],
                                'render_type'        => 'none',
                                'frontend_available' => true,
                        ]
                );


                $widget->end_popover();

                $widget->add_control(
                        'sa_floating_ef_skew_toggle',
                        [
                                'label'              => esc_html__('Skew', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::POPOVER_TOGGLE,
                                'return_value'       => 'yes',
                                'render_type'        => 'template',
                                'frontend_available' => true,
                                'condition'          => [
                                        'sa_floating_ef_enable' => 'yes',
                                ],
                        ]
                );

                $widget->start_popover();

                $widget->add_control(
                        'sa_floating_ef_skew_x',
                        [
                                'label'              => esc_html__('Skew X', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::SLIDER,
                                'default'            => [
                                        'sizes' => [
                                                'from' => 1,
                                                'to'   => 1.5,
                                        ],
                                        'unit'  => 'px',
                                ],
                                'range'              => [
                                        'px' => [
                                                'min' => -180,
                                                'max' => 180,
                                        ]
                                ],
                                'labels'             => [
                                        esc_html__('From', 'sky-elementor-addons'),
                                        esc_html__('To', 'sky-elementor-addons'),
                                ],
                                'scales'             => 1,
                                'handles'            => 'range',
                                'condition'          => [
                                        'sa_floating_ef_enable'      => 'yes',
                                        'sa_floating_ef_skew_toggle' => 'yes',
                                ],
                                'render_type'        => 'none',
                                'frontend_available' => true,
                        ]
                );

                $widget->add_control(
                        'sa_floating_ef_skew_y',
                        [
                                'label'              => esc_html__('Skew Y', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::SLIDER,
                                'default'            => [
                                        'sizes' => [
                                                'from' => 1,
                                                'to'   => 1.5,
                                        ],
                                        'unit'  => 'px',
                                ],
                                'range'              => [
                                        'px' => [
                                                'min' => -180,
                                                'max' => 180,
                                        ]
                                ],
                                'labels'             => [
                                        esc_html__('From', 'sky-elementor-addons'),
                                        esc_html__('To', 'sky-elementor-addons'),
                                ],
                                'scales'             => 1,
                                'handles'            => 'range',
                                'condition'          => [
                                        'sa_floating_ef_enable'      => 'yes',
                                        'sa_floating_ef_skew_toggle' => 'yes',
                                ],
                                'render_type'        => 'none',
                                'frontend_available' => true,
                        ]
                );

                $widget->add_control(
                        'sa_floating_ef_skew_duration',
                        [
                                'label'              => esc_html__('Duration', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::SLIDER,
                                'range'              => [
                                        'px' => [
                                                'min'  => 0,
                                                'max'  => 10000,
                                                'step' => 100,
                                        ],
                                ],
                                'default'            => [
                                        'unit' => 'px',
                                        'size' => 1000,
                                ],
                                'condition'          => [
                                        'sa_floating_ef_enable'      => 'yes',
                                        'sa_floating_ef_skew_toggle' => 'yes',
                                ],
                                'render_type'        => 'none',
                                'frontend_available' => true,
                        ]
                );

                $widget->add_control(
                        'sa_floating_ef_skew_delay',
                        [
                                'label'              => esc_html__('Delay', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::SLIDER,
                                'range'              => [
                                        'px' => [
                                                'min'  => 0,
                                                'max'  => 5000,
                                                'step' => 100,
                                        ],
                                ],
                                'condition'          => [
                                        'sa_floating_ef_enable'      => 'yes',
                                        'sa_floating_ef_skew_toggle' => 'yes',
                                ],
                                'render_type'        => 'none',
                                'frontend_available' => true,
                        ]
                );


                $widget->end_popover();

                $widget->add_control(
                        'sa_floating_ef_easing',
                        [
                                'label'              => esc_html__('Easing', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::SELECT,
                                'default'            => '',
                                'options'            => [
                                        ''                => esc_html__('Default', 'sky-elementor-addons'),
                                        'easeInQuart'     => esc_html__('easeInQuart', 'sky-elementor-addons'),
                                        'easeInQuint'     => esc_html__('easeInQuint', 'sky-elementor-addons'),
                                        'easeInSine'      => esc_html__('easeInSine', 'sky-elementor-addons'),
                                        'easeInExpo'      => esc_html__('easeInExpo', 'sky-elementor-addons'),
                                        'easeInCirc'      => esc_html__('easeInCirc', 'sky-elementor-addons'),
                                        'easeInBack'      => esc_html__('easeInBack', 'sky-elementor-addons'),
                                        'easeInBounce'    => esc_html__('easeInBounce', 'sky-elementor-addons'),
                                        'easeOutQuart'    => esc_html__('easeOutQuart', 'sky-elementor-addons'),
                                        'easeOutQuint'    => esc_html__('easeOutQuint', 'sky-elementor-addons'),
                                        'easeOutSine'     => esc_html__('easeOutSine', 'sky-elementor-addons'),
                                        'easeOutExpo'     => esc_html__('easeOutExpo', 'sky-elementor-addons'),
                                        'easeOutCirc'     => esc_html__('easeOutCirc', 'sky-elementor-addons'),
                                        'easeOutBack'     => esc_html__('easeOutBack', 'sky-elementor-addons'),
                                        'easeOutBounce'   => esc_html__('easeOutBounce', 'sky-elementor-addons'),
                                        'easeInOutQuart'  => esc_html__('easeInOutQuart', 'sky-elementor-addons'),
                                        'easeInOutQuint'  => esc_html__('easeInOutQuint', 'sky-elementor-addons'),
                                        'easeInOutSine'   => esc_html__('easeInOutSine', 'sky-elementor-addons'),
                                        'easeInOutExpo'   => esc_html__('easeInOutExpo', 'sky-elementor-addons'),
                                        'easeInOutCirc'   => esc_html__('easeInOutCirc', 'sky-elementor-addons'),
                                        'easeInOutBack'   => esc_html__('easeInOutBack', 'sky-elementor-addons'),
                                        'easeInOutBounce' => esc_html__('easeInOutBounce', 'sky-elementor-addons'),
                                        'easeOutInQuart'  => esc_html__('easeOutInQuart', 'sky-elementor-addons'),
                                        'easeOutInQuint'  => esc_html__('easeOutInQuint', 'sky-elementor-addons'),
                                        'easeOutInSine'   => esc_html__('easeOutInSine', 'sky-elementor-addons'),
                                        'easeOutInExpo'   => esc_html__('easeOutInExpo', 'sky-elementor-addons'),
                                        'easeOutInCirc'   => esc_html__('easeOutInCirc', 'sky-elementor-addons'),
                                        'easeOutInBack'   => esc_html__('easeOutInBack', 'sky-elementor-addons'),
                                        'easeOutInBounce' => esc_html__('easeOutInBounce', 'sky-elementor-addons'),
                                ],
                                'render_type'        => 'none',
                                'frontend_available' => true,
                                'condition'          => [
                                        'sa_floating_ef_enable' => 'yes',
                                ],
                        ]
                );
        }

        public function widget_floating_ef_before_render($widget)
        {
                $settings = $widget->get_settings_for_display();
                if ($settings['sa_floating_ef_enable'] == 'yes') {
                        wp_enqueue_script('anime');
                }
        }

        protected function add_actions()
        {

                add_action(
                        'elementor/element/common/_section_style/after_section_end',
                        [
                                $this,
                                'register_section'
                        ]
                );

                add_action(
                        'elementor/element/common/section_sky_addons_floating_ef_controls/before_section_end',
                        [
                                $this,
                                'register_controls'
                        ],
                        10,
                        2
                );

                add_action('elementor/frontend/widget/before_render', [$this, 'widget_floating_ef_before_render'], 10, 1);
        }
}
