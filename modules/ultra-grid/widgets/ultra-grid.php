<?php

namespace Sky_Addons\Modules\UltraGrid\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Sky_Addons\Includes\Controls\GroupQuery\Group_Control;
use Sky_Addons\Traits\Global_Widget_Controls;
use Sky_Addons\Traits\Global_Widget_Functions;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Exit if accessed directly

class Ultra_Grid extends Widget_Base {
	use Group_Control;
	use Global_Widget_Functions;
	use Global_Widget_Controls;

	private $_query = null;

	public function get_name() {
		return 'sky-ultra-grid';
	}

	public function get_title() {
		return esc_html__( 'Ultra Grid', 'sky-elementor-addons' );
	}

	public function get_icon() {
		return 'sky-icon-ultra-grid';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'sky', 'post', 'list', 'blogs' ];
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
			'section_ultra_grid_layout',
			[ 
				'label' => esc_html__( 'Layout', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'content_layout',
			[ 
				'label' => esc_html__( 'Select Layout', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'options' => [ 
					'default' => esc_html__( 'Default', 'sky-elementor-addons' ),
					'layout_1' => esc_html__( 'Layout 1', 'sky-elementor-addons' ),
					'layout_2' => esc_html__( 'Layout 2', 'sky-elementor-addons' ),
					'layout_3' => esc_html__( 'Layout 3', 'sky-elementor-addons' ),
				],
				'default' => 'default',
				'tablet_default' => 'default',
				'mobile_default' => 'default',
				'prefix_class' => 'sa-ultra-grid-',
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[ 
				'label' => esc_html__( 'Row Gap', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
					]
				],
				'selectors' => [ 
						'{{WRAPPER}} .sa-ultra-grid' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
					],
			]
		);

		$this->add_responsive_control(
			'column_gap',
			[ 
				'label' => esc_html__( 'Column Gap', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
					]
				],
				'selectors' => [ 
						'{{WRAPPER}} .sa-ultra-grid' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
					],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[ 
				'name' => 'primary_thumbnail',
				'exclude' => [ 'custom' ],
				'default' => 'large',
			]
		);

		$this->add_responsive_control(
			'content_alignment',
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
					'{{WRAPPER}} .sa-post-item' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .sa-post-meta, {{WRAPPER}} .sa-post-category' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		/*
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
				'default' => 3,
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
			'show_title',
			[ 
				'label' => esc_html__( 'Show Title', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'title_tag',
			[ 
				'label' => esc_html__( 'Title HTML Tag', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => sky_title_tags(),
				'condition' => [ 
					'show_title' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_image',
			[ 
				'label' => esc_html__( 'Show Image', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'yes',
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
				'default' => 'no',
			]
		);

		$this->add_control(
			'show_excerpt',
			[ 
				'label' => esc_html__( 'Show Text', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'excerpt_length',
			[ 
				'label' => esc_html__( 'Text Limit', 'sky-elementor-addons' ),
				'description' => esc_html__( 'This is for the main content, but not for excerpts. If you set the offset to 0, then you\'ll get the full text instead.', 'sky-elementor-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 15,
				'condition' => [ 
					'show_excerpt' => 'yes',
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

		/*
		 * Global Date Controls
		 */

		$this->add_control(
			'show_date',
			[ 
				'label' => esc_html__( 'Show Date', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
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

		$this->add_control(
			'show_pagination',
			[ 
				'label' => esc_html__( 'Show Pagination', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_button',
			[ 
				'label' => esc_html__( 'Show Read More', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_post_video_settings',
			[ 
				'label' => esc_html__( 'Video Settings', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [ 
					'show_video' => 'yes',
				],
			]
		);

		/*
		 * Global Video Lightbox Control
		 */
		$this->video_lightbox_controls();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			[ 
				'label' => esc_html__( 'Read More', 'sky-elementor-addons' ),
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
				'default' => esc_html__( 'READ MORE', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
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
			'section_ultra_grid_style',
			[ 
				'label' => esc_html__( 'Ultra Grid', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'item_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-item',
			]
		);

		$this->add_responsive_control(
			'item_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'default' => [ 
					'top' => '.8',
					'right' => '.8',
					'bottom' => '.8',
					'left' => '.8',
					'unit' => 'em',
					'isLinked' => true,
				],
				'selectors' => [ 
						'{{WRAPPER}} .sa-post-item, {{WRAPPER}} .sa-post-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
					],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'item_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-item',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			[ 
				'label' => esc_html__( 'Image', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_image' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'image_overlay',
				'label' => esc_html__( 'Image Overlay', 'sky-elementor-addons' ),
				'types' => [ 'gradient' ],
				'separator' => 'before',
				'exclude' => [ 'image' ],
				'fields_options' => [ 
					'background' => [ 
						'label' => 'Image Overlay'
					],
				],
				'selector' => '{{WRAPPER}} .sa-post-img-wrapper:after',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'img_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-img',
			]
		);

		$this->add_responsive_control(
			'img_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .sa-post-img  ::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'img_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-post-img',
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[ 
				'name' => 'img_css_filters',
				'selector' => '{{WRAPPER}} .sa-post-img',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[ 
				'label' => esc_html__( 'Title', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_title' => 'yes',
				],
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
						'{{WRAPPER}} .sa-post-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
			]
		);

		/*
		 * Global Title
		 */

		$this->register_post_title_controls_style();

		$this->add_responsive_control(
			'title_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				// 'default'    => [
				//     'size'  
				// ]
				'selectors' => [ 
					'{{WRAPPER}} .sa-post-title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'title_background',
				'label' => esc_html__( 'Title Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'separator' => 'before',
				'exclude' => [ 'image' ],
				'fields_options' => [ 
					'background' => [ 
						'label' => 'Title Background'
					],
				],
				'selector' => '{{WRAPPER}} .sa-post-title a',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			[ 
				'label' => esc_html__( 'Text', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 'show_excerpt' => 'yes' ],
			]
		);

		/*
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
					'show_category' => 'yes',
				],
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

		$this->add_responsive_control(
			'category_space_between',
			[ 
				'label' => esc_html__( 'Space Between', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [ 
						'{{WRAPPER}}' => '--sa-post-category-spacing: {{SIZE}}{{UNIT}};',
					],
			]
		);

		/*
		 * Global Category
		 */

		$this->register_post_category_controls_style();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_meta_style',
			[ 
				'label' => esc_html__( 'Meta', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'conditions' => [ 
					'relation' => 'or',
					'terms' => [ 
						[ 
							'name' => 'show_author',
							'value' => 'yes',
						],
						[ 
							'name' => 'show_date',
							'value' => 'yes',
						],
					],
				],
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

		$this->add_responsive_control(
			'meta_space_between',
			[ 
				'label' => esc_html__( 'Space Between', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' => [ 
						'{{WRAPPER}} .sa-post-meta' => 'grid-gap: {{SIZE}}{{UNIT}};',
					],
			]
		);

		/**
		 * Global Controls Meta
		 */

		$this->register_post_meta_controls_style();

		$this->end_controls_section();

		/*
		 * Global Pagination
		 *
		 */
		$this->register_post_pagination_controls_style();

		$this->start_controls_section(
			'section_button_style',
			[ 
				'label' => esc_html__( 'Read More', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_button' => 'yes'
				]
			]
		);

		/**
		 * Global Read more 
		 *
		 */
		$this->general_button_controls_style();

		$this->end_controls_section();

		$this->start_controls_section(
			'play_btn_style',
			[ 
				'label' => esc_html__( 'Play Button', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [ 
					'show_video' => 'yes',
				],
			]
		);

		/*
		 * Global Controls
		 */
		$this->player_button_style( [ 
			'prefix' => 'play_button',
			'selector' => '.sa-post-play-button',
		] );

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
	 * Get post query builder arguments.
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

	protected function render_author() {
		$settings = $this->get_settings_for_display();
		if ( 'yes' !== $settings['show_author'] ) {
			return;
		} ?>
		<div class="sa-post-author-wrapper sa-d-flex">
			<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"
				class="sa-d-inline-flex sa-align-items-center">
				<div class="sa-icon-wrap sa-me-1">
					<i class="eicon-user-circle-o"></i>
				</div>
				<span class="sa-post-author-text">
					<?php echo wp_kses_post( get_the_author() ); ?>
				</span>
			</a>
		</div>
		<?php
	}

	protected function render_date() {
		$settings = $this->get_settings_for_display();
		if ( 'yes' !== $settings['show_date'] ) {
			return;
		} ?>
		<div class="sa-post-date-wrapper sa-d-flex sa-align-items-center">
			<div class="sa-icon-wrap sa-me-1">
				<i class="eicon-calendar"></i>
			</div>
			<?php
			$this->render_post_date(); ?>
		</div>
		<?php
	}

	protected function render_item( $post_id, $image_size, $excerpt_length ) {
		// global $post;
		$settings = $this->get_settings_for_display(); ?>
		<div class="sa-post-item sa-d-flex">

			<?php $this->render_post_thumb_with_video( $post_id, $image_size ); ?>

			<div class="sa-post-content-wrapper sa-w-100 sa-p-4">
				<div class="sa-post-meta sa-d-flex sa-mb-1">

					<?php $this->render_author(); ?>

					<?php $this->render_date(); ?>

				</div>

				<?php

				$this->render_post_category( [ 
					'wrapper_class' => 'sa-post-category-style-1 sa-mb-3',
				] );

				$this->render_post_title( [ 
					'wrapper_class' => 'sa-mb-2',
				] );

				$this->render_post_excerpt( $excerpt_length );

				$this->render_post_general_button();

				?>
			</div>
		</div>
		<?php
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'ultra-grid', [ 
			'class' => 'sa-ultra-grid sa-img-effect-1-1',
		] );

		$this->query_posts( $settings['posts_per_page'] );
		$wp_query = $this->get_query();

		if ( ! $wp_query->found_posts ) {
			return;
		}

		?>
		<div <?php $this->print_render_attribute_string( 'ultra-grid' ); ?>>
			<?php
			while ( $wp_query->have_posts() ) :
				$wp_query->the_post();

				$thumbnail_size = $settings['primary_thumbnail_size'];

				$this->get_posts_tags();

				$this->render_item( get_the_ID(), $thumbnail_size, $settings['excerpt_length'] );

			endwhile; ?>
		</div>

		<?php

		if ( 'yes' == $settings['show_pagination'] ) {
			if ( function_exists( 'sky_post_pagination' ) ) {
				sky_post_pagination( $wp_query, $this->get_id() );
			}
		}

		wp_reset_postdata();
	}
}
