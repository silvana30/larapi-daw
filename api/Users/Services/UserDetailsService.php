<?php

namespace Api\Users\Services;

use Api\Users\Repositories\UserDetailsRepository;
use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Events\Dispatcher;
use Api\Users\Exceptions\UserNotFoundException;
use Api\Users\Events\UserWasCreated;
use Api\Users\Events\UserWasDeleted;
use Api\Users\Events\UserWasUpdated;
use Api\Users\Repositories\DoctorRepository;
use Auth;
class UserDetailsService
{
    private $auth;

    private $database;

    private $dispatcher;

    private $userDetailsRepository;

    public function __construct(
        AuthManager $auth,
        DatabaseManager $database,
        Dispatcher $dispatcher,
        UserDetailsRepository $userDetailsRepository
    ) {
        $this->auth = $auth;
        $this->database = $database;
        $this->dispatcher = $dispatcher;
        $this-> userDetailsRepository= $userDetailsRepository;
    }

    public function getAll($options = [])
    {
        $details=$this->userDetailsRepository->get($options);

        foreach ($details as $usr) {
            $usr->imag_profil = base64_encode($usr->imag_profil);
        }
        return $details;
    }

    public function getById($userId, array $options = [])
    {
        $user = $this->getRequestedUser($userId);
//        $user->imag_profil = base64_encode($user->imag_profil);
        return $user;
    }

    public function create($data)
    {
        $user = $this->userDetailsRepository->create($data);

//        $this->dispatcher->fire(new DoctorWasCreated($doctor));

        return $user;
    }

    public function update( array $data)
    {
        $userId = Auth::user()->id;
        $user = $this->getRequestedUser($userId);

        $this->userDetailsRepository->update($user, $data);

//        $this->dispatcher->fire(new DoctorWasUpdated($doctor));

        return $user;
    }
    public function upload( $data)
    {
        $userId = Auth::user()->id;
        $user = $this->getRequestedUser($userId);

        $this->userDetailsRepository->update($user, $data);

//        $this->dispatcher->fire(new DoctorWasUpdated($doctor));

        return $user;
    }


    public function delete($userId)
    {
        $user = $this->getRequestedUser($userId);

        $this->userDetailsRepository->delete($userId);

//        $this->dispatcher->fire(new DoctorWasDeleted($doctor));
    }

    private function getRequestedUser($userId)
    {
        $user = $this->userDetailsRepository->getById($userId);

        if (is_null($user)) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
