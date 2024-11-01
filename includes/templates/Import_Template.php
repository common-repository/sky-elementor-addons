<?php


namespace Sky_Addons\Templates;

use Sky_Addons\Templates\Library_Api;
use Elementor\Core\Common\Modules\Ajax\Module as Ajax;
use Elementor\Plugin;

if (!defined('ABSPATH')) {
    exit;
}

class Import_Template {

    private static $instance = null;

    protected static $template = null;

    public function load() {
        add_action('elementor/ajax/register_actions', array($this, 'ajax_actions'));
    }

    public function ajax_actions(Ajax $ajax) {
        $ajax->register_ajax_action('get_sky_templates_data', function ($data) {

            if (!current_user_can('edit_posts')) {
                throw new \Exception('Access Denied');
            }

            if (!empty($data['editor_post_id'])) {
                $editor_post_id = absint($data['editor_post_id']);

                if (!get_post($editor_post_id)) {
                    throw new \Exception(esc_html__('Sorry, the Post was not found.', 'sky-elementor-addons'));
                }
                Plugin::$instance->db->switch_to_post($editor_post_id);
            }

            if (empty($data['template_id'])) {
                throw new \Exception(esc_html__('Sorry, the Template id missing.', 'sky-elementor-addons'));
            }
            if (empty($data['json_url'])) {
                throw new \Exception(esc_html__('Sorry, the JSON data missing.', 'sky-elementor-addons'));
            }
            return self::get_template_data($data);
        });
    }

    public static function get_template_data(array $args) {
        $template = self::template_library();
        return $template->get_data($args);
    }

    public static function template_library() {
        if (is_null(self::$template)) {
            self::$template = new Library_Api();
        }
        return self::$template;
    }

    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}
