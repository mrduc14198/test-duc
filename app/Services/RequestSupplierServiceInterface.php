<?php

namespace App\Services;

interface RequestSupplierServiceInterface
{
    public function store($data);

    public function getByCondition();

    public function accept($data, $requestSupplier);

    public function reject($data, $requestSupplier);
}
