<?php

namespace Api\Users\Controllers;

use Api\Users\Requests\CreateMedDocRequest;
use Illuminate\Http\Request;
use Infrastructure\Http\Controller;
use Api\Users\Requests\CreateDoctorRequest;
use Api\Users\Services\DoctorService;

class DoctorController extends Controller
{
    private $doctorService;

    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }

    public function getAll()
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->doctorService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'doctors');

        return $this->response($parsedData);
    }

    public function getById($doctorId)
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->doctorService->getById($doctorId, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'doctor');

        return $this->response($parsedData);
    }
    public function getByMedicalUnit( CreateMedDocRequest $req){
        $resourceOptions = $this->parseResourceOptions();
        $data = $this->doctorService->getByMedicalUnit($req['id'],$resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'doctor');
        return $this->response($parsedData);

    }

    public function create(CreateDoctorRequest $request)
    {
        $data = $request->all();

        return $this->response($this->doctorService->create($data), 201);
    }

    public function update($doctorId, Request $request)
    {
        $data = $request->all();

        return $this->response($this->doctorService->update($doctorId, $data));
    }

    public function delete($doctorId)
    {
        return $this->response($this->doctorService->delete($doctorId));
    }
}
