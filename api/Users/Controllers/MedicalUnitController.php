<?php

namespace Api\Users\Controllers;

use Api\Users\Requests\CreateMedicalUnitRequest;
use Api\Users\Services\MedicalUnitService;
use Illuminate\Http\Request;
use Infrastructure\Http\Controller;
use Api\Users\Requests\CreateDoctorRequest;
use Api\Users\Services\DoctorService;

class MedicalUnitController extends Controller
{
    private $medicalUnitService;

    public function __construct(MedicalUnitService $medicalUnitService)
    {
        $this->medicalUnitService= $medicalUnitService;
    }

    public function getAll()
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->medicalUnitService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'medical_units');

        return $this->response($parsedData);
    }

    public function getById($doctorId)
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->medicalUnitService->getById($doctorId, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'doctor');

        return $this->response($parsedData);
    }

    public function create(CreateMedicalUnitRequest $request)
    {
        $data = $request->get('doctor', []);

        return $this->response($this->medicalUnitService->create($data), 201);
    }

    public function update($doctorId, Request $request)
    {
        $data = $request->get('doctor', []);

        return $this->response($this->medicalUnitService->update($doctorId, $data));
    }

    public function delete($doctorId)
    {
        return $this->response($this->medicalUnitService->delete($doctorId));
    }
}
