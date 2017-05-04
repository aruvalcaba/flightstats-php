<?php

namespace BlackLabel\FlightStats\Query;

/**
 * @author George Garchagudashvili <george@worldnet-intl.com>
 */
class FlightStatusByArrivingDateTest extends QueryTest
{
    function setUp()
    {
        parent::setUp();
        
        $this->query = new FlightStatusByArrivingDate($this->client);
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
    function testFlightStatusByArrivingDate(string $carrier, string $flight, string $date)
    {
        $date = $this->carbon->createFromFormat('Y-m-d', $date);

        $year   = $date->year;
        $month  = $date->month;
        $day    = $date->day;
        $airport = 'jfk';
        
        $params = compact(['carrier','flight','year','month','day', 'airport']);
        
        $response = $this->query->invoke($params);
        $data = json_decode($response->getBody()->getContents(), true);
        
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertFalse(array_key_exists('error', $data));       
        $this->assertArrayHasKey('flightStatuses', $data);
    }
    
    /**
     * @dataProvider dataProvider 
     */
    function testFlightStatusByTooOldArrivingDate(string $carrier, string $flight, string $date)
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
