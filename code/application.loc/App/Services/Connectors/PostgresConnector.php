<?php


namespace App\Services\Connectors;


use App\Exceptions\Connection\InvalidArgumentException;
use App\Helpers\ConfigHelper;
use PDO;
use Src\Database\Connectors\ConnectorsFactory;

/**
 * Class PostgresConnector
 *
 * Подключение к базе данных Postgres
 *
 * @package Services\Connectors
 */
class PostgresConnector
{

    private string $driver;

    /**
     * PostgresConnector constructor.
     */
    public function __construct()
    {
        $this->driver = $_ENV['PGSQL_DRIVER'];
    }

    /**
     * Возвращает PDO соединения с базой данных Postgres
     *
     * @return PDO
     * @throws InvalidArgumentException
     */
    public function connect(): PDO
    {
        return ConnectorsFactory::createConnection($this->driver, ConfigHelper::getConnectionConfigPostgres())->connect();
    }

}
