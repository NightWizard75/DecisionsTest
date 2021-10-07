<?php


namespace App\Providers;


use App\Exceptions\Connection\InvalidArgumentException;
use App\Services\Connectors\MySqlConnector;
use App\Services\Connectors\PostgresConnector;
use PDO;

/**
 * Class AppServiceProvider
 *
 * Определяет подключение к выбранной в конфигурации базе данных
 *
 * @package app\Providers
 */
class AppServiceProvider
{
    private mixed $connector;

    /**
     * AppServiceProvider constructor.
     */
    public function __construct()
    {
        $this->connector = $_ENV['DB_CONNECTION'];
    }

    /**
     * @return PDO
     * @throws InvalidArgumentException
     */
    public function getConnection(): PDO
    {
        return match ($this->connector) {
            'mysql' => (new MySqlConnector())->connect(),
            default => (new PostgresConnector())->connect(),
        };
    }

}
