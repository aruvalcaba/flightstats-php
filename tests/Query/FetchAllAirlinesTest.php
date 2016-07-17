<?php

namespace BlackLabel\FlightStats\Query;

class FetchAllAirlinesTest extends QueryTest
{
    public function testFetchAllAirlines()
    {
        $query = new FetchAllAirlines($this->client);

        $response = $query->invoke();

        $this->assertEquals(200,$response->getStatusCode());

        $response = json_decode($response->getBody()->getContents(),true);

        $this->assertArrayHasKey('airlines',$response);
    }
}
