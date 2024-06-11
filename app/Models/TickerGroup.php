<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TickerGroup extends Model
{
    protected $table = 'ticker_groups';

    protected $fillable = [
        'name',
        'number',
        'sum',
        'user_id',
        'qr_radom'
    ];

    function user(){
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }
}
