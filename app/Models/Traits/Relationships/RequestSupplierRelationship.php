<?php

namespace App\Models\Traits\Relationships;

use App\Models\User;

trait RequestSupplierRelationship
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
