<?php

namespace Sky_Addons\Includes;

use Sky_Addons\Admin\Sky_Addons_Admin;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class Pro_Widget_Map {

    public function get_pro_widget_map() {

        $widgets_fields = Sky_Addons_Admin::get_element_list();

        $core_widgets        = $widgets_fields['sky_addons_widgets'];

        $arr = [];

        foreach ($core_widgets as $key => $widget) {
            if ('pro' === $widget['widget_type']) {
                $ar = [
                    'categories'    => ['sky-elementor-addons-pro'],
                    'name'          => $widget['name'],
                    'title'         => $widget['label'],
                    'icon'          => 'sky-icon-' . $widget['name'] . ' sa-pro-widget-unlock-icon',
                    'action_button' => [
                        'classes' => ['elementor-button', 'elementor-button-success'],
                        'text'    => esc_html__('See it in Action', 'sky-elementor-addons'),
                        'url'     => esc_url($widget['demo_url'])
                    ]
                ];
                array_push($arr, $ar);
            }
        }
        return $arr;
    }
}
