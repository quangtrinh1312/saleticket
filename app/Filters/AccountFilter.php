<?php

namespace App\Filters;

class AccountFilter extends QueryFilter
{
    protected $filterable = [
        'id',
        'username',
    ];
    
    public function filterName($name) {
        return $this->builder->where('name', 'like', '%' . $name . '%')->where('role_id',$role_id);
    }

    public function filterInfo($info) {
        return $this->builder->where('name', 'like', '%' . $info . '%')->orWhere('username', $info);
    }

    public function filterRole($role) {
        return $this->builder->where('role_id',$role);
    }
}

