<?php

namespace App\Services\Dao;

use App\Exceptions\Connection\InvalidArgumentException;
use App\Providers\AppServiceProvider;
use App\Services\Dao\DataMapper\Scheduler\Scheduler;
use App\Services\Dao\DataMapper\Scheduler\SchedulerMapper;
use PDO;

class SchedulerDaoService
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
     * @param int|null $classId
     * @param int|null $groupId
     * @return Scheduler
     */
    public function getSchedule(int $classId = null, int $groupId = null): Scheduler
    {
        return (new SchedulerMapper($this->connection))->getScheduler($classId, $groupId);
    }

    /**
     * @param int $classId
     * @return array
     */
    public function getScheduleForClass(int $classId): array
    {
        return (new SchedulerMapper($this->connection))->findForClass($classId);
    }

    /**
     * @param int $groupId
     * @return array
     */
    public function getScheduleForGroup(int $groupId): array
    {
        return (new SchedulerMapper($this->connection))->findForGroup($groupId);
    }

    /**
     * @param int $weekday
     * @param int $classId
     * @return Scheduler
     */
    public function getSchedulerByDayForClass(int $weekday, int $classId): Scheduler
    {
        return (new SchedulerMapper($this->connection))->findByDayForClass($weekday, $classId);
    }

    /**
     * @param int $weekday
     * @param int $groupId
     * @return Scheduler
     */
    public function getSchedulerByDayForGroup(int $weekday, int $groupId): Scheduler
    {
        return (new SchedulerMapper($this->connection))->findByDayForGroup($weekday, $groupId);
    }

    /**
     * @param array $schedule
     * @return bool
     */
    public function saveSchedule(array $schedule): bool
    {
        return (new SchedulerMapper($this->connection))->saveSchedule($schedule);
    }

}