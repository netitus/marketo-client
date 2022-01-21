<?php

namespace EventFarm\Marketo;

use EventFarm\Marketo\API;
use EventFarm\Marketo\Client\MarketoClient;
use EventFarm\Marketo\Client\MarketoClientInterface;

class Marketo
{
    private MarketoClientInterface $client;

    public function __construct(MarketoClientInterface $client)
    {
        $this->client = $client;
    }

    public static function withDefaultClient(string $clientId, string $clientSecret, string $baseUrl): Marketo
    {
        $client = MarketoClient::withDefaults($clientId, $clientSecret, $baseUrl);
        return new static($client);
    }

    public function programs()
    {
        return new API\Programs($this->client);
    }

    public function campaigns()
    {
        return new API\Campaigns($this->client);
    }

    public function leadFields()
    {
        return new API\LeadFields($this->client);
    }

    public function statuses()
    {
        return new API\Statuses($this->client);
    }

    public function leads()
    {
        return new API\Leads($this->client);
    }

    public function partitions()
    {
        return new API\Partitions($this->client);
    }
}