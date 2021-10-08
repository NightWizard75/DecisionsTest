<?php

namespace App\Http\Controllers;


use App\Exceptions\Loader\ViewLoaderException;
use App\Http\Response\IResponse;
use App\Models\LoginModel;


class LoginController extends BaseController
{
    /**
     * @var LoginModel
     */
    private LoginModel $model;


    /**
     * @param IResponse $response
     */
    public function __construct(IResponse $response)
    {
        parent::__construct($response);
        $this->model = new LoginModel();
    }

    /**
     * Обработчик маршрута по умолчанию
     *
     * @throws ViewLoaderException
     */
    public function run(): void
    {
        $this->data['title'] = 'Login';
        $this->data += $parameters = $this->getParameters();
        if (!empty($parameters)) {
            if ($this->model->login(...$parameters)) {
                header('Location: /default');
                return;
            } else {
                $this->data['error'] = true;
            }
        }
        $this->loadView('Login/index');
    }

    public function logout(): void
    {
        $this->model->logout();
        header('Location: /default');
    }
}