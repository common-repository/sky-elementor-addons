<?php

namespace Sky_Addons;

/**
 * Custom Meta Box class
 * Source - https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/
 */
class Custom_Meta_Box {

	function __construct() {
		add_action( 'add_meta_boxes', [ $this, 'add_meta_box' ] );
		add_action( 'save_post', [ $this, 'save_meta_data' ] );
	}

	/**
	 * Set up and add the meta box.
	 */
	public function add_meta_box() {
		$screens = [ 'post', 'wporg_cpt', 'side', 'default' ];
		foreach ( $screens as $screen ) {
			add_meta_box(
				// 'wporg_box_id',          // Unique ID
				'sky_addons_video_link_meta_box_id',          // Unique ID
				esc_html__( 'Video Link', 'sky-elementor-addons' ), // Box title
				[ $this, 'meta_render_html' ],   // Content callback, must be of type callable
				$screen                  // Post type
			);
		}
	}


	/**
	 * Save the meta box selections.
	 *
	 * @param int $post_id  The post ID.
	 */
	public function save_meta_data( int $post_id ) {
		if ( array_key_exists( 'sky_video_link_meta', $_POST ) ) {

			if ( ! wp_verify_nonce( $_POST['sa-video-link-meta'], 'sky_video_link_nonce_action' ) ) {
				wp_die( 'Are you cheating?' );
			}

			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return false;
			}

			update_post_meta(
				$post_id,
				'sky_video_link_meta',
				sanitize_text_field( $_POST['sky_video_link_meta'] )
			);
		}
	}


	/**
	 * Display the meta box HTML to the user.
	 *
	 * @param \WP_Post $post   Post object.
	 */
	public function meta_render_html( $post ) {
		wp_nonce_field( 'sky_video_link_nonce_action', 'sa-video-link-meta' );
		$get_meta = get_post_meta( $post->ID, 'sky_video_link_meta', true );
		$value = ! empty( $get_meta ) ? $get_meta : '';
		?>
		<label for="sky_video_link_meta">
			<?php esc_html_e( 'Sky Addons Video Link', 'sky-elementor-addons' ); ?>
		</label>
		<input type="text" name="sky_video_link_meta" id="sky_video_link_meta" class="widefat"
			value="<?php echo wp_kses_post( $value ); ?>">
		<?php
	}

	public static function init() {
		static $instance = false;

		if ( ! $instance ) {
			$instance = new self();
		}

		return $instance;
	}
}




function sky_addons_meta_box() {
	return Custom_Meta_Box::init();
}

// kick-off the class
sky_addons_meta_box();
