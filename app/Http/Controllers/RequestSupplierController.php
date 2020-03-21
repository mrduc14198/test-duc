<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetRequestSupplier;
use App\Http\Requests\StoreRequestSupplierRequest;
use App\Http\Requests\UpdateRequestSupplerRequest;
use App\Models\RequestSupplier;
use App\Repositories\RequestSupplierRepository;
use App\Repositories\UserRepository;
use App\Services\RequestSupplierService;
use App\Services\UserService;

class RequestSupplierController extends Controller
{
    protected $userService;
    protected $requestSupplierService;

    public function __construct(UserService $userService, RequestSupplierService $requestSupplierService)
    {
        $this->userService = $userService;
        $this->requestSupplierService = $requestSupplierService;
    }

    public function index(GetRequestSupplier $request)
    {
        $data = $request->all();
        $requestSuppliers = $this->requestSupplierService->getByCondition();

        return view('frontend.pages.request_suppliers.index', compact('requestSuppliers'));
    }

    public function store(StoreRequestSupplierRequest $request)
    {
        $data = $request->only('email', 'password');
        $result = $this->requestSupplierService->store($data);
        if (!$result) {
            return redirect()->back()->withErrors(__('alert.all.error'));
        } elseif ($result['status'] == FALSE && $result['message'] == __('alert.all.password_update_required')) {
            return redirect()->back()->withErrors(__('alert.all.password_update_required'));
        } elseif ($result['status'] == FALSE && $result['message'] == __('alert.all.wrong_credential')) {
            return redirect()->back()->withErrors(__('alert.all.wrong_credential'));
        } elseif ($result['status'] == FALSE && $result['message'] == __('alert.all.request-pending')) {
            return redirect()->back()->withErrors(__('alert.all.request-pending'));
        }
        return redirect()->back()->with('success', __('alert.all.success'));
    }

    public function accept(UpdateRequestSupplerRequest $request, RequestSupplier $requestSupplier)
    {
        $data['status'] = RequestSupplier::$requestSupplierStatus['accepted'];
        $requestSupplier = $this->requestSupplierService->accept($data, $requestSupplier);
        if ($requestSupplier) {
            return redirect()->back()->with('success', __('alert.all.success'));
        }
        return redirect()->back()->with('error', __('alert.all.error'));
    }

    public function reject(UpdateRequestSupplerRequest $request, RequestSupplier $requestSupplier)
    {
        $data['status'] = RequestSupplier::$requestSupplierStatus['rejected'];
        $requestSupplier = $this->requestSupplierService->reject($data, $requestSupplier);
        if ($requestSupplier) {
            return redirect()->back()->with('success', __('alert.all.success'));
        }
        return redirect()->back()->with('error', __('alert.all.error'));
    }
}
