<?php

namespace Sky_Addons\Modules\AudioPlayer\Widgets;

use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;
use Elementor\Widget_Base;
use Sky_Addons\Sky_Addons_Plugin;

use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Audio_Player extends Widget_Base {

	public function get_name() {
		return 'sky-audio-player';
	}

	public function get_title() {
		return esc_html__( 'Audio Player (Beta)', 'sky-elementor-addons' );
	}

	public function get_icon() {
		return 'sky-icon-audio-player';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'sky', 'audio', 'player', 'music', 'sound', 'song', 'track' ];
	}

	public function get_script_depends() {
		return [ 'plyr' ];
	}

	public function get_style_depends() {
		return [ 
			'plyr',
		];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_ad_acc',
			[ 
				'label' => esc_html__( 'Layout', 'sky-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'audio_style',
			[ 
				'label'   => esc_html__( 'Style', 'sky-elementor-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [ 
					'default' => esc_html__( 'Default', 'sky-elementor-addons' ),
					'new'     => esc_html__( 'New Coming Soon', 'sky-elementor-addons' ),
				],
			]
		);

		$this->add_control(
			'source_type',
			[ 
				'label'     => esc_html__( 'Source Type', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'hosted_url',
				'options'   => [ 
					'hosted_url' => esc_html__( 'Local Audio', 'sky-elementor-addons' ),
					'remote_url' => esc_html__( 'Remote Audio', 'sky-elementor-addons' ),
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'hosted_url',
			[ 
				'label'      => esc_html__( 'Local Audio', 'elementor' ),
				'type'       => Controls_Manager::MEDIA,
				'dynamic'    => [ 
					'active'     => true,
					'categories' => [ 
						TagsModule::POST_META_CATEGORY,
						TagsModule::MEDIA_CATEGORY,
					],
				],
				'media_type' => 'audio',
				'default'    => [ 
					'url' => SKY_ADDONS_ASSETS_URL . 'others/sample-music.mp3',
				],
				'condition'  => [ 
					'source_type' => 'hosted_url'
				]
			]
		);

		$this->add_control(
			'remote_url',
			[ 
				'label'         => esc_html__( 'Remote URL', 'sky-elementor-addons' ),
				'description'   => __( 'Enter the URL of the audio file. Supports MP3, OGG, WAV, and WebM audio file formats. You can upload the audio file in the WordPress media library and copy its URL here.', 'sky-elementor-addons' ),
				'type'          => Controls_Manager::URL,
				'show_external' => false,
				'default'       => [ 
					'url' => SKY_ADDONS_ASSETS_URL . 'others/sample-music.mp3',
				],
				'placeholder'   => 'https://example.com/music.mp3',
				'dynamic'       => [ 
					'active'     => true,
					'categories' => [ 
						TagsModule::POST_META_CATEGORY,
						TagsModule::URL_CATEGORY,
					],
				],
				'condition'     => [ 
					'source_type' => 'remote_url'
				]
			]
		);

		$this->add_control(
			'player_controls_icon_size',
			[ 
				'label'     => esc_html__( 'Controls Icon Size', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'units'     => [ 'px', 'em' ],
				'range'     => [ 
					'px' => [ 
						'min' => 5,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}}' => '--plyr-control-icon-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[ 
				'label' => esc_html__( 'Audio Player', 'sky-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'     => 'plyr_background',
				'selector' => '{{WRAPPER}} .plyr__controls',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => 'plyr_box_shadow',
				'selector' => '{{WRAPPER}} .plyr__controls',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[ 
				'name'     => 'plyr_border',
				'selector' => '{{WRAPPER}} .plyr__controls',
			]
		);

		$this->add_responsive_control(
			'plyr_border_radius',
			[ 
				'label'      => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .plyr__controls' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_controls_style',
			[ 
				'label' => esc_html__( 'Controls', 'sky-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'player_controls_color',
			[ 
				'label'     => esc_html__( 'Controls Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}}' => '--plyr-audio-control-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'player_controls_color_hover',
			[ 
				'label'     => esc_html__( 'Controls Color Hover', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}}' => '--plyr-audio-control-color-hover: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'player_primary_color',
			[ 
				'label'     => esc_html__( 'Primary Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}}' => '--plyr-color-main: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tooltip_style',
			[ 
				'label' => esc_html__( 'Tooltip', 'sky-elementor-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name'     => 'player_tooltip_background',
				'selector' => '{{WRAPPER}} .plyr__tooltip',
			]
		);

		$this->add_control(
			'player_tooltip_color',
			[ 
				'label'     => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}}' => '--plyr-tooltip-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'player_tooltip_padding',
			[ 
				'label'      => esc_html__( 'Padding', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}} .plyr__tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'player_tooltip_border_radius',
			[ 
				'label'      => esc_html__( 'Border Radius', 'sky-elementor-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [ 
					'{{WRAPPER}}' => '--plyr-tooltip-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[ 
				'name'     => 'player_tooltip_box_shadow',
				'selector' => '{{WRAPPER}} .plyr__tooltip',
			]
		);

		$this->add_responsive_control(
			'player_tooltip_arrow_size',
			[ 
				'label'     => esc_html__( 'Arrow Size', 'sky-elementor-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'units'     => [ 'px', 'em' ],
				'range'     => [ 
					'px' => [ 
						'min' => 5,
						'max' => 100,
					],
				],
				'selectors' => [ 
					'{{WRAPPER}}' => '--plyr-tooltip-arrow-size: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		// $this->add_control(
		// 	'player_tooltip_arrow_color',
		// 	[ 
		// 		'label'     => esc_html__( 'Arrow Color', 'sky-elementor-addons' ),
		// 		'type'      => Controls_Manager::COLOR,
		// 		'selectors' => [ 
		// 			'{{WRAPPER}}' => '--plyr-tooltip-arrow-color: {{VALUE}}',
		// 		],
		// 	]
		// );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$id       = 'sa-audio-player-' . $this->get_id();

		$this->add_render_attribute(
			[ 
				'audio-player' => [ 
					'id'            => $id,
					'class'         => 'sa-audio-player',
					'data-settings' => [ 
						wp_json_encode(
							[ 
								'id' => '#' . $id,
							]
						),
					],
				],
			]
		);

		$audio_url = 'remote_url' === $settings['source_type'] ? $settings['remote_url']['url'] : $settings['hosted_url']['url'];

		?>

		<div <?php $this->print_render_attribute_string( 'audio-player' ); ?>>
			<audio id="<?php echo esc_attr( $id ); ?>-player" controls>
				<source src="<?php echo esc_url( $audio_url ); ?>" type="audio/mp3" />
				<!-- <source src="/path/to/audio.ogg" type="audio/ogg" /> -->
			</audio>
		</div>

		<?php
	}
}
