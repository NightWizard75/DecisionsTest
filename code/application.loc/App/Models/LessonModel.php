<?php

namespace App\Models;

use App\Services\Dao\DataMapper\Lesson\Lesson;
use App\Services\Dao\LessonDaoService;

class LessonModel implements IModel
{
    /**
     * @var LessonDaoService
     */
    protected LessonDaoService $dataAccess;


    public function __construct()
    {
        $this->dataAccess = new LessonDaoService();
    }

    /**
     * @return array
     */
    public function getAllLessons(): array
    {
        return $this->dataAccess->getAll();
    }

    /**
     * @param $id
     * @return Lesson
     */
    public function getLesson($id): Lesson
    {
        return $this->dataAccess->getLesson($id);
    }
}