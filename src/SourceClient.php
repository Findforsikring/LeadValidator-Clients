<?php

namespace LeadValidator;

class SourceClient extends BaseClient
{
    protected $baseUrl = 'https://leadvalidator.dk/api/in/v1';

    /**
     * Client constructor.
     * @param $api_token
     */
    public function __construct($api_token)
    {
        parent::__construct($api_token);
    }

    public function getCampaigns()
    {
        return $this->callApi('', 'GET');
    }

    public function getCampaign($id)
    {
        return $this->callApi('/' . $id, 'GET');
    }

    public function postLead($campaign_id, array $data)
    {
        return $this->callApi('', 'POST', [
            'campaign_id' => $campaign_id,
            'leaddata'    => $data
        ]);
    }
}