<?php

namespace App\Repositories;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class PayMethodRepository extends AbstractRepository
{
    public function getModel()
    {
        return PaymentMethod::class;
    }
}
