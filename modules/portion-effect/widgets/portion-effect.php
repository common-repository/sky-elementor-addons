<?php

namespace Sky_Addons\Modules\PortionEffect\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Portion_Effect extends Widget_Base
{

    public function get_name()
    {
        return 'sky-portion-effect';
    }

    public function get_title()
    {
        return esc_html__('Portion Effect', 'sky-elementor-addons');
    }

    public function get_icon()
    {
        return 'sky-icon-portion-effect';
    }

    public function get_categories()
    {
        return ['sky-elementor-addons'];
    }

    public function get_keywords()
    {
        return ['sky', 'portion', 'effect', 'image', 'photo', 'portfolio'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'section_number_layout',
            [
                'label' => esc_html__('Layout', 'sky-elementor-addons'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image',
            [
                'label'   => esc_html__('Choose Image', 'sky-elementor-addons'),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_responsive_control(
            'block_height',
            [
                'label'     => esc_html__('Height', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-block{{CURRENT_ITEM}}' => 'height: {{SIZE}}%;',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'block_width',
            [
                'label'     => esc_html__('Width', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-block{{CURRENT_ITEM}}' => 'width: {{SIZE}}%;',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'block_top',
            [
                'label'     => esc_html__('Top', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-block{{CURRENT_ITEM}}' => 'top: {{SIZE}}%;',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'block_left',
            [
                'label'     => esc_html__('Left', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sa-block{{CURRENT_ITEM}}' => 'left: {{SIZE}}%;',
                ],
            ]
        );

        $this->add_control(
            'block_list',
            [
                'label'     => esc_html__('Blocks', 'sky-elementor-addons'),
                'type'      => Controls_Manager::REPEATER,
                'fields'    => $repeater->get_controls(),
                'separator' => 'before',
                'default'   => [
                    [],
                    [],
                    [],
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_portion_style',
            [
                'label' => esc_html__('Portion', 'sky-elementor-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'portion_height',
            [
                'label'      => esc_html__('Height', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 5,
                    ],
                    '%'  => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-portion-wrapper' => 'padding-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'box_shadow',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-side',
            ]
        );

        $this->add_responsive_control(
            'portion_angel',
            [
                'label'     => esc_html__('Angle', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 30,
                        'max'  => 50,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' => '--sky-pe-main-v-offset: {{SIZE}}deg;',
                ],
            ]
        );

        $this->add_control(
            'portion_left_heading',
            [
                'label'     => esc_html__('Left Side', 'sky-elementor-addons'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'left_width',
            [
                'label'     => esc_html__('Width', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' => '--sky-pe-left-width: {{SIZE}}%;',
                ],
            ]
        );

        $this->add_responsive_control(
            'left_rotate_y',
            [
                'label'     => esc_html__('Rotate Y', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 50,
                        'max'  => 70,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' => '--sky-pe-media-v-offset: -{{SIZE}}deg;',
                ],
            ]
        );

        $this->add_responsive_control(
            'left_brightness',
            [
                'label'     => esc_html__('Brightness', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} ' => '--sky-pe-media-filter: {{SIZE}}%;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute(
            [
                'portion' => [
                    'class'         => 'sa-portion-effect',
                    'data-settings' => [
                        wp_json_encode(array_filter([
                            'image' => isset($settings['image']['url']) ? esc_url($settings['image']['url']) : false,
                        ]))
                    ],
                ]
            ]
        );
?>
        <div <?php $this->print_render_attribute_string('portion'); ?>>
            <div class="sa-portion-wrapper">
                <?php
                foreach ($settings['block_list'] as $item) {
                ?>
                    <div class="sa-block elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                        <div class="sa-side -main"></div>
                        <div class="sa-side -left"></div>
                    </div>
                <?php } ?>
            </div>
        </div>
<?php
    }
}
