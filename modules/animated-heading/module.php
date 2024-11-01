<?php

namespace Sky_Addons\Modules\AnimatedHeading;

use Sky_Addons\Base\Module_Base;

class Module extends Module_Base {

	public function __construct() {
		parent::__construct();

	}

	public function get_name() {
		return 'animated-heading';
	}

	public function get_widgets() {
		return [ 
			'Animated_Heading',
		];
	}

}