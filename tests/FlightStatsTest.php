<?php

namespace BlackLabel\FlightStats;

use PHPUnit\Framework\TestCase;

abstract class FlightStatsTest extends TestCase
{
    protected $apiUrl;

    protected $appKey;

    protected $appId;

    public function setUp()
    {
        $this->apiUrl = $_ENV['API_URL'];
        $this->appKey = $_ENV['APP_KEY'];
        $this->appId = $_ENV['APP_ID'];
    }
}
