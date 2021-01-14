<?php

/**
 * @author Alan Ruvalcaba <aruval3@gmail.com>
 * @copyright 2016 Alan Ruvalcaba
 * @description Find connections arriving as late as possible before the given time.
 */
namespace BlackLabel\FlightStats\Query;

class LastFlightIn extends FetchFlightConnectionWithDateTime
{
    protected $method = 'lastflightin';
    protected $dateMethod = 'arriving_before';    
}
