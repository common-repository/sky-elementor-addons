<?php

namespace Sky_Addons\Modules\TidyList;

use Sky_Addons\Base\Module_Base;

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();

    }

    public function get_name() {
        return 'tidy-list';
    }

    public function get_widgets() {
        return [
                'Tidy_List',
        ];
    }

}
