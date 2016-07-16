<?php

namespace BlackLabel\FlightStats\Query;

use BlackLabel\FlightStats\FlightStatsClient;

abstract class Query
{
    protected $client;

    public function __construct(FlightStatsClient $client)
    {
        $this->client = $client;
    }
    
    /**
     * Implement invoke function to make api call using the flight status client.
     */
    abstract public function invoke(array $params = []);
}
