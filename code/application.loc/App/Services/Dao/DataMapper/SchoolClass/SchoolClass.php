<?php

namespace App\Services\Dao\DataMapper\SchoolClass;

use App\Services\Dto\ClassDto;
use App\Services\Traits\HasObjectTools;

class SchoolClass
{
    use HasObjectTools;

    private ?int $id = null;
    private ?string $name = null;

    /**
     * @param ClassDto $SchoolDto
     */
    public function __construct(ClassDto $SchoolDto)
    {
        $this->id = $SchoolDto->id;
        $this->name = $SchoolDto->name;
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