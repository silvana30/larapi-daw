<?php

namespace Api\Users\Services;

use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Events\Dispatcher;
use Api\Users\Exceptions\UserNotFoundException;
use Api\Users\Events\UserWasCreated;
use Api\Users\Events\UserWasDeleted;
use Api\Users\Events\UserWasUpdated;
use Api\Users\Repositories\DoctorRepository;

class DoctorService
{
    private $auth;

    private $database;

    private $dispatcher;

    private $doctorRepository;

    public function __construct(
        AuthManager $auth,
        DatabaseManager $database,
        Dispatcher $dispatcher,
        DoctorRepository $doctorRepository
    )
    {
        $this->auth = $auth;
        $this->database = $database;
        $this->dispatcher = $dispatcher;
        $this->doctorRepository = $doctorRepository;
    }

    public function getAll($options = [])
    {
        $doctors = $this->doctorRepository->get($options);
        foreach ($doctors as $doctor) {
            $doctor->poza_profil = base64_encode($doctor->poza_profil);
        }
        return $doctors;
    }

    public function getById($doctorId, array $options = [])
    {
        $doctor = $this->getRequestedDoctor($doctorId);

        return $doctor;
    }

    public function getByMedicalUnit($unitId, array $options = [])
    {
        $doctor = $this->doctorRepository->getByMedicalUnit($unitId);

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

    public function upload($doctorId, $data)
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
