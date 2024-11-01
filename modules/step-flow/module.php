<?php

namespace Sky_Addons\Modules\StepFlow;

use Sky_Addons\Base\Module_Base;

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();

    }

    public function get_name() {
        return 'step-flow';
    }

    public function get_widgets() {
        return [
                'Step_Flow',
        ];
    }

}
