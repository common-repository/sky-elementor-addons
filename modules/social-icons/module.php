<?php

namespace Sky_Addons\Modules\SocialIcons;

use Sky_Addons\Base\Module_Base;

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();
    }

    public function get_name() {
        return 'social-icons';
    }

    public function get_widgets() {
        return [
                'Social_Icons',
        ];
    }

}
