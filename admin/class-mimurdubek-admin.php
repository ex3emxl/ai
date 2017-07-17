<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       www.zfort.com.ua
 * @since      1.0.0
 *
 * @package    Mimurdubek
 * @subpackage Mimurdubek/admin
 */
class Mimurdubek_Admin extends Mimurdubek_Base
{

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles ()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Mimurdubek_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Mimurdubek_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/mimurdubek-admin.css', [], $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts ()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Mimurdubek_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Mimurdubek_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/mimurdubek-admin.js', ['jquery'], $this->version, false);

    }

    public function add_menu_pages ()
    {
        //TODO Need refactor
        add_menu_page(ucfirst($this->plugin_name), ucfirst($this->plugin_name), 'manage_options', $this->plugin_name . '-options', [$this, 'display_admin'], 'dashicons-microphone', 80);
        add_submenu_page($this->plugin_name . '-options', 'Actions', 'Actions', 'manage_options', $this->plugin_name . '-pt-options', [$this, 'display_pt_admin']);
    }

    public function display_admin ()
    {
        //Template parts is located at admin/partials
        require_once plugin_dir_path(__FILE__) . 'partials/mimurdubek-admin-display.php';
    }

    public function display_pt_admin ()
    {
        if (!empty($_POST[$this->plugin_name . '-pt'])) {
            $pt_query = $this->get_items_by_type($_POST[$this->plugin_name . '-pt']);
            if ($pt_query->have_posts()) {
                $exporter = new Mimurdubek_Base_Export_Entities(get_option('api_dev_token'));
                $exporter->export_entities($pt_query->get_posts());
            }

        }
        require_once plugin_dir_path(__FILE__) . 'partials/mimurdubek-admin-pt-display.php';
    }

    public function register_options ()
    {
        register_setting('mimurdubek_settings', 'api_client_token');
        register_setting('mimurdubek_settings', 'api_dev_token');
    }

    private function get_existing_post_types ()
    {
        $args = [];

        $excludedPostTypes = ['attachment', 'revision', 'nav_menu_item'];
        $postTypes = get_post_types($args);

        return array_diff($postTypes, $excludedPostTypes);
    }

    private function get_items_by_type ($type)
    {
        $args = [
            'post_type'      => $type,
            'posts_per_page' => '-1'
        ];

        return new WP_Query($args);
    }
}
