<?php

namespace App\Services\Dto;

/**
 * Class UserDto
 *
 * содержит поля из таблицы 'user'
 *
 * @package Services\Dto
 */
class UserDto extends AbstractDto
{
    public ?int $id = null;
    public ?string $login = null;
    public ?string $password = null;
    public ?string $first_name = null;
    public ?string $middle_name = null;
    public ?string $last_name = null;
    public ?string $created_at = null;
    public ?string $updated_at = null;
    public ?int $role_id = null;
    public ?int $class_id = null;
    public ?int $group_id = null;
    public ?string $role = null;
    public ?string $class = null;
    public ?string $group = null;
}
