<?php

namespace BlackLabel\FlightStats\Query;

class FirstFlightOutTest extends ConnectFlightTest
{
    public function setUp()
    {
        parent::setUp();

        $this->query = new FirstFlightOut($this->client);
    }
}
