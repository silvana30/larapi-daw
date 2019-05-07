<?php

namespace Api\Users\Controllers;

use Api\Users\Requests\CreateCommentsRequest;
use Api\Users\Services\CommentsService;
use Illuminate\Http\Request;
use Infrastructure\Http\Controller;
use Api\Users\Requests\CreateDoctorRequest;
use Api\Users\Services\DoctorService;

class CommentsController extends Controller
{
    private $commentService;

    public function __construct(CommentsService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function getAll()
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->commentService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'comments');

        return $this->response($parsedData);
    }

    public function getById($commentId)
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->commentService->getById($commentId, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'comment');

        return $this->response($parsedData);
    }

    public function create(CreateCommentsRequest $request)
    {
        $data = $request->all();

        return $this->response($this->commentService->create($data), 201);
    }

    public function update($commentId, Request $request)
    {
        $data = $request->all();

        return $this->response($this->commentService->update($commentId, $data));
    }

    public function delete($commentId)
    {
        return $this->response($this->commentService->delete($commentId));
    }
}
