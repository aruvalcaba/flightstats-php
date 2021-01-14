<?php

namespace BlackLabel\FlightStats\Query;

class LastFlightOutTest extends ConnectFlightTest
{
    public function setUp()
    {
        parent::setUp();

        $this->query = new LastFlightOut($this->client);
    }
}
