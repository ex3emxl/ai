<?php 

require_once plugin_dir_path(__FILE__) . 'api-ai-php-master/vendor/autoload.php';

use Api\Client;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of class-mimurdubek-clients-method
 *
 * @author mihalyuk
 */
class Mimurdubek_Base_Expanded_Client extends Client{
    
    /**
     * @var array
     */
    public static $allowedMethod = ['GET', 'POST', 'PUT'];
    
    /**
     * @var string Api token
     */
    protected $token;
    
    /**
     * Client constructor.
     *
     * @param string $accessToken
     * @param HttpClient|null $httpClient
     * @param string $apiLanguage
     * @param string $apiVersion
     */
    public function __construct($token)
    {
        
        $this->token = $token;
        parent::__construct($token);
    }
    
    /**
     * @param string $uri
     * @param array $params
     *
     * @return ResponseInterface
     */
    public function put($uri, array $params = [])
    {
        return $this->send('PUT', $uri, $params);
    }
    
    
    /**
     * @param string $method
     * @param string $uri
     * @param mixed $body
     * @param array $query
     * @param array $headers
     * @param array $options
     *
     * @return ResponseInterface
     */
    public function send($method, $uri, $body = null, array $query = [], array $headers = [], array $options = [])
    {

        $query = array_merge($this->getDefaultQuery(), $query);
        $headers = array_merge($this->getDefaultHeaders(), $headers);
        
        $client = $this->getHttpClient();

        $this->lastResponse = $client->send($method, $uri, $body, $query, $headers, $options);
        
       // var_dump($this->lastResponse);die();

        $this->validateResponse($this->lastResponse);

        return $this->lastResponse;
    }
    
    
    /**
     * @param ResponseInterface $response
     * @throws BadResponseException
     */
    private function validateResponse(ResponseInterface $response)
    {
        if ($response->getStatusCode() !== 200) {
            $message = empty($response->getReasonPhrase()) ? 'Bad response status code' : $response->getReasonPhrase();
            throw new BadResponseException($message, $response);
        }
    }
    
    
    /**
     * Get the defaults query
     *
     * @return array
     */
    private function getDefaultQuery()
    {
        return [
            'v' => $this->apiVersion,
            'lang' => $this->apiLanguage,
        ];
    }
    
        /**
     * Get the defaults headers
     *
     * @return array
     */
    private function getDefaultHeaders()
    {
        return [
            'Content-Type' => 'application/json; charset=utf-8',
            'Authorization' => 'Bearer ' . $this->token,
            'api-request-source' => self::DEFAULT_API_SOURCE,
        ];
    }

}
