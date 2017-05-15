<?php
/**
 * Created by PhpStorm.
 * User: Morten
 * Date: 15-05-2017
 * Time: 13:06
 */

namespace LeadValidator;

/**
 * Class BaseClient
 * @package LeadValidator
 */
abstract class BaseClient
{
    /**
     * @var string
     */
    protected $api_token;
    /**
     * @var string
     */
    protected $baseUrl = '';

    /**
     * BaseClient constructor.
     * @param $api_token
     */
    public function __construct($api_token)
    {
        $this->api_token = $api_token;
    }

    /**
     * @param $endpoint
     * @param $method
     * @param array $params
     * @return array|null
     */
    protected function callApi($endpoint, $method, $params = [])
    {
        if (!preg_match('/^' . preg_replace('/\//', '\/\/', $this->baseUrl) . '/', $endpoint)) {
            $endpoint = $this->baseUrl . $endpoint;
        }
        if (!preg_match('/api_token=.*/', $endpoint)){
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