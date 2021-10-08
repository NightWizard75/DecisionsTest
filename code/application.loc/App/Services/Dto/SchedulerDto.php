<?php

namespace App\Services\Dto;

class SchedulerDto extends AbstractDto
{
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
}