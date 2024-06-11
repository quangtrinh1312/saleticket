<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, Filterable, HasRoles;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'password',
        'link',
        'account',
        'acpass',
        'username_api',
        'password_api', 
        'pattern', 
        'serial', 
        'cus_name',
        'prod_name',
        'address',
        'price',
        'mst',
        'address_user',
        'number_max',
        'number',
        'api',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function tickers() {

        return $this->hasMany(Ticker::class, 'user_id');

    }
    function role() {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
