<?php

/**
 * @author Alan Ruvalcaba <aruval3@gmail.com>
 * @copyright 2016 Alan Ruvalcaba
 */
namespace BlackLabel\FlightStats\Query;

class FetchAllAirlines extends Query
{
    public function invoke(array $params =[])
    {
        $route = 'v1/json/active';

        return $this->client->request($route);
    }
}
