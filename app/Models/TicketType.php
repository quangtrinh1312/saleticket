<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketType extends Model
{
    //
    use SoftDeletes, Filterable;

    protected $table = 'ticket_types';

    protected $fillable = [

        'title',
        'name',
        'post_vat_price',
        'pre_vat_price',
        'vat',
        'note',
        'pattern',
        'serial',
        'is_actived',

    ];
}
