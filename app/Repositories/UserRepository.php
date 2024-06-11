<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RequestResetPass;

class UserRepository extends AbstractRepository
{
    public function getModel()
    {
        return User::class;
    }

    public function getListByRole($role_id) {
        return $this->model->where('role_id',$role_id)->get();
    }
    //change role_id of user to 1 in database
    public function changeRole($id, $role_id) {
        $user = $this->model->find($id);
        $user->role_id = $role_id;
        $user->save();
    }
}
