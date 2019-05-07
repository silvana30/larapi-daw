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

class CommentsService
{
    private $auth;

    private $database;

    private $dispatcher;

    private $commentRepository;

    public function __construct(
        AuthManager $auth,
        DatabaseManager $database,
        Dispatcher $dispatcher,
        DoctorRepository $commentRepository
    ) {
        $this->auth = $auth;
        $this->database = $database;
        $this->dispatcher = $dispatcher;
        $this->commentRepository = $commentRepository;
    }

    public function getAll($options = [])
    {
        return $this->commentRepository->get($options);
    }

    public function getById($commentId, array $options = [])
    {
        $comment = $this->getRequestedComment($commentId);

        return $comment;
    }

    public function create($data)
    {
        $comment = $this->commentRepository->create($data);

//        $this->dispatcher->fire(new DoctorWasCreated($comment));

        return $comment;
    }

    public function update($commentId, array $data)
    {
        $comment = $this->getRequestedComment($commentId);

        $this->commentRepository->update($comment, $data);

//        $this->dispatcher->fire(new DoctorWasUpdated($comment));

        return $comment;
    }

    public function delete($commentId)
    {
        $comment = $this->getRequestedComment($commentId);

        $this->commentRepository->delete($commentId);

//        $this->dispatcher->fire(new DoctorWasDeleted($comment));
    }

    private function getRequestedComment($commentId)
    {
        $comment = $this->commentRepository->getById($commentId);

        if (is_null($comment)) {
            throw new UserNotFoundException();
        }

        return $comment;
    }
}
