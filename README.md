#LeadValidator Clients
## Installation
```
$ composer require findforsikring/leadvalidator-clients
```

## Lead source usage
```php
$client = new \LeadValidator\SourceClient("api token");

// List available campaigns
$campaigns = $client->getCampaigns();

// Detailed campaign info
$campaign = $client->getCampaign(12);

/* 
 * Post a lead
 * 1st parameter is campaign ID.
 * 2nd parameter must use keys defined in the campaign
 */
$success = $client->postLead(12, [
    'name' => 'Lead name',
    'phone' => '12345678',
    'email' => 'test@test.com'
]);
```

## Lead customer usage
```php
$client = new \LeadValidator\CustomerClient("api token");

/* 
 * Get all new leads (not delivered yet)
 * Optionally limit by campaign or source
 * Optional pagination
 */
$leads = $client->getNewLeads();

/* 
 * Get all leads from a period
 * Limit by creation-time or delivery-time
 * Optionally limit by campaign or source
 * Optional pagination
 */
$leads = $client->getLeadsFromPeriod();

```