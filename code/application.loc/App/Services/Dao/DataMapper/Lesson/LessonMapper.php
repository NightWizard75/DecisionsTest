<?php

namespace App\Services\Dao\DataMapper\Lesson;

use App\Services\Dto\LessonDto;
use PDO;
use PDOStatement;

class LessonMapper
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
    private PDOStatement|false $selectAllStmt;

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
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $prefix = $_ENV['PGSQL_DB_SCHEME'];
        $this->selectStmt = $pdo->prepare(
            "select * from $prefix.lesson where id = :id"
        );
        $this->selectAllStmt = $pdo->prepare(
            "select id, name from $prefix.lesson"
        );
        $this->insertStmt = $pdo->prepare(
            "insert into $prefix.lesson (name) 
                            values (?)"
        );
        $this->updateStmt = $pdo->prepare(
            "update $prefix.lesson set name = :name 
                   where id = :id"
        );
        $this->deleteStmt = $pdo->prepare("delete from $prefix.lesson where id = :id");
    }

    public function findById(int $id): Lesson
    {
        $this->selectStmt->setFetchMode(PDO::FETCH_CLASS, LessonDto::class);
        $this->selectStmt->execute(['id' => $id]);
        $lesson = $this->selectStmt->fetch();
        if ($lesson == false) {
            return new Lesson();
        }
        return new Lesson($lesson);
    }

    public function getAll(): array
    {
        $this->selectAllStmt->execute();
        return $this->selectAllStmt->fetchAll(PDO::FETCH_CLASS, LessonDto::class);
    }

}