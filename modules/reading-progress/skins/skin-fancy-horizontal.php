<?php

namespace Sky_Addons\Modules\ReadingProgress\Skins;

use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Skin_Base as Elementor_Skin_Base;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

class Skin_Fancy_Horizontal extends Elementor_Skin_Base
{

    public function get_id()
    {
        return 'sky-skin-fancy-horizontal';
    }

    public function get_title()
    {
        return esc_html__('Fancy Horizontal', 'sky-elementor-addons');
    }

    protected function _register_controls_actions()
    {
        parent::_register_controls_actions();
    }

    public function render()
    {
        $settings = $this->parent->get_settings_for_display();
?>
        <div class="sa-reading-progress sa-skin-fancy-horizontal">
            <span></span>
        </div>
<?php
    }
}
