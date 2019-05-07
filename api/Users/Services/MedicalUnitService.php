<?php

namespace Api\Users\Services;

use Api\Users\Repositories\MedicalUnitRepository;
use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Events\Dispatcher;
use Api\Users\Exceptions\UserNotFoundException;
use Api\Users\Events\UserWasCreated;
use Api\Users\Events\UserWasDeleted;
use Api\Users\Events\UserWasUpdated;
use Api\Users\Repositories\DoctorRepository;

class MedicalUnitService
{
    private $auth;

    private $database;

    private $dispatcher;

    private $medicalUnitRepository;

    public function __construct(
        AuthManager $auth,
        DatabaseManager $database,
        Dispatcher $dispatcher,
        MedicalUnitRepository $medicalUnitRepository
    ) {
        $this->auth = $auth;
        $this->database = $database;
        $this->dispatcher = $dispatcher;
        $this->medicalUnitRepository = $medicalUnitRepository;
    }

    public function getAll($options = [])
    {
        $medicalUnits= $this->medicalUnitRepository->get($options);


        foreach ($medicalUnits as $unit) {
            $unit->sigla = base64_encode($unit->sigla);
        }
        return $medicalUnits;
    }

    public function getById($unitId, array $options = [])
    {
        $unit = $this->getRequestedUnit($unitId);
        $unit->sigla = base64_encode($unit->sigla);
        return $unit;
    }

    public function create($data)
    {
        $unit = $this->medicalUnitRepository->create($data);

//        $this->dispatcher->fire(new DoctorWasCreated($doctor));

        return $unit;
    }

    public function update($doctorId, array $data)
    {
        $doctor = $this->getRequestedUnit($doctorId);

        $this->medicalUnitRepository->update($doctor, $data);

//        $this->dispatcher->fire(new DoctorWasUpdated($doctor));

        return $doctor;
    }

    public function delete($doctorId)
    {
        $doctor = $this->getRequestedUnit($doctorId);

        $this->medicalUnitRepository->delete($doctorId);

//        $this->dispatcher->fire(new DoctorWasDeleted($doctor));
    }

    private function getRequestedUnit($doctorId)
    {
        $doctor = $this->medicalUnitRepository->getById($doctorId);

        if (is_null($doctor)) {
            throw new UserNotFoundException();
        }

        return $doctor;
    }
}
