<?php

namespace Sky_Addons\Modules\SaplingGrid;

use Sky_Addons\Base\Module_Base;

class Module extends Module_Base
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_name()
    {
        return 'sapling-grid';
    }

    public function get_widgets()
    {
        return [
            'Sapling_Grid',
        ];
    }
}
