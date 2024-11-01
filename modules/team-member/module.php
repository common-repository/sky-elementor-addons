<?php
namespace Sky_Addons\Modules\TeamMember;
use Sky_Addons\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

    public function __construct() {
        parent::__construct();
    }

    public function get_name() {
        return 'team-member';
    }

    public function get_widgets() {
        return [
                'Team_Member',
        ];
    }

}
