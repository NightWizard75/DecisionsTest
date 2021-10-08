<?php

namespace App\Models;


use App\Services\Dao\DataMapper\User\User;
use App\Services\Dao\SchedulerDaoService;
use App\Services\Dao\UserDaoService;


class UserModel implements IModel
{
    /**
     * @var UserDaoService
     */
    protected UserDaoService $dataAccess;


    public function __construct()
    {
        $this->dataAccess = new UserDaoService();
    }

    /**
     * @param int $id
     * @return User
     */
    public function getUser(int $id): User
    {
       return $this->dataAccess->getUser($id);
    }

    /**
     * @param int $classId
     * @return array
     */
    public function getUsersByClassId(int $classId): array
    {
        return $this->dataAccess->getUsersByClassId($classId);
    }

    /**
     * @param int $groupId
     * @return array
     */
    public function getUsersByGroupId(int $groupId): array
    {
        return $this->dataAccess->getUsersByGroupId($groupId);
    }

    /**
     * @param int $userId
     * @param int|null $groupId
     * @return bool
     */
    public function changeUserGroup(int $userId, ?int $groupId): bool
    {
        $user = $this->getUser($userId);
        $user->setGroupId($groupId);
        return $this->dataAccess->updateUser($user);
    }
}