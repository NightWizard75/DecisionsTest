<?php

namespace Src\Database\Connectors;


use App\Exceptions\Connection\InvalidArgumentException;
use App\Exceptions\ErrorCodes;


class ConnectorsFactory
{
    /**
     * @param string $driver
     * @param array $config
     * @return Connector
     * @throws InvalidArgumentException
     */
    public static function createConnection(string $driver, array $config): Connector
    {
        return match ($driver) {
            PostgresPdoConnector::DSN => new PostgresPdoConnector($driver, $config),
            PostgresPgConnector::DSN => new PostgresPgConnector($driver, $config),
            default => throw new InvalidArgumentException("Unsupported driver '$driver'", ErrorCodes::getCode(InvalidArgumentException::class))
        };
    }
}