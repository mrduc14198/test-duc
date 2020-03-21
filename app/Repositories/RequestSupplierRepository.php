<?php

namespace App\Repositories;

use App\Models\RequestSupplier;

class RequestSupplierRepository extends EloquentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function getModel()
    {
        return RequestSupplier::class;
    }

}
