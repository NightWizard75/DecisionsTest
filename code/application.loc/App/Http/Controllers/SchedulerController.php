<?php

namespace App\Http\Controllers;


use App\Exceptions\Auth\PermissionsDeniedException;
use App\Exceptions\Loader\ViewLoaderException;
use App\Exceptions\User\InvalidRelationIdException;
use App\Exceptions\User\InvalidUserRoleException;
use App\Http\Response\IResponse;
use App\Models\LoginModel;
use App\Models\SchedulerModel;


class SchedulerController extends BaseController
{
    /**
     * @var SchedulerModel
     */
    private SchedulerModel $model;


    /**
     * @param IResponse $response
     */
    public function __construct(IResponse $response)
    {
        parent::__construct($response);
        $this->model = new SchedulerModel();
        $this->currentUser = (new LoginModel())->GetCurrentUser();
        if (is_null($this->currentUser)) {
            header('Location: /login');
        }
    }

    /**
     * Обработчик маршрута save
     *
     * @throws InvalidRelationIdException
     * @throws ViewLoaderException
     * @throws PermissionsDeniedException
     * @throws InvalidUserRoleException
     */
    public function save(): void
    {
        if (!$this->checkPermissions()) return;
        $this->data['title'] = 'Электронный журнал';
        $this->data['user'] = $this->currentUser;
        $this->data += $schedule = $this->getParameters();
        $this->model->saveSchedule($schedule);
        $this->loadView('Template/header');
        $this->loadView('Schedule/save_success');
        $this->loadView('Template/footer');
    }
}