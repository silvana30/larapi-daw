<?php

namespace Api\Users\Repositories;

use Api\Users\Models\Comments;
use Api\Users\Models\Doctor;
use Infrastructure\Database\Eloquent\Repository;

class CommentsRepository extends Repository
{
    public function getModel()
    {
        return new Comments();
    }

    public function create(array $data)
    {
        $comment = $this->getModel();
        $comment['id']=uniqid();
        $comment->fill($data);
        $comment->save();

        return $comment;
    }

    public function update(Comments $comment, array $data)
    {
        $comment->fill($data);

        $comment->save();

        return $comment;
    }
}
