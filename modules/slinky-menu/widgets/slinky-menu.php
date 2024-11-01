<?php

namespace Sky_Addons\Modules\SlinkyMenu\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;

use Sky_Addons\Modules\SlinkyMenu\Menu_Walker;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Slinky_Menu extends Widget_Base {

    public function get_name() {
        return 'sky-slinky-menu';
    }

    public function get_title() {
        return esc_html__('Slinky Menu', 'sky-elementor-addons');
    }

    public function get_icon() {
        return 'sky-icon-slinky-menu';
    }

    public function get_categories() {
        return ['sky-elementor-addons'];
    }

    public function get_keywords() {
        return ['sky', 'slinky', 'menu', 'vertical', 'creative'];
    }

    public function get_style_depends() {
        return [
            'slinky',
            'elementor-icons-fa-solid',
        ];
    }

    public function get_script_depends() {
        return ['slinky'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_number_layout',
            [
                'label' => esc_html__('Slinky Menu', 'sky-elementor-addons'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'select_menu',
            [
                'label'   => esc_html__('Select Menu', 'sky-elementor-addons'),
                'type'    => Controls_Manager::SELECT,
                'options' => sa_wp_get_menu(),
                'default' => 0,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_settings',
            [
                'label' => esc_html__('Settings', 'sky-elementor-addons'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label'     => esc_html__('Show Title', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'speed',
            [
                'label'     => esc_html__('Animate Speed (ms)', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 100,
                        'max'  => 5000,
                    ],
                ],
                'default'   => [
                    'unit' => 'px',
                    'size' => 300,
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_item_style',
            [
                'label'     => esc_html__('Menu Item', 'sky-elementor-addons'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'bottom_spacing',
            [
                'label'      => esc_html__('Bottom Spacing', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'size' => 2,
                    'unit' => 'px',
                ],
                'render_type' => 'template',
                'selectors'   => [
                    '{{WRAPPER}} li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} li .title' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'item_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} li > a',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'item_border',
                'label'    => esc_html__('Border', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} li > a',
            ]
        );

        $this->add_responsive_control(
            'item_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_item_style');

        $this->start_controls_tab(
            'tab_item_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons'),
            ]
        );

        $this->add_control(
            'item_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} li > a, {{WRAPPER}} li > a:focus' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'           => 'item_background',
                'label'          => esc_html__('Background', 'sky-elementor-addons'),
                'types'          => ['classic', 'gradient'],
                'fields_options' => [
                    'background' => [
                        'label'   => esc_html__('Background', 'elementor'),
                        'default' => 'classic',
                    ],
                    'color' => [
                        'default' => '#F6F7F8',
                    ],
                ],
                'selector' => '{{WRAPPER}} li > a, {{WRAPPER}} li > a:focus',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'item_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} li > a',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_box_shadow',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} li > a',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_item_hover',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons'),
            ]
        );

        $this->add_control(
            'item_color_hover',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} li > a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'item_background_hover',
                'label'    => esc_html__('Background', 'sky-elementor-addons'),
                'types'    => ['classic', 'gradient'],
                'fields_options' => [
                    'background' => [
                        'label'   => esc_html__('Background', 'elementor'),
                        'default' => 'classic',
                    ],
                    'color' => [
                        'default' => '#f1f2f4',
                    ],
                ],
                'selector' => '{{WRAPPER}} li > a:hover',
            ]
        );

        $this->add_control(
            'item_border_color_hover',
            [
                'label'     => esc_html__('Border Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} li > a:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'item_border_border!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_border_radius_hover',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} li > a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'item_text_shadow_hover',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} li > a:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_box_shadow_hover',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} li > a:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
            'section_item_title_style',
            [
                'label'     => esc_html__('Menu Item Title', 'sky-elementor-addons'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_title' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'item_title_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} li > .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'item_title_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} li > .title',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'item_title_border',
                'label'    => esc_html__('Border', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} li > .title',
            ]
        );

        $this->add_responsive_control(
            'item_title_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} li > .title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->add_control(
            'item_title_color',
            [
                'label'     => esc_html__('Text Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} li > .title, {{WRAPPER}} li > .title:focus' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'           => 'item_title_background',
                'label'          => esc_html__('Background', 'sky-elementor-addons'),
                'types'          => ['classic', 'gradient'],
                'fields_options' => [
                    'background' => [
                        'label'   => esc_html__('Background', 'elementor'),
                        'default' => 'classic',
                    ],
                    'color' => [
                        'default' => '#F6F7F8',
                    ],
                ],
                'selector' => '{{WRAPPER}} li > .title, {{WRAPPER}} li > .title:focus',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'item_title_text_shadow',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} li > .title',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'item_title_box_shadow',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} li > .title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_arrow_style',
            [
                'label'     => esc_html__('Arrow', 'sky-elementor-addons'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slinky-theme-default .next::after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .slinky-theme-default .back::before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_color_hover',
            [
                'label'     => esc_html__('Hover Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .menu-item-has-children:hover > .next::after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .header:hover > .back::before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_size',
            [
                'label'      => esc_html__('Size', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slinky-theme-default .next::after' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .slinky-theme-default .back::before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // $this->add_control(
        //     'arrow_font_weight',
        //     [
        //         'label'   => esc_html__('Font Weight', 'sky-elementor-addons'),
        //         'type'    => Controls_Manager::SELECT,
        //         'options' => [
        //             ''       => esc_html__('Default', 'sky-elementor-addons'),
        //             'normal' => esc_html__('Normal', 'sky-elementor-addons'),
        //             'bold'   => esc_html__('Bold', 'sky-elementor-addons'),
        //             '300'    => esc_html__('300', 'sky-elementor-addons'),
        //             '400'    => esc_html__('400', 'sky-elementor-addons'),
        //             '600'    => esc_html__('600', 'sky-elementor-addons'),
        //             '700'    => esc_html__('700', 'sky-elementor-addons')
        //         ],
        //         'selectors'  => [
        //             '{{WRAPPER}} .slinky-theme-default .next::after' => 'font-weight: {{VALUE}}',
        //         ],
        //     ]
        // );

        $this->end_controls_section();
    }

    protected function wp_menu($settings, $id) {
        include_once SKY_ADDONS_MODULES_PATH . 'slinky-menu/class/menu-walker.php';

        if (!$settings['select_menu']) {
            echo esc_html__('Please Select Menu at First.', 'sky-elementor-addons');
        }

        $nav_menu = !empty($settings['select_menu']) ? wp_get_nav_menu_object($settings['select_menu']) : false;
        if (!$nav_menu) {
            return;
        }

        $nav_menu_args = array(
            'menu'           => $nav_menu,
            'container'      => false,
            'menu_class'     => 'slinky-vertical-menu',
            'menu_id'        => $id . '-menu',
            'echo'           => true,
            'fallback_cb'    => false,
            'depth'          => 0,
            'walker'         => new Menu_Walker(),
            'show_carets'    => true,
            'theme_location' => 'default_navmenu',
        );

        wp_nav_menu(apply_filters('widget_nav_menu_args', $nav_menu_args, $nav_menu, $settings));
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id       = 'sa-slinky-menu' . $this->get_id();

        $this->add_render_attribute('slinky-menu', [
            'class'         => 'sa-slinky-menu slinky-theme-default sa-d-none',
            'id'            => $id,
            'data-settings' => [
                wp_json_encode(array_filter([
                    'id'    => '#' . $id,
                    'speed' => !empty($settings['speed']['size']) ? $settings['speed']['size'] : 300,
                    'title' => ('yes' == $settings['show_title']) ? $settings['show_title'] : false,
                ]))
            ]
        ]);

?>
        <div <?php $this->print_render_attribute_string('slinky-menu'); ?>>
            <?php $this->wp_menu($settings, $id); ?>
        </div>
<?php
    }
}
