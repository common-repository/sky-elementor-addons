<?php

namespace Sky_Addons\Modules\ReadingProgress;

use Sky_Addons\Base\Module_Base;

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();
    }

    public function get_name() {
        return 'reading-progress';
    }

    public function get_widgets() {
        return [
                'Reading_Progress',
        ];
    }

}
