<?php

namespace BlackLabel\FlightStats\Query;

use Faker\Factory as Faker;

class ConnectFlightTest extends QueryTest
{
    public function testConnectionFlightWithValidParams()
    {
        $faker = Faker::create();

        $departureAirportCode = 'ORD';
        $arrivalAirportCode = 'LGA';

        $tomorrow = $this->carbon->tomorrow();
        $tomorrow->minute($faker->numberBetween(1,59));

        $year = $tomorrow->year;
        $month = $tomorrow->month;
        $day = $tomorrow->day;
        $minute = $tomorrow->minute;
        $hour = $tomorrow->hour;

        $params = [
            'departureAirport' => $departureAirportCode,
            'arrivalAirport' => $arrivalAirportCode,
            'year' => $year,
            'month' => $month,
            'day' => $day,
            'minute' => $minute,
            'hour' => $hour,
            'numHours' => $faker->numberBetween(1,24),
            'maxResults' => $faker->numberBetween(1,50),
            'includeSurface' => $faker->boolean,
            'payloadType' => $faker->randomElement(['passenger','cargo','all']),
            'maxConnections' => $faker->numberBetween(1,2),
            'includeCodeshares' => $faker->boolean,
            'includeMultipleCarriers' => $faker->boolean,
        ];

        $response = $this->query->invoke($params);
 
        $this->assertEquals(200,$response->getStatusCode());

        $response = json_decode($response->getBody()->getContents(),true);
        $this->assertFalse(array_key_exists('error',$response));       
        $this->assertArrayHasKey('connections',$response);
    }

    public function testConnectionFlightWithInvalidParams()
    {
        $query = new FirstFlightOut($this->client);

        $faker = Faker::create();

        $departureAirportCode = 'ORD';
        $arrivalAirportCode = 'LGA';

        $tomorrow = $this->carbon->tomorrow();
        $tomorrow->minute($faker->numberBetween(1,59));

        $year = $tomorrow->year;
        $month = $tomorrow->month;
        $day = $tomorrow->day;
        $minute = $tomorrow->minute;
        $hour = $tomorrow->hour;

        $params = [
            'departureAirport' => $departureAirportCode,
            'arrivalAirport' => $arrivalAirportCode,
            'year' => $year,
            'month' => $month,
            'day' => $day,
            'minute' => $minute,
            'hour' => $hour,
            'numHours' => $faker->word,
            'maxResults' => $faker->word,
            'includeSurface' => $faker->word,
            'payloadType' => $faker->randomDigit,
            'maxConnections' => $faker->word,
            'includeCodeshares' => $faker->word,
            'includeMultipleCarriers' => $faker->word,
        ];

        $response = $this->query->invoke($params);
 
        $this->assertEquals(200,$response->getStatusCode());

        $response = json_decode($response->getBody()->getContents(),true);
        $this->assertArrayHasKey('error',$response);
    }
}
