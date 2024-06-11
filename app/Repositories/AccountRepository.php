<?php

namespace App\Repositories;

use App\Models_12345\Account;
use Illuminate\Http\Request;
use App\Http\Requests\RequestResetPass;

class AccountRepository extends AbstractRepository
{
    public function getModel()
    {
        return Account::class;
    }

    public function getRoles() {
        $roles = $this->model->select('role')->groupBy('role')->get();
        return $roles;
    }

    public function search($search, $role) {
        $accounts = $this->model->orderBy('id', 'DESC')
                        ->where('role', $role)
                        ->orWhere('fullname', $search)
                        ->orWhere('username', $search)
                        ->orWhere('email', $search)
                        ->orWhere('phone_number', $search);
        return $accounts;
    }

    public function getListByRoleParentID($parent_id) {

        $accounts = $this->model->select()
        ->where('role', 'qlv');

        if ($parent_id != 0) {

            $accounts = $accounts->where('parent_id', $parent_id);

        }

        $accounts = $accounts->get();

        return $accounts;



    }

    public function getProtector() {
        $protectors = $this->model->where('role', 'protector')->whereNotNull('ktx')->withTrashed()->get();
        return $protectors;
    }
}
