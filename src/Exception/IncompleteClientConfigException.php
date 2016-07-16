<?php

namespace BlackLabel\FlightStats\Exception;

use Exception;

class IncompleteClientConfigException extends Exception
{
    public function __construct(
        string $key
    )
    {
        parent::__construct(sprintf('Client configuration is missing %s.',$key));
    }
}
