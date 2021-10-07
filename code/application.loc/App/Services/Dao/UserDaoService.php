<?php

namespace App\Services\Dao;


use App\Exceptions\Connection\InvalidArgumentException;
use App\Providers\AppServiceProvider;
use App\Services\Dao\DataMapper\User\User;
use App\Services\Dao\DataMapper\User\UserMapper;
use PDO;

/**
 * Class UserDaoService
 *
 * Сервис вызова методов из DataMapper для таблицы
 * 'user',
 *
 * @package Services\Dao
 */
class UserDaoService
{
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
     * @return User
     */
    public function getUser(int $id = null): User
    {
        return (new UserMapper($this->connection))->findById($id);
    }

    /**
     * @param string $login
     * @return User
     */
    public function getUserByLogin(string $login): User
    {
        return (new UserMapper($this->connection))->findByLogin($login);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getUsersByClassId(int $id): array
    {
        return (new UserMapper($this->connection))->getUsersByClassId($id);
    }

    /**
     * @param int $id
     * @return array
     */
    public function getUsersByGroupId(int $id): array
    {
        return ($id !==0)
            ? (new UserMapper($this->connection))->getUsersByGroupId($id)
            : (new UserMapper($this->connection))->getStudentsWithoutGroup();
    }

    /**
     * @param User $user
     * @return bool
     */
    public function updateUser(User $user): bool
    {
        return (new UserMapper($this->connection))->update($user);
    }
}