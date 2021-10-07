<?php


namespace App\Models;


use App\Services\Dao\DataMapper\User\User;
use App\Services\Dao\UserDaoService;


class LoginModel implements IModel
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
     * @return User|null
     */
    public function getCurrentUser(): ?User
    {
        session_start();
        if (!isset($_SESSION['currentUserId'])) {
            return null;
        } else {
            $id = $_SESSION['currentUserId'];
        }
        session_write_close();
        return $this->dataAccess->getUser($id);
    }

    /**
     * @param $id
     */
    private function setCurrentUser($id): void
    {
        session_start();
        $_SESSION['currentUserId'] = $id;
        session_write_close();
    }

    /**
     * @param string $login
     * @param string $password
     * @return bool
     */
    public function login(string $login = '', string $password = ''): bool
    {
        $user = $this->dataAccess->getUserByLogin($login);
        if ($user->getPassword() !== sha1($password))
            return false;
        $this->setCurrentUser($user->getId());
        return true;
    }

    public function logout(): void
    {
        session_start();
        $_SESSION['currentUserId'] = null;
        session_write_close();
    }
}