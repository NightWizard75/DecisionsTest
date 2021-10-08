<?php

namespace App\Services\Dao;

use App\Exceptions\Connection\InvalidArgumentException;
use App\Providers\AppServiceProvider;
use App\Services\Dao\DataMapper\Group\Group;
use App\Services\Dao\DataMapper\Group\GroupMapper;
use PDO;

class GroupDaoService
{
    /**
     * @var PDO
     */
    private PDO $connection;

    /**
     * @throws InvalidArgumentException
     */
    public function __construct()
    {
        $this->connection = (new AppServiceProvider())->getConnection();
    }

    /**
     * @param int|null $id
     * @return Group
     */
    public function getGroup(int $id = null): Group
    {
        return (new GroupMapper($this->connection))->findById($id);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return (new GroupMapper($this->connection))->getAll();
    }
}