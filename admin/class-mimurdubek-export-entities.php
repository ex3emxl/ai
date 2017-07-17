<?php
require_once plugin_dir_path(__FILE__) . 'class-mimurdubek-expanded-client.php';


class Mimurdubek_Base_Export_Entities extends Mimurdubek_Base_Expanded_Client {

    /**
     * @var array
     */
    public $entries = array();
    

    /**
     * Export entities
     * @param $posts array
     *
     * @since 1.0.0
     * @author Mihalyuk Sergii
     */
    public function prepera_enteties($posts) {


        foreach ($posts as $post) {
//            $synonym = preg_replace('/[^\p{L}\p{N}\s]/u', '', $post->post_title);
            $entries[] = [
                "value" => $post->post_name,
                "synonyms" => preg_replace('/[^\p{L}\p{N}\s]/u', '', $post->post_title)
            ];
        }
        
        return $entries;        
    }

    /**
     * Export entities
     * @param $posts array
     *
     * @since 1.0.0
     * @author Mihalyuk Sergii
     */
    public function export_entities($posts) {

        try {
            $token = get_option('api_dev_token');
            $clientapi = new Mimurdubek_Base_Expanded_Client($this->token);
            $query = $clientapi->$put("entities", [
                "name" => "goto2",
                "entries" => $this->prepera_enteties($posts)
            ]);
        } catch (\Exception $error) {
            echo $error->getMessage();
        }
    }

    
}
