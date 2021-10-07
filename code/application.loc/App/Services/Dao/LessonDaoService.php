<?php

namespace App\Services\Dao;


use App\Exceptions\Connection\InvalidArgumentException;
use App\Providers\AppServiceProvider;
use App\Services\Dao\DataMapper\Lesson\Lesson;
use App\Services\Dao\DataMapper\Lesson\LessonMapper;
use PDO;

class LessonDaoService
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
     * @return Lesson
     */
    public function getLesson(int $id = null): Lesson
    {
        return (new LessonMapper($this->connection))->findById($id);
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        return (new LessonMapper($this->connection))->getAll();
    }

}