<?php

namespace BlackLabel\FlightStats\Query;

use GuzzleHttp\Client;

use BlackLabel\FlightStats\FlightStatsTest;

use BlackLabel\FlightStats\FlightStatsClient;

class QueryTest extends FlightStatsTest
{
    protected $client;

    public function setUp()
    {
        parent::setUp();

        $httpClient = new Client();

        $config = [ 'appId' => $this->appId, 'appKey' => $this->appKey ];

        $this->client = new FlightStatsClient($httpClient,$this->apiUrl,$config);
    }
}
