<?php

namespace Sky_Addons\Modules\UltraGrid;

use Sky_Addons\Base\Module_Base;

class Module extends Module_Base
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_name()
    {
        return 'ultra-grid';
    }

    public function get_widgets()
    {
        return [
            'Ultra_Grid',
        ];
    }
}
