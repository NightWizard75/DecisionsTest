<?php

namespace App\Http\Controllers;

use App\Exceptions\Auth\PermissionsDeniedException;
use App\Exceptions\Loader\ViewLoaderException;
use App\Exceptions\User\InvalidUserRoleException;
use App\Http\Response\IResponse;
use App\Models\GroupModel;
use App\Models\UserModel;


class UserController extends BaseController
{
    /**
     * @var GroupModel
     */
    private GroupModel $groupModel;

    /**
     * @var UserModel
     */
    private UserModel $userModel;


    /**
     * @param IResponse $response
     */
    public function __construct(IResponse $response)
    {
        parent::__construct($response);
        if (is_null($this->currentUser)) {
            header('Location: /login');
        }
        $this->groupModel = new GroupModel();
        $this->userModel = new UserModel();
    }

    /**
     * @throws InvalidUserRoleException
     * @throws PermissionsDeniedException
     * @throws ViewLoaderException
     */
    public function run(): void
    {
        if (!$this->checkPermissions()) return;
        $this->data['title'] = 'Электронный журнал';
        $this->data['user'] = $this->currentUser;
        $this->data['users'] = $this->userModel->getUsersByClassId($this->getParameters()['class']);
        $this->data['groups'] = $this->groupModel->getAllGroups();
        $this->loadView('Template/header');
        $this->loadView('User/users');
        $this->loadView('Template/footer');
    }

    /**
     * Маршрут обработки ajax-запроса по маршруту 'xhrGetUserById'.
     * Отдает пользователя по Id
     */
    public function xhrGetUserById(): void
    {
        $id = $this->getParameters()['id'] ?? 0;
        $this->title = 'User';
        $this->responseMsg = "Response: User";
        $this->xhrSendResult($this->userModel->getUser($id)->asArray());
    }

    /**
     * Маршрут обработки ajax-запроса по маршруту 'xhrGetUsersByGroupId'.
     * Возвращает список пользователей для группы по groupId.
     */
    public function xhrGetUsersByGroupId(): void
    {
        $id = $this->getParameters()['groupId'] ?? 0;
        $this->title = 'Group Users';
        $this->responseMsg = "Response: Users";
        $this->xhrSendResult($this->userModel->getUsersByGroupId($id));
    }

    /**
     * Маршрут обработки ajax-запроса по маршруту 'xhrChangeUserGroup'.
     * Изменяет группу для пользователя. И возвращает список пользователей для этой группы.
     */
    public function xhrChangeUserGroup(): void
    {
        $userId = $this->getParameters()['userId'] ?? null;
        $groupId = empty($this->getParameters()['groupId']) ? null : $this->getParameters()['groupId'];
        $this->title = 'Change user group';
        $this->responseMsg = "Response: Users";
        $this->userModel->changeUserGroup($userId, $groupId);
        $this->xhrSendResult($this->userModel->getUsersByGroupId($groupId ?? 0));
    }
}