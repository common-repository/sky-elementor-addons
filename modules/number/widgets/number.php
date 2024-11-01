<?php

namespace Sky_Addons\Modules\Number\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Number extends Widget_Base {

    public function get_name() {
        return 'sky-number';
    }

    public function get_title() {
        return esc_html__('Number', 'sky-elementor-addons');
    }

    public function get_icon() {
        return 'sky-icon-number';
    }

    public function get_categories() {
        return ['sky-elementor-addons'];
    }

    public function get_keywords() {
        return ['sky', 'number', 'counter'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_number_layout',
            [
                'label' => esc_html__('Number', 'sky-elementor-addons'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'text',
            [
                'label'   => esc_html__('Number', 'sky-elementor-addons'),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__('1', 'sky-elementor-addons'),
                'dynamic' => ['active' => true],
            ]
        );

        $this->add_control(
            'number_animation',
            [
                'label'        => esc_html__('Number Animation', 'sky-elementor-addons'),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
            ]
        );


        $this->add_control(
            'anim_duration',
            [
                'label'     => esc_html__('Animation Duration', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 2000,
                        'max' => 5000,
                    ],
                ],
                'default'   => [
                    'unit' => 'px',
                    'size' => 2600,
                ],
                'condition' => [
                    'number_animation' => 'yes',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_number_style',
            [
                'label' => esc_html__('Number', 'sky-elementor-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'overflow_hidden',
            [
                'label'        => esc_html__('Overflow Hidden', 'sky-elementor-addons'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'prefix_class' => 'sa-overflow-'
            ]
        );

        $this->add_responsive_control(
            'number_align',
            [
                'label'   => esc_html__('Alignment', 'sky-elementor-addons'),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'   => [
                        'title' => esc_html__('Left', 'sky-elementor-addons'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'sky-elementor-addons'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'sky-elementor-addons'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .sa-number' => '{{VALUE}};'
                ],
                'selectors_dictionary' => [
                    'left'   => 'justify-content: flex-start',
                    'center' => 'justify-content: center',
                    'right'  => 'justify-content: flex-end'
                ],
            ]
        );

        $this->add_responsive_control(
            'size',
            [
                'label'      => esc_html__('Size', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min'  => 50,
                        'max'  => 200,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-number' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        //        $this->add_responsive_control(
        //            'padding', [
        //                'label'      => esc_html__('Padding', 'sky-elementor-addons'),
        //                'type'       => Controls_Manager::DIMENSIONS,
        //                'size_units' => ['px', 'em', '%'],
        //                'selectors'  => [
        //                        '{{WRAPPER}} .sa-number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        //                ],
        //            ]
        //        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'border',
                'label'    => esc_html__('Border', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-number',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'           => 'background',
                'label'          => esc_html__('Background', 'sky-elementor-addons'),
                'types'          => ['classic', 'gradient'],
                'exclude'        => ['image'],
                'fields_options' => [
                    'background' => [
                        'label'   => esc_html__('Background', 'sky-elementor-addons'),
                        'default' => 'classic',
                    ],
                    'color' => [
                        'default' => '#8441A4',
                    ],
                ],
                'selector' => '{{WRAPPER}} .sa-number',
            ]
        );

        $this->add_responsive_control(
            'border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'default'    => [
                    'top'      => '50',
                    'right'    => '50',
                    'bottom'   => '50',
                    'left'     => '50',
                    'unit'     => '%',
                    'isLinked' => true,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
                'condition'  => [
                    'show_adv_border_radius!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_adv_border_radius',
            [
                'label' => esc_html__('Advanced Border Radius', 'sky-elementor-addons'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'adv_border_radius',
            [
                'label'     => esc_html__('Radius', 'sky-elementor-addons'),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__('30% 70% 70% 30% / 30% 30% 70% 70% ', 'sky-elementor-addons'),
                'dynamic'   => ['active' => true],
                'selectors' => [
                    '{{WRAPPER}} .sa-number' => 'border-radius: {{VALUE}};',
                ],
                'condition' => [
                    'show_adv_border_radius' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'adv_border_radius_note',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => sprintf(esc_html__("You can easily generate Radius value from this link <a href='%1s' target='_blank'> Go </a>.", 'sky-elementor-addons'), "https://9elements.github.io/fancy-border-radius/"),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
                'condition'       => [
                    'show_adv_border_radius' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-number',
            ]
        );


        $this->add_responsive_control(
            'bg_rotate',
            [
                'label'       => esc_html__('Background Rotate', 'sky-elementor-addons'),
                'type'        => Controls_Manager::SLIDER,
                'devices'     => ['desktop', 'tablet', 'mobile'],
                'range'       => [
                    'px' => [
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 5,
                    ],
                ],
                'render_type' => 'ui',
                'selectors'   => [
                    '{{WRAPPER}} .sa-number' => '--sky-number-bg-rotate: {{SIZE}}deg;'
                ],
            ]
        );

        $this->add_control(
            'bg_rotate_note',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => esc_html__("If you see scrollbar on your design of Number widget. Please use padding from Advanced Tab to fix it. And Text rotate option on the Text Style Section.", 'sky-elementor-addons'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_text_style',
            [
                'label' => esc_html__('Text', 'sky-elementor-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .sa-text' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-text',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-text',
            ]
        );

        $this->add_responsive_control(
            'text_rotate',
            [
                'label'       => esc_html__('Text Rotate', 'sky-elementor-addons'),
                'type'        => Controls_Manager::SLIDER,
                'devices'     => ['desktop', 'tablet', 'mobile'],
                'range'       => [
                    'px' => [
                        'min'  => -360,
                        'max'  => 360,
                        'step' => 5,
                    ],
                ],
                'render_type' => 'ui',
                'selectors'   => [
                    '{{WRAPPER}} .sa-number' => '--sky-number-text-rotate: {{SIZE}}deg;'
                ],
            ]
        );


        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('number', [
            'class'         => 'sa-number',
            'data-settings' => [
                wp_json_encode(array_filter([
                    'animation' => $settings['number_animation'] == 'yes' ? 'yes' : 'no',
                    'number'    => (int) $settings['text'],
                    'time'      => isset($settings['anim_duration']) && !empty($settings['anim_duration']['size']) ? $settings['anim_duration']['size'] : 2600,
                ]))
            ]
        ]);
?>
        <div <?php $this->print_render_attribute_string('number'); ?>>
            <div class="sa-text"><?php echo esc_html($settings['text']); ?></div>
        </div>
<?php
    }
}
