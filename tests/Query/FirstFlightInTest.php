<?php

namespace BlackLabel\FlightStats\Query;

class FirstFlightInTest extends ConnectFlightTest
{
    public function setUp()
    {
        parent::setUp();

        $this->query = new FirstFlightIn($this->client);
    }
}
