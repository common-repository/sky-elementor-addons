<?php

namespace Sky_Addons\Modules\Testimonial\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Testimonial extends Widget_Base {

	public function get_name() {
		return 'sky-testimonial';
	}

	public function get_title() {
		return esc_html__( 'Testimonial', 'sky-elementor-addons' );
	}

	public function get_icon() {
		return 'sky-icon-testimonial';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'sky', 'testimonial', 'review', 'clients', 'rating' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_testimonial',
			[ 
				'label' => esc_html__( 'Testimonial', 'elementor' ),
			]
		);

		$this->add_control(
			'testimonial_text',
			[ 
				'label' => esc_html__( 'Testimonial', 'elementor' ),
				'type' => Controls_Manager::TEXTAREA,
				'dynamic' => [ 
					'active' => true,
				],
				'rows' => '10',
				'default' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'elementor' ),
			]
		);

		$this->add_responsive_control(
			'testimonial_alignment',
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
				],
				'prefix_class' => 'sa-testimonial-%s-',
				'toggle' => false,
				'default' => 'left',
				'selectors' => [ 
					'{{WRAPPER}} .sa-testimonial' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_reviewer',
			[ 
				'label' => esc_html__( 'Reviewer', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'testimonial_image',
			[ 
				'label' => esc_html__( 'Choose Image', 'elementor' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [ 
					'active' => true,
				],
				'default' => [ 
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[ 
				'name' => 'testimonial_image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `testimonial_image_size` and `testimonial_image_custom_dimension`.
				'default' => 'full',
				'separator' => 'none',
			]
		);

		$this->add_control(
			'testimonial_name',
			[ 
				'label' => esc_html__( 'Name', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic' => [ 
					'active' => true,
				],
				'default' => 'John Doe',
			]
		);

		$this->add_control(
			'testimonial_job',
			[ 
				'label' => esc_html__( 'Title', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic' => [ 
					'active' => true,
				],
				'default' => 'Designer',
			]
		);

		$this->add_control(
			'link',
			[ 
				'label' => esc_html__( 'Link', 'elementor' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,
				'dynamic' => [ 
					'active' => true,
				],
				'placeholder' => esc_html__( 'https://your-link.com', 'elementor' ),
			]
		);



		$this->end_controls_section();


		$this->start_controls_section(
			'section_testimonial_style',
			[ 
				'label' => esc_html__( 'Testimonial', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'testimonial_padding',
			[ 
				'label' => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'testimonial_spacing',
			[ 
				'label' => esc_html__( 'Bottom Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [ 
						'{{WRAPPER}} .sa-testimonial-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'testimonial_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-testimonial-content',
			]
		);

		$this->add_control(
			'testimonial_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-testimonial-content' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'testimonial_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-testimonial-content',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'testimonial_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-testimonial-content',
			]
		);

		$this->add_responsive_control(
			'testimonial_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-testimonial-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'testimonial_box_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-testimonial-content',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_image_style',
			[ 
				'label' => esc_html__( 'Image', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'image_size',
			[ 
				'label' => esc_html__( 'Size', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 200,
					],
					'%' => [ 
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}} .sa-testimonial' => '--sky-media-size: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'image_spacing',
			[ 
				'label' => esc_html__( 'Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [ 
						'{{WRAPPER}}.sa-testimonial--left .sa-reviewer-meta' => 'padding-left: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}}.sa-testimonial--right .sa-reviewer-meta' => 'padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}}.sa-testimonial--center .sa-reviewer-meta' => 'padding-top: {{SIZE}}{{UNIT}};',
					],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name' => 'image_border',
				'label' => esc_html__( 'Border', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-reviewer-thumb img',
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[ 
				'label' => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-reviewer-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [ 
					'show_adv_border_radius!' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_adv_border_radius',
			[ 
				'label' => esc_html__( 'Advanced Border Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'adv_border_radius',
			[ 
				'label' => esc_html__( 'Radius', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '30% 70% 70% 30% / 30% 30% 70% 70% ', 'sky-elementor-addons' ),
				'dynamic' => [ 'active' => true ],
				'selectors' => [ 
					'{{WRAPPER}} .sa-reviewer-thumb img' => 'border-radius: {{VALUE}};',
				],
				'condition' => [ 
						'show_adv_border_radius' => 'yes',
					],
			]
		);

		$this->add_control(
			'adv_border_radius_note',
			[ 
				'type' => Controls_Manager::RAW_HTML,
				'raw' => sprintf( esc_html__( "You can easily generate Radius value from this link <a href='%1s' target='_blank'> Go </a>.", 'sky-elementor-addons' ), "https://9elements.github.io/fancy-border-radius/" ),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				'condition' => [ 
					'show_adv_border_radius' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name' => 'image_shadow',
				'label' => esc_html__( 'Box Shadow', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-reviewer-thumb img',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_reviewer_style',
			[ 
				'label' => esc_html__( 'Reviewer', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'name_spacing',
			[ 
				'label' => esc_html__( 'Spacing', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [ 
					'px' => [ 
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' => [ 
						'{{WRAPPER}} .sa-testimonial-job' => 'margin-top: {{SIZE}}{{UNIT}};',
					],
			]
		);

		$this->add_control(
			'name_heading',
			[ 
				'label' => esc_html__( 'Name', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'name_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-testimonial-name' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'name_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-testimonial-name',
			]
		);

		$this->add_control(
			'job_heading',
			[ 
				'label' => esc_html__( 'Title', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'job_color',
			[ 
				'label' => esc_html__( 'Text Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-testimonial-job' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'job_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-testimonial-job',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$has_content = ! ! $settings['testimonial_text'];
		$has_image = ! ! $settings['testimonial_image']['url'];
		$has_name = ! ! $settings['testimonial_name'];
		$has_job = ! ! $settings['testimonial_job'];

		if ( ! $has_content && ! $has_image && ! $has_name && ! $has_job ) {
			return;
		}

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'link', $settings['link'] );
		}
		?>
		<div class="sa-testimonial">
			<?php
			if ( $has_content ) :
				$this->add_render_attribute( 'testimonial_text', 'class', 'sa-testimonial-content sa-mb-4 sa-fs-6' );
				$this->add_inline_editing_attributes( 'testimonial_text' );
				?>
				<div <?php $this->print_render_attribute_string( 'testimonial_text' ); ?>>
					<?php echo wp_kses_post( $this->parse_text_editor( $settings['testimonial_text'] ) ); ?>
				</div>
			<?php endif; ?>
			<div class="sa-reviewer">
				<?php if ( $has_image ) : ?>
					<a class="sa-d-block sa-text-decoration-none" <?php $this->print_render_attribute_string( 'link' ); ?>>
						<div class="sa-reviewer-thumb">
							<?php
							echo wp_kses_post( Group_Control_Image_Size::get_attachment_image_html( $settings, 'testimonial_image' ) );
							?>
						</div>
					</a>
				<?php endif; ?>
				<div class="sa-reviewer-meta">
					<?php
					if ( $has_name ) :
						$this->add_render_attribute( 'testimonial_name', 'class', 'sa-testimonial-name sa-d-block sa-mb-2 sa-text-decoration-none' );
						$this->add_inline_editing_attributes( 'testimonial_name', 'none' );

						if ( ! empty( $settings['link']['url'] ) ) :
							?>
							<a <?php $this->print_render_attribute_string( 'testimonial_name' ) . ' ' . $this->get_render_attribute_string( 'link' ); ?>>
								<?php echo wp_kses_post( $settings['testimonial_name'] ); ?>
							</a>
							<?php
						else :
							?>
							<div <?php $this->print_render_attribute_string( 'testimonial_name' ); ?>>
								<?php echo wp_kses_post( $settings['testimonial_name'] ); ?>
							</div>
							<?php
						endif;
					endif;
					?>
					<?php
					if ( $has_job ) :
						$this->add_render_attribute( 'testimonial_job', 'class', 'sa-testimonial-job sa-d-block sa-text-decoration-none' );

						$this->add_inline_editing_attributes( 'testimonial_job', 'none' );

						if ( ! empty( $settings['link']['url'] ) ) :
							?>
							<a <?php $this->print_render_attribute_string( 'testimonial_job' ) . ' ' . $this->get_render_attribute_string( 'link' ); ?>>
								<?php echo esc_html( $settings['testimonial_job'] ); ?>
							</a>
							<?php
						else :
							?>
							<div <?php $this->print_render_attribute_string( 'testimonial_job' ); ?>>
								<?php echo esc_html( $settings['testimonial_job'] ); ?>
							</div>
							<?php
						endif;
					endif;
					?>
				</div>
			</div>
		</div>
		<?php
	}
}
