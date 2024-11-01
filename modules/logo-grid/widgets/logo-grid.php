<?php

namespace Sky_Addons\Modules\LogoGrid\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Css_Filter;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Logo_Grid extends Widget_Base {

	public function get_name() {
		return 'sky-logo-grid';
	}

	public function get_title() {
		return esc_html__( 'Logo Grid', 'sky-elementor-addons' );
	}

	public function get_icon() {
		return 'sky-icon-logo-grid';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'sky', 'logo', 'grid', 'logogrid' ];
	}

	public function get_style_depends() {
		return [ 
			'tippy',
		];
	}

	public function get_script_depends() {
		return [ 'popper', 'tippyjs' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_logo_grid_layout',
			[ 
				'label' => esc_html__( 'Layout', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'columns',
			[ 
				'label' => esc_html__( 'Columns', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [ 
					2 => esc_html__( '2 Columns', 'sky-elementor-addons' ),
					3 => esc_html__( '3 Columns', 'sky-elementor-addons' ),
					4 => esc_html__( '4 Columns', 'sky-elementor-addons' ),
					5 => esc_html__( '5 Columns', 'sky-elementor-addons' ),
					6 => esc_html__( '6 Columns', 'sky-elementor-addons' ),
				],
				'desktop_default' => 4,
				'tablet_default' => 2,
				'mobile_default' => 2,
				'prefix_class' => 'sa-logo-grid--col-%s',
				'style_transfer' => true,
				'render_type' => 'template',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'logo',
			[ 
				'label' => esc_html__( 'Logo', 'sky-elementor-addons' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [ 
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'link',
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

		$repeater->add_control(
			'brand_name',
			[ 
				'label' => esc_html__( 'Brand Name', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic' => [ 'active' => true ],
				'default' => esc_html__( 'Brand Name', 'sky-elementor-addons' ),
				'placeholder' => 'Your Brand Name',
			]
		);

		$repeater->add_control(
			'brand_text',
			[ 
				'label' => esc_html__( 'Brand Text', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'dynamic' => [ 'active' => true ],
				'default' => esc_html__( 'Create an Enticing Logo Display Website.', 'sky-elementor-addons' ),
			]
		);

		$repeater->add_control(
			'show_tooltip',
			[ 
				'label' => esc_html__( 'Show Tooltip', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$repeater->add_control(
			'tooltip_placement',
			[ 
				'label' => esc_html__( 'Tooltip Placement', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'top',
				'options' => [ 
					'top' => esc_html__( 'Top', 'sky-elementor-addons' ),
					'right' => esc_html__( 'Right', 'sky-elementor-addons' ),
					'bottom' => esc_html__( 'Bottom', 'sky-elementor-addons' ),
					'left' => esc_html__( 'Left', 'sky-elementor-addons' ),
					'auto' => esc_html__( 'Auto', 'sky-elementor-addons' ),
				],
				'condition' => [ 
					'show_tooltip' => 'yes'
				]
			]
		);

		$this->add_control(
			'logo_list',
			[ 
				'label' => esc_html__( 'Logo List', 'sky-elementor-addons' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'separator' => 'before',
				'default' => [ 
					[ 
						'logo' => [ 'url' => Utils::get_placeholder_image_src() ],
					],
					[ 
						'logo' => [ 'url' => Utils::get_placeholder_image_src() ],
					],
					[ 
						'logo' => [ 'url' => Utils::get_placeholder_image_src() ],
					],
					[ 
						'logo' => [ 'url' => Utils::get_placeholder_image_src() ],
					],
					[ 
						'logo' => [ 'url' => Utils::get_placeholder_image_src() ],
					],
					[ 
						'logo' => [ 'url' => Utils::get_placeholder_image_src() ],
					],
					[ 
						'logo' => [ 'url' => Utils::get_placeholder_image_src() ],
					],
					[ 
						'logo' => [ 'url' => Utils::get_placeholder_image_src() ],
					],
				],
				'title_field' => '{{{ brand_name }}}',
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

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[ 
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'default' => 'large',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'style_select',
			[ 
				'label' => esc_html__( 'Select Style', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'box',
				'options' => [ 
					'box' => esc_html__( 'Box', 'sky-elementor-addons' ),
					'border' => esc_html__( 'Border', 'sky-elementor-addons' ),
					'magic' => esc_html__( 'Magic Border', 'sky-elementor-addons' ),
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tooltip',
			[ 
				'label' => esc_html__( 'Tooltip Settings', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'tooltip_animation',
			[ 
				'label' => esc_html__( 'Animation', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'shift-away',
				'options' => [ 
					'shift-away' => esc_html__( 'Shift-Away', 'sky-elementor-addons' ),
					'shift-toward' => esc_html__( 'Shift-Toward', 'sky-elementor-addons' ),
					'scale' => esc_html__( 'Scale', 'sky-elementor-addons' ),
					'perspective' => esc_html__( 'Perspective', 'sky-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'tooltip_offset_popover',
			[ 
				'label' => esc_html__( 'Offset', 'sky-elementor-addons' ),
				'type' => Controls_Manager::POPOVER_TOGGLE,
			]
		);


		$this->start_popover();

		$this->add_control(
			'tooltip_x_offset',
			[ 
				'label' => esc_html__( 'X Offset', 'sky-elementor-addons' ),
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
						'step' => 2,
						'max' => 300,
					],
				],
				'condition' => [ 
					'tooltip_offset_popover' => 'yes'
				],
			]
		);

		$this->add_control(
			'tooltip_y_offset',
			[ 
				'label' => esc_html__( 'Y Offset', 'sky-elementor-addons' ),
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
						'step' => 2,
						'max' => 300,
					],
				],
				'condition' => [ 
					'tooltip_offset_popover' => 'yes'
				],
			]
		);

		$this->end_popover();


		$this->add_control(
			'tooltip_arrow',
			[ 
				'label' => esc_html__( 'Show Arrow', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'tooltip_trigger_on_click',
			[ 
				'label' => esc_html__( 'Trigger on Click', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'description' => esc_html__( 'By default tooltip will show on hover, if you will activate this option tooltip will show on click.', 'sky-elementor-addons' ),
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_logo_grid_style',
			[ 
				'label' => esc_html__( 'Logo Grid', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[ 
				'label' => esc_html__( 'Row Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
						'step' => 1,
					]
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-logo-grid' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 
					'style_select' => 'box'
				]
			]
		);

		$this->add_responsive_control(
			'column_gap',
			[ 
				'label' => esc_html__( 'Column Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
						'step' => 1,
					]
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-logo-grid' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 
					'style_select' => 'box'
				]
			]
		);

		$this->add_responsive_control(
			'grid_height',
			[ 
				'label' => esc_html__( 'Height', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 150,
						'max' => 500,
						'step' => 5,
					]
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-logo-grid-item' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'grid_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-logo-grid-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		/*
		 * start 
		 * border style for style  
		 */
		$this->add_control(
			'border_type',
			[ 
				'label' => esc_html__( 'Border Type', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [ 
					'none' => esc_html__( 'None', 'sky-elementor-addons' ),
					'solid' => esc_html__( 'Solid', 'sky-elementor-addons' ),
					'double' => esc_html__( 'Double', 'sky-elementor-addons' ),
					'dotted' => esc_html__( 'Dotted', 'sky-elementor-addons' ),
					'dashed' => esc_html__( 'Dashed', 'sky-elementor-addons' ),
					'groove' => esc_html__( 'Groove', 'sky-elementor-addons' ),
				],
				'selectors' => [ 
					'{{WRAPPER}} ' => '--sky-border-type: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'border_size',
			[ 
				'label' => esc_html__( 'Border Size', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 10,
						'step' => 1,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} ' => '--sky-border-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border_color',
			[ 
				'label' => esc_html__( 'Border Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} ' => '--sky-border-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'grid_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-logo-grid-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 
					'style_select' => 'box'
				]
			]
		);

		/*
		 * end 
		 */

		$this->start_controls_tabs( 'tabs_grid_style' );

		$this->start_controls_tab(
			'tab_grid_normal',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'grid_bg',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-logo-grid-item',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'grid_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-logo-grid-item',
			]
		);

		$this->add_control(
			'grid_opacity',
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
					'{{WRAPPER}} .sa-logo-grid img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[ 
				'name' => 'grid_css_filters',
				'selector' => '{{WRAPPER}} .sa-logo-grid img',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_grid_hover',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'grid_bg_hover',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-logo-grid-item:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'grid_box_shadow_hover',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-logo-grid-item:hover',
			]
		);

		$this->add_control(
			'grid_opacity_hover',
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
					'{{WRAPPER}} .sa-logo-grid-item:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[ 
				'name' => 'grid_css_filters_hover',
				'selector' => '{{WRAPPER}} .sa-logo-grid-item:hover img',
			]
		);

		$this->add_control(
			'grid_transition',
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
					'{{WRAPPER}} .sa-logo-grid-item' => 'transition-duration: {{SIZE}}s',
				],
			]
		);


		$this->add_control(
			'hover_animation',
			[ 
				'label' => esc_html__( 'Hover Animation', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tooltip_style',
			[ 
				'label' => esc_html__( 'Tooltip', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'tooltip_max_width',
			[ 
				'label' => esc_html__( 'Width', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 50,
						'max' => 500,
					],
				],
				'selectors' => [ 
					'.tippy-box[data-theme="sa-tippy-{{ID}}"]' => 'max-width: calc({{SIZE}}{{UNIT}} - 10px) !important;',
				],
				'render_type' => 'template',
			]
		);

		$this->add_responsive_control(
			'tooltip_alignment',
			[ 
				'label' => esc_html__( 'Alignment', 'sky-elementor-addons' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'center',
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
					'.tippy-box[data-theme="sa-tippy-{{ID}}"]' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'tooltip_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '.tippy-box[data-theme="sa-tippy-{{ID}}"]',
			]
		);

		$this->add_responsive_control(
			'tooltip_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'.tippy-box[data-theme="sa-tippy-{{ID}}"] .tippy-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'tooltip_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '.tippy-box[data-theme="sa-tippy-{{ID}}"]',
			]
		);

		$this->add_responsive_control(
			'tooltip_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'.tippy-box[data-theme="sa-tippy-{{ID}}"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'tooltip_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '.tippy-box[data-theme="sa-tippy-{{ID}}"]',
			]
		);

		$this->start_controls_tabs( 'tooltip_tabs' );

		$this->start_controls_tab(
			'tooltip_tab_normal',
			[ 
				'label' => esc_html__( 'Title', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'tooltip_title_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'.tippy-box[data-theme="sa-tippy-{{ID}}"] .tippy-content .sa-tippy-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'tooltip_title_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '.tippy-box[data-theme="sa-tippy-{{ID}}"] .tippy-content .sa-tippy-title',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tooltip_tab_hover',
			[ 
				'label' => esc_html__( 'Text', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'tooltip_text_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'.tippy-box[data-theme="sa-tippy-{{ID}}"]' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'tooltip_text_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '.tippy-box[data-theme="sa-tippy-{{ID}}"]',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'tooltip_heading_arrow',
			[ 
				'label' => esc_html__( 'A R R O W - S T Y L E', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'tooltip_arrow_color',
			[ 
				'label' => esc_html__( 'Arrow Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'.tippy-box[data-theme="sa-tippy-{{ID}}"] .tippy-arrow' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>

		<div class="sa-logo-grid sa-<?php echo esc_attr( $settings['style_select'] ); ?>">
			<?php
			foreach ( $settings['logo_list'] as $item ) {
				$image = wp_get_attachment_image_url( $item['logo']['id'], $settings['thumbnail_size'] );
				$tippy_class = ! empty( $item['brand_name'] ) && ( $item['show_tooltip'] == 'yes' ) ? ' sa-tippy-tooltip' : '';
				$this->add_render_attribute( 'link-attr', 'class', 'sa-logo-link sa-d-inline-block sa-text-decoration-none ' . $tippy_class, true );

				if ( ! empty( $item['link']['url'] ) ) {
					$this->add_render_attribute( 'link-attr', 'href', esc_url( $item['link']['url'] ), true );

					if ( $item['link']['is_external'] ) {
						$this->add_render_attribute( 'link-attr', 'target', '_blank', true );
					}

					if ( $item['link']['nofollow'] ) {
						$this->add_render_attribute( 'link-attr', 'rel', 'nofollow', true );
					}
				} else {
					$this->add_render_attribute( 'link-attr', 'target', '_self', true );
					$this->add_render_attribute( 'link-attr', 'href', 'javascript:void(0);', true );
				}

				// perfect alt
				$alt_text = ! empty( $item['brand_name'] ) ? $item['brand_name'] : '';
				$alt_text = ! empty( $item['brand_text'] ) ? $alt_text . ' ' . $item['brand_text'] : $alt_text;
				$alt_text = empty( $item['brand_name'] ) && empty( $item['brand_text'] ) ? Control_Media::get_image_alt( $item['logo'] ) : $alt_text;

				// tooltip
				if ( ! empty( $item['brand_name'] ) && ( $item['show_tooltip'] == 'yes' ) ) :
					$this->add_render_attribute( 'tooltip-attr', 'class', 'sa-tippy-tooltip' );
					$this->add_render_attribute( 'tooltip-attr', 'data-tippy', '', true );

					$tooltip_content = '<span class="sa-tippy-title sa-d-block sa-fw-bold mb-1 sa-fw-5">' . wp_kses_post( $item['brand_name'] ) . '</span>' . wp_kses_post( $item['brand_text'] );
					$this->add_render_attribute( 'tooltip-attr', 'data-tippy-content', $tooltip_content, true );

					if ( $item['tooltip_placement'] ) {
						$this->add_render_attribute( 'tooltip-attr', 'data-tippy-placement', esc_attr( $item['tooltip_placement'] ), true );
					}

					if ( $settings['tooltip_animation'] ) {
						$this->add_render_attribute( 'tooltip-attr', 'data-tippy-animation', esc_attr( $settings['tooltip_animation'] ), true );
					}

					if ( $settings['tooltip_offset_popover'] == 'yes' ) {
						if ( $settings['tooltip_x_offset']['size'] or $settings['tooltip_y_offset']['size'] ) {
							$this->add_render_attribute( 'tooltip-attr', 'data-tippy-offset', '[' . $settings['tooltip_x_offset']['size'] . ',' . $settings['tooltip_y_offset']['size'] . ']', true );
						}
					}

					if ( $settings['tooltip_arrow'] == 'yes' ) {
						$this->add_render_attribute( 'tooltip-attr', 'data-tippy-arrow', 'true', true );
					} else {
						$this->add_render_attribute( 'tooltip-attr', 'data-tippy-arrow', 'false', true );
					}

					if ( $settings['tooltip_trigger_on_click'] == 'yes' ) {
						$this->add_render_attribute( 'tooltip-attr', 'data-tippy-trigger', 'click', true );
					}

				endif;
				?>
				<div class="sa-logo-grid-item sa-d-flex sa-justify-content-center sa-align-items-center sa-rounded-1 sa-p-3">
					<a <?php $this->print_render_attribute_string( 'link-attr' ); ?> 			<?php $this->print_render_attribute_string( 'tooltip-attr' ); ?>>
						<figure class="sa-logo-grid-figure">
							<?php
							if ( $image ) :
								echo wp_get_attachment_image(
									$item['logo']['id'],
									$settings['thumbnail_size'],
									false,
									[ 
										'class' => 'sa-logo-grid-img elementor-animation-' . esc_attr( $settings['hover_animation'] ),
										'alt' => $alt_text
									]
								);
							else :
								printf(
									'<img class="sa-logo-grid-img elementor-animation-%s" src="%s" alt="%s">',
									esc_attr( $settings['hover_animation'] ),
									esc_url( Utils::get_placeholder_image_src() ),
									esc_attr( $alt_text )
								);
							endif;
							?>
						</figure>
					</a>
				</div>
			<?php } ?>
		</div>
		<?php
	}
}
