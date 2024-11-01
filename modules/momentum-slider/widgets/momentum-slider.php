<?php

namespace Sky_Addons\Modules\MomentumSlider\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Group_Control_Css_Filter;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Momentum_Slider extends Widget_Base {

	public function get_name() {
		return 'sky-momentum-slider';
	}

	public function get_title() {
		return esc_html__( 'Momentum Slider', 'sky-elementor-addons' );
	}

	public function get_icon() {
		return 'sky-icon-momentum-slider';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'sky', 'momentum', 'slider', 'carousel', 'portfolio' ];
	}

	public function get_style_depends() {
		return [ 
			'momentum',
		];
	}

	public function get_script_depends() {
		return [ 'momentum' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_momentum_slider_layout',
			[ 
				'label' => esc_html__( 'Momentum Slider', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'slider_title',
			[ 
				'label' => esc_html__( 'Title', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Slider Title', 'sky-elementor-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'slider_image',
			[ 
				'label' => esc_html__( 'Slider Image', 'sky-elementor-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [ 
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'slider_link',
			[ 
				'label' => esc_html__( 'Link', 'sky-elementor-addons' ),
				'type' => Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'sky-elementor-addons' ),
				'show_external' => true,
				'default' => [ 
					'url' => '',
					'is_external' => false,
				],
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'momentum_list',
			[ 
				'label' => esc_html__( '', 'sky-elementor-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				//                'separator'   => 'before',
				'default' => [ 
					[ 
						'slider_title' => esc_html__( 'Add Your Text Here #1', 'sky-elementor-addons' ),
					],
					[ 
						'slider_title' => esc_html__( 'Add Your Text Here #2', 'sky-elementor-addons' ),
					],
					[ 
						'slider_title' => esc_html__( 'Add Your Text Here #3', 'sky-elementor-addons' ),
					],
					[ 
						'slider_title' => esc_html__( 'Add Your Text Here #4', 'sky-elementor-addons' ),
					],
				],
				'title_field' => '{{{ slider_title }}}',
			]
		);

		$this->add_control(
			'title_tag',
			[ 
				'label' => esc_html__( 'Title HTML Tag', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => sky_title_tags(),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'hide_number',
			[ 
				'label' => esc_html__( 'Hide Number', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'prefix_class' => 'sa-hide-number-',
			]
		);

		$this->add_control(
			'show_button',
			[ 
				'label' => esc_html__( 'Show Button / Link', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'hide_pagination',
			[ 
				'label' => esc_html__( 'Hide Pagination', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'prefix_class' => 'sa-hide-pagination-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			[ 
				'label' => esc_html__( 'Button / Link', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [ 
					'show_button' => 'yes'
				]
			]
		);


		$this->add_control(
			'button_text',
			[ 
				'label' => esc_html__( 'Button Text', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Read more', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'button_icon',
			[ 
				'label' => esc_html__( 'Icon', 'sky-elementor-addons' ),
				'type' => Controls_Manager::ICONS,
				'label_block' => true,
				'default' => [ 
					'value' => 'fas fa-long-arrow-alt-right',
					'library' => 'fa-solid',
				],
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
						'step' => 1,
					],
				],
				'default' => [ 
					'unit' => 'px',
					'size' => 5,
				],
				'condition' => [ 
					'button_icon[value]!' => ''
				],
				'selectors' => [ 
					'{{WRAPPER}} .ms--links .sa-icon-before' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ms--links .sa-icon-after' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();


		$this->start_controls_section(
			'section_momentum_slider_style',
			[ 
				'label' => esc_html__( 'Momentum Slider', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'slider_height',
			[ 
				'label' => esc_html__( 'Slider Height', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [ 
					'px' => [ 
						'min' => 430,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-momentum-slider .sliders-container' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_number_style',
			[ 
				'label' => esc_html__( 'Number', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'hide_number!' => 'yes',
				]
			]
		);

		$this->add_control(
			'number_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .ms--numbers .ms-slide' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'number_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ms--numbers .ms-slide',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'number_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .ms--numbers .ms-slide',
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

		$this->add_control(
			'title_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .ms--titles .ms-slide-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'title_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ms--titles .ms-slide',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .ms--titles .ms-slide-title',
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .ms--titles .ms-slide-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[ 
				'label' => esc_html__( 'Button / Link', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_button' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .ms--links .ms-slide__link.sa-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'button_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .ms--links .ms-slide__link.sa-link',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_responsive_control(
			'button_width',
			[ 
				'label' => esc_html__( 'Width', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [ 
					'px' => [ 
						'min' => 50,
						'max' => 250,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .ms--links.ms-container--vertical, {{WRAPPER}} .sa-momentum-slider .ms--links .ms-slide' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .ms--links .ms-slide__link.sa-link' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'button_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ms--links .ms-slide__link.sa-link',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'button_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .ms--links .ms-slide__link.sa-link',
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .ms--links .ms-slide__link.sa-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'button_text_shadow',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .ms--links .ms-slide__link.sa-link',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'button_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .ms--links .ms-slide__link.sa-link',
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
					'{{WRAPPER}} .ms--links .ms-slide__link.sa-link:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'button_background_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .ms--links .ms-slide__link.sa-link:hover',
			]
		);

		$this->add_control(
			'button_border_color_hover',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .ms--links .ms-slide__link.sa-link:hover' => 'border-color: {{VALUE}};',
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
					'{{WRAPPER}} .ms--links .ms-slide__link.sa-link:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[ 
				'name' => 'button_text_shadow_hover',
				'label' => esc_html__( 'Text Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .ms--links .ms-slide__link.sa-link:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'button_box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .ms--links .ms-slide__link.sa-link:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_img_style',
			[ 
				'label' => esc_html__( 'Images', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'img_width',
			[ 
				'label' => esc_html__( 'Width', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 400,
						'max' => 1000,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-momentum-slider .ms--images .ms-slide' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'img_height',
			[ 
				'label' => esc_html__( 'Height', 'sky-elementor-addons' ),
				'description' => 'Please maintain also slider height.',
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 300,
						'max' => 1000,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-momentum-slider .ms--images.ms-container--horizontal' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .sa-momentum-slider .ms--images .ms-slide' => 'height: {{SIZE}}{{UNIT}};',
				],
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
					'{{WRAPPER}} .ms--images .ms-slide__image' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_control(
			'img_spacing',
			[ 
				'label' => esc_html__( 'Space Between', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-momentum-slider .ms--images .ms-slide__image-container' => 'width: calc(100% - {{SIZE}}px);',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[ 
				'name' => 'img_css_filters',
				'selector' => '{{WRAPPER}} .ms--images .ms-slide__image',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_pagination_style',
			[ 
				'label' => esc_html__( 'Pagination', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'hide_pagination!' => 'yes',
				]
			]
		);

		$this->add_responsive_control(
			'pagination_height',
			[ 
				'label' => esc_html__( 'Height', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 1,
						'max' => 50,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-momentum-slider .pagination__button:before,
                         {{WRAPPER}} .sa-momentum-slider .pagination__button:after,
                         {{WRAPPER}} .sa-momentum-slider .pagination__button
                            ' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'pagination_width',
			[ 
				'label' => esc_html__( 'Width', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-momentum-slider .pagination__button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'pagination_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-momentum-slider .pagination__button:before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'pagination_color_active',
			[ 
				'label' => esc_html__( 'Active Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-momentum-slider .pagination__button:after' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$slider_titles = [];
		$slider_images = [];
		$id = 'sa-momentum-slider-' . $this->get_id();
		//        $slider_links = [];
		$slider_attr = [];
		foreach ( $settings['momentum_list'] as $index => $item ) {
			$slider_titles[ $index ] = esc_html( $item['slider_title'] );
			$slider_images[ $index ] = esc_url( $item['slider_image']['url'] );
			//$slider_links[ $index ] =  !empty($item[ 'slider_link' ][ 'url' ]) ? esc_url($item[ 'slider_link' ][ 'url' ]) : 'javascript:void(0);';

			$this->add_link_attributes( 'link' . $index, $item['slider_link'], true );
			$slider_attr[ $index ] = $this->get_render_attribute_string( 'link' . $index );
		}

		$icon_position = $settings['button_icon_position'] == 'before' ? 'sa-icon-before' : 'sa-icon-after';

		$link_icon = NULL;
		if ( ! empty( $settings['button_icon']['value'] ) ) {
			$link_icon = '<i class="' . esc_attr( $settings['button_icon']['value'] ) . ' ' . $icon_position . '"></i>';
		}

		$button_text = ( $settings['button_icon_position'] == 'before' ) ? $link_icon . $settings['button_text'] : $settings['button_text'] . $link_icon;


		$this->add_render_attribute(
			[ 
				'momentum-slider' => [ 
					'class' => 'sa-momentum-slider',
					'data-settings' => [ 
						wp_json_encode(
							[ 
								'id' => '#' . $id,
								'range' => count( $settings['momentum_list'] ),
								'sliderTitles' => $slider_titles,
								'titleTag' => Utils::validate_html_tag( $settings['title_tag'] ),
								'sliderImages' => $slider_images,
								'buttonText' => $button_text,
								//'buttonLinks'   => $slider_links,
								'sliderAttr' => $slider_attr,
							]
						),
					],
				],
			]
		);
		?>
		<div <?php $this->print_render_attribute_string( 'momentum-slider' ); ?>>
			<div class="sliders-container" id="<?php echo esc_attr( $id ); ?>">
				<?php
				//Here will be injected sliders for images, numbers, titles and links 
				?>
				<ul class="momentum-slider-pagination">
					<?php
					for ( $i = 0; $i < count( $settings['momentum_list'] ); $i++ ) {
						?>
						<li class="pagination__item"><a class="pagination__button"></a></li>
					<?php } ?>
				</ul>

			</div>
		</div>
		<?php
	}
}
