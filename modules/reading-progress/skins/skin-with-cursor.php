<?php

namespace Sky_Addons\Modules\ReadingProgress\Skins;

use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Skin_Base as Elementor_Skin_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Skin_With_Cursor extends Elementor_Skin_Base
{

    public function get_id()
    {
        return 'sky-skin-with-cursor';
    }

    public function get_title()
    {
        return esc_html__('With Cursor', 'sky-elementor-addons');
    }

    protected function _register_controls_actions()
    {
        parent::_register_controls_actions();
    }

    public function render()
    {
        $settings = $this->parent->get_settings_for_display();
?>
        <div class="sa-reading-progress sa-skin-with-cursor"></div>
        <div class='sa-progress-with-cursor-2'>
            <div class="sa-progress-wrap">
                <svg class="sa-progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                    <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
                </svg>
            </div>
        </div>
        <div class='sa-progress-with-cursor-3'></div>
<?php
    }
}
