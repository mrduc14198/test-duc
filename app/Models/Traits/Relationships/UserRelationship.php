<?php

namespace App\Models\Traits\Relationships;

use App\Models\RequestSupplier;

trait UserRelationship
{
    public function requestSupplier()
    {
        return $this->hasOne(RequestSupplier::class);
    }
}
