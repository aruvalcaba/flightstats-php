<?php

namespace BlackLabel\FlightStats\Query;

class FetchDepartingFlightsWithDate extends Query
{
    public function invoke(array $params =[])
    {
        $format = 'schedules/rest/v1/json/from/%s/to/%s/departing/%s/%s/%s';
        
        $departureAirportCode = $params['departureAirportCode'];
        $arrivalAirportCode = $params['arrivalAirportCode'];
        $year = $params['year'];
        $month = $params['month'];
        $day = $params['day'];

        $route = sprintf($format,$departureAirportCode,$arrivalAirportCode,$year,$month,$day);

        return $this->client->request($route);
    }
}
