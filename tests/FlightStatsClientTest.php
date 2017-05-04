<?php

namespace BlackLabel\FlightStats;

use GuzzleHttp\Client;

use BlackLabel\FlightStats\Exception\IncompleteClientConfigException;

class FlightStatsClientTest extends FlightStatsTest
{
    public function incompleteConfigProvider()
    {
        $appId = $_ENV['APP_ID'];
        $appKey = $_ENV['APP_KEY'];

        return [
            [ [] ],
            [ ['appId' => $appId] ],
            [ ['appKey' => $appKey] ],
            [ ['app_key' => $appKey, 'app_id' => $appId] ]
        ];
    }

    public function completeConfigProvider()
    {
        $appId = $_ENV['APP_ID'];
        $appKey = $_ENV['APP_KEY'];

        return [
            [ ['appId' => $appId,'appKey' => $appKey] ],
            [ ['appId' => $appId,'appKey' => $appKey,'extraKey' => 'EXTRA_KEY'] ],
        ];
    }

    /**
     * @dataProvider incompleteConfigProvider
     */
    public function testConstructWithInCompleteConfig(array $config)
    {
        $this->expectException(IncompleteClientConfigException::class);

        $httpClient = new Client();

        $client = new FlightStatsClient($httpClient,$this->apiUrl,$config);
    }
    
    /**
     * @dataProvider completeConfigProvider
     * @depends testConstructWithInCompleteConfig
     */
    public function testConstructWithCompleteConfig(array $config)
    {   
        $httpClient = new Client();
        
        $client = new FlightStatsClient($httpClient,$this->apiUrl,$config);
        
        $this->assertNotNull($client);
    }
}
