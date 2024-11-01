<?php

namespace Sky_Addons\Modules\TeamMember\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Team_Member extends Widget_Base {

	public function get_name() {
		return 'sky-team-member';
	}

	public function get_title() {
		return esc_html__( 'Team Member', 'sky-elementor-addons' );
	}

	public function get_icon() {
		return 'sky-icon-team-member';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'sky', 'team', 'member', 'profile', 'portfolio' ];
	}

	public function get_style_depends() {
		return [ 
			'elementor-icons-fa-solid',
			'elementor-icons-fa-brands',
		];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_member_layout',
			[ 
				'label' => esc_html__( 'Member Info', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'style_select',
			[ 
				'label' => esc_html__( 'Select Style', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [ 
					'default' => esc_html__( 'Default', 'sky-elementor-addons' ),
					'ardent' => esc_html__( 'Ardent', 'sky-elementor-addons' ),
					'folk' => esc_html__( 'Folk', 'sky-elementor-addons' ),
					'folker' => esc_html__( 'Folker', 'sky-elementor-addons' ),
					'slide' => esc_html__( 'Slide', 'sky-elementor-addons' ),
					'mold' => esc_html__( 'Mold', 'sky-elementor-addons' ),
					//                        'flip'    => esc_html__('Flip', 'sky-elementor-addons'),
				],
				'render_type' => 'content',
			]
		);

		$this->add_control(
			'slide_effect',
			[ 
				'label' => esc_html__( 'Slide Effect', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'top-to-bottom',
				'options' => [ 
					'top-to-bottom' => esc_html__( 'Top to Bottom', 'sky-elementor-addons' ),
					'bottom-to-top' => esc_html__( 'Bottom to Top', 'sky-elementor-addons' ),
					'left-to-right' => esc_html__( 'Left To Right', 'sky-elementor-addons' ),
					'right-to-left' => esc_html__( 'Right to Left', 'sky-elementor-addons' ),
				],
				'render_type' => 'content',
				'condition' => [ 
					'style_select' => 'slide',
				],
			]
		);

		$this->add_responsive_control(
			'image_position',
			[ 
				'label' => esc_html__( 'Image Position', 'sky-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [ 
					'left' => [ 
						'title' => esc_html__( 'Left', 'sky-elementor-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [ 
						'title' => esc_html__( 'Top', 'sky-elementor-addons' ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [ 
						'title' => esc_html__( 'Right', 'sky-elementor-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'top',
				'toggle' => false,
				'prefix_class' => 'sa-team-member-%s-',
				'style_transfer' => true,
				'selectors' => [ 
					'{{WRAPPER}} .elementor-widget-container .sa-team-member' => '{{VALUE}};',
				],
				'selectors_dictionary' => [ 
					'left' => 'display: flex; flex-direction: row; text-align: left;',
					'top' => 'text-align: left; display: block; flex-direction: unset; flex-flow: unset;',
					'right' => 'display: flex; flex-direction: row-reverse; text-align: right;'
				],
				'condition' => [ 
					'style_select' => 'default',
				],
				'separator' => 'before',
			]
		);
		$this->add_control(
			'image',
			[ 
				'label' => esc_html__( 'Choose Image', 'sky-elementor-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [ 
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [ 'active' => true ],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[ 
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'large',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'show_alter_image',
			[ 
				'label' => esc_html__( 'Alternative Image', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'prefix_class' => 'sa-alter-img-',
				'separator' => 'before',
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'alter_image',
			[ 
				'label' => esc_html__( 'Choose Image', 'sky-elementor-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [ 
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [ 'active' => true ],
				'condition' => [ 
					'show_alter_image' => 'yes',
				]
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[ 
				'name' => 'alter_thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'large',
				'separator' => 'none',
				'condition' => [ 
					'show_alter_image' => 'yes',
				]
			]
		);

		$this->add_control(
			'name',
			[ 
				'label' => esc_html__( 'Name', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'John Doe', 'sky-elementor-addons' ),
				'placeholder' => esc_html__( 'Type name here', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'name_tag',
			[ 
				'label' => esc_html__( 'Name HTML Tag', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => sky_title_tags(),
			]
		);

		$this->add_control(
			'show_job_title',
			[ 
				'label' => esc_html__( 'Show Job Title', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'job_title',
			[ 
				'label' => esc_html__( 'Job Title', 'sky-elementor-addons' ),
				'label_block' => true,
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Software Engineer', 'sky-elementor-addons' ),
				'placeholder' => esc_html__( 'Type your job title here', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
				'condition' => [ 
					'show_job_title' => 'yes'
				],
			]
		);

		$this->add_control(
			'job_title_tag',
			[ 
				'label' => esc_html__( 'Job Title HTML Tag', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h6',
				'options' => sky_title_tags(),
				'condition' => [ 
					'show_job_title' => 'yes'
				]
			]
		);

		$this->add_control(
			'text',
			[ 
				'label' => esc_html__( 'Short Text', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Type your text here', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'text_show_note',
			[ 
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'In this style (mold), the Short Text will not visible for design purposes.', 'sky-elementor-addons' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'condition' => [ 
					'style_select' => 'mold'
				]
			]
		);

		$this->add_control(
			'show_socials',
			[ 
				'label' => esc_html__( 'Show Social Icons', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'show_button',
			[ 
				'label' => esc_html__( 'Show Button', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'button_show_note',
			[ 
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'In this style (mold), the Button will not visible for design purposes.', 'sky-elementor-addons' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'condition' => [ 
					'style_select' => 'mold'
				]
			]
		);

		$this->end_controls_section();

		//start social icons

		$this->start_controls_section(
			'section_socials_layout',
			[ 
				'label' => esc_html__( 'Social Media', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [ 
					'show_socials' => 'yes',
				]
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'social_name',
			[ 
				'label' => esc_html__( 'Title', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Social Title', 'sky-elementor-addons' ),
				'label_block' => true,
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'social_link',
			[ 
				'label' => esc_html__( 'Link', 'sky-elementor-addons' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'sky-elementor-addons' ),
				'show_external' => true,
				'default' => [ 
					'url' => 'https://your-link.com',
					'is_external' => true,
				],
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'social_icon',
			[ 
				'label' => esc_html__( 'Choose Icon', 'sky-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
			]
		);

		//        $repeater->add_control(
		//            'social_color', [
		//                'label'     => esc_html__('Color', 'sky-elementor-addons'),
		//                'type'      => Controls_Manager::COLOR,
		//                'selectors' => [
		//                        '{{WRAPPER}} {{CURRENT_ITEM}}' => 'color: {{VALUE}}'
		//                ],
		//            ]
		//        );

		$repeater->add_control(
			'icon_customize',
			[ 
				'label' => esc_html__( 'Customize ?', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$repeater->start_controls_tabs(
			'tabs',
			[ 
				'condition' => [ 
					'icon_customize' => 'yes',
				],
			]
		);

		$repeater->start_controls_tab(
			'tab_custom_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'item_icon_color',
			[ 
				'label' => esc_html__( 'Icon Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-link{{CURRENT_ITEM}} ' => 'color: {{VALUE}};',
					'{{WRAPPER}} .sa-link{{CURRENT_ITEM}} svg * ' => 'fill: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'item_icon_bg',
			[ 
				'label' => esc_html__( 'Background Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-link{{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'item_icon_border_color',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-link{{CURRENT_ITEM}}' => 'border-color: {{VALUE}};',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'tab_custom_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'item_icon_color_hover',
			[ 
				'label' => esc_html__( 'Icon Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-link{{CURRENT_ITEM}}:hover ' => 'color: {{VALUE}};',
					'{{WRAPPER}} .sa-link{{CURRENT_ITEM}}:hover svg * ' => 'fill: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'item_icon_bg_hover',
			[ 
				'label' => esc_html__( 'Background Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-link{{CURRENT_ITEM}}:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$repeater->add_control(
			'item_icon_border_color_hover',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-link{{CURRENT_ITEM}}' => 'border-color: {{VALUE}};',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'social_list',
			[ 
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [ 
					[ 
						'social_name' => esc_html__( 'Facebook', 'sky-elementor-addons' ),
						'social_link' => 'https://www.facebook.com/',
						'social_icon' => [ 
							'value' => 'fab fa-facebook-f',
							'library' => 'fa-brands'
						],
					],
					[ 
						'social_name' => esc_html__( 'Twitter', 'sky-elementor-addons' ),
						'social_link' => 'https://www.twitter.com/',
						'social_icon' => [ 
							'value' => 'fab fa-twitter',
							'library' => 'fa-brands'
						],
					],
					[ 
						'social_name' => esc_html__( 'Linkedin', 'sky-elementor-addons' ),
						'social_link' => 'https://www.linkedin.com/',
						'social_icon' => [ 
							'value' => 'fab fa-linkedin-in',
							'library' => 'fa-brands'
						],
					],
				],
				'title_field' => '{{{ elementor.helpers.renderIcon( this, social_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}}{{{ social_name }}}',
			]
		);


		$this->end_controls_section();



		// start button

		$this->start_controls_section(
			'section_button',
			[ 
				'label' => esc_html__( 'Button', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [ 
					'show_button' => 'yes'
				]
			]
		);

		$this->add_control(
			'button_position',
			[ 
				'label' => esc_html__( 'Button Position', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'after_socials',
				'options' => [ 
					'after_socials' => esc_html__( 'After Social Icons', 'sky-elementor-addons' ),
					'before_socials' => esc_html__( 'Before Social Icons', 'sky-elementor-addons' ),
				],
				'condition' => [ 
					'style_select!' => 'ardent'
				]
			]
		);

		$this->add_control(
			'button_text',
			[ 
				'label' => esc_html__( 'Button Text', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Click here', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'link',
			[ 
				'label' => esc_html__( 'Link', 'sky-elementor-addons' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'sky-elementor-addons' ),
				'show_external' => true,
				'default' => [ 
					'url' => '',
					'is_external' => true,
				],
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'button_full_width',
			[ 
				'label' => esc_html__( 'Full Width', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'button_alignment',
			[ 
				'label' => esc_html__( 'Alignment', 'sky-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [ 
					'left' => [ 
						'title' => esc_html__( 'Left', 'sky-elementor-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [ 
						'title' => esc_html__( 'Center', 'sky-elementor-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [ 
						'title' => esc_html__( 'Right', 'sky-elementor-addons' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [ 
						'title' => esc_html__( 'Justified', 'sky-elementor-addons' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'condition' => [ 
					'button_full_width' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-team-member .sa-button' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_icon',
			[ 
				'label' => esc_html__( 'Icon', 'sky-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'button_icon_position',
			[ 
				'label' => esc_html__( 'Icon Position', 'sky-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options' => [ 
					'before' => [ 
						'title' => esc_html__( 'Before', 'sky-elementor-addons' ),
						'icon' => 'eicon-h-align-left',
					],
					'after' => [ 
						'title' => esc_html__( 'After', 'sky-elementor-addons' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'default' => 'after',
				'toggle' => false,
				'condition' => [ 
					'button_icon[value]!' => ''
				],
				'style_transfer' => true,
			]
		);

		$this->add_responsive_control(
			'button_icon_spacing',
			[ 
				'label' => esc_html__( 'Icon Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 20,
					],
				],
				'condition' => [ 
					'button_icon[value]!' => ''
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-button-icon-before .sa-button-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sa-button-icon-after .sa-button-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_member_style',
			[ 
				'label' => esc_html__( 'Member', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'member_alignment',
			[ 
				'label' => esc_html__( 'Alignment', 'sky-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [ 
					'left' => [ 
						'title' => esc_html__( 'Left', 'sky-elementor-addons' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [ 
						'title' => esc_html__( 'Center', 'sky-elementor-addons' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [ 
						'title' => esc_html__( 'Right', 'sky-elementor-addons' ),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [ 
						'title' => esc_html__( 'Justified', 'sky-elementor-addons' ),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-team-member' => 'text-align: {{VALUE}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[ 
				'label' => esc_html__( 'Content Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-team-member .sa-content-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_mold_Content_style',
			[ 
				'label' => esc_html__( 'Mold Content', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'style_select' => [ 'mold' ]
					//                        'style_select' => ['mold','default'] 
				]
			]
		);

		$this->start_controls_tabs( 'content_tabs' );

		$this->start_controls_tab(
			'content_tab_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'content_bg',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-content-area',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'content_tab_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'content_bg_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .elementor-widget-container:hover .sa-content-area::before',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_ardent_overlay_style',
			[ 
				'label' => esc_html__( 'Overlay', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'style_select' => [ 'ardent', 'folk', 'slide' ]
				]
			]
		);

		$this->add_control(
			'ardent_overlay_color',
			[ 
				'label' => esc_html__( 'Overlay Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-overlay-area' => 'background: linear-gradient(to bottom, rgba(0,0,0,0) 0%,{{VALUE}} 100%)',
					'{{WRAPPER}} .style-folk .sa-overlay-area, {{WRAPPER}} .style-slide .sa-overlay-area' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'ardent_overlay_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-overlay-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_img_style',
			[ 
				'label' => esc_html__( 'Image', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'img_spacing',
			[ 
				'label' => esc_html__( 'Bottom Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-img-area' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'img_width',
			[ 
				'label' => esc_html__( 'Width', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [ 
					'px' => [ 
						'min' => 50,
						'max' => 200,
						'step' => 1,
					],
					'%' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-img-area' => '--sa-team-member-img-area-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'img_height',
			[ 
				'label' => esc_html__( 'Height', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 150,
						'max' => 800,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-img-area' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'img_offset_popover',
			[ 
				'label' => esc_html__( 'Offset', 'sky-elementor-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
				'label_off' => esc_html__( 'Default', 'sky-elementor-addons' ),
				'label_on' => esc_html__( 'Custom', 'sky-elementor-addons' ),
				'return_value' => 'yes',
			]
		);

		$this->start_popover();

		$this->add_responsive_control(
			'img_horizontal_offset',
			[ 
				'label' => esc_html__( 'Horizontal Offset', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [ 
					'size' => 0,
				],
				'tablet_default' => [ 
					'size' => 0,
				],
				'mobile_default' => [ 
					'size' => 0,
				],
				'range' => [ 
					'px' => [ 
						'min' => -300,
						'max' => 300,
					],
				],
				'render_type' => 'ui',
				'condition' => [ 
					'img_offset_popover' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-team-member' => '--sky-media-h-offset: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'img_vertical_offset',
			[ 
				'label' => esc_html__( 'Vertical Offset', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [ 
					'size' => 0,
				],
				'tablet_default' => [ 
					'size' => 0,
				],
				'mobile_default' => [ 
					'size' => 0,
				],
				'range' => [ 
					'px' => [ 
						'min' => -300,
						'max' => 300,
					],
				],
				'render_type' => 'ui',
				'condition' => [ 
					'img_offset_popover' => 'yes'
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-team-member' => '--sky-media-v-offset: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'img_rotate',
			[ 
				'label' => esc_html__( 'Rotate', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => [ 
					'size' => 0,
				],
				'tablet_default' => [ 
					'size' => 0,
				],
				'mobile_default' => [ 
					'size' => 0,
				],
				'range' => [ 
					'px' => [ 
						'min' => -360,
						'max' => 360,
					],
				],
				'condition' => [ 
					'img_offset_popover' => 'yes'
				],
				'render_type' => 'ui',
				//                'selectors'   => [
				//                        '(desktop){{WRAPPER}} .sa-team-member .sa-img-area' => 'transform: translate({{img_horizontal_offset.SIZE}}px, {{img_vertical_offset.SIZE}}px) rotate({{SIZE}}deg);',
				//                        '(tablet){{WRAPPER}} .sa-team-member .sa-img-area'  => 'transform: translate({{img_horizontal_offset_tablet.SIZE}}px, {{img_vertical_offset_tablet.SIZE}}px) rotate({{SIZE}}deg);',
				//                        '(mobile){{WRAPPER}} .sa-team-member .sa-img-area'  => 'transform: translate({{img_horizontal_offset_mobile.SIZE}}px, {{img_vertical_offset_mobile.SIZE}}px) rotate({{SIZE}}deg);',
				//                ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-team-member' => '--sky-media-rotate: {{SIZE}}deg;'
				],
			]
		);

		$this->end_popover();



		$this->add_responsive_control(
			'img_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-img-area img ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'img_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-img-area img',
			]
		);

		$this->add_responsive_control(
			'img_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-img-area img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'img_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-img-area img',
			]
		);


		$this->start_controls_tabs( 'tabs_img_style' );

		$this->start_controls_tab(
			'tab_img_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'img_opacity',
			[ 
				'label' => esc_html__( 'Opacity', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-img-area img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[ 
				'name' => 'img_css_filters',
				'selector' => '{{WRAPPER}} .sa-img-area img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_img_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'img_opacity_hover',
			[ 
				'label' => esc_html__( 'Opacity', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-img-area img:hover' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[ 
				'name' => 'img_css_filters_hover',
				'selector' => '{{WRAPPER}} .sa-img-area img:hover',
			]
		);

		$this->add_control(
			'img_transition',
			[ 
				'label' => esc_html__( 'Transition Duration (s)', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-img-area img' => 'transition-duration: {{SIZE}}s',
				],
			]
		);

		$this->add_control(
			'img_hover_animation',
			[ 
				'label' => esc_html__( 'Hover Animation', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();



		$this->start_controls_section(
			'section_name_style',
			[ 
				'label' => esc_html__( 'Name', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'name!' => '',
				]
			]
		);

		$this->add_responsive_control(
			'name_spacing',
			[ 
				'label' => esc_html__( 'Bottom Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
					'%' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'name_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-name',
			]
		);

		$this->start_controls_tabs( 'tabs_name_style' );

		$this->start_controls_tab(
			'tab_name_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'name_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'name_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-name',
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_name_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'name_color_hover',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .elementor-widget-container:hover .sa-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'name_text_shadow_hover',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .elementor-widget-container:hover .sa-name',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_job_title_style',
			[ 
				'label' => esc_html__( 'Job Title', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'job_title!' => '',
					'show_job_title' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'job_title_spacing',
			[ 
				'label' => esc_html__( 'Bottom Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
					'%' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-job-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'job_title_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-job-title',
			]
		);

		$this->start_controls_tabs( 'tabs_job_title_style' );

		$this->start_controls_tab(
			'tab_job_title_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'job_title_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-job-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'job_title_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-job-title',
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_job_title_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'job_title_color_hover',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .elementor-widget-container:hover .sa-job-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'job_title_text_shadow_hover',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .elementor-widget-container:hover .sa-job-title',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			[ 
				'label' => esc_html__( 'Text', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'text!' => '',
				]
			]
		);

		$this->add_responsive_control(
			'text_spacing',
			[ 
				'label' => esc_html__( 'Bottom Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
					'%' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'text_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-text',
			]
		);

		$this->start_controls_tabs( 'tabs_text_style' );

		$this->start_controls_tab(
			'tab_text_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'text_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_text_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'text_color_hover',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .elementor-widget-container:hover .sa-text' => 'color: {{VALUE}}',
				],
			]
		);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		// start social icons style

		$this->start_controls_section(
			'section_social_icons_style',
			[ 
				'label' => esc_html__( 'Social Icons', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_socials' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'social_icons_spacing',
			[ 
				'label' => esc_html__( 'Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-social-icons-wrapper .sa-link' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sa-social-icons-wrapper .sa-link svg' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'social_icons_icon_size',
			[ 
				'label' => esc_html__( 'Icon Size', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-social-icons-wrapper .sa-link' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sa-social-icons-wrapper .sa-link svg' => 'height: {{SIZE}}{{UNIT}}; width:auto;',
				],
			]
		);

		$this->add_responsive_control(
			'social_icons_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-social-icons-wrapper .sa-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .sa-social-icons-wrapper .sa-link svg' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'social_icons_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-social-icons-wrapper .sa-link, {{WRAPPER}} .sa-social-icons-wrapper .sa-link svg',
			]
		);

		$this->add_responsive_control(
			'social_icon_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-social-icons-wrapper .sa-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .sa-social-icons-wrapper .sa-link svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 
					'show_socials_adv_border_radius!' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_socials_adv_border_radius',
			[ 
				'label' => esc_html__( 'Advanced Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'socials_adv_border_radius',
			[ 
				'label' => esc_html__( 'Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '30% 70% 70% 30% / 30% 30% 70% 70% ', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-social-icons-wrapper .sa-link' => 'border-radius: {{VALUE}};',
					'{{WRAPPER}} .sa-social-icons-wrapper .sa-link svg' => 'border-radius: {{VALUE}};',
				],
				'condition' => [ 
					'show_socials_adv_border_radius' => 'yes',
				],
			]
		);

		$this->start_controls_tabs( 'social_icons_tabs' );

		$this->start_controls_tab(
			'social_icons_tab_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		//controls
		$this->add_control(
			'social_icons_color',
			[ 
				'label' => esc_html__( 'Icons Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-social-icons-wrapper .sa-link' => 'color: {{VALUE}}',
					'{{WRAPPER}} .sa-social-icons-wrapper .sa-link svg *' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'social_icons_bg',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-social-icons-wrapper .sa-link, {{WRAPPER}} .sa-social-icons-wrapper .sa-link svg',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'social_icons_tab_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		//controls

		$this->add_control(
			'social_icons_color_hover',
			[ 
				'label' => esc_html__( 'Icons Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-social-icons-wrapper .sa-link:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .sa-social-icons-wrapper .sa-link:hover svg *' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'social_icons_bg_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-social-icons-wrapper .sa-link:hover, {{WRAPPER}} .sa-social-icons-wrapper .sa-link:hover svg',
			]
		);

		$this->add_control(
			'social_icons_border_color_hover',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-social-icons-wrapper .sa-link:hover' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .sa-social-icons-wrapper .sa-link:hover svg' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'social_icons_border_border!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'social_icon_border_radius_hover',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-social-icons-wrapper .sa-link:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .sa-social-icons-wrapper .sa-link:hover svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 
					'show_socials_adv_border_radius!' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// start button style

		$this->start_controls_section(
			'section_button_style',
			[ 
				'label' => esc_html__( 'Button', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_button' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[ 
				'label' => esc_html__( 'Margin', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'button_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-button',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-button' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'button_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-button',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'button_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-button',
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'button_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-button',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'button_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-button',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);


		$this->add_control(
			'button_color_hover',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-button:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'button_background_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-button:hover',
			]
		);

		$this->add_control(
			'button_border_color_hover',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-button:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'button_border_border!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'button_border_radius_hover',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'button_text_shadow_hover',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-button:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'button_box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-button:hover',
			]
		);

		$this->add_control(
			'button_hover_animation',
			[ 
				'label' => esc_html__( 'Animation', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function name() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'name', 'class', 'sa--title sa-name sa-mt-0 sa-mb-0' );
		$this->add_inline_editing_attributes( 'name', 'none' );

		printf(
			'<%1$s %2$s>%3$s</%1$s>',
			esc_attr( Utils::validate_html_tag( $settings['name_tag'] ) ),
			wp_kses_post( $this->get_render_attribute_string( 'name' ) ),
			wp_kses_post( $settings['name'] )
		);
	}

	protected function job_title() {
		$settings = $this->get_settings_for_display();
		printf(
			'<%1$s class="%2$s">%3$s</%1$s>',
			esc_attr( Utils::validate_html_tag( $settings['job_title_tag'] ) ),
			'sa--sub-title sa-job-title sa-mt-0 sa-mb-2 sa-fs-6',
			wp_kses_post( $settings['job_title'] )
		);
	}

	protected function text() {
		$settings = $this->get_settings_for_display();
		printf(
			'<div class="%1$s">%2$s</div>',
			'sa--text sa--text-info sa-text sa-mb-2 sa-fs-6',
			wp_kses_post( $settings['text'] )
		);
	}

	protected function button() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'link_attr', 'class', 'sa-button sa-d-inline-block sa-text-decoration-none sa-my-2' );
		$this->add_render_attribute( 'link_attr', 'class', ( $settings['button_full_width'] == 'yes' ) ? 'sa-d-block' : '' );
		$this->add_render_attribute( 'link_attr', 'class', 'sa-button-icon-' . $settings['button_icon_position'] );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'link_attr', 'href', esc_url( $settings['link']['url'] ) );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'link_attr', 'target', '_blank' );
			}

			if ( $settings['link']['nofollow'] ) {
				$this->add_render_attribute( 'link_attr', 'rel', 'nofollow' );
			}
		} else {
			$this->add_render_attribute( 'link_attr', 'href', 'javascript:void(0);' );
		}

		if ( $settings['button_hover_animation'] ) {
			$this->add_render_attribute( 'link_attr', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
		}
		?>
		<a <?php $this->print_render_attribute_string( 'link_attr' ); ?>>
			<?php
			if ( ! empty( $settings['button_icon']['value'] ) && $settings['button_icon_position'] == 'before' ) {
				Icons_Manager::render_icon( $settings['button_icon'], [ 
					'aria-hidden' => 'true',
					'class' => 'sa-button-icon'
				] );
			}

			if ( ! empty( $settings['button_text'] ) ) :
				$this->add_render_attribute( 'button_text', 'class', 'sa-button-text' );
				$this->add_inline_editing_attributes( 'button_text', 'none' );

				printf(
					'<span %1$s>%2$s</span>',
					wp_kses_post( $this->get_render_attribute_string( 'button_text' ) ),
					esc_html( $settings['button_text'] )
				);


			endif;
			if ( ! empty( $settings['button_icon']['value'] ) && $settings['button_icon_position'] == 'after' ) {
				Icons_Manager::render_icon( $settings['button_icon'], [ 
					'aria-hidden' => 'true', 'class' => 'sa-button-icon'
				] );
			}
			?>
		</a>
		<?php
	}

	protected function social_icons() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="sa-social-icons-wrapper">
			<ul class="sa-m-0 sa-p-0 sa-d-inline">
				<?php
				foreach ( $settings['social_list'] as $item ) {
					$this->add_render_attribute( 'social_link_attr', 'class', [ 
						'sa-link sa-text-decoration-none  sa-me-2',
						'elementor-repeater-item-' . $item['_id'],
					], true );
					if ( ! empty( $item['social_link']['url'] ) ) {
						$this->add_render_attribute( 'social_link_attr', 'href', esc_url( $item['social_link']['url'] ), true );

						if ( $item['social_link']['is_external'] ) {
							$this->add_render_attribute( 'social_link_attr', 'target', '_blank', true );
						}

						if ( $item['social_link']['nofollow'] ) {
							$this->add_render_attribute( 'social_link_attr', 'rel', 'nofollow', true );
						}
					} else {
						$this->add_render_attribute( 'social_link_attr', 'href', 'javascript:void(0);', true );
					}
					?>

					<li class="sa-d-inline-block">
						<a <?php $this->print_render_attribute_string( 'social_link_attr' ); ?>>
							<?php
							if ( ! empty( $item['social_icon']['value'] ) ) {
								Icons_Manager::render_icon( $item['social_icon'], [ 
									'aria-hidden' => 'true'
								] );
							}
							?>
						</a>
					</li>

				<?php } ?>

			</ul>
		</div>
		<?php
	}

	//   alter image  
	protected function alter_image() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'alter_image', 'class', 'sa-alter-image' );
		$this->add_render_attribute( 'alter_image', 'src', esc_url( $settings['alter_image']['url'] ) );
		$this->add_render_attribute( 'alter_image', 'alt', Control_Media::get_image_alt( $settings['alter_image'] ) );
		$this->add_render_attribute( 'alter_image', 'title', Control_Media::get_image_title( $settings['alter_image'] ) );

		if ( $settings['img_hover_animation'] ) {
			$settings['hover_animation'] = $settings['img_hover_animation'];
			$this->add_render_attribute( 'alter_image', 'class', 'elementor-animation-' . $settings['hover_animation'] );
		}

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'link', $settings['link'] );
			?>
			<a <?php $this->print_render_attribute_string( 'link' ); ?>>
				<?php
				echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'alter_thumbnail', 'alter_image' ) );
				?>
			</a>';
			<?php
		} else {
			echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'alter_thumbnail', 'alter_image' ) );
		}
	}

	protected function image() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute( 'image', 'src', $settings['image']['url'] );
		$this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $settings['image'] ) );
		$this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $settings['image'] ) );

		if ( $settings['img_hover_animation'] ) {
			$settings['hover_animation'] = $settings['img_hover_animation'];
			$this->add_render_attribute( 'image', 'class', 'elementor-animation-' . $settings['hover_animation'] );
		}

		?>
		<figure class="sa-img-area">
			<?php


			if ( ! empty( $settings['link']['url'] ) ) {
				$this->add_link_attributes( 'link', $settings['link'] );
				?>
				<a <?php $this->print_render_attribute_string( 'link' ); ?>>
					<?php echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ) ); ?>
				</a>
				<?php
			} else {
				echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'image' ) );
			}
			//        start alter_image
			if ( $settings['show_alter_image'] == 'yes' ) {
				$this->alter_image();
			}
			?>
		</figure>
		<?php
	}

	protected function style_default() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="sa-team-member sa-p-3">

			<?php
			if ( ! empty( $settings['image']['url'] ) ) {
				$this->image();
			}
			?>

			<div class="sa-content-area sa-pt-3 mold-effect">
				<?php
				if ( ! empty( $settings['name'] ) ) {
					$this->name();
				}

				if ( $settings['show_job_title'] == 'yes' && ! empty( $settings['job_title'] ) ) {
					$this->job_title();
				}

				if ( ! empty( $settings['text'] ) ) {
					$this->text();
				}


				if ( $settings['show_button'] == 'yes' && $settings['button_position'] == 'before_socials' ) {
					$this->button();
				}

				if ( $settings['show_socials'] == 'yes' ) {
					$this->social_icons();
				}

				if ( $settings['show_button'] == 'yes' && $settings['button_position'] == 'after_socials' ) {
					$this->button();
				}
				?>
			</div>
		</div>
		<?php
	}

	protected function style_ardent() {

		$settings = $this->get_settings_for_display();
		?>
		<div class="sa-team-member style-ardent">

			<?php
			if ( ! empty( $settings['image']['url'] ) ) {
				$this->image();
			}
			?>

			<div class="sa-overlay-area">
				<div class="sa-content-area">
					<?php
					if ( ! empty( $settings['name'] ) ) {
						$this->name();
					}
					if ( $settings['show_job_title'] == 'yes' && ! empty( $settings['job_title'] ) ) {
						$this->job_title();
					}
					?>
				</div>
				<?php
				if ( $settings['show_socials'] == 'yes' ) {
					$this->social_icons();
				}

				if ( ! empty( $settings['text'] ) ) {
					$this->text();
				}

				if ( $settings['show_button'] == 'yes' ) {
					$this->button();
				}
				?>
			</div>
		</div>
		<?php
	}

	protected function style_folk() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="sa-team-member style-folk">

			<div class="sa-overlay-wrapper">
				<?php
				if ( ! empty( $settings['image']['url'] ) ) {
					$this->image();
				}
				?>
				<div class="sa-overlay-area">
					<div class="sa-overlay-content sa-p-4">
						<?php
						if ( ! empty( $settings['text'] ) ) {
							$this->text();
						}
						if ( $settings['show_button'] == 'yes' && $settings['button_position'] == 'before_socials' ) {
							$this->button();
						}

						if ( $settings['show_socials'] == 'yes' ) {
							$this->social_icons();
						}

						if ( $settings['show_button'] == 'yes' && $settings['button_position'] == 'after_socials' ) {
							$this->button();
						}
						?>
					</div>
				</div>
			</div>

			<div class="sa-content-area  sa-p-3">
				<?php
				if ( ! empty( $settings['name'] ) ) {
					$this->name();
				}
				if ( $settings['show_job_title'] == 'yes' && ! empty( $settings['job_title'] ) ) {
					$this->job_title();
				}
				?>
			</div>
		</div>
		<?php
	}

	protected function style_folker() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="sa-team-member style-folker">

			<div class="sa-overlay-wrapper">
				<?php
				if ( ! empty( $settings['image']['url'] ) ) {
					$this->image();
				}
				?>
				<div class="sa-overlay-area">
					<div class="sa-overlay-content sa-p-4">
						<div class="sa-content-area  sa-p-3">
							<?php
							if ( ! empty( $settings['text'] ) ) {
								$this->text();
							}
							if ( $settings['show_button'] == 'yes' && $settings['button_position'] == 'before_socials' ) {
								$this->button();
							}

							if ( $settings['show_socials'] == 'yes' ) {
								$this->social_icons();
							}

							if ( $settings['show_button'] == 'yes' && $settings['button_position'] == 'after_socials' ) {
								$this->button();
							}
							?>
						</div>
					</div>
				</div>
			</div>

			<div class="sa-content-area  sa-p-3">
				<?php
				if ( ! empty( $settings['name'] ) ) {
					$this->name();
				}
				if ( $settings['show_job_title'] == 'yes' && ! empty( $settings['job_title'] ) ) {
					$this->job_title();
				}
				?>
			</div>
		</div>
		<?php
	}

	protected function style_slide() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="sa-team-member style-slide">
			<?php
			if ( ! empty( $settings['image']['url'] ) ) {
				$this->image();
			}
			?>
			<div class="sa-overlay-area <?php echo esc_html( $settings['slide_effect'] ); ?>">
				<div class="sa-overlay-content sa-p-4">
					<div class="sa-content-area  sa-p-3">
						<?php
						if ( ! empty( $settings['name'] ) ) {
							$this->name();
						}
						if ( $settings['show_job_title'] == 'yes' && ! empty( $settings['job_title'] ) ) {
							$this->job_title();
						}
						if ( ! empty( $settings['text'] ) ) {
							$this->text();
						}
						if ( $settings['show_button'] == 'yes' && $settings['button_position'] == 'before_socials' ) {
							$this->button();
						}

						if ( $settings['show_socials'] == 'yes' ) {
							$this->social_icons();
						}

						if ( $settings['show_button'] == 'yes' && $settings['button_position'] == 'after_socials' ) {
							$this->button();
						}
						?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	protected function style_mold() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="sa-team-member style-mold">

			<?php
			if ( ! empty( $settings['image']['url'] ) ) {
				$this->image();
			}
			?>

			<div class="sa-content-area sa-p-3">
				<?php
				if ( ! empty( $settings['name'] ) ) {
					$this->name();
				}

				if ( $settings['show_job_title'] == 'yes' && ! empty( $settings['job_title'] ) ) {
					$this->job_title();
				}

				if ( $settings['show_socials'] == 'yes' ) {
					$this->social_icons();
				}
				?>
			</div>
		</div>
		<?php
	}

	protected function style_flip() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="sa-team-member sa-flip-card-wrapper flip-right">
			<div class="card">
				<div class="front">
					<div class="inner">
						<?php
						if ( ! empty( $settings['image']['url'] ) ) {
							$this->image();
						}
						?>
					</div>
				</div>
				<div class="back">
					<div class="inner">
						Showcase each member image, designation, social shares using different style presets
					</div>
				</div>
			</div>
		</div>

		<?php
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( $settings['style_select'] == 'default' ) {
			$this->style_default();
		} elseif ( $settings['style_select'] == 'ardent' ) {
			$this->style_ardent();
		} elseif ( $settings['style_select'] == 'folk' ) {
			$this->style_folk();
		} elseif ( $settings['style_select'] == 'folker' ) {
			$this->style_folker();
		} elseif ( $settings['style_select'] == 'slide' ) {
			$this->style_slide();
		} elseif ( $settings['style_select'] == 'mold' ) {
			$this->style_mold();
		} elseif ( $settings['style_select'] == 'flip' ) {
			$this->style_flip();
		} else {
		}
	}
}
