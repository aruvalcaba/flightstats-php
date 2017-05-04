<?php

namespace BlackLabel\FlightStats\Query;

use Carbon\Carbon;

use GuzzleHttp\Client;

use BlackLabel\FlightStats\FlightStatsTest;

use BlackLabel\FlightStats\FlightStatsClient;

abstract class QueryTest extends FlightStatsTest
{
    protected $client;
    
    /**
     * @var Carbon
     */
    protected $carbon;

    protected $query;
    
    public function setUp()
    {
        parent::setUp();

        $httpClient = new Client();
    
        $config = [ 'appId' => $this->appId, 'appKey' => $this->appKey ];

        $this->client = new FlightStatsClient($httpClient,$this->apiUrl,$config);

        $this->carbon = new Carbon();
    }
}
