<?php

namespace Sky_Addons\Modules\PostList;

use Sky_Addons\Base\Module_Base;

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();
        
    }

    public function get_name() {
        return 'post-list';
    }

    public function get_widgets() {
        return [
                'Post_List',
        ];
    }

}
