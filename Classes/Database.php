<?php

/**
 * Class Database
 */
class Database
{
    /**
     * @return PDO
     */
    protected static function connect()
    {
        require('./config.php');

        return new \PDO(
            'mysql:host=' . $config['dbHost'] . ';dbname=' . $config['dbName'] . ';charset=utf8',
            $config['dbUser'],
            $config['dbPassword']
        );
    }
}