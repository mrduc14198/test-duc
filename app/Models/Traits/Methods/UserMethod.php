<?php

namespace App\Models\Traits\Methods;

use App\Models\RequestSupplier;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait UserMethod
{
    public function is_pending_request_supplier()
    {
        return isset($this->requestSupplier) && $this->requestSupplier->status == RequestSupplier::$requestSupplierStatus['pending'];
    }

    public function is_rejected_request_supplier()
    {
        return isset($this->requestSupplier) && $this->requestSupplier->status == RequestSupplier::$requestSupplierStatus['rejected'];
    }

    public function is_show_request_supplier_button()
    {
        return Auth::check() && !isset($this->requestSupplier);
    }

    public function is_admin()
    {
        return $this->role == User::$userRoles['admin'];
    }

    public function is_customer()
    {
        return $this->type == User::$userTypes['customer'];
    }

    public function is_supplier()
    {
        return $this->type == User::$userTypes['supplier'];
    }

    public function get_user_type_label()
    {
        if ($this->is_supplier()) {
            return __('labels.all.supplier_type_label');
        } else if ($this->is_customer()) {
            return __('labels.all.customer_type_label');
        }
    }

    public function get_role_label()
    {
        if ($this->role == User::$userRoles['admin']) {
            return __('labels.all.admin');
        } else if ($this->role == User::$userRoles['user']) {
            return __('labels.all.user');
        }
    }
}
