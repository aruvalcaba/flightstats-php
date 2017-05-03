<?php

namespace BlackLabel\FlightStats\Query;

/**
 * @author George Garchagudashvili <george@worldnet-intl.com>
 */
class FlightStatusByID extends Query
{
    public function invoke(array $params = array())
    {
        $format = 'flightstatus/rest/v2/json/flight/status/%s';
        
        $route = sprintf($format, $params['flightID']);
        
        return $this->client->request($route, $params);
    }
}
