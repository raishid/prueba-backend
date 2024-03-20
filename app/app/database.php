<?php

namespace App\app;

use Illuminate\Database\Capsule\Manager;


class database 
{
    public $connection = null;

    public function connect()
    {
        $config = new config();

        $connection = new Manager();

        $connection->addConnection([
            'driver'    => $config->database['driver'],
            'host'      => $config->database['host'],
            'database'  => $config->database['database'],
            'username'  => $config->database['username'],
            'password'  => $config->database['password'],
            'charset'   => $config->database['charset'],
            'port'      => $config->database['port']
        ]);

        $connection->setAsGlobal();

        $connection->bootEloquent();

        $connection->getConnection()->statement('SET default_storage_engine=' . $config->database['engine'] ?? 'MyISAM');        

        $this->connection = $connection;
    }
}