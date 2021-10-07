<?php

namespace App\Models;

use App\Services\Dao\DataMapper\SchoolClass\SchoolClass;
use App\Services\Dao\ClassDaoService;

class ClassModel implements IModel
{
    /**
     * @var ClassDaoService
     */
    protected ClassDaoService $dataAccess;

    public function __construct()
    {
        $this->dataAccess = new ClassDaoService();
    }

    /**
     * @return array
     */
    public function getAllClasses(): array
    {
        return $this->dataAccess->getAll();
    }

    /**
     * @param $id
     * @return SchoolClass
     */
    public function getSchoolClass($id): SchoolClass
    {
        return $this->dataAccess->getSchoolClass($id);
    }
}