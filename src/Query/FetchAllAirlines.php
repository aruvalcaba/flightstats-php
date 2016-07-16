<?php

namespace BlackLabel\FlightStats\Query;

class FetchAllAirlines extends Query
{
    public function invoke(array $params =[])
    {
        $route = 'v1/json/active';

        return $this->client->request($route);
    }
}
