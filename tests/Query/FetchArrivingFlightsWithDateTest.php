<?php

namespace BlackLabel\FlightStats\Query;

class FetchArrivingFlightsWithDateTest extends QueryTest
{
    public function testFetchArrivingFlightsWithValidDate()
    {
        $query = new FetchArrivingFlightsWithDate($this->client);

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
     * Fetching flights with dates over a month will result in a response with an error.
     * @depends testFetchArrivingFlightsWithValidDate
     */
    public function testFetchArrivingFlightsWithValidInvalidDate()
    {
        $query = new FetchArrivingFlightsWithDate($this->client);

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
