<?php

namespace Sky_Addons\Modules\AdvancedSkillBars;

use Sky_Addons\Base\Module_Base;

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();

    }

    public function get_name() {
        return 'advanced-skill-bars';
    }

    public function get_widgets() {
        return [
                'Advanced_Skill_Bars',
        ];
    }

}
