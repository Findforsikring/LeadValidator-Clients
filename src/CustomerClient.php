<?php
/**
 * Created by PhpStorm.
 * User: Morten
 * Date: 15-05-2017
 * Time: 13:05
 */

namespace LeadValidator;


/**
 * Class CustomerClient
 * @package LeadValidator
 */
class CustomerClient extends BaseClient
{
    /**
     * @var string
     */
    protected $baseUrl = 'https://leadvalidator.dk/api/out/v1';

    /**
     * CustomerClient constructor.
     * @param $api_token
     */
    public function __construct($api_token)
    {
        parent::__construct($api_token);
    }

    /**
     * Get a single lead by id.
     * @param $id
     * @return array|null
     */
    public function getLead($id)
    {
        return $this->callApi('/single/' . $id, 'GET');
    }
}