<?php

namespace Sky_Addons\Modules\ContentSwitcher;

use Sky_Addons\Base\Module_Base;

class Module extends Module_Base
{

    public function __construct()
    {
        parent::__construct();

    }

    public function get_name()
    {
        return 'content-switcher';
    }

    public function get_widgets()
    {
        return [
            'Content_Switcher',
        ];
    }
    
}
