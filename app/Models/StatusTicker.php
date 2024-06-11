<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StatusTicker extends Model
{
    use SoftDeletes;

    protected $table = 'status_tickers';

    protected $fillable = [

        'title'

    ];
}
