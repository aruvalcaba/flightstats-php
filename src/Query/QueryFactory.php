<?php

namespace BlackLabel\FlightStats\Query;

use BlackLabel\FlightStats\FlightStatsClient;

class QueryFactory
{
    private $client;

    public function __construct(FlightStatsClient $client)
    {
        $this->client = $client;
    }

    public function newInstance($class)
    {
        return new $class($this->client);
    }
}
