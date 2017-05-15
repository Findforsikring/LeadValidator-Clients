<?php
/**
 * Created by PhpStorm.
 * User: Morten
 * Date: 15-05-2017
 * Time: 13:05
 */

namespace LeadValidator;


class CustomerClient extends BaseClient
{
    protected $baseUrl = 'https://leadvalidator.dk/api/out/v1';

    /**
     * CustomerClient constructor.
     * @param $api_token
     */
    public function __construct($api_token)
    {
        parent::__construct($api_token);
    }

    public function getLead($id)
    {
        return $this->callApi('/single/' . $id, 'GET');
    }
}