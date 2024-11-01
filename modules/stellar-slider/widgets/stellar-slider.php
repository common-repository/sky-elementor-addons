<?php

namespace Sky_Addons\Modules\StellarSlider\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

use Sky_Addons\Includes\Controls\GroupQuery\Group_Control;
use Sky_Addons\Traits\Global_Widget_Functions;
use Sky_Addons\Traits\Global_Widget_Controls;


if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Stellar_Slider extends Widget_Base {

	use Group_Control;
	use Global_Widget_Functions;
	use Global_Widget_Controls;

	private $_query = null;

	public function get_name() {
		return 'sky-stellar-slider';
	}

	public function get_title() {
		return esc_html__( 'Stellar Blog Slider', 'sky-elementor-addons' );
	}

	public function get_icon() {
		return 'sky-icon-stellar-slider';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'sky', 'blog', 'stellar', 'slider' ];
	}

	public function get_style_depends() {
		return [ 
			'elementor-icons-fa-solid',
		];
	}

	public function get_query() {
		return $this->_query;
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_layout',
			[ 
				'label' => esc_html__( 'Layout', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'height',
			[ 
				'label' => esc_html__( 'Height', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'vh' ],
				'range' => [ 
					'px' => [ 
						'min' => 400,
						'max' => 1000,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .swiper' => 'height: {{SIZE}}{{UNIT}};',
				],
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'height_notice',
			[ 
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'Note: Video Height is not working, because of Aspect Ratio. Now Aspect Ratio Working.', 'sky-elementor-addons' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
				'condition' => [ 
					'slider_aspect_ratio!' => ''
				]

			]
		);

		$this->add_control(
			'slider_aspect_ratio',
			[ 
				'label' => esc_html__( 'Aspect Ratio', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [ 
					'' => esc_html__( 'Select Aspect Ratio', 'sky-elementor-addons' ),
					'11' => '1:1',
					'21' => '2:1',
					'32' => '3:2',
					'43' => '4:3',
					'85' => '8:5',
					'169' => '16:9',
					'219' => '21:9',
					'916' => '9:16',
				],
				'prefix_class' => 'sa-ss-ratio-yes sa-ratio-',
				'render_type' => 'template',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[ 
				'name' => 'primary_thumbnail',
				'exclude' => [ 'custom' ],
				'default' => 'full',
			]
		);

		$this->add_responsive_control(
			'content_alignment',
			[ 
				'label' => esc_html__( 'Content Alignment', 'sky-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'label_block' => false,
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
				'toggle' => true,
				'desktop_default' => 'left',
				'tablet_default' => 'left',
				'mobile_default' => 'left',
				// 'prefix_class'         => 'sa-ss-%s-',
				'style_transfer' => true,
				'selectors' => [ 
					'{{WRAPPER}} .sa-content-container' => '{{VALUE}};',
					'{{WRAPPER}} .sa-post-meta' => '{{VALUE}};',
					'{{WRAPPER}} .sa-buttons-wrapper' => '{{VALUE}};',
				],
				'selectors_dictionary' => [ 
					'left' => 'text-align: left; justify-content: flex-start; align-items: left;',
					'center' => 'text-align: center; justify-content: center; align-items: center;',
					'right' => 'text-align: right; justify-content: right; align-items: flex-end;',
					'justify' => 'text-align: left; justify-content: left; align-items: flex-start;'
				]
			]
		);

		$this->add_control(
			'show_social_icons',
			[ 
				'label' => esc_html__( 'Show Social Icons', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		/**
		 * Global Query Builder Settings
		 */
		$this->start_controls_section(
			'section_post_query_builder',
			[ 
				'label' => __( 'Query', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->register_query_builder_controls();

		$this->update_control(
			'posts_per_page',
			[ 
				'default' => 4,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_social_icon',
			[ 
				'label' => esc_html__( 'Social Icons', 'sky-elementor-addons' ),
				'condition' => [ 
					'show_social_icons' => 'yes'
				]
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'social_icon',
			[ 
				'label' => esc_html__( 'Icon', 'sky-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
				'default' => [ 
					'value' => 'fab fa-facebook-f',
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
					'fa-solid' => [ 
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
				'label' => esc_html__( 'Link', 'sky-elementor-addons' ),
				'type' => Controls_Manager::URL,
				'default' => [ 
					'is_external' => 'true',
				],
				'dynamic' => [ 
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'social_icon_list',
			[ 
				'label' => esc_html__( 'Social Icons', 'sky-elementor-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [ 
					[ 
						'social_icon' => [ 
							'value' => 'fab fa-facebook-f',
							'library' => 'fa-brands',
						],
					],
					[ 
						'social_icon' => [ 
							'value' => 'fab fa-twitter',
							'library' => 'fa-brands',
						],
					],
					[ 
						'social_icon' => [ 
							'value' => 'fab fa-youtube',
							'library' => 'fa-brands',
						],
					],
				],
				'title_field' => '{{{ elementor.helpers.renderIcon( this, social_icon, {}, "i", "panel" ) || \'<i class="{{ icon }}" aria-hidden="true"></i>\' }}}<# print(elementor.helpers.getSocialNetworkNameFromIcon( social_icon )); #>',
			]
		);

		$this->add_control(
			'social_icon_default_color',
			[ 
				'label' => esc_html__( 'Default Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'prefix_class' => 'sa-social-default-color-',
				'render_type' => 'template'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional',
			[ 
				'label' => esc_html__( 'Additional', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title_tag',
			[ 
				'label' => esc_html__( 'Title HTML Tag', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => sky_title_tags(),
			]
		);

		$this->add_control(
			'show_category',
			[ 
				'label' => esc_html__( 'Show Category', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_author',
			[ 
				'label' => esc_html__( 'Show Author', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_excerpt',
			[ 
				'label' => esc_html__( 'Show Text', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'excerpt_length',
			[ 
				'label' => esc_html__( 'Text Limit', 'sky-elementor-addons' ),
				'description' => esc_html__( 'This is for the main content, but not for excerpts. If you set the offset to 0, then you\'ll get the full text instead.', 'sky-elementor-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 30,
				'condition' => [ 
					'show_excerpt' => 'yes'
				],
			]
		);

		$this->add_control(
			'strip_shortcode',
			[ 
				'label' => esc_html__( 'Strip ShortCode', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [ 
					'show_excerpt' => 'yes',
				],
			]
		);

		/**
		 * Global Date Controls
		 */

		$this->add_control(
			'show_date',
			[ 
				'label' => esc_html__( 'Show Date', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->register_post_date_controls();

		$this->add_control(
			'show_video',
			[ 
				'label' => esc_html__( 'Show Video', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_post_video_settings',
			[ 
				'label' => esc_html__( 'Video Settings', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [ 
					'show_video' => 'yes'
				]
			]
		);

		/**
		 * Global Video Lightbox Control
		 */
		$this->video_lightbox_controls();

		$this->end_controls_section();


		$this->start_controls_section(
			'section_slider_settings',
			[ 
				'label' => esc_html__( 'Settings', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'transition_effect',
			[ 
				'label' => esc_html__( 'Transition Effect', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'fade',
				'options' => [ 
					'slide' => esc_html__( 'Slide', 'sky-elementor-addons' ),
					'fade' => esc_html__( 'Fade', 'sky-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'cross_fade',
			[ 
				'label' => esc_html__( 'Cross Fade', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'condition' => [ 
					'transition_effect' => 'fade',
				],
			]
		);

		$this->add_control(
			'coverflow_rotate',
			[ 
				'label' => esc_html__( 'Rotate', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [ 
					'unit' => 'px',
					'size' => 30,
				],
				'condition' => [ 
					'transition_effect' => 'coverflow',
				],
			]
		);

		$this->add_control(
			'slide_shadows',
			[ 
				'label' => esc_html__( 'Slide Shadows', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [ 
					'transition_effect' => [ 'coverflow', 'flip', 'cube' ],
				],
			]
		);

		$this->add_control(
			'autoplay',
			[ 
				'label' => esc_html__( 'Autoplay', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'autoplay_speed',
			[ 
				'label' => esc_html__( 'Autoplay Speed (sec)', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 10,
						'step' => .5,
					],
				],
				'default' => [ 
					'unit' => 'px',
					'size' => 5,
				],
				'condition' => [ 
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'loop',
			[ 
				'label' => esc_html__( 'Loop', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'speed',
			[ 
				'label' => esc_html__( 'Slide Speed (sec)', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 1,
						'max' => 10,
						'step' => .5,
					],
				],
				'default' => [ 
					'unit' => 'px',
					'size' => 1,
				],
			]
		);

		$this->add_control(
			'pause_on_hover',
			[ 
				'label' => esc_html__( 'Pause On Hover', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [ 
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'observer',
			[ 
				'label' => esc_html__( 'Observer', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
				'description' => esc_html__( 'Note: Please use it when you using slider on a hidden element.', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'show_navigation',
			[ 
				'label' => esc_html__( 'Show Navigation', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_pagination',
			[ 
				'label' => esc_html__( 'Show Pagination', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_navigation',
			[ 
				'label' => esc_html__( 'Navigation', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [ 'show_navigation' => 'yes' ]
			]
		);

		$this->add_control(
			'prev_icon',
			[ 
				'label' => esc_html__( 'Prev Icon', 'sky-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
			]
		);

		$this->add_control(
			'next_icon',
			[ 
				'label' => esc_html__( 'Next Icon', 'sky-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_pagination',
			[ 
				'label' => esc_html__( 'Pagination', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [ 'show_pagination' => 'yes' ]
			]
		);

		$this->add_control(
			'pagination_type',
			[ 
				'label' => esc_html__( 'Pagination Type', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'bullets',
				'options' => [ 
					'none' => esc_html__( 'None', 'sky-elementor-addons' ),
					'bullets' => esc_html__( 'Bullets', 'sky-elementor-addons' ),
					'fraction' => esc_html__( 'Fraction', 'sky-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'dynamic_bullets',
			[ 
				'label' => esc_html__( 'Dynamic Bullets', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'condition' => [ 'pagination_type' => 'bullets' ]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_buttons',
			[ 
				'label' => esc_html__( 'Buttons', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button_text',
			[ 
				'label' => esc_html__( 'Read More Button Text', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'READ MORE', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'play_button_text',
			[ 
				'label' => esc_html__( 'Play Button Text', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'PLAY', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_common_style',
			[ 
				'label' => esc_html__( 'Common', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'container_width',
			[ 
				'label' => esc_html__( 'Container Width', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [ 
					'px' => [ 
						'min' => 500,
						'max' => 2000,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-content-container' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'container_padding',
			[ 
				'label' => esc_html__( 'Container Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-content-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'image_background',
				'label' => esc_html__( 'Overlay', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'fields_options' => [ 
					'background' => [ 
						'label' => esc_html__( 'Overlay', 'sky-elementor-addons' ),
						'default' => 'classic',
					],
					'color' => [ 
						'default' => '#0504046B',
					],
				],
				'selector' => '{{WRAPPER}} .sa-stellar-slider .swiper-slide:before',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_title_style',
			[ 
				'label' => esc_html__( 'Title', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'title_spacing',
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
					'{{WRAPPER}} .sa-post-title-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[ 
				'label' => esc_html__( 'Text Color Hover', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-title:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'title_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-title',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[ 
				'name' => 'title_text_stroke',
				'selector' => '{{WRAPPER}} .sa-post-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			[ 
				'label' => esc_html__( 'Text', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 'show_excerpt' => 'yes' ]
			]
		);

		$this->add_responsive_control(
			'text_spacing',
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
					'{{WRAPPER}} .sa-post-text' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		/**
		 * Global Text Controls
		 */
		$this->register_post_text_controls_style();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_category_style',
			[ 
				'label' => esc_html__( 'Category', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_category' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'category_spacing',
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
					'{{WRAPPER}} .sa-post-category' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// $this->add_responsive_control(
		//     'category_space_between',
		//     [
		//         'label'      => esc_html__('Space Between', 'sky-elementor-addons'),
		//         'type'       => Controls_Manager::SLIDER,
		//         'size_units' => ['px', 'em'],
		//         'range'      => [
		//             'px' => [
		//                 'min' => 0,
		//                 'max' => 50,
		//             ],
		//         ],
		//         'selectors'  => [
		//             '{{WRAPPER}}'  => '--sa-post-category-spacing: {{SIZE}}{{UNIT}};',
		//         ],
		//     ]
		// );

		/**
		 * Global Category
		 */

		$this->register_post_category_controls_style();

		$this->end_controls_section();


		$this->start_controls_section(
			'section_author_style',
			[ 
				'label' => esc_html__( 'Author', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_author' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'meta_spacing',
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
					'{{WRAPPER}} .sa-post-meta' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'author_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-author-text a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'author_color_hover',
			[ 
				'label' => esc_html__( 'Color Hover', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-author-text:hover  a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'author_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-author-text',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'author_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-author-text',
			]
		);

		$this->add_control(
			'author_heading_style',
			[ 
				'label' => esc_html__( 'Image', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'author_img_width',
			[ 
				'label' => esc_html__( 'Size', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [ 
					'px' => [ 
						'min' => 50,
						'max' => 500,
					],
					'%' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-author-thumb' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'author_img_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-author-thumb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'author_img_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-author-thumb',
				'fields_options' => [ 
					'border' => [ 
						'default' => 'solid',
					],
					'width' => [ 
						'default' => [ 
							'top' => '2',
							'right' => '2',
							'bottom' => '2',
							'left' => '2',
							'unit' => 'px',
							'isLinked' => false,
						],
					],
					'color' => [ 
						'default' => '#fff',
					],
				],
			]
		);

		$this->add_responsive_control(
			'author_img_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-author-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'author_img_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-author-thumb',
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[ 
				'name' => 'author_img_css_filters',
				'selector' => '{{WRAPPER}} .sa-post-author-thumb',
			]
		);

		$this->add_control(
			'author_date_heading_style',
			[ 
				'label' => esc_html__( 'Date', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'author_date_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}}' => '--sa-post-author-date-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'author_date_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-date, {{WRAPPER}} .sa-icon-wrap',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'author_date_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-date, {{WRAPPER}} .sa-icon-wrap',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_buttons_style',
			[ 
				'label' => esc_html__( 'Buttons', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
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

		$this->start_controls_tabs( 'tabs_buttons_style' );

		$this->start_controls_tab(
			'tab_buttons_read_more',
			[ 
				'label' => esc_html__( 'Read More', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'button_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-read-more, {{WRAPPER}} .sa-read-more:focus' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'button_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-read-more, {{WRAPPER}} .sa-read-more:focus',
			]
		);

		$this->add_control(
			'button_border_color_override',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-read-more' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover',
			[ 
				'label' => esc_html__( 'H O V E R', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'button_color_hover',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-read-more:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'button_background_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-read-more:hover',
			]
		);

		$this->add_control(
			'button_border_color_hover',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-read-more:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_buttons_play',
			[ 
				'label' => esc_html__( 'Play Button', 'sky-elementor-addons' ),
				'condition' => [ 
					'show_video' => 'yes'
				]
			]
		);

		$this->add_control(
			'play_button_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-play-button, {{WRAPPER}} .sa-play-button:focus' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'play_button_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-play-button, {{WRAPPER}} .sa-play-button:focus',
			]
		);

		$this->add_control(
			'play_button_border_color',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-play-button' => 'border-color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'play_button_hover',
			[ 
				'label' => esc_html__( 'H O V E R', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'play_button_color_hover',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-play-button:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'play_button_background_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-play-button:hover',
			]
		);

		$this->add_control(
			'play_button_border_color_hover',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-play-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_navigation_style',
			[ 
				'label' => esc_html__( 'Navigation', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_navigation' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'navigation_bottom_spacing',
			[ 
				'label' => esc_html__( 'Bottom Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-navigation-wrapper' => 'bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'navigation_size',
			[ 
				'label' => esc_html__( 'Size', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 5,
						'max' => 50,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} ' => '--sa-navigation-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'navigation_spacing',
			[ 
				'label' => esc_html__( 'Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} ' => '--sa-navigation-spacing: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'navigation_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'navigation_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next',
				'fields_options' => [ 
					'border' => [ 
						'default' => 'solid',
					],
					'width' => [ 
						'default' => [ 
							'top' => '2',
							'right' => '2',
							'bottom' => '2',
							'left' => '2',
							'unit' => 'px',
							'isLinked' => false,
						],
					],
					'color' => [ 
						'default' => '#e0528d',
					],
				],
			]
		);

		$this->start_controls_tabs( 'navigation_tabs' );

		$this->start_controls_tab(
			'navigation_tab_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'navigation_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next' => 'color: {{VALUE}}',
					'{{WRAPPER}} .sa-swiper-button-prev svg *, {{WRAPPER}} .sa-swiper-button-next svg *' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'navigation_bg',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next',
				'fields_options' => [ 
					'background' => [ 
						'label' => esc_html__( 'Background', 'elementor' ),
						'default' => 'classic',
					],
					'color' => [ 
						'default' => '#fff',
					],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'navigation_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'navigation_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next',
			]
		);

		$this->add_responsive_control(
			'navigation_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-swiper-button-prev, {{WRAPPER}} .sa-swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'navigation_tab_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'navigation_color_hover',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .sa-swiper-button-prev:hover svg *, {{WRAPPER}} .sa-swiper-button-next:hover svg *' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'navigation_bg_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'fields_options' => [ 
					'background' => [ 
						'label' => esc_html__( 'Background', 'elementor' ),
						'default' => 'classic',
					],
					'color' => [ 
						'default' => '#e0528d',
					],
				],
				'selector' => '{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover',
			]
		);

		$this->add_control(
			'navigation_border_color_hover',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'navigation_border_border!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'navigation_text_shadow_hover',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'navigation_box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover',
			]
		);

		$this->add_responsive_control(
			'navigation_border_radius_hover',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-swiper-button-prev:hover, {{WRAPPER}} .sa-swiper-button-next:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_pagination_style',
			[ 
				'label' => esc_html__( 'Pagination', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_pagination' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'pagination_bottom_spacing',
			[ 
				'label' => esc_html__( 'Bottom Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .swiper-pagination-fraction, .swiper-pagination-custom, {{WRAPPER}} .swiper-horizontal > .swiper-pagination-bullets' => 'bottom: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'bullet_size',
			[ 
				'label' => esc_html__( 'Bullet Height', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 1,
						'max' => 50,
						'step' => .5,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}}' => '--sa-pagination-bullet-height: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'pagination_type' => 'bullets' ]
			]
		);

		$this->add_responsive_control(
			'bullet_width',
			[ 
				'label' => esc_html__( 'Bullet Width', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 1,
						'max' => 50,
						'step' => .5,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}}' => '--sa-pagination-bullet-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'pagination_type' => 'bullets' ]
			]
		);

		$this->add_responsive_control(
			'bullet_spacing',
			[ 
				'label' => esc_html__( 'Bullet Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 4,
						'max' => 20,
						'step' => .5,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .swiper-pagination-bullets .swiper-pagination-bullet' => 'margin: 0px {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'pagination_type' => 'bullets' ]
			]
		);

		$this->start_controls_tabs(
			'style_pagination_tabs'
		);

		$this->start_controls_tab(
			'style_pagination_normal_tab',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'fraction_color',
			[ 
				'label' => esc_html__( 'Pagination Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ddd',
				'selectors' => [ 
					'{{WRAPPER}} .swiper-pagination.swiper-pagination-fraction' => 'color: {{VALUE}}',
				],
				'condition' => [ 'pagination_type' => 'fraction' ]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'pagination_fraction_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .swiper-pagination-fraction',
				'condition' => [ 'pagination_type' => 'fraction' ]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'pagination_color',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'fields_options' => [ 
					'background' => [ 
						'label' => esc_html__( 'Pagination Color', 'sky-elementor-addons' ),
					],
				],
				'selector' => '{{WRAPPER}} .swiper-pagination-bullet',
				'condition' => [ 'pagination_type' => 'bullets' ]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'pagination_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .swiper-pagination-bullet',
				'condition' => [ 'pagination_type' => 'bullets' ],
				'fields_options' => [ 
					'border' => [ 
						'default' => 'solid',
					],
					'width' => [ 
						'default' => [ 
							'top' => '8',
							'right' => '8',
							'bottom' => '8',
							'left' => '8',
							'unit' => 'px',
							'isLinked' => false,
						],
					],
					'color' => [ 
						'default' => '#0A0A0AC4',
					],
				],
			]
		);

		$this->add_responsive_control(
			'pagination_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'pagination_type' => 'bullets' ],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_pagination_active_tab',
			[ 
				'label' => esc_html__( 'Active', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'fraction_active_color',
			[ 
				'label' => esc_html__( 'Pagination Active Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [ 
					'{{WRAPPER}} .swiper-pagination-fraction .swiper-pagination-current' => 'color: {{VALUE}}',
				],
				'condition' => [ 'pagination_type' => 'fraction' ]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'pagination_fraction_typography_active',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .swiper-pagination-fraction .swiper-pagination-current',
				'condition' => [ 'pagination_type' => 'fraction' ]
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'pagination_active_color',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'fields_options' => [ 
					'background' => [ 
						'label' => esc_html__( 'Pagination Active Color', 'sky-elementor-addons' ),
					],
				],
				'selector' => '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active',
				'condition' => [ 'pagination_type' => 'bullets' ]
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'pagination_border_active',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active',
				'condition' => [ 'pagination_type' => 'bullets' ],
				'fields_options' => [ 
					'border' => [ 
						'default' => 'solid',
					],
					'width' => [ 
						'default' => [ 
							'top' => '6',
							'right' => '6',
							'bottom' => '6',
							'left' => '6',
							'unit' => 'px',
							'isLinked' => false,
						],
					],
					'color' => [ 
						'default' => '#fff',
					],
				],
			]
		);

		$this->add_responsive_control(
			'pagination_border_radius_active',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 'pagination_type' => 'bullets' ],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_social_icons_style',
			[ 
				'label' => esc_html__( 'Social Icons', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_social_icons' => 'yes'
				]
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
						'step' => 1,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-social-icons .sa-icon-wrap' => 'font-size: {{SIZE}}{{UNIT}};',
				],
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
						'step' => 1,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-social-icons' => 'gap: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .sa-social-icons .sa-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'social_icons_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-social-icons .sa-link',
			]
		);

		$this->add_responsive_control(
			'social_icons_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-social-icons .sa-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .sa-social-icons .sa-link' => 'border-radius: {{VALUE}};',
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

		$this->add_control(
			'social_icons_color',
			[ 
				'label' => esc_html__( 'Icons Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-social-icons .sa-link' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'social_icons_bg',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-social-icons .sa-link',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'social_icons_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-social-icons .sa-link',
			]
		);

		$this->add_control(
			'social_icons_opacity',
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
					'{{WRAPPER}} .sa-social-icons .sa-link' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'social_icons_tab_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'social_icons_color_hover',
			[ 
				'label' => esc_html__( 'Icons Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-social-icons .sa-link:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'social_icons_bg_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-social-icons .sa-link:hover',
			]
		);

		$this->add_control(
			'social_icons_border_color_hover',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-social-icons .sa-link:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [ 
					'social_icons_border_border!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'social_icons_border_radius_hover',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-social-icons .sa-link:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 
					'show_socials_adv_border_radius!' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'social_icons_shadow_hover',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-social-icons .sa-link:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'social_icons_box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-social-icons .sa-link:hover',
			]
		);

		$this->add_control(
			'social_icons_opacity_hover',
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
					'{{WRAPPER}} .sa-social-icons .sa-link:hover' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'icons_hover_animation',
			[ 
				'label' => esc_html__( 'Hover Animation', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	public function get_taxonomies() {
		$taxonomies = get_taxonomies( [ 'show_in_nav_menus' => true ], 'objects' );

		$options = [ '' => '' ];

		foreach ( $taxonomies as $taxonomy ) {
			$options[ $taxonomy->name ] = $taxonomy->label;
		}

		return $options;
	}

	public function get_posts_tags() {
		$taxonomy = $this->get_settings( 'taxonomy' );

		foreach ( $this->_query->posts as $post ) {
			if ( ! $taxonomy ) {
				$post->tags = [];

				continue;
			}

			$tags = wp_get_post_terms( $post->ID, $taxonomy );

			$tags_slugs = [];

			foreach ( $tags as $tag ) {
				$tags_slugs[ $tag->term_id ] = $tag;
			}

			$post->tags = $tags_slugs;
		}
	}

	/**
	 * Get post query builder arguments
	 */
	public function query_posts( $posts_per_page ) {
		$settings = $this->get_settings();

		$args = [];
		if ( $posts_per_page ) {
			$args['posts_per_page'] = $posts_per_page;
			$args['paged'] = max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) );
		}

		$default = $this->getGroupControlQueryArgs();
		$args = array_merge( $default, $args );

		$this->_query = new \WP_Query( $args );
	}

	protected function render_social_icons() {
		$settings = $this->get_settings_for_display();

		$class_animation = '';

		if ( ! empty( $settings['icons_hover_animation'] ) ) {
			$class_animation = ' elementor-animation-' . $settings['icons_hover_animation'];
		}
		?>
		<div
			class="sa-social-icons sa-position-absolute sa-d-flex sa-flex-column sa-align-items-center sa-justify-content-center">
			<?php
			foreach ( $settings['social_icon_list'] as $index => $item ) :

				$social = '';
				if ( ! empty( $item['social_icon']['value'] ) && ( 'yes' == $settings['social_icon_default_color'] ) ) {
					$social = explode( ' ', $item['social_icon']['value'], 2 );

					$social = str_replace( 'fa-', '', $social[1] );
				}

				$link_key = 'link_' . $index;
				$this->add_render_attribute( $link_key, 'class', [ 
					'sa-link sa-text-decoration-none sa-p-3 sa-icon-wrap sa-rounded',
					$class_animation,
					'elementor-repeater-item-' . $item['_id'],
					'elementor-social-icon-' . $social
				] );

				$this->add_link_attributes( $link_key, $item['link'] );
				?>
				<a <?php $this->print_render_attribute_string( $link_key ); ?>>
					<?php
					Icons_Manager::render_icon( $item['social_icon'] );
					?>
				</a>
			<?php endforeach; ?>
		</div>
		<?php
	}

	protected function render_date() {
		$settings = $this->get_settings_for_display();
		if ( 'yes' !== $settings['show_date'] ) {
			return;
		}
		?>
		<div class="sa-post-date-wrapper sa-d-flex sa-align-items-center">
			<div class="sa-icon-wrap sa-me-1">
				<i class="eicon-calendar"></i>
			</div>
			<?php
			$this->render_post_date();
			?>
		</div>
		<?php
	}

	protected function render_author_thumb() {
		$settings = $this->get_settings_for_display();
		if ( 'yes' !== $settings['show_author'] ) {
			return;
		}

		?>
		<div class="sa-post-author-wrapper sa-d-flex" data-swiper-parallax="-350">
			<div class="sa-d-inline-flex sa-align-items-center">
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
					<div class="sa-post-author-thumb sa-me-3 sa-rounded-circle sa-overflow-hidden">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), 48 ); ?>
					</div>
				</a>
				<div>
					<div class="sa-post-author-text">
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
							<?php echo get_the_author(); ?>
						</a>
					</div>
					<?php $this->render_date(); ?>
				</div>
			</div>
		</div>
		<?php
	}

	protected function render_video_button( $settings, $post_id ) {
		/**
		 * Video Feature enabled
		 */

		$video_url = get_post_meta( $post_id, 'sky_video_link_meta', true );

		if ( ( 'yes' == $settings['show_video'] ) && ! empty( $video_url ) ) :
			$tag = 'div';
			$id = $this->get_id() . '-' . $post_id;

			/**
			 * Lightbox
			 */

			$this->render_post_video_lightbox( $video_url, $id );

			if ( $settings['video_open'] == 'file' ) {
				$tag = 'a';
			}
			$this->add_render_attribute( 'lightbox-attr-' . $id, [ 
				'class' => 'sa-play-button sa-button sa-text-decoration-none sa-rounded',
			] );

			?>
			<<?php echo esc_attr( $tag ); ?>
				<?php $this->print_render_attribute_string( 'lightbox-attr-' . $id ); ?>>
				<span class="sa-button-text">
					<?php echo esc_html( $settings['play_button_text'] ); ?>
				</span>
				<i class="fas fa-play sa-ms-3"></i>
			</<?php echo esc_attr( $tag ); ?>>
		<?php endif;
	}

	protected function render_item( $post_id, $image_size, $excerpt_length ) {
		$settings = $this->get_settings_for_display();
		$_title_id = $post_id . $this->get_id();
		?>
		<div class="swiper-slide sa-position-relative">
			<div class="sa-img-wrap sa-position-absolute sa-w-100 sa-h-100">
				<?php
				$this->render_post_image( [ 
					'wrapper_class' => 'sa-cover',
					'image_id' => get_post_thumbnail_id( $post_id ),
					'thumbnail_size' => $image_size,
				] );
				?>
			</div>
			<div
				class="sa-content-wrapper sa-position-absolute sa-w-100 sa-d-flex sa-align-items-center sa-justify-content-center">
				<div class="sa-content-container sa-p-5 sa-d-flex sa-flex-column">
					<div class="sa-content">
						<?php
						$cat_attr = [ 
							'class' => 'sa-post-category sa-post-category-style-1 sa-mb-4',
							'data-swiper-parallax' => -220,
						];
						$this->render_post_category_attr( 'cat' . $_title_id, $cat_attr );
						?>
						<div class="sa-post-title-wrapper sa-mb-4" data-swiper-parallax="-200">
							<?php
							printf(
								'<%1$s class="%2$s">%3$s</%1$s>',
								esc_attr( Utils::validate_html_tag( $settings['title_tag'] ) ),
								'sa-post-title sa-m-0',
								esc_html( get_the_title() )
							);
							?>
						</div>
						<div class="sa-post-meta sa-d-flex sa-mb-4">

							<?php $this->render_author_thumb(); ?>

						</div>
						<div class="sa-mb-5" data-swiper-parallax="-150">
							<?php
							$this->render_post_excerpt( $excerpt_length );
							?>
						</div>

						<div class="sa-buttons-wrapper sa-d-flex" data-swiper-parallax="-100">
							<a href="<?php echo esc_url( get_permalink() ); ?>"
								class="sa-read-more sa-button a-text-decoration-none sa-rounded">
								<span class="sa-button-text">
									<?php echo esc_html( $settings['button_text'] ); ?>
								</span>
								<i class="fas fa-arrow-right sa-ms-3"></i>
							</a>
							<?php
							$this->render_video_button( $settings, $post_id );
							?>
						</div>

					</div>
				</div>
			</div>
		</div>
		<?php
	}


	protected function render_navigation() {
		$settings = $this->get_settings_for_display();
		?>
		<!-- If we need navigation buttons -->
		<div class="sa-swiper-button-prev sa-slider-navigation sa-icon-wrap">
			<?php
			if ( ! empty( $settings['prev_icon']['value'] ) ) :
				Icons_Manager::render_icon( $settings['prev_icon'], [ 
					'aria-hidden' => 'true',
					'class' => 'fa-fw'
				] );
			else :
				?>
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 44">
					<path d="M0,22L22,0l2.1,2.1L4.2,22l19.9,19.9L22,44L0,22L0,22L0,22z">
				</svg>
				<?php
			endif;
			?>

		</div>
		<div class="sa-swiper-button-next sa-slider-navigation sa-icon-wrap">
			<?php
			if ( ! empty( $settings['next_icon']['value'] ) ) :
				Icons_Manager::render_icon( $settings['next_icon'], [ 
					'aria-hidden' => 'true',
					'class' => 'fa-fw'
				] );
			else :
				?>
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27 44">
					<path d="M27,22L27,22L5,44l-2.1-2.1L22.8,22L2.9,2.1L5,0L27,22L27,22z">
				</svg>
				<?php
			endif;
			?>
		</div>
		<?php
	}

	protected function render_pagination() {
		?>
		<div class="swiper-pagination"></div>
		<?php
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$id = 'sa-stellar-slider' . $this->get_id();

		$this->add_render_attribute(
			[ 
				'slider' => [ 
					'class' => 'sa-stellar-slider',
					'id' => $id,
					'data-settings' => [ 
						wp_json_encode( array_filter( [ 
							'effect' => $settings['transition_effect'],
							'fadeEffect' => ( isset( $settings['cross_fade'] ) && $settings['cross_fade'] == 'yes' ) ? true : false,
							'autoplay' => $settings["autoplay"] == 'yes' ? [ 
								"delay" => $settings["autoplay_speed"]['size'] * 1000
							] : false,
							'loop' => ( $settings['loop'] == 'yes' ) ? true : false,
							'speed' => ( ! empty( $settings['speed']['size'] ) ) ? $settings['speed']['size'] * 1000 : 2000,
							'pauseOnHover' => ( $settings["autoplay"] == 'yes' && $settings["pause_on_hover"] == 'yes' ) ? true : false,
							'observer' => $settings['observer'] == 'yes' ? true : false,
							'parallax' => true,
							'navigation' => [ 
								'nextEl' => "#$id .sa-swiper-button-next",
								'prevEl' => "#$id .sa-swiper-button-prev",
							],
							'pagination' => [ 
								'el' => "#$id .swiper-pagination",
								'clickable' => true,
								'type' => $settings['pagination_type'] != 'none' ? $settings['pagination_type'] : false,
								'dynamicBullets' => ( isset( $settings['dynamic_bullets'] ) && ( $settings['dynamic_bullets'] == 'yes' ) ) ? true : false,
							],

						] ) )
					]
				]
			]
		);

		$this->query_posts( $settings['posts_per_page'] );
		$wp_query = $this->get_query();

		if ( ! $wp_query->found_posts ) {
			return;
		}

		?>
		<div <?php $this->print_render_attribute_string( 'slider' ); ?>>
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php

					while ( $wp_query->have_posts() ) :
						$wp_query->the_post();

						$thumbnail_size = $settings['primary_thumbnail_size'];

						$this->get_posts_tags();

						$this->render_item( get_the_ID(), $thumbnail_size, $settings['excerpt_length'] );

					endwhile;


					wp_reset_postdata();

					?>
				</div>
				<?php
				if ( $settings['show_social_icons'] == 'yes' ) :
					$this->render_social_icons();
				endif;

				if ( $settings['show_pagination'] == 'yes' ) :
					$this->render_pagination();
				endif;

				if ( $settings['show_navigation'] == 'yes' ) :
					?>
					<div class="sa-navigation-wrapper sa-position-absolute sa-d-flex">
						<?php $this->render_navigation(); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}
}
