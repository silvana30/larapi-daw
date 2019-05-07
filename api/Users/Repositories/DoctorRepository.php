<?php

namespace Api\Users\Repositories;

use Api\Users\Models\Doctor;
use Api\Users\Models\DoctorMedicalUnit;
use Infrastructure\Database\Eloquent\Repository;

class DoctorRepository extends Repository
{
    public function getModel()
    {
        return new Doctor();
    }

    public function create(array $data)
    {
        $doctor = $this->getModel();
        $doctor['id'] = uniqid();
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

    public function upload(Doctor $doctor, $data)
    {
        $doctor->fill($data);

        $doctor->save();

        return $doctor;
    }

    public function getByMedicalUnit($unitId)
    {
        $doctors = [];
        $lista=DoctorMedicalUnit::where('medical_unit_id', $unitId)->get();

        foreach($lista as $legatura){
            $doc = Doctor::where('id', $legatura->doctor_id)->first();
            $doc->poza_profil = base64_encode($doc->poza_profil);
            array_push($doctors, $doc);
        }
        return $doctors;
    }

}
