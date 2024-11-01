<?php

namespace Sky_Addons\Modules\Changelog\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;
use Sky_Addons\Includes\Parsedown;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

class Changelog extends Widget_Base {

	public function get_name() {
		return 'sky-changelog';
	}

	public function get_title() {
		return esc_html__( 'Changelog', 'sky-elementor-addons' );
	}

	public function get_icon() {
		return 'sky-icon-changelog';
	}

	public function get_categories() {
		return [ 'sky-elementor-addons' ];
	}

	public function get_keywords() {
		return [ 'sky', 'changelog' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_settings',
			[ 
				'label' => esc_html__( 'Settings', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'remote_url',
			[ 
				'label' => esc_html__( 'Remote URL', 'sky-elementor-addons' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$this->add_control(
			'cache_data',
			[ 
				'label' => esc_html__( 'Cache', 'sky-elementor-addons' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'sky-elementor-addons' ),
				'label_off' => esc_html__( 'Off', 'sky-elementor-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'cache_time',
			[ 
				'label' => esc_html__( 'Cache Time (Days)', 'sky-elementor-addons' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 3,
				'condition' => [ 
					'cache_data' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[ 
				'label' => esc_html__( 'Heading', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .elementor-widget-container > p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'heading_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .elementor-widget-container > p',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_label_style',
			[ 
				'label' => esc_html__( 'Labels', 'sky-elementor-addons' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[ 
				'name' => 'label_typography',
				'label' => esc_html__( 'Typography', 'sky-elementor-addons' ),
				'selector' => '{{WRAPPER}} .sa-label-changelog',
			]
		);

		$this->add_control(
			'heading_fixed',
			[ 
				'label' => esc_html__( 'Fixed', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'fixed_color',
			[ 
				'label' => esc_html__( 'Fixed Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-label-changelog.sa-fixed' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'fixed_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-label-changelog.sa-fixed',
			]
		);


		$this->add_control(
			'heading_added',
			[ 
				'label' => esc_html__( 'Added', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'added_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-label-changelog.sa-added' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'added_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-label-changelog.sa-added',
			]
		);

		$this->add_control(
			'heading_updated',
			[ 
				'label' => esc_html__( 'Updated', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'updated_color',
			[ 
				'label' => esc_html__( 'Updated Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-label-changelog.sa-updated' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'updated_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-label-changelog.sa-updated',
			]
		);

		$this->add_control(
			'heading_note',
			[ 
				'label' => esc_html__( 'Note', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'note_color',
			[ 
				'label' => esc_html__( 'Note Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-label-changelog.sa-note' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'note_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-label-changelog.sa-note',
			]
		);

		$this->add_control(
			'heading_changed',
			[ 
				'label' => esc_html__( 'Changed', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'changed_color',
			[ 
				'label' => esc_html__( 'Changed Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-label-changelog.sa-changed' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'changed_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-label-changelog.sa-changed',
			]
		);

		$this->add_control(
			'heading_removed',
			[ 
				'label' => esc_html__( 'Removed', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'removed_color',
			[ 
				'label' => esc_html__( 'Removed Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} .sa-label-changelog.sa-removed' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[ 
				'name' => 'removed_background',
				'label' => esc_html__( 'Background', 'sky-elementor-addons' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .sa-label-changelog.sa-removed',
			]
		);

		$this->add_control(
			'heading_style',
			[ 
				'label' => esc_html__( 'Text', 'sky-elementor-addons' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_control(
			'heading_text_color',
			[ 
				'label' => esc_html__( 'Color', 'sky-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [ 
					'{{WRAPPER}} li:not(span)' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

	}


	protected function parse_data( $response_data ) {
		$parsedown = new Parsedown();
		$parsedown->addTag = '<span class="sa-label sa-added">' . esc_html__( 'Added:', 'sky-elementor-addons' ) . '</span>';
		$parsedown->removeTag = '<span class="sa-label sa-remove">' . esc_html__( 'Removed', 'sky-elementor-addons' ) . '</span>';
		$parsedown->updateTag = '<span class="sa-label sa-update">' . esc_html__( 'Updated', 'sky-elementor-addons' ) . '</span>';
		$parsedown->changedTag = '<span class="sa-label sa-changed">' . esc_html__( 'Changed', 'sky-elementor-addons' ) . '</span>';
		$parsedown->fixedTag = '<span class="sa-label sa-fixed">' . esc_html__( 'Fixed', 'sky-elementor-addons' ) . '</span>';
		$parsedown->noteTag = '<span class="sa-label sa-note">' . esc_html__( 'Note', 'sky-elementor-addons' ) . '</span>';

		$parsedown = $parsedown->text( $response_data );

		$data = $parsedown;

		return $data;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$id = 'tf_changelog_' . $this->get_id();
		require_once( SKY_ADDONS_INC_PATH . 'class-parsedown.php' );

		$transient_key = $id . '_data';
		$response_data = get_transient( $transient_key );

		$api_url = ! empty( $settings['remote_url'] ) ? $settings['remote_url'] : '';
		if ( empty( $api_url ) ) {
			echo 'URL End Point Missing.';
			return;
		}

		if ( ! $response_data ) {
			$response = wp_remote_request( $api_url, [] );
			/**
			 * Access Body of JSON & Decode to Array
			 */
			$response_data = wp_remote_retrieve_body( $response );

			$response_data = $this->parse_data( $response_data );

			if ( 'yes' == $settings['cache_data'] ) {
				$cache_time = ! empty( $settings['cache_time'] ) ? $settings['cache_time'] : 3;
				set_transient( $transient_key, $response_data, apply_filters( 'sky-addons/changelog/cached-time', DAY_IN_SECONDS * $cache_time ) );
			}

		}

		$final_response_data = $response_data;
		// $final_response_data = get_transient( $transient_key );

		if ( ! is_array( $final_response_data ) && is_wp_error( $final_response_data ) ) {
			echo 'Data not found.';
			return;
		}

		$final_response_data = str_replace( '=', '', $final_response_data );
		$final_response_data = str_replace( '[', '(', $final_response_data );
		$final_response_data = str_replace( ']', ')', $final_response_data );
		$final_response_data = str_replace( 'Added:', '<span class="sa-label-changelog sa-added">Added:</span> ', $final_response_data );
		$final_response_data = str_replace( 'Updated:', '<span class="sa-label-changelog sa-updated">Updated:</span> ', $final_response_data );
		$final_response_data = str_replace( 'Fixed:', '<span class="sa-label-changelog sa-fixed">Fixed:</span> ', $final_response_data );
		$final_response_data = str_replace( 'Removed:', '<span class="sa-label-changelog sa-removed">Removed:</span> ', $final_response_data );
		$final_response_data = str_replace( 'Changed:', '<span class="sa-label-changelog sa-changed">Changed:</span> ', $final_response_data );
		$final_response_data = str_replace( 'Note:', '<span class="sa-label-changelog sa-note">Note:</span> ', $final_response_data );

		echo wp_kses_post( $final_response_data );
	}
}
