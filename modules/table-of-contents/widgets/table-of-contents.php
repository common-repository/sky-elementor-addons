<?php

namespace Sky_Addons\Modules\TableOfContents\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if accessed directly

class Table_Of_Contents extends Widget_Base {

	public function get_name() {
		return 'sky-table-of-contents';
	}

	public function get_title() {
		return esc_html__( 'Table Of Contents', 'sky-elementor-addons' );
	}

	public function get_icon() {
		return 'sky-icon-table-of-contents';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'sky', 'table-of-contents', 'counter' ];
	}

	public function is_reload_preview_required() {
		return true;
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_layout',
			[ 
				'label' => esc_html__( 'Table Of Contents', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'select_layout',
			[ 
				'label' => esc_html__( 'Select Layout', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'simple',
				'options' => [ 
					'simple' => esc_html__( 'Simple', 'sky-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'parent_selector',
			[ 
				'label' => esc_html__( 'Container Selector', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => false,
				'default' => '.elementor',
				'placeholder' => '.elementor',
			]
		);

		$this->add_control(
			'heading_selectors',
			[ 
				'label' => esc_html__( 'Select Heading Tag', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT2,
				'multiple' => true,
				'description' => 'Select tags for Table of Contents.',
				'default' => [ 'h2', 'h3', 'h4' ],
				'options' => sky_title_tags(),
			]
		);

		$this->add_control(
			'parent_selector_note',
			[ 
				'type' => Controls_Manager::RAW_HTML,
				'raw' => esc_html__( 'Note: Class or ID of Container/Post main area. Otherwise, it will automatically pull inappropriate contents. Example: .elementor, #post', 'sky-elementor-addons' ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',

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
			'simple_auto_hash',
			[ 
				'label' => esc_html__( 'Auto Hash Location', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'animate_time',
			[ 
				'label' => esc_html__( 'Animate Time (ms)', 'sky-elementor-addons' ),
				'type' => Controls_Manager::NUMBER,
				'description' => esc_html__( 'Scrolling Animate Time', 'sky-elementor-addons' ),
				'default' => 1500,
				'separator' => 'before'
			]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'style_simple',
			[ 
				'label' => esc_html__( 'List Style', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'select_list_style',
			[ 
				'label' => esc_html__( 'Select Style', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'decimal',
				'options' => [ 
					'decimal' => esc_html__( 'Decimal', 'sky-elementor-addons' ),
					'circle' => esc_html__( 'Circle', 'sky-elementor-addons' ),
					'disc' => esc_html__( 'Disc', 'sky-elementor-addons' ),
					'square' => esc_html__( 'Square', 'sky-elementor-addons' ),
					'lower-alpha' => esc_html__( 'Lower Alpha', 'sky-elementor-addons' ),
					'upper-alpha' => esc_html__( 'Upper Alpha', 'sky-elementor-addons' ),
					'lower-roman' => esc_html__( 'Lower Roman', 'sky-elementor-addons' ),
					'upper-roman' => esc_html__( 'Upper Roman', 'sky-elementor-addons' ),
				],
				'selectors' => [ 
					'{{WRAPPER}} ul' => 'list-style: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'simple_spacing',
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
					'{{WRAPPER}} li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'simple_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} a',
			]
		);

		$this->start_controls_tabs(
			'style_simple_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[ 
				'label' => esc_html__( 'Normal', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'simple_list_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[ 
				'label' => esc_html__( 'Hover', 'sky-elementor-addons' ),
			]
		);

		$this->add_control(
			'simple_list_color_hover',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$id = 'sa-table-of-contents-' . $this->get_id();

		$heading_selectors = implode( ',', $settings['heading_selectors'] );

		$this->add_render_attribute( 'sa-table-of-contents', [ 
			'class' => 'sa-table-of-contents',
			'data-settings' => [ 
				wp_json_encode(
					array_filter( [ 
						'id' => $id,
						'parentSelector' => ! empty( $settings['parent_selector'] ) ? $settings['parent_selector'] : '.elementor',
						'headingSelectors' => ! empty( $heading_selectors ) ? $heading_selectors : 'h2,h3',
						'autoHash' => $settings['simple_auto_hash'],
						'animateTime' => ! empty( $settings['animate_time'] ) ? (int) $settings['animate_time'] : 1500,
					] )
				),
			],
		] );
		?>
		<div <?php $this->print_render_attribute_string( 'sa-table-of-contents' ); ?>></div>
		<?php
	}
}
