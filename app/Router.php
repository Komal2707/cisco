<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Router extends Model
{
    use SoftDeletes;

    protected $table = 'routers';
    protected $fillable = [
        'sap_id',
        'hostname',
        'type',
        'loopback',
        'mac_address'
    ];
}
