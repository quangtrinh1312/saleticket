<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticker extends Model
{
    use SoftDeletes;

    protected $table = 'tickers';

    protected $fillable = [

        'address',
        'number_bill_number',
        'number_bill_string',
        'username',
        'pattern',
        'serial',
        'cus_name',
        'prod_name',
        'price',
        'status',
        'user_id',
        'check',
        'trading_code',
        'mst',
        'ticker_group_id',
    ];

    function user() {

        return $this->belongsTo(User::class, 'user_id')->withTrashed();

    }

    function status() {

        return $this->belongsTo(StatusTicker::class, 'status_id')->withTrashed();

    }
}
