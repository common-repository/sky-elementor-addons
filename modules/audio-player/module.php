<?php

namespace Sky_Addons\Modules\AudioPlayer;

use Sky_Addons\Base\Module_Base;

class Module extends Module_Base {

	public function __construct() {
		parent::__construct();

	}

	public function get_name() {
		return 'audio-player';
	}

	public function get_widgets() {
		return [ 
			'Audio_Player',
		];
	}

}
