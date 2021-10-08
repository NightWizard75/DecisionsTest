<?php

namespace App\Models;

use App\Exceptions\ErrorCodes;
use App\Exceptions\User\InvalidRelationIdException;
use App\Services\Dao\SchedulerDaoService;
use JetBrains\PhpStorm\ArrayShape;


class SchedulerModel implements IModel
{
    /**
     * @var SchedulerDaoService
     */
    protected SchedulerDaoService $dataAccess;


    public function __construct()
    {
        $this->dataAccess = new SchedulerDaoService();
    }

    /**
     * @param int $classId
     * @return array
     */
    public function getSchedulerForClass(int $classId): array
    {
        return array_reduce(
            $this->dataAccess->getScheduleForClass($classId),
            function ($carry, $item) {
                $carry[$item->weekday] = [
                    'lesson1' => $item->lesson1_name,
                    'lesson2' => $item->lesson2_name,
                    'lesson3' => $item->lesson3_name,
                    'lesson4' => $item->lesson4_name,
                    'lesson5' => $item->lesson5_name,
                    'lesson6' => $item->lesson6_name,
                    'lesson7' => $item->lesson7_name,
                    'lesson8' => $item->lesson8_name,
                ];
                return $carry;
            },
            []
        );
    }

    /**
     * @param int $groupId
     * @return array
     */
    public function getSchedulerForGroup(int $groupId): array
    {
        return array_reduce(
            $this->dataAccess->getScheduleForGroup($groupId),
            function ($carry, $item) {
                $carry[$item->weekday] = [
                    'lesson1' => $item->lesson1_name,
                    'lesson2' => $item->lesson2_name,
                    'lesson3' => $item->lesson3_name,
                    'lesson4' => $item->lesson4_name,
                    'lesson5' => $item->lesson5_name,
                    'lesson6' => $item->lesson6_name,
                    'lesson7' => $item->lesson7_name,
                    'lesson8' => $item->lesson8_name,
                ];
                return $carry;
            },
            []
        );
    }

    /**
     * @param null $classId
     * @param null $groupId
     * @return array
     */
    public function getSchedule($classId = null, $groupId = null): array
    {
        $schedule1 = !is_null($classId)
            ? $this->getSchedulerForClass($classId)
            : [];
        $schedule2 = !is_null($groupId)
            ? $this->getSchedulerForGroup($groupId)
            : [];
        foreach ($schedule1+$schedule2 as $day => $lessons) {
            foreach ($lessons as $key => $lesson) {
                $schedule1[$day][$key] = $schedule2[$day][$key] ?? $lesson;
            }
        }
        return $schedule1;
    }

    /**
     * @throws InvalidRelationIdException
     */
    public function saveSchedule(array $schedule): bool
    {
        return $this->dataAccess->saveSchedule($this->prepareSchedule($schedule));
    }

    /**
     * @param array $data
     * @return array
     * @throws InvalidRelationIdException
     */
    private function prepareSchedule(array $data): array
    {
        $data = $this->transformData($data);
        $relation = $this->getRelation($data);
        $preparedScheduler = [];
        foreach ($data as $day => $lessons) {
            $scheduleFoDay = match ($relation['type']) {
                'class' => $this->dataAccess->getSchedulerByDayForClass($day, $relation['id'])
                    ->setClassId($relation['id'])
                    ->setWeekday($day),
                'group' => $this->dataAccess->getSchedulerByDayForGroup($day, $relation['id'])
                    ->setGroupId($relation['id'])
                    ->setWeekday($day),
            };
            foreach ($lessons as $number => $lesson) {
                $scheduleFoDay->{'set'.$number}($lesson != 0 ? $lesson : null);
            }
            $preparedScheduler[] = $scheduleFoDay;
        }
        return $preparedScheduler;
    }

    /**
     * @param array $data
     * @return array
     */
    private function transformData(array $data): array
    {
        $result = [];
        foreach ($data as $key => $value) {
            $parseKey = explode('_', $key);
            $result[$parseKey[1]][$parseKey[0]] = $value;
        }
        return $result;
    }

    /**
     * @param array $data
     * @return array
     * @throws InvalidRelationIdException
     */
    #[ArrayShape(['type' => "string", 'id' => "mixed"])]
    private function getRelation(array &$data): array
    {
        if (isset($data['id'])) {
            $id = $data['id'];
            unset($data['id']);
            // В массиве $id находятся связи расписания с классом и группой. В зависимости для кого это расписание пришло.
            // Выделяется первый ключ, не равный 0.
            // На случай если кроме класса и группы, расписание будет еще для чего-нибудь.
            // Теоретически групп тоже может быть несколько, но это уже другая история.
            match (array_key_first(array_slice(array_diff($id,[0]),0,1))) {
                'class' => $relation = ['type' => 'class', 'id' => $id['class']],
                'group' => $relation = ['type' => 'group', 'id' => $id['group']],
                default => throw new InvalidRelationIdException('User does not have relation such as: ' . array_key_first($id), ErrorCodes::getCode(InvalidRelationIdException::class)),
            };
        } else {
            throw new InvalidRelationIdException('User must have a relation. Nothing given', ErrorCodes::getCode(InvalidRelationIdException::class));
        }
        return $relation;
    }
}