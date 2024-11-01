<?php

namespace Sky_Addons\Modules\ReadingProgress\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Sky_Addons\Modules\ReadingProgress\Skins;

if (!defined('ABSPATH'))
        exit; // Exit if accessed directly

class Reading_Progress extends Widget_Base
{

        public function get_name()
        {
                return 'sky-reading-progress';
        }

        public function get_title()
        {
                return esc_html__('Reading Progress', 'sky-elementor-addons');
        }

        public function get_icon()
        {
                return 'sky-icon-reading-progress';
        }

        public function get_categories()
        {
                return ['sky-elementor-addons'];
        }

        public function get_keywords()
        {
                return ['sky', 'reading', 'progress'];
        }

        public function get_script_depends()
        {
                return ['sa-reading-progress'];
        }

        protected function register_skins()
        {
                $this->add_skin(new Skins\Skin_Fancy_Horizontal($this));
                $this->add_skin(new Skins\Skin_Fancy_Vertical($this));
                $this->add_skin(new Skins\Skin_Scroll_Top($this));
                $this->add_skin(new Skins\Skin_With_Cursor($this));
        }

        protected function register_controls()
        {

                $this->start_controls_section(
                        'section_reading_progress',
                        [
                                'label' => esc_html__('Reading Progress', 'sky-elementor-addons'),
                                'tab'   => Controls_Manager::TAB_CONTENT,
                        ]
                );

                $this->add_control(
                        'primary_size',
                        [
                                'label'       => esc_html__('Size', 'sky-elementor-addons'),
                                'type'        => Controls_Manager::SLIDER,
                                'range'       => [
                                        'px' => [
                                                'min' => 1,
                                                'max' => 20,
                                        ],
                                ],
                                'selectors'   => [
                                        '{{WRAPPER}} .elementor-widget-container' => '--sky-reading-progress-size: {{SIZE}}px;',
                                ],
                                'separator'   => 'before',
                                'render_type' => 'template'
                        ]
                );

                $this->add_control(
                        'position',
                        [
                                'label'                => esc_html__('Select Position', 'sky-elementor-addons'),
                                'type'                 => Controls_Manager::SELECT,
                                'default'              => 'top',
                                'options'              => [
                                        'top'    => esc_html__('Top', 'sky-elementor-addons'),
                                        'bottom' => esc_html__('Bottom', 'sky-elementor-addons'),
                                ],
                                'selectors'            => [
                                        '{{WRAPPER}} .sa-reading-progress.sa-skin-default' => '{{VALUE}};',
                                ],
                                'selectors_dictionary' => [
                                        'top'    => 'bottom: unset; top: 0;',
                                        'bottom' => 'top: unset !important; bottom: 0;'
                                ],
                                'condition'            => [
                                        '_skin' => [''],
                                ]
                        ]
                );

                $this->add_control(
                        'fancy_reading_position',
                        [
                                'label'                => esc_html__('Select Position', 'sky-elementor-addons'),
                                'type'                 => Controls_Manager::SELECT,
                                'default'              => 'left',
                                'options'              => [
                                        'left'  => esc_html__('Left', 'sky-elementor-addons'),
                                        'right' => esc_html__('Right', 'sky-elementor-addons'),
                                ],
                                'prefix_class'         => 'sa-fancy-reading-position-',
                                'selectors'            => [
                                        '{{WRAPPER}} .sa-reading-progress.sa-skin-fancy-vertical' => '{{VALUE}};',
                                ],
                                'selectors_dictionary' => [
                                        'left'  => 'right: unset; left: var(--sky-rp-fancy-spacing, 2vw);',
                                        'right' => 'right: var(--sky-rp-fancy-spacing, 2vw); left:unset;'
                                ],
                                'condition'            => [
                                        '_skin' => ['sky-skin-fancy-vertical'],
                                ]
                        ]
                );

                $this->add_responsive_control(
                        'fancy_reading_spacing',
                        [
                                'label'       => esc_html__('Spacing', 'sky-elementor-addons'),
                                'type'        => Controls_Manager::SLIDER,
                                'range'       => [
                                        'px' => [
                                                'min' => 0,
                                                'max' => 100,
                                        ],
                                ],
                                'selectors'   => [
                                        '{{WRAPPER}}' => '--sky-rp-fancy-spacing: {{SIZE}}vw',
                                ],
                                'render_type' => 'template',
                                'condition'   => [
                                        '_skin' => ['sky-skin-fancy-vertical'],
                                ]
                        ]
                );


                $this->add_control(
                        'scroll_top_position',
                        [
                                'label'                => esc_html__('Position', 'sky-elementor-addons'),
                                'type'                 => Controls_Manager::SELECT,
                                'default'              => '2',
                                'options'              => [
                                        '1' => esc_html__('Right top', 'sky-elementor-addons'),
                                        '2' => esc_html__('Right Bottom', 'sky-elementor-addons'),
                                        '3' => esc_html__('Left Top', 'sky-elementor-addons'),
                                        '4' => esc_html__('Left Bottom', 'sky-elementor-addons'),
                                ],
                                'prefix_class'         => 'sa-fancy-reading-position-',
                                'selectors'            => [
                                        '{{WRAPPER}} .sa-reading-progress.sa-skin-scroll-top' => '{{VALUE}};',
                                ],
                                'selectors_dictionary' => [
                                        '1' => 'right: 50px; top: 50px; left:unset; bottom:unset;',
                                        '2' => 'right: 50px;',
                                        '3' => 'left: 50px; top: 50px; right:unset; bottom:unset;',
                                        '4' => 'left: 50px; right:unset;',
                                ],
                                'condition'            => [
                                        '_skin' => ['sky-skin-scroll-top'],
                                ]
                        ]
                );

                // start offset
                $this->add_control(
                        'reading_progress_offset_popover',
                        [
                                'label'        => esc_html__('Offset', 'sky-elementor-addons'),
                                'type'         => Controls_Manager::POPOVER_TOGGLE,
                                'label_off'    => esc_html__('Default', 'sky-elementor-addons'),
                                'label_on'     => esc_html__('Custom', 'sky-elementor-addons'),
                                'return_value' => 'yes',
                                'condition'    => [
                                        '_skin' => ['sky-skin-scroll-top'],
                                ]
                        ]
                );


                $this->start_popover(
                        [
                                'condition' => [
                                        '_skin' => ['sky-skin-scroll-top'],
                                ]
                        ]
                );

                $this->add_responsive_control(
                        'reading_progress_horizontal_offset',
                        [
                                'label'          => esc_html__('Horizontal Offset', 'sky-elementor-addons'),
                                'type'           => Controls_Manager::SLIDER,
                                'default'        => [
                                        'size' => 0,
                                ],
                                'tablet_default' => [
                                        'size' => 0,
                                ],
                                'mobile_default' => [
                                        'size' => 0,
                                ],
                                'range'          => [
                                        'px' => [
                                                'min' => -100,
                                                'max' => 100,
                                        ],
                                ],
                                'render_type'    => 'ui',
                                'condition'      => [
                                        'reading_progress_offset_popover' => 'yes'
                                ],
                                'selectors'      => [
                                        '{{WRAPPER}} .sa-reading-progress' => '--sky-media-h-offset: {{SIZE}}px;'
                                ],
                        ]
                );

                $this->add_responsive_control(
                        'reading_progress_vertical_offset',
                        [
                                'label'          => esc_html__('Vertical Offset', 'sky-elementor-addons'),
                                'type'           => Controls_Manager::SLIDER,
                                'default'        => [
                                        'size' => 0,
                                ],
                                'tablet_default' => [
                                        'size' => 0,
                                ],
                                'mobile_default' => [
                                        'size' => 0,
                                ],
                                'range'          => [
                                        'px' => [
                                                'min' => -100,
                                                'max' => 100,
                                        ],
                                ],
                                'render_type'    => 'ui',
                                'condition'      => [
                                        'reading_progress_offset_popover' => 'yes'
                                ],
                                'selectors'      => [
                                        '{{WRAPPER}} .sa-reading-progress' => '--sky-media-v-offset: {{SIZE}}px;'
                                ],
                        ]
                );

                $this->end_popover();
                // end offset

                $this->end_controls_section();

                $this->start_controls_section(
                        'section_reading_progress_style',
                        [
                                'label' => esc_html__('Reading Progress', 'sky-elementor-addons'),
                                'tab'   => Controls_Manager::TAB_STYLE,
                        ]
                );

                // progress color
                $this->add_control(
                        'primary_color',
                        [
                                'label'       => esc_html__('Color', 'sky-elementor-addons'),
                                'type'        => Controls_Manager::COLOR,
                                'selectors'   => [
                                        '{{WRAPPER}}' => '--sky-r-p-primary-color: {{VALUE}}',
                                ],
                                'render_type' => 'template'
                        ]
                );

                // base color
                $this->add_control(
                        'secondary_color',
                        [
                                'label'       => esc_html__('Base Color', 'sky-elementor-addons'),
                                'type'        => Controls_Manager::COLOR,
                                'selectors'   => [
                                        '{{WRAPPER}}' => '--sky-r-p-secondary-color: {{VALUE}}',
                                ],
                                'render_type' => 'template',
                                'condition'   => [
                                        '_skin' => ['', 'sky-skin-scroll-top', 'sky-skin-with-cursor'],
                                ],
                        ]
                );

                $this->add_control(
                        'icon_color',
                        [
                                'label'     => esc_html__('Icon Color', 'sky-elementor-addons'),
                                'type'      => Controls_Manager::COLOR,
                                'selectors' => [
                                        '{{WRAPPER}} .sa-reading-progress.sa-skin-scroll-top::before' => 'background-color: {{VALUE}}',
                                ],
                                'condition' => [
                                        '_skin' => ['sky-skin-scroll-top'],
                                ],
                                'separator' => 'before',
                        ]
                );

                $this->add_responsive_control(
                        'icon_size',
                        [
                                'label'      => esc_html__('Icon Size', 'sky-elementor-addons'),
                                'type'       => Controls_Manager::SLIDER,
                                'size_units' => ['px', 'em'],
                                'range'      => [
                                        'px' => [
                                                'min' => 0,
                                                'max' => 30,
                                        ],
                                ],
                                'selectors'  => [
                                        '{{WRAPPER}} .sa-reading-progress.sa-skin-scroll-top::before' => 'font-size: {{SIZE}}{{UNIT}};',
                                ],
                                'condition'  => [
                                        '_skin' => ['sky-skin-scroll-top'],
                                ]
                        ]
                );

                $this->end_controls_section();

                $this->start_controls_section(
                        'section_perc_style',
                        [
                                'label'     => esc_html__('Percentage', 'sky-elementor-addons'),
                                'tab'       => Controls_Manager::TAB_STYLE,
                                'condition' => [
                                        '_skin' => ['sky-skin-fancy-horizontal', 'sky-skin-fancy-vertical'],
                                ]
                        ]
                );

                $this->add_control(
                        'perc_value_color',
                        [
                                'label'     => esc_html__('Value Color', 'sky-elementor-addons'),
                                'type'      => Controls_Manager::COLOR,
                                'selectors' => [
                                        '{{WRAPPER}}' => '--sky-rp-perc-value-color: {{VALUE}}',
                                ],
                        ]
                );

                $this->add_control(
                        'perc_color',
                        [
                                'label'     => esc_html__('Percentage Color', 'sky-elementor-addons'),
                                'type'      => Controls_Manager::COLOR,
                                'selectors' => [
                                        '{{WRAPPER}}' => '--sky-rp-perc-color: {{VALUE}}',
                                ],
                        ]
                );

                $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                                'name'     => 'perc_typography',
                                'label'    => esc_html__('Typography', 'sky-elementor-addons'),
                                'selector' => '{{WRAPPER}} .sa-reading-progress.sa-skin-fancy-horizontal span',
                        ]
                );

                $this->end_controls_section();
        }

        public function render()
        {
                $settings = $this->get_settings_for_display();
                $id = 'sa-reading-progress-' . $this->get_id();
                $this->add_render_attribute(
                        [
                                'reading-progress' => [
                                        'id'            => $id,
                                        'class'         => 'sa-reading-progress sa-skin-default',
                                        'data-settings' => [
                                                wp_json_encode(
                                                        [
                                                                'id'             => '#sa-reading-progress-' . $this->get_id(),
                                                                'size'           => !(empty($settings['primary_size']['size'])) ? $settings['primary_size']['size'] : 5,
                                                                'primaryColor'   => !(empty($settings['primary_color'])) ? $settings['primary_color'] : 'blueviolet',
                                                                'secondaryColor' => !(empty($settings['secondary_color'])) ? $settings['secondary_color'] : '#e2498a',
                                                        ]
                                                ),
                                        ],
                                ],
                        ]
                );
?>

                <div <?php $this->print_render_attribute_string('reading-progress'); ?>> </div>

<?php
        }
}
