<?php

namespace Api\Users\Repositories;

use Api\Users\Models\User;
use Api\Users\Models\UserDetails;
use Infrastructure\Database\Eloquent\Repository;

class UserDetailsRepository extends Repository
{
    public function getModel()
    {
        return new UserDetails();
    }

    public function create(array $data)
    {
        $user = $this->getModel();

//        $user->fill($data);
//
        $user['id']=$data["id"];
        $user['nume']=$data["nume"];
        $user['afectiune']=$data["afectiune"];
        $user->save();

        return $user;
    }

    public function upload(UserDetails $user, $data)
    {
//        $user->fill($data);
        $user['imag_profil']=$data;
        $user->save();

        return $user;
    }

    public function update(UserDetails $user, array $data)
    {
        $user->fill($data);

        $user->save();

        return $user;
    }
}
