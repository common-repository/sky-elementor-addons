<?php

namespace Sky_Addons\Modules\SlinkyMenu;

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class Menu_Walker extends \Walker_Nav_Menu {

    public function start_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '<ul>';
    }

    public function end_lvl(&$output, $depth = 0, $args = array()) {
        $output .= '</ul>';
    }

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $object = $item->object;
        $type = $item->type;
        $title = $item->title;
        $description = $item->description;
        $permalink = $item->url;

        $output .= "<li class='" .  implode(" ", $item->classes) . "'>";

        //Add SPAN if no Permalink
        if ($permalink && $permalink != '#') {
            $output .= '<a href="' . $permalink . '">';
        } else {
            $output .= '<span>';
        }

        $output .= $title;

        // if ($args->walker->has_children) {
        //     $output .= '<i class="caret fa fa-angle-right"></i>';
        // }

        if ($permalink && $permalink != '#') {
            $output .= '</a>';
        } else {
            $output .= '</span>';
        }
    }
    public function end_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $output .= '</li>';
    }

    public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output) {
        // attach to element so that it's available in start_el()
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);
        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}
