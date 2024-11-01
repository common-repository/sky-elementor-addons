<?php
namespace Sky_Addons\Modules\PortionEffect;

use Sky_Addons\Base\Module_Base;

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();

    }

    public function get_name() {
        return 'portion-effect';
    }

    public function get_widgets() {
        return [
                'Portion_Effect',
        ];
    }

}
