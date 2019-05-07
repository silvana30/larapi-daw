<?php

namespace Api\Users\Repositories;

use Api\Users\Models\Doctor;
use Infrastructure\Database\Eloquent\Repository;
use Api\Users\Models\DoctorMedicalUnit;
class DoctorMedicalUnitRepository extends Repository
{
    public function getModel()
    {
        return new DoctorMedicalUnit();
    }

    public function create(array $data)
    {
        $doctor = $this->getModel();
        $doctor['id']=uniqid();
        $doctor->fill($data);
        $doctor->save();

        return $doctor;
    }

    public function update(Doctor $doctor, array $data)
    {
        $doctor->fill($data);

        $doctor->save();

        return $doctor;
    }


}
