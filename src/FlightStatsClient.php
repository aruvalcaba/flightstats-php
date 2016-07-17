<?php

/**
 * @author Alan Ruvalcaba <aruval3@gmail.com>
 * @copyright 2016 Alan Ruvalcaba
 */
namespace BlackLabel\FlightStats;

use GuzzleHttp\ClientInterface as Client;

use BlackLabel\FlightStats\Exception\IncompleteClientConfigException;

class FlightStatsClient 
{
    protected $client;
    
    protected $apiUrl;

    protected $config;

    public function __construct(
        Client $client,
        string $apiUrl,
        array $config  
    )
    {
        $appIdIndex = 'appId';
        $appKeyIndex = 'appKey';

        if( ! isset($config[$appIdIndex]) )
        {
            throw new IncompleteClientConfigException($appIdIndex);
        }

        if( ! isset($config[$appKeyIndex]) )
        {
            throw new IncompleteClientConfigException($appKeyIndex);
        }

        $this->client = $client;
        $this->apiUrl = $apiUrl;
        $this->config = $config;
    }

    public function request(string $route,array $params = [])
    {
        $absoluteUrl = sprintf('%s/%s',$this->apiUrl,$route);

        $headers = [ 'Content-Type' => 'application/json;charset=UTF-8' ];

        $options = [
            'headers' => $headers,
            'query' => $this->config
        ];

        if( count($params) > 0 )
        {
            $options = $options + $params;
        }
        
        return $this->client->get($absoluteUrl,$options);
    }
}
