<?php

namespace BlackLabel\FlightStats\Query;

/**
 * @author George Garchagudashvili <george@worldnet-intl.com>
 */
class FlightTracksByDepartingDate extends Query
{
    public function invoke(array $params = array())
    {
        $format = 'flightstatus/rest/v2/json/flight/tracks/%s/%s/dep/%s/%s/%s';
        
        $route = sprintf(
            $format, 
            $params['carrier'], 
            $params['flight'], 
            $params['year'], 
            $params['month'], 
            $params['day']
        );
        
        return $this->client->request($route, $params);
    }
}
