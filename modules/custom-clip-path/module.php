<?php

namespace Sky_Addons\Modules\CustomClipPath;

use Elementor\Controls_Manager;
use Sky_Addons\Base\Module_Base;

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
                return 'sky-custom-clip-path';
        }

        public function register_section($element)
        {
                $element->start_controls_section(
                        'section_sky_addons_custom_cp_controls',
                        [
                                'tab'   => Controls_Manager::TAB_STYLE,
                                'label' => esc_html__('Custom Clip Path', 'sky-elementor-addons') . sky_addons_get_icon(),
                        ]
                );

                $element->end_controls_section();
        }

        public function register_controls($widget, $args)
        {

                $widget->add_control(
                        'sa_custom_cp_enable',
                        [
                                'label'              => esc_html__('Enable', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::SWITCHER,
                                'render_type'        => 'template',
                                'frontend_available' => true,
                        ]
                );

                $widget->start_controls_tabs(
                        'sa_custom_cp_tabs',
                        [
                                'condition'          => [
                                        'sa_custom_cp_enable' => 'yes',
                                ],
                        ]
                );

                $widget->start_controls_tab(
                        'sa_custom_cp_normal_tab',
                        [
                                'label' => esc_html__('Normal', 'sky-elementor-addons'),
                        ]
                );

                $widget->add_control(
                        'sa_custom_cp_css_normal',
                        [
                                'label' => esc_html__('Clip-path', 'sky-elementor-addons'),
                                'type' => Controls_Manager::TEXTAREA,
                                'rows' => 3,
                                'default' => 'clip-path: polygon(50% 0%, 90% 20%, 100% 60%, 75% 100%, 25% 100%, 0% 60%, 10% 20%);',
                                'placeholder' => esc_html__('clip-path: polygon(50% 0%, 90% 20%, 100% 60%, 75% 100%, 25% 100%, 0% 60%, 10% 20%);
', 'sky-elementor-addons'),
                                'selectors'            => [
                                        '{{WRAPPER}} .elementor-widget-container img' => '{{VALUE}};',
                                ],
                        ]
                );

                $widget->end_controls_tab();

                $widget->start_controls_tab(
                        'sa_custom_cp_hover_tab',
                        [
                                'label' => esc_html__('Hover', 'sky-elementor-addons'),
                        ]
                );

                $widget->add_control(
                        'sa_custom_cp_css_hover',
                        [
                                'label' => esc_html__('Clip-path', 'sky-elementor-addons'),
                                'type' => Controls_Manager::TEXTAREA,
                                'rows' => 3,
                                'placeholder' => esc_html__('clip-path: polygon(50% 0%, 90% 20%, 100% 60%, 75% 100%, 25% 100%, 0% 60%, 10% 20%);
', 'sky-elementor-addons'),
                                'selectors'            => [
                                        '{{WRAPPER}} .elementor-widget-container:hover img' => '{{VALUE}};',
                                ],
                        ]
                );

                $widget->end_controls_tab();

                $widget->end_controls_tabs();

                $widget->add_control(
                        'sa_custom_cp_css_link_desc',
                        [
                                'label' => sprintf('Please click the link of <a href="%s" target="_blank">Clippy</a> to create a custom clip-path.', 'https://bennettfeely.com/clippy/'),
                                'type' => Controls_Manager::HEADING,
                                'separator' => 'before',
                                'condition'          => [
                                        'sa_custom_cp_enable' => 'yes',
                                ],
                        ]
                );

                $widget->add_control(
                        'sa_custom_cp_transition',
                        [
                                'label'     => esc_html__('Transition Duration (s)', 'sky-elementor-addons'),
                                'type'      => Controls_Manager::SLIDER,
                                'range'     => [
                                        'px' => [
                                                'max'  => 3,
                                                'step' => 0.1,
                                        ],
                                ],
                                'selectors' => [
                                        '{{WRAPPER}}' => '--sky-ccp-transition: {{SIZE}};',
                                ],
                                'condition'          => [
                                        'sa_custom_cp_enable' => 'yes',
                                ],
                        ]
                );

                $widget->add_control(
                        'sa_custom_cp_transition_type',
                        [
                                'label'   => esc_html__('Transition Type', 'sky-elementor-addons'),
                                'type'    => Controls_Manager::SELECT,
                                'default' => 'ease-in-out',
                                'options' => [
                                        'ease'        => 'Ease',
                                        'linear'      => 'Linear',
                                        'ease-in'     => 'Ease-In',
                                        'ease-in-out' => 'Ease-In-Out',
                                ],
                                'selectors' => [
                                        '{{WRAPPER}}' => '--sky-ccp-transition-type: {{SIZE}};',
                                ],
                                'condition'          => [
                                        'sa_custom_cp_enable' => 'yes',
                                ],
                        ]
                );

                $widget->add_control(
                        'sa_custom_cp_transition_delay',
                        [
                                'label'     => esc_html__('Transition Delay (s)', 'sky-elementor-addons'),
                                'type'      => Controls_Manager::SLIDER,
                                'range'     => [
                                        'px' => [
                                                'max'  => 3,
                                                'step' => 0.1,
                                        ],
                                ],
                                'selectors' => [
                                        '{{WRAPPER}}' => '--sky-ccp-transition-delay: {{SIZE}};',
                                ],
                                'condition'          => [
                                        'sa_custom_cp_enable' => 'yes',
                                ],
                        ]
                );

                $widget->add_control(
                        'sa_custom_cp_output',
                        [
                                'type'      => Controls_Manager::HIDDEN,
                                'default'   => '1',
                                'selectors' => [
                                        '{{WRAPPER}} .elementor-widget-container img' => 'transition: clip-path var(--sky-ccp-transition, 0.3)s var(--sky-ccp-transition-type, ease-in) var(--sky-ccp-transition-delay, 0.1)s;',
                                ],
                                'render_type' => 'template',
                                'condition'   => [
                                        'sa_custom_cp_enable'   => 'yes'
                                ],
                        ]
                );
        }

        protected function add_actions()
        {

                add_action(
                        'elementor/element/image/section_style_image/after_section_end',
                        [
                                $this,
                                'register_section'
                        ]
                );

                add_action(
                        'elementor/element/image/section_sky_addons_custom_cp_controls/before_section_end',
                        [
                                $this,
                                'register_controls'
                        ],
                        10,
                        2
                );
        }
}
