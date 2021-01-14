<?php

namespace BlackLabel\FlightStats\Query;

class LastFlightInTest extends ConnectFlightTest
{
    public function setUp()
    {
        parent::setUp();

        $this->query = new LastFlightIn($this->client);
    }
}
