<?php

namespace BlackLabel\FlightStats\Query;

use function BlackLabel\array_pull;

abstract class FetchFlightsWithDate extends Query
{
    protected $method;

    public function invoke(array $params =[])
    {
        $format = 'schedules/rest/v1/json/from/%s/to/%s/%s/%s/%s/%s';
        
        $departureAirportCode = $params['departureAirportCode'];
        $arrivalAirportCode = $params['arrivalAirportCode'];
        $year = $params['year'];
        $month = $params['month'];
        $day = $params['day'];

        $route = sprintf($format,$departureAirportCode,$arrivalAirportCode,$this->method,$year,$month,$day);

        $requiredKeys = ['departureAirportCode','arrivalAirportCode','year','month','day'];

        $requiredParams = array_pull($params,$requiredKeys);

        return $this->client->request($route,$params);
    }
}
