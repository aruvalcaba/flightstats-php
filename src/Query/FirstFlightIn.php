<?php

/**
 * @author Alan Ruvalcaba <aruval3@gmail.com>
 * @copyright 2016 Alan Ruvalcaba
 * @description Find connections arriving as early as possible before the given time.
 */
namespace BlackLabel\FlightStats\Query;

class FirstFlightIn extends FetchFlightConnectionWithDateTime
{
    protected $method = 'firstflightin';
    protected $dateMethod = 'arriving_before';    
}
