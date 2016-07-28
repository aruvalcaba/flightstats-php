<?php
/**
 * @author Alan Ruvalcaba <aruval3@gmail.com>
 * @copyright 2016 Alan Ruvalcaba
 */
namespace BlackLabel\FlightStats\Query;

abstract class FetchFlightConnectionWithDateTime extends Query
{
    protected $method;

    protected $dateMethod;

    public function invoke(array $params = [])
    {
        $format = 'connections/rest/v2/json/%s/%s/to/%s/%s/%s/%s/%s/%s/%s';
        
        $departureAirportCode = $params['departureAirport'];
        $arrivalAirportCode = $params['arrivalAirport'];
        $year = $params['year'];
        $month = $params['month'];
        $day = $params['day'];
        $hour = $params['hour'];
        $minute = $params['minute'];

        $route = sprintf($format,$this->method,$departureAirportCode,$arrivalAirportCode,$this->dateMethod,$year,$month,$day,$hour,$minute);

        $requiredKeys = ['departureAirportCode','arrivalAirportCode','year','month','day','hour','minute'];

        $requiredParams = \BlackLabel\array_pull($params,$requiredKeys);

        return $this->client->request($route,$params);
    }   
}
