<?php

namespace Sky_Addons\Modules\TableOfContents;

use Sky_Addons\Base\Module_Base;

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();
        
    }

    public function get_name() {
        return 'table-of-contents';
    }

    public function get_widgets() {
        return [
                'Table_Of_Contents',
        ];
    }

}
