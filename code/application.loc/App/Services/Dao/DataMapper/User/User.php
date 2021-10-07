<?php


namespace App\Services\Dao\DataMapper\User;


use App\Services\Dto\UserDto;
use App\Services\Traits\HasObjectTools;

/**
 * Class User
 *
 * Сущность для Пользователей
 *
 * @package Services\Dao\DataMapper\User
 */
class User
{
    use HasObjectTools;

    private ?int $id = null;
    private ?string $login = null;
    private ?string $password = null;
    private ?string $first_name = null;
    private ?string $middle_name = null;
    private ?string $last_name = null;
    private ?string $created_at = null;
    private ?string $updated_at = null;
    private ?string $role = null;
    private ?string $class = null;
    private ?string $group = null;
    private ?int $role_id = null;
    private ?int $class_id = null;
    private ?int $group_id = null;
    private array $propertyToArray = [
        'Id',
        'Login',
        'FirstName',
        'MiddleName',
        'LastName',
        'CreatedAt',
        'UpdatedAt',
        'RoleId',
        'ClassId',
        'GroupId',
        'SchoolClass',
        'Group'
    ];

    public function __construct(UserDto $user = null)
    {
        if (is_null($user)){
            return;
        }
        $this->id = $user->id;
        $this->login = $user->login;
        $this->password = $user->password;
        $this->first_name = $user->first_name;
        $this->middle_name = $user->middle_name;
        $this->last_name = $user->last_name;
        $this->created_at = $user->created_at;
        $this->updated_at = $user->updated_at;
        $this->role_id = $user->role_id;
        $this->class_id = $user->class_id;
        $this->group_id = $user->group_id;
        $this->role = $user->role;
        $this->class = $user->class;
        $this->group = $user->group;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getLogin(): ?string
    {
        return $this->login;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    /**
     * @return string|null
     */
    public function getMiddleName(): ?string
    {
        return $this->middle_name;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->created_at;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    /**
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @return string|null
     */
    public function getSchoolClass(): ?string
    {
        return $this->class;
    }

    /**
     * @return string|null
     */
    public function getGroup(): ?string
    {
        return $this->group;
    }

    /**
     * @return int|null
     */
    public function getRoleId(): ?int
    {
        return $this->role_id;
    }

    /**
     * @return int|null
     */
    public function getClassId(): ?int
    {
        return $this->class_id;
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
     * @return User
     */
    public function setGroupId(?int $group_id): User
    {
        $this->group_id = $group_id;
        return $this;
    }

    public function asArray(): array
    {
        $result = [];
        foreach ($this->propertyToArray as $property) {
            $result[$property] = $this->{'get' . $property}();
        }
        return $result;
    }
}