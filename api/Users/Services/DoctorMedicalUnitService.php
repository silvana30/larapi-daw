<?php

namespace Api\Users\Services;

use Api\Users\Repositories\DoctorMedicalUnitRepository;
use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Events\Dispatcher;
use Api\Users\Exceptions\UserNotFoundException;
use Api\Users\Events\UserWasCreated;
use Api\Users\Events\UserWasDeleted;
use Api\Users\Events\UserWasUpdated;
use Api\Users\Repositories\DoctorRepository;

class DoctorMedicalUnitService
{
    private $auth;

    private $database;

    private $dispatcher;

    private $doctorRepository;

    public function __construct(
        AuthManager $auth,
        DatabaseManager $database,
        Dispatcher $dispatcher,
        DoctorMedicalUnitRepository $doctorRepository
    ) {
        $this->auth = $auth;
        $this->database = $database;
        $this->dispatcher = $dispatcher;
        $this->doctorRepository = $doctorRepository;
    }

    public function getAll($options = [])
    {
        return $this->doctorRepository->get($options);
    }

    public function getById($doctorId, array $options = [])
    {
        $doctor = $this->getRequestedDoctor($doctorId);

        return $doctor;
    }

    public function create($data)
    {
        $doctor = $this->doctorRepository->create($data);

//        $this->dispatcher->fire(new DoctorWasCreated($doctor));

        return $doctor;
    }

    public function update($doctorId, array $data)
    {
        $doctor = $this->getRequestedDoctor($doctorId);

        $this->doctorRepository->update($doctor, $data);

//        $this->dispatcher->fire(new DoctorWasUpdated($doctor));

        return $doctor;
    }
    public function upload($doctorId,  $data)
    {
        $doctor = $this->getRequestedDoctor($doctorId);

        $this->doctorRepository->update($doctor, $data);

//        $this->dispatcher->fire(new DoctorWasUpdated($doctor));

        return $doctor;
    }
    public function delete($doctorId)
    {
        $doctor = $this->getRequestedDoctor($doctorId);

        $this->doctorRepository->delete($doctorId);

//        $this->dispatcher->fire(new DoctorWasDeleted($doctor));
    }

    private function getRequestedDoctor($doctorId)
    {
        $doctor = $this->doctorRepository->getById($doctorId);

        if (is_null($doctor)) {
            throw new UserNotFoundException();
        }

        return $doctor;
    }
}
