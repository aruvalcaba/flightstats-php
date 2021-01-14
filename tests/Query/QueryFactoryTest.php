<?php

namespace BlackLabel\FlightStats\Query;

use BlackLabel\FlightStats\FlightStatsClient;

class QueryFactoryTest extends QueryTest
{
    public function instanceProvider()
    {
        return [
            ['BlackLabel\FlightStats\Query\FetchAllAirlines'],
            ['BlackLabel\FlightStats\Query\FetchArrivingFlightsWithDate'],
            ['BlackLabel\FlightStats\Query\FetchDepartingFlightsWithDate'],
            ['BlackLabel\FlightStats\Query\FirstFlightIn'],
            ['BlackLabel\FlightStats\Query\FirstFlightOut'],
            ['BlackLabel\FlightStats\Query\LastFlightOut'],
            ['BlackLabel\FlightStats\Query\LastFlightIn'],
        ];
    }
    
    /**
     * @dataProvider instanceProvider
     */
    public function testQueryInstance($class)
    {
        $queryFactory = new QueryFactory($this->client);

        $query = $queryFactory->newInstance($class);

        $this->assertTrue( $query instanceOf $class );
    }
}
