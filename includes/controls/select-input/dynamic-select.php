<?php

namespace Sky_Addons\Includes\Controls\SelectInput;

use Elementor\Base_Data_Control;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Dynamic Select.
 *
 * A base control for creating Dynamic_Select control. 
 * Displays a select box control based on select on elementor select2 control
 * It accepts an array in which the `key` is the value and the `value` is the
 * option name. Set `multiple` to `true` to allow multiple value selection.
 *
 * @since 1.1.0
 */
class Dynamic_Select extends Base_Data_Control {

	const TYPE = 'sky-dynamic-select';

	/**
	 * Get the type of Control
	 *
	 * Retrieve the type of Control.
	 * @since 1.1.0
	 * @access public
	 */
	public function get_type() {
		return self::TYPE;
	}

	/**
	 * Get Select2 Control default settings.
	 *
	 * Retrieve the default settings of the select2 control.
	 * Used to return the default settings while initializing the select2 control.
	 *
	 * @return array Control default settings.
	 * @since 1.1.0
	 * @access protected
	 *
	 */
	protected function get_default_settings() {
		return [ 
			'options' => [],
			'multiple' => false,
			/**
			 * Select2 library options
			 */
			'select2options' => [],
			/**
			 * The lockedOptions array can be passed option keys. 
			 * The passed option keys will be non-delete able
			 */
			'lockedOptions' => [],
			/**
			 * The query arguments can be passed array,
			 */
			'query_args' => array(),

		];
	}

	/**
	 * Render Select2 control
	 *
	 * object.
	 * @since 1.1.0
	 * @access public
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">
			<# if ( data.label ) {#>
				<label for="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-title">{{{data.label }}}</label>
				<# } #>
					<div class="elementor-control-input-wrapper elementor-control-unit-5">
						<# var multiple=( data.multiple ) ? 'multiple' : '' ; #>
							<select id="<?php echo esc_attr( $control_uid ); ?>" class="elementor-select2" type="select2" {{
								multiple }} data-setting="{{ data.name }}">
								<# _.each( data.options, function( option_title, option_value ) { var value=data.controlValue;
									if ( typeof value=='string' ) { var selected=( option_value===value ) ? 'selected' : '' ; }
									else if ( null !==value ) { var value=_.values( value ); var selected=( -1 !==value.indexOf(
									option_value ) ) ? 'selected' : '' ; } #>
									<option {{ selected }} value="{{ option_value }}">{{{option_title }}}</option>
									<# } ); #>
							</select>
					</div>
		</div>
		<# if ( data.description ) { #>
			<div class="elementor-control-field-description">{{{data.description }}}</div>
			<# } #>
				<?php
	}

	/**
	 * Enqueue Scripts & Styles.
	 *
	 * Used to register and enqueue Custom Scripts and Styles
	 * @since 1.1.0
	 */
	public function enqueue() {
		wp_enqueue_script( 'sky-dynamic-select', SKY_ADDONS_URL . 'includes/controls/assets/js/sky-dynamic-select.min.js', [ 'jquery' ], SKY_ADDONS_VERSION );

		wp_localize_script(
			'sky-dynamic-select',
			'sky_dynamic_select',
			[ 
				'nonce' => wp_create_nonce( 'sky_dynamic_select' ),
				'action' => 'sky_addons_dynamic_select_input_data',
				'ajax_url' => admin_url( 'admin-ajax.php' )
			]
		);
	}
}

add_action( 'elementor/controls/register', function () {
	$controls_manager = Plugin::$instance->controls_manager;
	$controls_manager->register( new Dynamic_Select() );
} );
