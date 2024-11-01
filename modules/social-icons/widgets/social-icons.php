<?php

namespace Sky_Addons\Modules\SocialIcons\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Social_Icons extends Widget_Base
{

    public function get_name()
    {
        return 'sky-social-icons';
    }

    public function get_title()
    {
        return esc_html__('Social Icons', 'sky-elementor-addons');
    }

    public function get_icon()
    {
        return 'sky-icon-social-icons';
    }

    public function get_categories()
    {
        return ['sky-elementor-addons'];
    }

    public function get_keywords()
    {
        return ['sky', 'social', 'icons'];
    }

    public function get_style_depends()
    {
        return [
            'elementor-icons-fa-solid',
            'elementor-icons-fa-brands',
        ];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'section_social_icon',
            [
                'label' => esc_html__('Social Icons', 'sky-elementor-addons'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'social_icon',
            [
                'label'       => esc_html__('Icon', 'sky-elementor-addons'),
                'type'        => Controls_Manager::ICONS,
                'default'     => [
                    'value'   => 'fab fa-facebook-f',
                    'library' => 'fa-brands',
                ],
                'recommended' => [
                    'fa-brands' => [
                        'android',
                        'apple',
                        'behance',
                        'bitbucket',
                        'codepen',
                        'delicious',
                        'deviantart',
                        'digg',
                        'dribbble',
                        'sky-elementor-addons',
                        'facebook',
                        'facebook-f',
                        'flickr',
                        'foursquare',
                        'free-code-camp',
                        'github',
                        'gitlab',
                        'globe',
                        'houzz',
                        'instagram',
                        'jsfiddle',
                        'linkedin',
                        'linkedin-in',
                        'medium',
                        'meetup',
                        'mix',
                        'mixcloud',
                        'odnoklassniki',
                        'pinterest',
                        'product-hunt',
                        'reddit',
                        'shopping-cart',
                        'skype',
                        'slideshare',
                        'snapchat',
                        'soundcloud',
                        'spotify',
                        'stack-overflow',
                        'steam',
                        'telegram',
                        'thumb-tack',
                        'tripadvisor',
                        'tumblr',
                        'twitch',
                        'twitter',
                        'viber',
                        'vimeo',
                        'vk',
                        'weibo',
                        'weixin',
                        'whatsapp',
                        'wordpress',
                        'xing',
                        'yelp',
                        'youtube',
                        '500px',
                    ],
                    'fa-solid'  => [
                        'envelope',
                        'link',
                        'rss',
                    ],
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label'       => esc_html__('Link', 'sky-elementor-addons'),
                'type'        => Controls_Manager::URL,
                'default'     => [
                    'is_external' => 'true',
                ],
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'sky-elementor-addons'),
            ]
        );

        $repeater->add_control(
            'enable_social_label',
            [
                'label' => esc_html__('Enable Social Name', 'sky-elementor-addons'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $repeater->add_control(
            'social_label',
            [
                'label'     => esc_html__('Social Name', 'sky-elementor-addons'),
                'type'      => Controls_Manager::TEXT,
                'dynamic'   => ['active' => true],
                'condition' => [
                    'enable_social_label' => 'yes'
                ]
            ]
        );

        $repeater->add_control(
            'item_icon_Customize',
            [
                'label'   => esc_html__('Customize', 'sky-elementor-addons'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Official Color', 'sky-elementor-addons'),
                    'custom'  => esc_html__('Custom', 'sky-elementor-addons'),
                ],
            ]
        );

        $repeater->start_controls_tabs(
            'tabs',
            [
                'condition' => [
                    'item_icon_Customize' => 'custom',
                ],
            ]
        );

        $repeater->start_controls_tab(
            'tab_custom_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons'),
            ]
        );

        $repeater->add_control(
            'item_icon_color',
            [
                'label'     => esc_html__('Icon Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-social-icons .sa-social-icon{{CURRENT_ITEM}} '       => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sa-social-icons .sa-social-icon{{CURRENT_ITEM}} svg * ' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'item_icon_bg',
            [
                'label'     => esc_html__('Background Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-social-icons .sa-social-icon{{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'item_icon_border_color',
            [
                'label'     => esc_html__('Border Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-social-icons .sa-social-icon{{CURRENT_ITEM}}' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            'tab_custom_hover',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons'),
            ]
        );

        $repeater->add_control(
            'item_icon_color_hover',
            [
                'label'     => esc_html__('Icon Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-social-icons .sa-social-icon{{CURRENT_ITEM}}:hover '       => 'color: {{VALUE}};',
                    '{{WRAPPER}} .sa-social-icons .sa-social-icon{{CURRENT_ITEM}}:hover svg * ' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'item_icon_bg_hover',
            [
                'label'     => esc_html__('Background Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-social-icons .sa-social-icon{{CURRENT_ITEM}}:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'item_icon_border_color_hover',
            [
                'label'     => esc_html__('Border Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-social-icons .sa-social-icon{{CURRENT_ITEM}}' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $repeater->end_controls_tab();

        $repeater->end_controls_tabs();

        $this->add_control(
            'social_icon_list',
            [
                'label'       => esc_html__('Social Icons', 'sky-elementor-addons'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'social_icon' => [
                            'value'   => 'fab fa-facebook-f',
                            'library' => 'fa-brands',
                        ],
                    ],
                    [
                        'social_icon' => [
                            'value'   => 'fab fa-twitter',
                            'library' => 'fa-brands',
                        ],
                    ],
                    [
                        'social_icon' => [
                            'value'   => 'fab fa-youtube',
                            'library' => 'fa-brands',
                        ],
                    ],
                ],
                'title_field' => '{{{ elementor.helpers.renderIcon( this, social_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}}<# print(elementor.helpers.getSocialNetworkNameFromIcon( social_icon ) || social_label); #>',
            ]
        );

        $this->add_responsive_control(
            'socials_icons_alignment',
            [
                'label'     => esc_html__('Alignment', 'sky-elementor-addons'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
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
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hide_socials_name',
            [
                'label' => esc_html__('Hide Social Name', 'sky-elementor-addons'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'show_separator',
            [
                'label' => esc_html__('Show separator', 'sky-elementor-addons'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'separator_select',
            [
                'label'     => esc_html__('Separator Type', 'sky-elementor-addons'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'default',
                'options'   => [
                    'default' => esc_html__('Default', 'sky-elementor-addons'),
                    'custom'  => esc_html__('Custom', 'sky-elementor-addons'),
                ],
                'condition' => [
                    'show_separator' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'separator_width',
            [
                'label'      => esc_html__('Separator Size', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 20,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-social-icon-separator.sa-default' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'show_separator'   => 'yes',
                    'separator_select' => 'default'
                ]
            ]
        );

        $this->add_control(
            'separator_text',
            [
                'label'     => esc_html__('Custom Separator', 'sky-elementor-addons'),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__('/', 'sky-elementor-addons'),
                'dynamic'   => ['active' => true],
                'condition' => [
                    'separator_select' => 'custom'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_social_icons_style',
            [
                'label' => esc_html__('Social Icons', 'sky-elementor-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_responsive_control(
            'social_icons_spacing',
            [
                'label'      => esc_html__('Spacing', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 50,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-social-icons .sa-link, 
                         {{WRAPPER}} .sa-social-icons .sa-link svg' => 'margin-right: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .sa-social-icon-separator'                                                                      => 'margin-right: {{SIZE}}{{UNIT}};  margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'social_icons_padding',
            [
                'label'      => esc_html__('Padding', 'sky-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-social-icons .sa-link'     => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .sa-social-icons .sa-link svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'social_icons_border',
                'label'    => esc_html__('Border', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-social-icons .sa-link, {{WRAPPER}} .sa-social-icons .sa-link svg',
            ]
        );

        $this->add_responsive_control(
            'social_icons_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-social-icons .sa-link'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .sa-social-icons .sa-link svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'show_socials_adv_border_radius!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_socials_adv_border_radius',
            [
                'label' => esc_html__('Advanced Border Radius', 'sky-elementor-addons'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'socials_adv_border_radius',
            [
                'label'     => esc_html__('Radius', 'sky-elementor-addons'),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__('30% 70% 70% 30% / 30% 30% 70% 70% ', 'sky-elementor-addons'),
                'dynamic'   => ['active' => true],
                'selectors' => [
                    '{{WRAPPER}} .sa-social-icons .sa-link'     => 'border-radius: {{VALUE}};',
                    '{{WRAPPER}} .sa-social-icons .sa-link svg' => 'border-radius: {{VALUE}};',
                ],
                'condition' => [
                    'show_socials_adv_border_radius' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs('social_icons_tabs');

        $this->start_controls_tab(
            'social_icons_tab_normal',
            [
                'label' => esc_html__('Normal', 'sky-elementor-addons'),
            ]
        );

        $this->add_control(
            'social_icons_color',
            [
                'label'     => esc_html__('Icons Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-social-icons .sa-link'       => 'color: {{VALUE}}',
                    '{{WRAPPER}} .sa-social-icons .sa-link svg *' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'social_icons_bg',
                'label'    => esc_html__('Background', 'sky-elementor-addons'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-social-icons .sa-link, {{WRAPPER}} .sa-social-icons .sa-link svg',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'social_icons_box_shadow',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-social-icons .sa-link, {{WRAPPER}} .sa-social-icons .sa-link svg',
            ]
        );

        $this->add_control(
            'social_icons_opacity',
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
                    '{{WRAPPER}} .sa-social-icons .sa-link' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'social_icons_tab_hover',
            [
                'label' => esc_html__('Hover', 'sky-elementor-addons'),
            ]
        );

        $this->add_control(
            'social_icons_color_hover',
            [
                'label'     => esc_html__('Icons Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-social-icons .sa-link:hover'       => 'color: {{VALUE}}',
                    '{{WRAPPER}} .sa-social-icons .sa-link:hover svg *' => 'fill: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'social_icons_bg_hover',
                'label'    => esc_html__('Background', 'sky-elementor-addons'),
                'types'    => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .sa-social-icons .sa-link:hover, {{WRAPPER}} .sa-social-icons .sa-link:hover svg',
            ]
        );

        $this->add_control(
            'social_icons_border_color_hover',
            [
                'label'     => esc_html__('Border Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-social-icons .sa-link:hover'     => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .sa-social-icons .sa-link:hover svg' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'social_icons_border_border!' => '',
                ],
            ]
        );

        $this->add_responsive_control(
            'social_icons_border_radius_hover',
            [
                'label'      => esc_html__('Border Radius', 'sky-elementor-addons'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .sa-social-icons .sa-link:hover'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .sa-social-icons .sa-link:hover svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'show_socials_adv_border_radius!' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'social_icons_shadow_hover',
                'label'    => esc_html__('Text Shadow', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-social-icons .sa-link:hover i, {{WRAPPER}} .sa-social-icons .sa-link:hover svg',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'social_icons_box_shadow_hover',
                'label'    => esc_html__('Box Shadow', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-social-icons .sa-link:hover, {{WRAPPER}} .sa-social-icons .sa-link:hover svg',
            ]
        );

        $this->add_control(
            'social_icons_opacity_hover',
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
                    '{{WRAPPER}} .sa-social-icons .sa-link:hover' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_control(
            'icons_hover_animation',
            [
                'label' => esc_html__('Hover Animation', 'sky-elementor-addons'),
                'type'  => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


        $this->start_controls_section(
            'section_icons_style',
            [
                'label' => esc_html__('Icon', 'sky-elementor-addons'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'social_icons_icon_size',
            [
                'label'      => esc_html__('Icon Size', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}}'                               => '--icon-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .sa-social-icons .sa-link svg' => 'height: {{SIZE}}{{UNIT}}; width:auto;',
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'section_social_label_style',
            [
                'label'     => esc_html__('Label', 'sky-elementor-addons'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'hide_socials_name!' => 'yes'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'social_label_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-social-label',
            ]
        );

        $this->add_responsive_control(
            'social_label_spacing',
            [
                'label'      => esc_html__('Spacing', 'sky-elementor-addons'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em'],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 50,
                        'step' => 1,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .sa-social-label' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );



        $this->end_controls_section();

        $this->start_controls_section(
            'section_separator_style',
            [
                'label'     => esc_html__('Separator', 'sky-elementor-addons'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_separator' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'separator_color',
            [
                'label'     => esc_html__('Color', 'sky-elementor-addons'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sa-social-icon-separator'            => 'color: {{VALUE}}',
                    '{{WRAPPER}} .sa-social-icon-separator.sa-default' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'separator_typography',
                'label'    => esc_html__('Typography', 'sky-elementor-addons'),
                'selector' => '{{WRAPPER}} .sa-social-icon-separator',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $class_animation = '';

        if (!empty($settings['icons_hover_animation'])) {
            $class_animation = ' elementor-animation-' . $settings['icons_hover_animation'];
        }
?>
        <div class="sa-social-icons sa-d-inline-flex sa-align-items-center sa-justify-content-center">
            <?php
            foreach ($settings['social_icon_list'] as $index => $item) :

                $social = '';
                if (!empty($item['social_icon']['value'])) {
                    $social = explode(' ', $item['social_icon']['value'], 2);

                    $social = str_replace('fa-', '', $social[1]);
                }

                $link_key = 'link_' . $index;
                $this->add_render_attribute($link_key, 'class', [
                    'sa-link sa-social-icon sa-text-decoration-none',
                    'elementor-social-icon-' . $class_animation,
                    'elementor-repeater-item-' . $item['_id'],
                    'elementor-social-icon-' . $social
                ]);

                $this->add_link_attributes($link_key, $item['link']);
            ?>
                <a <?php $this->print_render_attribute_string($link_key); ?>>
                    <?php
                    Icons_Manager::render_icon($item['social_icon']);

                    if ($settings['hide_socials_name'] != 'yes' && !empty($item['social_label'])) : ?>
                        <span class="sa-social-label"><?php echo esc_html($item['social_label']); ?></span>
                    <?php endif; ?>
                </a>
                <?php if ($settings['show_separator'] == 'yes' && $settings['separator_select'] == 'default') : ?>
                    <span class="sa-social-icon-separator sa-default"> </span>
                <?php elseif ($settings['show_separator'] == 'yes' && !empty($settings['separator_text'])) : ?>
                    <span class="sa-social-icon-separator"><?php echo esc_html($settings['separator_text']); ?></span>
                <?php
                else :

                endif;
                ?>
            <?php endforeach; ?>
        </div>
<?php
    }
}
