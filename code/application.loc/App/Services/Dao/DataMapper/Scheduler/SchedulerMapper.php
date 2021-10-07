<?php

namespace App\Services\Dao\DataMapper\Scheduler;

use App\Models\LoginModel;
use App\Services\Dto\SchedulerDto;
use PDO;
use PDOStatement;

class SchedulerMapper
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
    private PDOStatement|false $selectForClassStmt;

    /**
     * @var PDOStatement|false
     */
    private PDOStatement|false $selectForGroupStmt;

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
     * @var PDOStatement|false
     */
    private PDOStatement|false $selectLessonStmt;

    /**
     * @var PDOStatement|false
     */
    private PDOStatement|false $selectClassStmt;

    /**
     * @var PDOStatement|false
     */
    private PDOStatement|false $selectGroupStmt;

    /**
     * @var PDOStatement|false
     */
    private PDOStatement|false $selectByDayForGroupStmt;

    /**
     * @var PDOStatement|false
     */
    private PDOStatement|false $selectByDayForClassStmt;


    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $prefix = $_ENV['PGSQL_DB_SCHEME'];
        /*$this->selectForClassStmt = $pdo->prepare(
            "select * from $prefix.scheduler where class_id = :classId order by weekday"
        );*/
        $this->selectForClassStmt = $pdo->prepare(
            "select weekday,
                          l1.name as lesson1_name, 
                          l2.name as lesson2_name,
                          l3.name as lesson3_name, 
                          l4.name as lesson4_name,
                          l5.name as lesson5_name,
                          l6.name as lesson6_name,
                          l7.name as lesson7_name,
                          l8.name as lesson8_name
                    from scheduler s
                        left join lesson l1 on s.lesson1=l1.id
                        left join lesson l2 on s.lesson2=l2.id
                        left join lesson l3 on s.lesson3=l3.id
                        left join lesson l4 on s.lesson4=l4.id
                        left join lesson l5 on s.lesson5=l5.id
                        left join lesson l6 on s.lesson6=l6.id
                        left join lesson l7 on s.lesson7=l7.id
                        left join lesson l8 on s.lesson8=l8.id
                    where class_id = :classId"
        );

        $this->selectForGroupStmt = $pdo->prepare(
            "select weekday,
                          l1.name as lesson1_name, 
                          l2.name as lesson2_name,
                          l3.name as lesson3_name, 
                          l4.name as lesson4_name,
                          l5.name as lesson5_name,
                          l6.name as lesson6_name,
                          l7.name as lesson7_name,
                          l8.name as lesson8_name
                    from scheduler s
                        left join lesson l1 on s.lesson1=l1.id
                        left join lesson l2 on s.lesson2=l2.id
                        left join lesson l3 on s.lesson3=l3.id
                        left join lesson l4 on s.lesson4=l4.id
                        left join lesson l5 on s.lesson5=l5.id
                        left join lesson l6 on s.lesson6=l6.id
                        left join lesson l7 on s.lesson7=l7.id
                        left join lesson l8 on s.lesson8=l8.id
                    where group_id = :groupId"
        );
        $this->selectByDayForClassStmt = $pdo->prepare(
            "select * from $prefix.scheduler where weekday = :weekday and class_id = :classId"
        );
        $this->selectByDayForGroupStmt = $pdo->prepare(
            "select * from $prefix.scheduler where weekday = :weekday and group_id = :groupId"
        );
        $this->selectLessonStmt = $pdo->prepare(
            "select name from $prefix.lesson where id = :id"
        );
        $this->selectClassStmt = $pdo->prepare(
            "select name from $prefix.class where id = :id"
        );
        $this->selectGroupStmt = $pdo->prepare(
            "select name from $prefix.group where id = :id"
        );
        $this->insertStmt = $pdo->prepare(
            "insert into $prefix.scheduler (weekday, lesson1, lesson2, lesson3, lesson4, lesson5, lesson6, lesson7, lesson8, class_id, group_id, created_by, created_at) 
                            values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $this->updateStmt = $pdo->prepare(
            "update $prefix.scheduler set weekday = :weekday, 
                                   lesson1 = :lesson1,
                                   lesson2 = :lesson2,
                                   lesson3 = :lesson3,
                                   lesson4 = :lesson4,
                                   lesson5 = :lesson5,
                                   lesson6 = :lesson6,
                                   lesson7 = :lesson7,
                                   lesson8 = :lesson8,
                                   class_id = :class_id, 
                                   group_id = :group_id,
                                   updated_by = :updated_by,
                                   updated_at = :updated_at
                   where id = :id"
        );
        $this->deleteStmt = $pdo->prepare("delete from $prefix.scheduler where id = :id");
    }

    /**
     * @param int $id
     * @return Scheduler
     */
    public function findById(int $id): Scheduler
    {
        $this->selectStmt->setFetchMode(PDO::FETCH_CLASS, SchedulerDto::class);
        $this->selectStmt->execute(['id' => $id]);
        $scheduler = $this->selectStmt->fetch();
        if ($scheduler === false) {
            return new Scheduler();
        }
        return new Scheduler($scheduler);
    }

    /**
     * @param SchedulerDto $data
     * @return Scheduler
     */
    public function insert(SchedulerDto $data): Scheduler
    {
        $data->created_at = date('Y-m-d H:i:s');
        $data->created_by = (new LoginModel())->getCurrentUser()->getId();
        $this->insertStmt->execute([
            $data->weekday,
            $data->lesson1,
            $data->lesson2,
            $data->lesson3,
            $data->lesson4,
            $data->lesson5,
            $data->lesson6,
            $data->lesson7,
            $data->lesson8,
            $data->class_id,
            $data->group_id,
            $data->created_by,
            $data->created_at,
        ]);
        $data->id = $this->pdo->lastInsertId();
        return new Scheduler($data);
    }

    /**
     * @param Scheduler $scheduler
     * @return bool
     */
    public function update(Scheduler $scheduler): bool
    {
        return $this->updateStmt->execute([
            'id'                => $scheduler->getId(),
            'weekday'           => $scheduler->getWeekday(),
            'lesson1'           => $scheduler->getLesson1(),
            'lesson2'           => $scheduler->getLesson2(),
            'lesson3'           => $scheduler->getLesson3(),
            'lesson4'           => $scheduler->getLesson4(),
            'lesson5'           => $scheduler->getLesson5(),
            'lesson6'           => $scheduler->getLesson6(),
            'lesson7'           => $scheduler->getLesson7(),
            'lesson8'           => $scheduler->getLesson8(),
            'updated_at'        => date('Y-m-d H:i:s'),
            'updated_by'        => $scheduler->getUpdatedBy(),
            'class_id'          => $scheduler->getClassId(),
            'group_id'          => $scheduler->getGroupId(),
        ]);
    }

    /**
     * @param Scheduler $scheduler
     * @return Scheduler|bool
     */
    public function save(Scheduler $scheduler): Scheduler|bool
    {
        return (empty($scheduler->getId()))
            ? $this->insert(new SchedulerDto($scheduler))
            : $this->update($scheduler);
    }

    /**
     * @param int $classId
     * @return array
     */
    public function findForClass(int $classId): array
    {
        $this->selectForClassStmt->execute(['classId' => $classId]);
        return $this->selectForClassStmt->fetchAll(PDO::FETCH_CLASS, SchedulerDto::class);
    }

    /**
     * @param int $weekday
     * @param int $classId
     * @return Scheduler
     */
    public function findByDayForClass(int $weekday, int $classId): Scheduler
    {
        $this->selectByDayForClassStmt->setFetchMode(PDO::FETCH_CLASS, SchedulerDto::class);
        $this->selectByDayForClassStmt->execute(['weekday' => $weekday, 'classId' => $classId]);
        $scheduler = $this->selectByDayForClassStmt->fetch();
        if ($scheduler == false) {
            return new Scheduler();
        }
        return new Scheduler($scheduler);
    }


    /**
     * @param int $groupId
     * @return array
     */
    public function findForGroup(int $groupId): array
    {
        $this->selectForGroupStmt->execute(['groupId' => $groupId]);
        return $this->selectForGroupStmt->fetchAll(PDO::FETCH_CLASS, SchedulerDto::class);
    }

    /**
     * @param int $weekday
     * @param int $groupId
     * @return Scheduler
     */
    public function findByDayForGroup(int $weekday, int $groupId): Scheduler
    {
        $this->selectByDayForGroupStmt->setFetchMode(PDO::FETCH_CLASS, SchedulerDto::class);
        $this->selectByDayForGroupStmt->execute(['weekday' => $weekday, 'groupId' => $groupId]);
        $scheduler = $this->selectByDayForGroupStmt->fetch();
        if ($scheduler === false) {
            return new Scheduler();
        }
        return new Scheduler($scheduler);
    }

    /**
     * @param array $schedule
     * @return bool
     */
    public function saveSchedule(array $schedule): bool
    {
        $this->pdo->beginTransaction();
        foreach ($schedule as $scheduler) {
            $this->save($scheduler);
        }
        return $this->pdo->commit();
    }

}