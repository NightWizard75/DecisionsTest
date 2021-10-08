<?php

namespace App\Services\Dao\DataMapper\User;


use PDO;
use PDOStatement;
use App\Services\Dto\UserDto;


class UserMapper
{
    /**
     * @var PDO
     */
    private PDO $pdo;

    /**
     * @var PDOStatement|false
     */
    private PDOStatement|false $selectStmt;

    /**
     * @var PDOStatement|false
     */
    private PDOStatement|false $selectRoleStmt;

    /**
     * @var PDOStatement|false
     */
    private PDOStatement|false $selectClassStmt;

    /**
     * @var PDOStatement|false
     */
    private PDOStatement|false $selectGroupStmt;

    /**
     * @var PDOStatement|false
     */
    private PDOStatement|false $insertStmt;

    /**
     * @var PDOStatement|false
     */
    private PDOStatement|false $updateStmt;

    /**
     * @var PDOStatement|false
     */
    private PDOStatement|false $deleteStmt;

    /**
     * @var PDOStatement|false
     */
    private PDOStatement|false $selectByLoginStmt;

    /**
     * @var PDOStatement|false
     */
    private PDOStatement|false $selectUsersByClassIdStmt;

    /**
     * @var PDOStatement|false
     */
    private PDOStatement|false $selectUsersByGroupIdStmt;

    /**
     * @var PDOStatement|false
     */
    private PDOStatement|false $selectStudentsWithoutGroupStmt;


    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $prefix = $_ENV['PGSQL_DB_SCHEME'];
        $this->selectStmt = $pdo->prepare(
            "select * from $prefix.user where id = :id"
        );
        $this->selectByLoginStmt = $pdo->prepare(
          "select * from $prefix.user where login = :login"
        );
        $this->selectUsersByClassIdStmt = $pdo->prepare(
          "select  id, login, first_name, middle_name, last_name, role_id, class_id, group_id from $prefix.user 
                where class_id = :classId
                order by last_name"
        );
        $this->selectUsersByGroupIdStmt = $pdo->prepare(
          "select u.id, u.login, u.first_name, u.middle_name, u.last_name, u.role_id, u.class_id, u.group_id, c.name as class  from $prefix.user u
                left join $prefix.class c on u.class_id = c.id
                where group_id = :groupId
                order by last_name"
        );
        $this->selectStudentsWithoutGroupStmt = $pdo->prepare(
          "select u.id, u.login, u.first_name, u.middle_name, u.last_name, u.role_id, u.class_id, u.group_id, c.name as class  from $prefix.user u
                left join $prefix.class c on u.class_id = c.id
                where group_id is NULL and role_id = 2
                order by last_name"
        );
        $this->selectRoleStmt = $pdo->prepare(
            "select name from $prefix.role where id = :id"
        );

        $this->selectClassStmt = $pdo->prepare(
            "select name from $prefix.class where id = :id"
        );
        $this->selectGroupStmt = $pdo->prepare(
            "select name from $prefix.group where id = :id"
        );

        $this->insertStmt = $pdo->prepare(
            "insert into $prefix.user (login, password, first_name, middle_name, last_name, created_at, role_id, class_id, group_id) 
                            values (?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $this->updateStmt = $pdo->prepare(
            "update $prefix.user set login = :login, 
                                   password = :password,
                                   first_name = :first_name,
                                   middle_name = :middle_name,
                                   last_name = :last_name,
                                   updated_at = :updated_at,
                                   role_id = :role_id, 
                                   class_id = :class_id, 
                                   group_id = :group_id 
                   where id = :id"
        );
        $this->deleteStmt = $pdo->prepare("delete from $prefix.user where id = :id");
    }

    /**
     * @param int $id
     * @return User
     */
    public function findById(int $id): User
    {
        $this->selectStmt->setFetchMode(\PDO::FETCH_CLASS, UserDto::class);
        $this->selectStmt->execute(['id' => $id]);
        $user = $this->selectStmt->fetch();
        if ($user === false) {
            return new User();
        }
        return new User($this->setUserProperty($user));
    }

    /**
     * @param $login
     * @return User
     */
    public function findByLogin($login): User
    {
        $this->selectByLoginStmt->setFetchMode(\PDO::FETCH_CLASS, UserDto::class);
        $this->selectByLoginStmt->execute(['login' => $login]);
        $user = $this->selectByLoginStmt->fetch();
        if ($user === false) {
            return new User();
        } else {
            $user = $this->setUserProperty($user);
        }
        return new User($user);
    }

    /**
     * @param int $classId
     * @return array
     */
    public function getUsersByClassId(int $classId): array
    {
        $this->selectUsersByClassIdStmt->execute(['classId' => $classId]);
        return $this->selectUsersByClassIdStmt->fetchAll(PDO::FETCH_CLASS, UserDto::class);
    }

    /**
     * @param int $groupId
     * @return array
     */
    public function getUsersByGroupId(int $groupId): array
    {
        $this->selectUsersByGroupIdStmt->execute(['groupId' => $groupId]);
        return $this->selectUsersByGroupIdStmt->fetchAll(PDO::FETCH_CLASS, UserDto::class);
    }

    public function getStudentsWithoutGroup(): array
    {
        $this->selectStudentsWithoutGroupStmt->execute();
        return $this->selectStudentsWithoutGroupStmt->fetchAll(PDO::FETCH_CLASS, UserDto::class);
    }

    /**
     * @param UserDto $data
     * @return User
     */
    public function insert(UserDto $data): User
    {
        $this->insertStmt->execute([
            $data->login,
            $data->password,
            $data->first_name,
            $data->middle_name,
            $data->last_name,
            date('Y-m-d H:i:s'),
            $data->role_id,
            $data->class_id,
            $data->group_id,
        ]);
        $data->id = $this->pdo->lastInsertId();
        return new User($data);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function update(User $user): bool
    {
        return $this->updateStmt->execute([
            'id'                => $user->getId(),
            'login'             => $user->getLogin(),
            'password'          => $user->getPassword(),
            'first_name'        => $user->getFirstName(),
            'middle_name'       => $user->getMiddleName(),
            'last_name'         => $user->getLastName(),
            'updated_at'        => date('Y-m-d H:i:s'),
            'role_id'           => $user->getRoleId(),
            'class_id'          => $user->getClassId(),
            'group_id'          => $user->getGroupId(),
        ]);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->deleteStmt->execute(['id' => $id]);
    }

    /**
     * @param mixed $user
     * @return UserDto
     */
    private function setUserProperty(UserDto $user): UserDto
    {
        $this->selectRoleStmt->setFetchMode(\PDO::FETCH_ASSOC);
        $this->selectRoleStmt->execute(['id' => $user->role_id]);
        $user->role = $this->selectRoleStmt->fetch()['name'] ?? null;
        $this->selectClassStmt->setFetchMode(\PDO::FETCH_ASSOC);
        $this->selectClassStmt->execute(['id' => $user->class_id]);
        $user->class = $this->selectClassStmt->fetch()['name'] ?? null;
        $this->selectGroupStmt->setFetchMode(\PDO::FETCH_ASSOC);
        $this->selectGroupStmt->execute(['id' => $user->group_id]);
        $user->group = $this->selectGroupStmt->fetch()['name'] ?? null;
        return $user;
    }
}