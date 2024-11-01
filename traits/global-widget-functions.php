<?php

namespace Sky_Addons\Traits;

use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Embed;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) )
	exit; // Exit if accessed directly

trait Global_Widget_Functions {

	protected function render_post_image( $add = [] ) {
		$image_id = $add['image_id'];
		$thumbnail_size = $add['thumbnail_size'];

		$wrapper_class = 'sa-post-img';

		$placeholder_image_src = Utils::get_placeholder_image_src();
		$image_src = wp_get_attachment_image_src( $image_id, $thumbnail_size );

		if ( isset( $add['wrapper_class'] ) ) {
			$wrapper_class .= ' ' . $add['wrapper_class'];
		}

		if ( ! $image_src ) {
			printf( '<img class="%1$s" src="%2$s" alt="%3$s">', esc_attr( $wrapper_class ), esc_url( $placeholder_image_src ), esc_html( get_the_title() ) );
		} else {
			print( wp_get_attachment_image(
				$image_id,
				$thumbnail_size,
				false,
				[ 
					'class' => $wrapper_class,
					'alt' => esc_html( get_the_title() )
				]
			) );
		}
	}

	protected function render_post_title( $add = [] ) {
		$settings = $this->get_settings_for_display();
		$wrapper_class = 'sa-post-title';

		if ( ! isset( $settings['show_title'] ) || 'yes' !== $settings['show_title'] ) {
			return;
		}

		if ( isset( $add['wrapper_class'] ) ) {
			$wrapper_class .= ' ' . $add['wrapper_class'];
		}

		printf(
			'<%1$s class="%2$s"><a href="%3$s" title="%4$s">%4$s</a></%1$s>',
			esc_attr( Utils::validate_html_tag( $settings['title_tag'] ) ),
			esc_attr( $wrapper_class ),
			esc_url( get_permalink() ),
			esc_html( get_the_title() )
		);
	}

	/**
	 * Feature Version - Alpha
	 * @since 1.0.11
	 * Used - Mate Slider
	 */

	protected function render_post_title_attr( $id, $add = [] ) {
		$settings = $this->get_settings_for_display();

		if ( ! isset( $settings['show_title'] ) || 'yes' !== $settings['show_title'] ) {
			return;
		}

		$this->add_render_attribute( $id, $add );

		printf(
			'<%1$s ' . wp_kses_post( $this->get_render_attribute_string( $id ) ) . '><a href="%2$s" title="%3$s">%3$s</a></%1$s>',
			esc_attr( Utils::validate_html_tag( $settings['title_tag'] ) ),
			esc_url( get_permalink() ),
			esc_html( get_the_title() )
		);
	}

	protected function render_post_category( $add = [] ) {
		$settings = $this->get_settings_for_display();
		$wrapper_class = 'sa-post-category';

		if ( ! isset( $settings['show_category'] ) || 'yes' !== $settings['show_category'] ) {
			return;
		}

		if ( ! function_exists( 'sky_get_post_category' ) ) {
			return;
		}

		if ( isset( $add['wrapper_class'] ) ) {
			$wrapper_class .= ' ' . $add['wrapper_class'];
		}

		printf(
			'<div class="%1$s">%2$s</div>',
			esc_attr( $wrapper_class ),
			wp_kses_post( sky_get_post_category( $this->get_settings( 'posts_source' ) ) )
		);
	}

	/**
	 * Feature Version - Alpha
	 * @since 1.0.11
	 * Used - Mate Slider
	 */
	protected function render_post_category_attr( $id, $add = [] ) {
		$settings = $this->get_settings_for_display();

		if ( ! isset( $settings['show_category'] ) || 'yes' !== $settings['show_category'] ) {
			return;
		}

		if ( ! function_exists( 'sky_get_post_category' ) ) {
			return;
		}

		$this->add_render_attribute( $id, $add );

		printf(
			'<div ' . wp_kses_post( $this->get_render_attribute_string( $id ) ) . '>%1$s</div>',
			wp_kses_post( sky_get_post_category( $this->get_settings( 'posts_source' ) ) )
		);
	}

	protected function render_post_date() {
		$settings = $this->get_settings_for_display();

		if ( ! isset( $settings['show_date'] ) || 'yes' !== $settings['show_date'] ) {
			return;
		}

		$date = get_the_date();

		if ( 'yes' == $settings['show_human_diff_time'] ) {
			$date = sky_post_time_ago( ( 'yes' == $settings['human_diff_time_short'] ) ? 'short' : '' );
		}

		printf(
			'<span class="%1$s">%2$s</span>',
			'sa-post-date',
			wp_kses_post( $date )
		);

		if ( isset( $settings['show_time'] ) && 'yes' == $settings['show_time'] ) {
			printf(
				'<span class="%1$s"><i class="sky-icon-clock" aria-hidden="true"></i>%2$s</span>',
				'sa-post-time sa-ms-1',
				wp_kses_post( get_the_time() )
			);
		}
	}

	protected function render_post_excerpt( $length ) {
		$settings = $this->get_settings_for_display();

		if ( ! isset( $settings['show_excerpt'] ) || 'yes' !== $settings['show_excerpt'] ) {
			return;
		}
		$strip_shortcode = ( $settings['strip_shortcode'] ) ? true : false;
		$excerpt = '';

		if ( has_excerpt() ) {
			// $excerpt = the_excerpt();
			ob_start();
			the_excerpt();
			$_excerpt = ob_get_clean();
			$excerpt = $_excerpt;
		} else {
			$excerpt = sky_post_custom_excerpt( $length, $strip_shortcode );
		}

		printf(
			'<div class="%1$s">%2$s</div>',
			'sa-post-text',
			wp_kses_post( $excerpt )
		);
	}

	protected function render_post_author( $add = [] ) {
		$wrapper_class = 'sa-post-author-wrapper';

		if ( isset( $add['wrapper_class'] ) ) {
			$wrapper_class .= ' ' . $add['wrapper_class'];
		}

		// $author_icon = '<i class="sa-post-icon-user"></i>';
		$author_icon = '<i class="far fa-user"></i>';

		printf(
			'<div class="%1$s"><a href="%2$s">%4$s<span>%3$s</span></a></div>',
			esc_attr( $wrapper_class ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			wp_kses_post( get_the_author() ),
			wp_kses_post( $author_icon )
		);
	}


	/**
	 * Start Video Lightbox in Global Posts
	 */


	public function get_post_lightbox_embed_params() {
		$settings = $this->get_settings_for_display();

		$params = [];
		$params['autoplay'] = '0';

		if ( 'yes' == $settings['video_autoplay'] ) {
			$params['autoplay'] = '1';
			$params['mute'] = 1;
		}

		if ( $settings['mute'] ) {
			$params['mute'] = 1;
		}

		return $params;
	}

	public function get_post_lightbox_embed_options() {
		$settings = $this->get_settings_for_display();
		$embed_options = [];
		$embed_options['lazy_load'] = ! empty( $settings['lazy_load'] );

		return $embed_options;
	}

	public function render_post_video_lightbox( $video_url, $id ) {
		$settings = $this->get_settings_for_display();

		if ( empty( $video_url ) ) {
			return;
		}

		$embed_params = $this->get_post_lightbox_embed_params();
		$embed_options = $this->get_post_lightbox_embed_options();

		$lightbox_url = Embed::get_embed_url( $video_url, $embed_params, $embed_options );

		if ( $settings['video_open'] !== 'file' ) {

			$lightbox_options = [ 
				'type' => 'video',
				// 'videoType' => $settings['video_type'],
				'url' => $lightbox_url,
				'modalOptions' => [ 
					'id' => 'elementor-lightbox-' . $id,
					'entranceAnimation' => $settings['lightbox_content_animation'],
					'entranceAnimation_tablet' => isset( $settings['lightbox_content_animation_tablet'] ) ? $settings['lightbox_content_animation_tablet'] : '',
					'entranceAnimation_mobile' => isset( $settings['lightbox_content_animation_mobile'] ) ? $settings['lightbox_content_animation_mobile'] : '',
					'videoAspectRatio' => $settings['aspect_ratio'],
				],
			];

			$this->add_render_attribute( 'lightbox-attr-' . $id, [ 
				'data-elementor-open-lightbox' => 'yes',
				'data-elementor-lightbox' => wp_json_encode( $lightbox_options ),
				'e-action-hash' => Plugin::instance()->frontend->create_action_hash( 'lightbox', $lightbox_options ),
			] );
		} else {
			$this->add_render_attribute( 'lightbox-attr-' . $id, [ 
				'href' => $lightbox_url,
			] );
			if ( 'yes' == $settings['file_new_tab'] ) {
				$this->add_render_attribute( 'lightbox-attr-' . $id, [ 
					'target' => '_blank',
				] );
			}
		}

		if ( Plugin::$instance->editor->is_edit_mode() ) {
			$this->add_render_attribute( 'lightbox-attr-' . $id, [ 
				'class' => 'elementor-clickable',
			] );
		}
	}

	protected function render_post_thumb_with_video( $post_id, $image_size = 'full', $add = [] ) {
		$settings = $this->get_settings_for_display();
		$wrapper_class = 'sa-post-img-wrapper';
		$play_class = 'sa-post-play-button sa-post-play-button-style-1 sa-icon-wrap sa-link sa-d-flex sa-justify-content-center sa-align-items-center sa-rounded-circle';

		if ( 'yes' !== $settings['show_image'] ) {
			return;
		}

		if ( isset( $add['wrapper_class'] ) ) {
			/**
			 * If you set any class then if required you must set flex also
			 */
			$wrapper_class .= ' ' . $add['wrapper_class'];
		} else {
			$wrapper_class .= ' sa-d-flex';
		}

		if ( isset( $add['play_class'] ) ) {
			$play_class .= ' ' . $add['play_class'];
		} else {
			$play_class .= ' sa-p-4';
		}

		/**
		 * Video Feature enabled
		 */

		$video_url = get_post_meta( $post_id, 'sky_video_link_meta', true );

		if ( 'yes' == $settings['show_video'] ) :
			$tag = 'div';
			$id = $this->get_id() . '-' . $post_id;

			/**
			 * Lightbox
			 */

			$this->render_post_video_lightbox( $video_url, $id );

			if ( $settings['video_open'] == 'file' ) {
				$tag = 'a';
			}
		endif;
		?>
		<div class="<?php print( esc_attr( $wrapper_class ) ); ?>">
			<?php if ( empty( $video_url ) || 'yes' != $settings['show_video'] ) : ?>
				<!-- Extra - Link added in Image -->
				<a class="sa-w-100 sa-h-100" href="<?php echo esc_url( get_permalink() ); ?>"
					title="<?php echo esc_html( get_the_title() ); ?>">
					<?php
					// $this->render_post_image(get_post_thumbnail_id($post_id), $image_size); 
					$this->render_post_image( [ 
						'image_id' => get_post_thumbnail_id( $post_id ),
						'thumbnail_size' => $image_size,
					] );
					?>
				</a>
			<?php else : ?>
				<?php
				// $this->render_post_image(get_post_thumbnail_id($post_id), $image_size); 
				$this->render_post_image( [ 
					'image_id' => get_post_thumbnail_id( $post_id ),
					'thumbnail_size' => $image_size,
				] );
				?>
			<?php endif; ?>

			<?php
			if ( 'yes' == $settings['show_video'] && ! empty( $video_url ) ) :
				$this->add_render_attribute( 'lightbox-attr-' . $id, [ 
					'class' => $play_class,
				] );
				?>
				<div class="sa-post-play-button-wrapper sa-abs-transform-middle">
					<<?php echo esc_attr( $tag ); ?>
						<?php $this->print_render_attribute_string( 'lightbox-attr-' . $id ); ?>>
						<!-- <i class="fas fa-play"></i> -->
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
							<path
								d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z" />
						</svg>
					</<?php echo esc_attr( $tag ); ?>>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * End Video Lightbox in Global Posts
	 */


	protected function render_post_general_button() {
		$settings = $this->get_settings_for_display();
		$id = $this->get_id();
		$link_attr = $id . get_the_ID();

		if ( 'yes' != $settings['show_button'] ) {
			return;
		}

		$this->add_render_attribute( $link_attr, 'href', esc_url( get_permalink() ) );
		$this->add_render_attribute( $link_attr, 'class', 'sa-general-button sa-button sa-d-inline-block sa-text-decoration-none sa-p-2 sa-px-4 sa-rounded' );

		if ( $settings['button_hover_animation'] ) {
			$this->add_render_attribute( $link_attr, 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
		}

		if ( ! empty( $settings['button_text'] ) ) :
			$this->add_render_attribute( $link_attr, 'class', 'sa-button-icon-' . $settings['button_icon_position'] );
		endif;

		?>
		<a <?php $this->print_render_attribute_string( $link_attr ); ?>>
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
}
