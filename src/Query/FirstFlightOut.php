<?php

/**
 * @author Alan Ruvalcaba <aruval3@gmail.com>
 * @copyright 2016 Alan Ruvalcaba
 * @description Find connections leaving as early as possible after the given time.
 */
namespace BlackLabel\FlightStats\Query;

class FirstFlightOut extends FetchFlightConnectionWithDateTime
{
    protected $method = 'firstflightout';
    protected $dateMethod = 'leaving_after';    
}
