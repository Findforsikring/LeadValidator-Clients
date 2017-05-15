<?php
/**
 * Created by PhpStorm.
 * User: Morten
 * Date: 15-05-2017
 * Time: 13:05
 */

namespace LeadValidator;

use DateTime;


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

    /**
     * Get leads that are not delivered
     * @param null $campaign_id
     * @param null $source_id
     * @param string $paginate
     * @param int $page
     * @param int $items_per_page
     * @return array|null
     */
    public function getNewLeads($campaign_id = null, $source_id = null, $paginate = 'no', $page = 1, $items_per_page = 15)
    {
        $params = compact('campaign_id', 'source_id', 'paginate', 'page', 'items_per_page');
        $params['api_token'] = $this->api_token;
        $url = $this->baseUrl . "/new?" . http_build_query($params);
        return $this->callApi($url, 'GET');
    }

    /**
     * Get leads in a time period
     * @param DateTime|null $created_after
     * @param DateTime|null $created_before
     * @param DateTime|null $delivered_after
     * @param DateTime|null $delivered_before
     * @param string $type
     * @param null $campaign_id
     * @param null $source_id
     * @param string $paginate
     * @param int $page
     * @param int $items_per_page
     * @return array|null
     */
    public function getLeadsFromPeriod(DateTime $created_after = null, DateTime $created_before = null, DateTime $delivered_after = null, DateTime $delivered_before = null, $type = 'all', $campaign_id = null, $source_id = null, $paginate = 'no', $page = 1, $items_per_page = 15)
    {
        $params = compact('campaign_id', 'source_id', 'paginate', 'page', 'items_per_page', 'type');
        if (!is_null($created_after)){
            $params['created_after'] = $created_after->format("Y-m-d H:i:s");
        }
        if (!is_null($created_before)){
            $params['created_before'] = $created_before->format("Y-m-d H:i:s");
        }
        if (!is_null($delivered_after)){
            $params['delivered_after'] = $delivered_after->format("Y-m-d H:i:s");
        }
        if (!is_null($delivered_before)){
            $params['delivered_before'] = $delivered_before->format("Y-m-d H:i:s");
        }
        $params['api_token'] = $this->api_token;
        $url = $this->baseUrl . "/period?" . http_build_query($params);
        return $this->callApi($url, 'GET');
    }
}