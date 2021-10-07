<?php

namespace App\Services\Dao\DataMapper\Group;

use App\Services\Dto\GroupDto;
use App\Services\Traits\HasObjectTools;

class Group
{
    use HasObjectTools;

    private ?int $id = null;
    private ?string $name = null;

    /**
     * @param GroupDto $groupDto
     */
    public function __construct(GroupDto $groupDto)
    {
        $this->id = $groupDto->id;
        $this->name = $groupDto->name;
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
    public function getName(): ?string
    {
        return $this->name;
    }

}