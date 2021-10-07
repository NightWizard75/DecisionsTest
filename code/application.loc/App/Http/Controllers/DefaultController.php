<?php

namespace App\Http\Controllers;


use App\Exceptions\ErrorCodes;
use App\Exceptions\Loader\ViewLoaderException;
use App\Exceptions\User\InvalidUserRoleException;
use App\Helpers\ConfigHelper;
use App\Http\Response\IResponse;
use App\Models\ClassModel;
use App\Models\GroupModel;
use App\Models\LessonModel;
use App\Models\LoginModel;
use App\Models\SchedulerModel;


/**
 * Контроллер по умолчанию.
 */
class DefaultController extends BaseController
{
    /**
     * @var LessonModel
     */
    private LessonModel $lessonModel;

    /**
     * @var ClassModel
     */
    private ClassModel $classModel;

    /**
     * @var GroupModel
     */
    private GroupModel $groupModel;

    /**
     * @var SchedulerModel
     */
    private SchedulerModel $schedulerModel;


    /**
     * @param IResponse $response
     */
    public function __construct(IResponse $response)
    {
        parent::__construct($response);
        $this->currentUser = (new LoginModel())->GetCurrentUser();
        if (is_null($this->currentUser)) {
            header('Location: /login');
        }
        $this->lessonModel = new LessonModel();
        $this->classModel = new ClassModel();
        $this->groupModel = new GroupModel();
        $this->schedulerModel = new SchedulerModel();
    }

    /**
     * Обработчик маршрута по умолчанию
     * @throws InvalidUserRoleException
     * @throws ViewLoaderException
     */
    public function run(): void
    {
        $this->data['title'] = 'Электронный журнал';
        $this->data['user'] = $this->currentUser;
        $this->data['daysOfWeek'] = ConfigHelper::getDaysOfWeek();
        $this->data['lessons'] = $this->lessonModel->getAllLessons();
        $this->data['lessonsCount'] = ConfigHelper::getLessonsCountPerDay();
        $this->data['editMode'] = false;

        match ($this->currentUser->getRoleId()) {
            1 => $this->loadTeacherPage(),
            2 => $this->loadStudentPage(),
            default => throw new InvalidUserRoleException('Not valid user role', ErrorCodes::getCode(InvalidUserRoleException::class))
        };
    }

    /**
     * @throws InvalidUserRoleException
     * @throws ViewLoaderException
     */
    public function editScheduler(): void
    {
        $this->data['title'] = 'Редактирование расписания';
        $this->data['user'] = $this->currentUser;
        $this->data['daysOfWeek'] = ConfigHelper::getDaysOfWeek();
        $this->data['lessons'] = $this->lessonModel->getAllLessons();
        $this->data['lessonsCount'] = ConfigHelper::getLessonsCountPerDay();
        $this->data['editMode'] = true;
        match ($this->currentUser->getRoleId()) {
            1 => $this->loadEditSchedulePage(),
            2 => $this->loadStudentPage(),
            default => throw new InvalidUserRoleException('Not valid user role', 1)
        };
    }

    public function logout(): void
    {
        $this->model->logout();
        header('Location: /login');
    }

    /**
     * @throws ViewLoaderException
     */
    private function loadTeacherPage(): void
    {
        $this->data['classes'] = $this->classModel->getAllClasses();
        $this->data['groups'] = $this->groupModel->getAllGroups();
        $this->loadView('Template/header');
        $this->loadView('Default/teacher');
        $this->loadView('Template/footer');
    }

    /**
     * @throws ViewLoaderException
     */
    private function loadStudentPage(): void
    {
        $this->data['schedule'] = $this->schedulerModel->getSchedule(classId:$this->currentUser->getClassId() ?? null, groupId:$this->currentUser->getGroupId() ?? null);
        $this->data['classes'] = $this->classModel->getAllClasses();
        $this->data['editMode'] = false;
        $this->loadView('Template/header');
        $this->loadView('Default/student');
        $this->loadView('Schedule/schedule');
        $this->loadView('Template/footer');
    }

    /**
     * @throws ViewLoaderException
     */
    private function loadEditSchedulePage(): void
    {
        $parameters = $this->getParameters();
        $this->data['schedule'] = $this->schedulerModel->getSchedule(classId:$parameters['class'] ?? null, groupId:$parameters['group'] ?? null);
        $this->data['classes'] = $this->classModel->getAllClasses();
        $this->data['classId'] = $this->getParameters()['class'] ?? 0;
        $this->data['groupId'] = $this->getParameters()['group'] ?? 0;
        $this->loadView('Template/header');
        $this->loadView('Schedule/schedule');
        $this->loadView('Template/footer');
    }
}