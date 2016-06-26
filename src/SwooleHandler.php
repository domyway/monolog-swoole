<?php

namespace DOMYWAY;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use WebSocket\Client;

class SwooleHandler extends AbstractProcessingHandler 
{
    static $client;
    static $ws;

    public function __construct(array $config)
    {
        self::$ws = $config['ws'];
    }

    static public function getInstance()
    {
        if(self::$client)
        {
            self::$client = new Client(self::$ws);
        }

        return self::$client;
    }

    public function write(array $record)
    {
        return self::getInstance()->send(json_encode($record, JSON_UNESCAPED_UNICODE));
    }

    public function receive()
    {
        return self::getInstance()->receive();
    }
}

