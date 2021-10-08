<?php

namespace App\Services\Dao\DataMapper\Group;


use App\Services\Dto\GroupDto;
use PDO;
use PDOStatement;

class GroupMapper
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
            "select * from $prefix.group where id = :id"
        );
        $this->selectAllStmt = $pdo->prepare(
            "select id, name from $prefix.group"
        );
        $this->insertStmt = $pdo->prepare(
            "insert into $prefix.group (name) 
                            values (?)"
        );
        $this->updateStmt = $pdo->prepare(
            "update $prefix.group set name = :name 
                   where id = :id"
        );
        $this->deleteStmt = $pdo->prepare("delete from $prefix.group where id = :id");
    }

    public function findById(int $id): Group
    {
        $this->selectStmt->setFetchMode(PDO::FETCH_CLASS, GroupDto::class);
        $this->selectStmt->execute(['id' => $id]);
        $group = $this->selectStmt->fetch();
        if ($group == false) {
            return new Group();
        }
        return new Group($group);
    }

    public function getAll(): array
    {
        $this->selectAllStmt->execute();
        return $this->selectAllStmt->fetchAll(PDO::FETCH_CLASS, GroupDto::class);
    }


}