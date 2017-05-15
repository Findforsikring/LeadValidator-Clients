<?php
/**
 * Created by PhpStorm.
 * User: Morten
 * Date: 15-05-2017
 * Time: 13:06
 */

namespace LeadValidator;

abstract class BaseClient
{
    protected $api_token;
    protected $baseUrl = '';

    /**
     * BaseClient constructor.
     * @param $api_token
     */
    public function __construct($api_token)
    {
        $this->api_token = $api_token;
    }

    protected function callApi($endpoint, $method, $params = [])
    {
        if (!preg_match('/^' . preg_replace('/\//', '\/\/', $this->baseUrl) . '/', $endpoint)) {
            $endpoint = $this->baseUrl . $endpoint;
        }
        if (!preg_match('/\?api_token=.*$/', $endpoint)){
            $endpoint .= "?api_token=" . $this->api_token;
        }
        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => $method,
                'content' => http_build_query($params)
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents($endpoint, false, $context);
        if ($response === false) {
            return null;
        }
        return json_decode($response, true);
    }
}