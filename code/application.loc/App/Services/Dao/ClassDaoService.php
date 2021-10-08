<?php

namespace App\Services\Dao;

use App\Exceptions\Connection\InvalidArgumentException;
use App\Providers\AppServiceProvider;
use App\Services\Dao\DataMapper\SchoolClass\SchoolClass;
use App\Services\Dao\DataMapper\SchoolClass\SchoolClassMapper;
use PDO;

class ClassDaoService
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
     * @return SchoolClass
     */
    public function getSchoolClass(int $id = null): SchoolClass
    {
        return (new SchoolClassMapper($this->connection))->findById($id);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return (new SchoolClassMapper($this->connection))->getAll();
    }
}