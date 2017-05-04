<?php

namespace BlackLabel\FlightStats\Query;

/**
 * @author George Garchagudashvili <george@worldnet-intl.com>
 */
class FlightTrackByIDTest extends QueryTest
{
    function setUp()
    {
        parent::setUp();
        
        $this->query = new FlightTrackByID($this->client);
    }
        
    function flightsIDDataProvider()
    {
        return [['885827427'], ['885831190']];
    }

    function flightsIDInvalidDataProvider()
    {
        return [['122'], ['0234']];
    }
    
    /**
     * @dataProvider flightsIDDataProvider
     */
    function testFlightTrack(string $flightID)
    {
        $params = [
            'flightID' => $flightID
        ];
        
        $response    = $this->query->invoke($params);
        $data        = json_decode($response->getBody()->getContents(), true);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertFalse(array_key_exists('error', $data)); 
        $this->assertArrayHasKey('flightTrack', $data);
    }
    
    /**
     * @dataProvider flightsIDInvalidDataProvider
     */
    function testFlightTrackWithWrongId(string $flightID)
    {
        $params = [
            'flightID' => $flightID
        ];
        
        $response = $this->query->invoke($params);

        $this->assertEquals(200, $response->getStatusCode());

        $response = json_decode($response->getBody()->getContents(), true);
        
        $this->assertArrayHasKey('error', $response);
    }
}
