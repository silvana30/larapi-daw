<?php

namespace Api\Users\Repositories;

use Api\Users\Models\Doctor;
use Api\Users\Models\MedicalUnit;
use Infrastructure\Database\Eloquent\Repository;

class MedicalUnitRepository extends Repository
{
    public function getModel()
    {
        return new MedicalUnit();
    }

    public function create(array $data)
    {
        $unit = $this->getModel();

        $unit->fill($data);
        $unit->save();

        return $unit;
    }

    public function update(MedicalUnit $unit, array $data)
    {
        $unit->fill($data);

        $unit->save();

        return $unit;
    }
}
