<?php

class Mimurdubek_Post_Types extends Mimurdubek_Base
{
    public static $actions_pt_slug = 'mimurdubek_actions';


    public function register_actions_post_type ()
    {
        register_post_type(self::$actions_pt_slug, $this->get_actions_post_type_options());
    }

    private function get_actions_post_type_options ()
    {
        //TODO Add hook/filter for changing behavior of options
        $labels = [
            'name'               => _x('Actions', 'post type general name', 'mimurdubek'),
            'singular_name'      => _x('Action', 'post type singular name', 'mimurdubek'),
            'menu_name'          => _x('Actions', 'admin menu', 'mimurdubek'),
            'name_admin_bar'     => _x('Action', 'add new on admin bar', 'mimurdubek'),
            'add_new'            => _x('Add New', 'Action', 'mimurdubek'),
            'add_new_item'       => __('Add New Action', 'mimurdubek'),
            'new_item'           => __('New Action', 'mimurdubek'),
            'edit_item'          => __('Edit Action', 'mimurdubek'),
            'view_item'          => __('View Action', 'mimurdubek'),
            'all_items'          => __('All Actions', 'mimurdubek'),
            'search_items'       => __('Search Actions', 'mimurdubek'),
            'parent_item_colon'  => __('Parent Actions:', 'mimurdubek'),
            'not_found'          => __('No Actions found.', 'mimurdubek'),
            'not_found_in_trash' => __('No Actions found in Trash.', 'mimurdubek')
        ];

        return [
            'labels'             => $labels,
            'description'        => __('Description.', 'mimurdubek'),
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => 'edit.php?post_type=mimurdubek_actions',
            //'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => ['slug' => self::$actions_pt_slug],
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_position'      => 85,
            'supports'           => ['title']
        ];

    }
}
