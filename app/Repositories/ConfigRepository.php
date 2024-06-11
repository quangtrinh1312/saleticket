<?php

namespace App\Repositories;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigRepository extends AbstractRepository
{
    public function getModel()
    {
        return Config::class;
    }

    public function getByApi($api) {
    	return $this->model->where('api', $api)->first();
    }
}
