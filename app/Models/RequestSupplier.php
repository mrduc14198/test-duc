<?php

namespace App\Models;

use App\Models\Traits\Relationships\RequestSupplierRelationship;
use Illuminate\Database\Eloquent\Model;

class RequestSupplier extends Model
{
    use RequestSupplierRelationship;

    protected $table = 'request_suppliers';

    protected $fillable = [
        'user_id',
        'status'
    ];


    public static $requestSupplierStatus = [
        'pending'  => 0,
        'accepted' => 1,
        'rejected' => 2
    ];

    public static $getKeyRequestSupplierStatus = [
        0 => 'pending',
        1 => 'accepted',
        2 => 'rejected',
    ];

}
