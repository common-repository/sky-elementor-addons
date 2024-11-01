<?php

namespace Sky_Addons\Modules\RevealEffects;

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
                return 'sky-reveal-effects';
        }

        public function register_section($element) {
                $element->start_controls_section(
                        'section_sky_addons_reveal_fx_controls',
                        [
                                'tab'   => Controls_Manager::TAB_ADVANCED,
                                'label' => esc_html__('Reveal Effects', 'sky-elementor-addons') . sky_addons_get_icon(),
                        ]
                );
                $element->end_controls_section();
        }

        public function register_controls($widget, $args) {

                $widget->add_control(
                        'sa_reveal_fx_enable',
                        [
                                'label'              => esc_html__('Enable', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::SWITCHER,
                                'render_type'        => 'template',
                                'frontend_available' => true,
                        ]
                );

                $widget->add_control(
                        'sa_reveal_fx_select_type',
                        [
                                'label'   => esc_html__('Selector', 'sky-elementor-addons'),
                                'type'    => Controls_Manager::SELECT,
                                'default' => 'default',
                                'options' => [
                                        'default' => esc_html__('Default', 'sky-elementor-addons'),
                                        'custom'  => esc_html__('Custom', 'sky-elementor-addons'),
                                ],
                                'render_type'        => 'none',
                                'frontend_available' => true,
                                'condition'          => [
                                        'sa_reveal_fx_enable' => 'yes',
                                ],
                        ]
                );

                $sa_reveal_fx_selector = (sky_addons_init_pro() == true || sky_editor_mode() == true) ? true : false;

                $widget->add_control(
                        'sa_reveal_fx_selector',
                        [
                                'label'              => esc_html__('Custom Selector', 'sky-elementor-addons') . sky_addons_control_indicator_pro(),
                                'type'               => Controls_Manager::TEXT,
                                'description'        => esc_html__('(Example - .post-item) Best to use on Grid Items. And must select the inner class of the element.', 'sky-elementor-addons'),
                                'render_type'        => 'none',
                                'frontend_available' => $sa_reveal_fx_selector,
                                'condition'          => [
                                        'sa_reveal_fx_enable'      => 'yes',
                                        'sa_reveal_fx_select_type' => 'custom',
                                ],
                        ]
                );

                $widget->add_control(
                        'sa_reveal_fx_direction',
                        [
                                'label'   => esc_html__('Direction', 'sky-elementor-addons'),
                                'type'    => Controls_Manager::SELECT,
                                'default' => 'lr',
                                'options' => [
                                        'lr' => esc_html__('Left to Right (Default)', 'sky-elementor-addons'),
                                        'rl' => esc_html__('Right to Left', 'sky-elementor-addons'),
                                        'tb' => esc_html__('Top to Bottom', 'sky-elementor-addons'),
                                        'bt' => esc_html__('Bottom to Top', 'sky-elementor-addons'),
                                ],
                                'render_type'        => 'none',
                                'frontend_available' => true,
                                'separator'          => 'before',
                                'condition'          => [
                                        'sa_reveal_fx_enable' => 'yes',
                                ],
                        ]
                );

                $widget->add_control(
                        'sa_reveal_fx_content_show',
                        [
                                'label'              => esc_html__('Content Show', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::SWITCHER,
                                'description'        => esc_html__('If true , the content of the element will be show on the reveal time.', 'sky-elementor-addons'),
                                'render_type'        => 'none',
                                'frontend_available' => true,
                                'condition'          => [
                                        'sa_reveal_fx_enable' => 'yes',
                                ],
                        ]
                );

                $widget->add_control(
                        'sa_reveal_fx_layers',
                        [
                                'label'              => esc_html__('Layers', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::NUMBER,
                                'description'        => esc_html__('The number of layers to be shown during the animation. Default : 1', 'sky-elementor-addons'),
                                'render_type'        => 'none',
                                'frontend_available' => true,
                                'condition'          => [
                                        'sa_reveal_fx_enable' => 'yes',
                                ],
                        ]
                );

                $widget->add_control(
                        'sa_reveal_fx_bg_colors',
                        [
                                'label'              => esc_html__('Background Colors', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::TEXTAREA,
                                'description'        => esc_html__('If you will use Multicolor then never forget to increase the Layers.', 'sky-elementor-addons'),
                                'rows'               => 4,
                                'placeholder'        => esc_html__('red, blue, green', 'sky-elementor-addons'),
                                'render_type'        => 'none',
                                'frontend_available' => true,
                                'condition'          => [
                                        'sa_reveal_fx_enable' => 'yes',
                                ],
                        ]
                );

                $widget->add_control(
                        'sa_reveal_fx_duration',
                        [
                                'label' => esc_html__('Duration (ms)', 'sky-elementor-addons'),
                                'type'  => Controls_Manager::SLIDER,
                                'range' => [
                                        'px' => [
                                                'min' => 500,
                                                'max' => 5000,
                                        ],
                                ],
                                'default'   => [
                                        'unit' => 'px',
                                        'size' => 600,
                                ],
                                'render_type'        => 'none',
                                'frontend_available' => true,
                                'condition'          => [
                                        'sa_reveal_fx_enable' => 'yes',
                                ],
                        ]
                );

                $sa_reveal_fx_easing_value = (sky_addons_init_pro() == true || sky_editor_mode() == true) ? true : false;

                $widget->add_control(
                        'sa_reveal_fx_easing',
                        [
                                'label'              => esc_html__('Easing', 'sky-elementor-addons') . sky_addons_control_indicator_pro(),
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
                                'frontend_available' => $sa_reveal_fx_easing_value,
                                'condition'          => [
                                        'sa_reveal_fx_enable' => 'yes',
                                ],
                        ]
                );

                $widget->add_control(
                        'sa_reveal_fx_cover_area',
                        [
                                'label'              => esc_html__('Cover Area', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::NUMBER,
                                'description'        => esc_html__('Percentage-based value representing how much of the area should be left covered. Default : 0', 'sky-elementor-addons'),
                                'render_type'        => 'none',
                                'frontend_available' => true,
                                'condition'          => [
                                        'sa_reveal_fx_enable' => 'yes',
                                ],
                        ]
                );

                $widget->add_control(
                        'sa_reveal_fx_delay',
                        [
                                'label'       => esc_html__('Delay (ms)', 'sky-elementor-addons'),
                                'description' => esc_html__('Staggered delay in timing between the layer. Default: 100', 'sky-elementor-addons'),
                                'type'        => Controls_Manager::SLIDER,
                                'range'       => [
                                        'px' => [
                                                'min' => 500,
                                                'max' => 5000,
                                        ],
                                ],
                                'default'   => [
                                        'unit' => 'px',
                                        'size' => 100,
                                ],
                                'render_type'        => 'none',
                                'frontend_available' => true,
                                'condition'          => [
                                        'sa_reveal_fx_enable' => 'yes',
                                ],
                        ]
                );

                $widget->add_control(
                        'sa_reveal_fx_z_index',
                        [
                                'label'              => esc_html__('Z-Index', 'sky-elementor-addons'),
                                'type'               => Controls_Manager::NUMBER,
                                'render_type'        => 'none',
                                'condition'          => [
                                        'sa_reveal_fx_enable' => 'yes',
                                ],
                                'selectors'  => [
                                        '{{WRAPPER}} .block-revealer__element' => 'z-index: {{VALUE}} !important;',
                                ],
                        ]
                );
        }

        public function widget_reveal_fx_before_render($widget) {
                $settings = $widget->get_settings_for_display();
                if ($settings['sa_reveal_fx_enable'] == 'yes') {
                        wp_enqueue_script('anime');
                        wp_enqueue_script('revealFx');
                }
        }

        protected function add_actions() {
                add_action('elementor/element/common/_section_style/after_section_end', [$this, 'register_section']);
                add_action('elementor/element/common/section_sky_addons_reveal_fx_controls/before_section_end', [$this, 'register_controls'], 10, 2);
                add_action('elementor/frontend/widget/before_render', [$this, 'widget_reveal_fx_before_render'], 10, 1);
        }
}
