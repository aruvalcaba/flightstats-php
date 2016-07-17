<?php

namespace BlackLabel\FlightStats\Query;

class FetchDepartingFlightsWithDateTest extends QueryTest
{
    public function testFetchDepartingFlightsWithValidDate()
    {
        $query = new FetchDepartingFlightsWithDate($this->client);

        $departureAirportCode = 'ORD';
        $arrivalAirportCode = 'LGA';

        $tomorrow = $this->carbon->tomorrow();

        $year = $tomorrow->year;
        $month = $tomorrow->month;
        $day = $tomorrow->day;

        $params = [
            'departureAirportCode' => $departureAirportCode,
            'arrivalAirportCode' => $arrivalAirportCode,
            'year' => $year,
            'month' => $month,
            'day' => $day
        ];
        
        $response = $query->invoke($params);

        $this->assertEquals(200,$response->getStatusCode());

        $response = json_decode($response->getBody()->getContents(),true);
        
        $this->assertFalse(array_key_exists('error',$response));       
        $this->assertArrayHasKey('scheduledFlights',$response);

        $scheduledFlights = $response['scheduledFlights'];

        $this->assertGreaterThan(0,count($scheduledFlights));
    }
    
    /**
     * @depends testFetchDepartingFlightsWithValidDate
     */
    public function testFetchDepartingFlightsWithValidInvalidDate()
    {
        $query = new FetchDepartingFlightsWithDate($this->client);

        $departureAirportCode = 'ORD';
        $arrivalAirportCode = 'LGA';

        $lastWeek = $this->carbon->subMonth(2);

        $year = $lastWeek->year;
        $month = $lastWeek->month;
        $day = $lastWeek->day;

        $params = [
            'departureAirportCode' => $departureAirportCode,
            'arrivalAirportCode' => $arrivalAirportCode,
            'year' => $year,
            'month' => $month,
            'day' => $day
        ];
        
        $response = $query->invoke($params);

        $this->assertEquals(200,$response->getStatusCode());

        $response = json_decode($response->getBody()->getContents(),true);
        
        $this->assertArrayHasKey('error',$response);
    }    
}
