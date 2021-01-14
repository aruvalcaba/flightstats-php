<?php

namespace BlackLabel\FlightStats\Query;

/**
 * @author George Garchagudashvili <george@worldnet-intl.com>
 */
class FlightTracksByArrivingDateTest extends QueryTest
{
    function setUp()
    {
        parent::setUp();
        
        $this->query = new FlightTracksByArrivingDate($this->client);
    }
    
    function dataProvider()
    {
        return [
            ['AA', '100', (new \DateTime)->format('Y-m-d')],
        ];
    }
    
    /**
     * @dataProvider dataProvider 
     */
    function testFlightTracksByArrivingDate(string $carrier, string $flight, string $date)
    {
        $date = $this->carbon->createFromFormat('Y-m-d', $date);

        $year   = $date->year;
        $month  = $date->month;
        $day    = $date->day;
        $airport = 'jfk';
        $hourOfDay = 2;
        $numHours = 24;
        $includeFlightPlan = 'true';
        $maxPositions = 2;
        
        $params = compact([
            'carrier','flight','year','month',
            'day','airport','hourOfDay','numHours',
            'includeFlightPlan','maxPositions'
        ]);
        
        $response = $this->query->invoke($params);
        $data = json_decode($response->getBody()->getContents(), true);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertFalse(array_key_exists('error', $data));       
        $this->assertArrayHasKey('flightTracks', $data);
    }
    
    /**
     * @dataProvider dataProvider 
     */
    function testFlightTracksByTooOldArrivingDate(string $carrier, string $flight, string $date)
    {
        $date = $this->carbon->createFromFormat('Y-m-d', $date);

        $year   = $date->year - 1;
        $month  = $date->month;
        $day    = $date->day;
        
        $params = compact(['carrier','flight','year','month','day']);
        
        $response = $this->query->invoke($params);
        $data = json_decode($response->getBody()->getContents(), true);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertTrue(array_key_exists('error', $data));       
    }
}
