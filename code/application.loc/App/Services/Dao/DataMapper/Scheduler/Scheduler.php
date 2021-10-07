<?php

namespace App\Services\Dao\DataMapper\Scheduler;

use App\Services\Dto\SchedulerDto;
use App\Services\Traits\HasObjectTools;

class Scheduler
{
    use HasObjectTools;

    public ?int $id = null;
    public ?string $weekday = null;
    public ?int $lesson1 = null;
    public ?int $lesson2 = null;
    public ?int $lesson3 = null;
    public ?int $lesson4 = null;
    public ?int $lesson5 = null;
    public ?int $lesson6 = null;
    public ?int $lesson7 = null;
    public ?int $lesson8 = null;
    public ?int $class_id = null;
    public ?int $group_id = null;
    public ?string $created_at = null;
    public ?int $created_by = null;
    public ?string $updated_at = null;
    public ?int $updated_by = null;
    public ?string $class = null;
    public ?string $group = null;
    public ?string $lesson1_name = null;
    public ?string $lesson2_name = null;
    public ?string $lesson3_name = null;
    public ?string $lesson4_name = null;
    public ?string $lesson5_name = null;
    public ?string $lesson6_name = null;
    public ?string $lesson7_name = null;
    public ?string $lesson8_name = null;

    /**
     * @param SchedulerDto|null $schedulerDto
     */
    public function __construct(SchedulerDto $schedulerDto = null)
    {
        if (is_null($schedulerDto)){
            return;
        }
        $this->id = $schedulerDto->id;
        $this->weekday = $schedulerDto->weekday;
        $this->lesson1 = $schedulerDto->lesson1;
        $this->lesson2 = $schedulerDto->lesson2;
        $this->lesson3 = $schedulerDto->lesson3;
        $this->lesson4 = $schedulerDto->lesson4;
        $this->lesson5 = $schedulerDto->lesson5;
        $this->lesson6 = $schedulerDto->lesson6;
        $this->lesson7 = $schedulerDto->lesson7;
        $this->lesson8 = $schedulerDto->lesson8;
        $this->class_id = $schedulerDto->class_id;
        $this->group_id = $schedulerDto->group_id;
        $this->created_at = $schedulerDto->created_at;
        $this->created_by = $schedulerDto->created_by;
        $this->updated_at = $schedulerDto->updated_at;
        $this->updated_by = $schedulerDto->updated_by;
        $this->class = $schedulerDto->class;
        $this->group = $schedulerDto->group;
        $this->lesson1_name = $schedulerDto->lesson1_name;
        $this->lesson2_name = $schedulerDto->lesson2_name;
        $this->lesson3_name = $schedulerDto->lesson3_name;
        $this->lesson4_name = $schedulerDto->lesson4_name;
        $this->lesson5_name = $schedulerDto->lesson5_name;
        $this->lesson6_name = $schedulerDto->lesson6_name;
        $this->lesson7_name = $schedulerDto->lesson7_name;
        $this->lesson8_name = $schedulerDto->lesson8_name;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Scheduler
     */
    public function setId(?int $id): Scheduler
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWeekday(): ?string
    {
        return $this->weekday;
    }

    /**
     * @param string|null $weekday
     * @return Scheduler
     */
    public function setWeekday(?string $weekday): Scheduler
    {
        $this->weekday = $weekday;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getLesson1(): ?int
    {
        return $this->lesson1;
    }

    /**
     * @param int|null $lesson1
     * @return Scheduler
     */
    public function setLesson1(?int $lesson1): Scheduler
    {
        $this->lesson1 = $lesson1;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getLesson2(): ?int
    {
        return $this->lesson2;
    }

    /**
     * @param int|null $lesson2
     * @return Scheduler
     */
    public function setLesson2(?int $lesson2): Scheduler
    {
        $this->lesson2 = $lesson2;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getLesson3(): ?int
    {
        return $this->lesson3;
    }

    /**
     * @param int|null $lesson3
     * @return Scheduler
     */
    public function setLesson3(?int $lesson3): Scheduler
    {
        $this->lesson3 = $lesson3;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getLesson4(): ?int
    {
        return $this->lesson4;
    }

    /**
     * @param int|null $lesson4
     * @return Scheduler
     */
    public function setLesson4(?int $lesson4): Scheduler
    {
        $this->lesson4 = $lesson4;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getLesson5(): ?int
    {
        return $this->lesson5;
    }

    /**
     * @param int|null $lesson5
     * @return Scheduler
     */
    public function setLesson5(?int $lesson5): Scheduler
    {
        $this->lesson5 = $lesson5;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getLesson6(): ?int
    {
        return $this->lesson6;
    }

    /**
     * @param int|null $lesson6
     * @return Scheduler
     */
    public function setLesson6(?int $lesson6): Scheduler
    {
        $this->lesson6 = $lesson6;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getLesson7(): ?int
    {
        return $this->lesson7;
    }

    /**
     * @param int|null $lesson7
     * @return Scheduler
     */
    public function setLesson7(?int $lesson7): Scheduler
    {
        $this->lesson7 = $lesson7;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getLesson8(): ?int
    {
        return $this->lesson8;
    }

    /**
     * @param int|null $lesson8
     * @return Scheduler
     */
    public function setLesson8(?int $lesson8): Scheduler
    {
        $this->lesson8 = $lesson8;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getClassId(): ?int
    {
        return $this->class_id;
    }

    /**
     * @param int|null $class_id
     * @return Scheduler
     */
    public function setClassId(?int $class_id): Scheduler
    {
        $this->class_id = $class_id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getGroupId(): ?int
    {
        return $this->group_id;
    }

    /**
     * @param int|null $group_id
     * @return Scheduler
     */
    public function setGroupId(?int $group_id): Scheduler
    {
        $this->group_id = $group_id;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getCreatedAt(): ?int
    {
        return $this->created_at;
    }

    /**
     * @param int|null $created_at
     * @return Scheduler
     */
    public function setCreatedAt(?int $created_at): Scheduler
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCreatedBy(): ?string
    {
        return $this->created_by;
    }

    /**
     * @param string|null $created_by
     * @return Scheduler
     */
    public function setCreatedBy(?string $created_by): Scheduler
    {
        $this->created_by = $created_by;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getUpdatedAt(): ?int
    {
        return $this->updated_at;
    }

    /**
     * @param int|null $updated_at
     * @return Scheduler
     */
    public function setUpdatedAt(?int $updated_at): Scheduler
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUpdatedBy(): ?string
    {
        return $this->updated_by;
    }

    /**
     * @param string|null $updated_by
     * @return Scheduler
     */
    public function setUpdatedBy(?string $updated_by): Scheduler
    {
        $this->updated_by = $updated_by;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getClass(): ?string
    {
        return $this->class;
    }

    /**
     * @param string|null $class
     * @return Scheduler
     */
    public function setClass(?string $class): Scheduler
    {
        $this->class = $class;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGroup(): ?string
    {
        return $this->group;
    }

    /**
     * @param string|null $group
     * @return Scheduler
     */
    public function setGroup(?string $group): Scheduler
    {
        $this->group = $group;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLesson1Name(): ?string
    {
        return $this->lesson1_name;
    }

    /**
     * @param string|null $lesson1_name
     * @return Scheduler
     */
    public function setLesson1Name(?string $lesson1_name): Scheduler
    {
        $this->lesson1_name = $lesson1_name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLesson2Name(): ?string
    {
        return $this->lesson2_name;
    }

    /**
     * @param string|null $lesson2_name
     * @return Scheduler
     */
    public function setLesson2Name(?string $lesson2_name): Scheduler
    {
        $this->lesson2_name = $lesson2_name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLesson3Name(): ?string
    {
        return $this->lesson3_name;
    }

    /**
     * @param string|null $lesson3_name
     * @return Scheduler
     */
    public function setLesson3Name(?string $lesson3_name): Scheduler
    {
        $this->lesson3_name = $lesson3_name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLesson4Name(): ?string
    {
        return $this->lesson4_name;
    }

    /**
     * @param string|null $lesson4_name
     * @return Scheduler
     */
    public function setLesson4Name(?string $lesson4_name): Scheduler
    {
        $this->lesson4_name = $lesson4_name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLesson5Name(): ?string
    {
        return $this->lesson5_name;
    }

    /**
     * @param string|null $lesson5_name
     * @return Scheduler
     */
    public function setLesson5Name(?string $lesson5_name): Scheduler
    {
        $this->lesson5_name = $lesson5_name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLesson6Name(): ?string
    {
        return $this->lesson6_name;
    }

    /**
     * @param string|null $lesson6_name
     * @return Scheduler
     */
    public function setLesson6Name(?string $lesson6_name): Scheduler
    {
        $this->lesson6_name = $lesson6_name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLesson7Name(): ?string
    {
        return $this->lesson7_name;
    }

    /**
     * @param string|null $lesson7_name
     * @return Scheduler
     */
    public function setLesson7Name(?string $lesson7_name): Scheduler
    {
        $this->lesson7_name = $lesson7_name;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLesson8Name(): ?string
    {
        return $this->lesson8_name;
    }

    /**
     * @param string|null $lesson8_name
     * @return Scheduler
     */
    public function setLesson8Name(?string $lesson8_name): Scheduler
    {
        $this->lesson8_name = $lesson8_name;
        return $this;
    }
}