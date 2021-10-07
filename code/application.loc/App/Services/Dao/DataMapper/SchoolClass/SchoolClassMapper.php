<?php

namespace App\Services\Dao\DataMapper\SchoolClass;


use App\Services\Dto\ClassDto;
use PDO;
use PDOStatement;


class SchoolClassMapper
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
            "select * from $prefix.class where id = :id"
        );
        $this->selectAllStmt = $pdo->prepare(
            "select id, name from $prefix.class"
        );
        $this->insertStmt = $pdo->prepare(
            "insert into $prefix.class (name) 
                            values (?)"
        );
        $this->updateStmt = $pdo->prepare(
            "update $prefix.class set name = :name 
                   where id = :id"
        );
        $this->deleteStmt = $pdo->prepare("delete from $prefix.class where id = :id");
    }

    public function findById(int $id): SchoolClass
    {
        $this->selectStmt->setFetchMode(PDO::FETCH_CLASS, ClassDto::class);
        $this->selectStmt->execute(['id' => $id]);
        $class = $this->selectStmt->fetch();
        if ($class == false) {
            return new SchoolClass();
        }
        return new SchoolClass($class);
    }

    public function getAll(): array
    {
        $this->selectAllStmt->execute();
        return $this->selectAllStmt->fetchAll(PDO::FETCH_CLASS, ClassDto::class);
    }


}