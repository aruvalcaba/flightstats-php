<?php

namespace BlackLabel\FlightStats\Query;

use Faker\Factory as Faker;

class FetchArrivingFlightsWithDateTest extends QueryTest
{
    public function testFetchArrivingFlightsWithValidDate()
    {
        $query = new FetchArrivingFlightsWithDate($this->client);

        $departureAirportCode = 'ORD';
        $arrivalAirportCode = 'LGA';

        $faker = Faker::create();

        $futures = ['tomorrow','addWeek'];

        $future = $faker->randomElement($futures);
        $futureDate = $this->carbon->$future();

        $year = $futureDate->year;
        $month = $futureDate->month;
        $day = $futureDate->day;

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
        
        $faker = Faker::create();

        $pasts = ['subMonth','subYear'];

        $past = $faker->randomElement($pasts);

        $num = $faker->numberBetween(2,5);

        $pastDate = $this->carbon->$past($num);

        $year = $pastDate->year;
        $month = $pastDate->month;
        $day = $pastDate->day;

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
