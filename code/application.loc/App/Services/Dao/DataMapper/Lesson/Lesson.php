<?php

namespace App\Services\Dao\DataMapper\Lesson;

use App\Services\Dto\LessonDto;
use App\Services\Traits\HasObjectTools;

class Lesson
{
    use HasObjectTools;

    private ?int $id = null;
    private ?string $name = null;

    /**
     * @param LessonDto $lessonDto
     */
    public function __construct(LessonDto $lessonDto)
    {
        $this->id = $lessonDto->id;
        $this->name = $lessonDto->name;
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