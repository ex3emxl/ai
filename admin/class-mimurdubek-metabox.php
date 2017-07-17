<?php

class Mimurdubek_Metabox
{
    public static $meta_fields = [
        'mimurdubek_action'      => 'Action',
        'mimurdubek_url'         => 'URL',
        'mimurdubek_description' => 'Description'
    ];


    function render_actions_metabox ($object)
    {
        require_once plugin_dir_path(__FILE__) . 'partials/mimurdubek-metabox-display.php';
    }

    function add_actions_metabox ()
    {
        add_meta_box(
            "mimurdubek-actions-metabox",
            "Actions fields",
            [$this, 'render_actions_metabox'],
            Mimurdubek_Post_Types::$actions_pt_slug
        );
    }

    function save_actions_metabox ($post_id)
    {
        if (!wp_verify_nonce($_POST['mimurdubek_metabox_nonce'], '-1'))
            return $post_id;

        global $post;
        if ($post->post_type == Mimurdubek_Post_Types::$actions_pt_slug) {
            foreach (self::$meta_fields as $slug => $label):
                if (!empty($_POST[$slug])) {
                    update_post_meta($post_id, '_' . $slug, sanitize_text_field($_POST[$slug]));
                }
            endforeach;
        }
    }
}