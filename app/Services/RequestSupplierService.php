<?php

namespace App\Services;

use App\Models\RequestSupplier;
use App\Models\User;
use App\Repositories\RequestSupplierRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RequestSupplierService implements RequestSupplierServiceInterface
{

    protected $requestSupplierRepository;

    public function __construct(RequestSupplierRepository $requestSupplierRepository)
    {
        $this->requestSupplierRepository = $requestSupplierRepository;
    }

    public function store($data)
    {
        try {
            $query = User::query();
            $user = $query->where('email', $data['email'])->first();

            if (!$user->password) {
                return [
                    'status' => FALSE,
                    'message' => __('alert.all.password_update_required')
                ];
            }

            if (!$user || auth()->user()->email !== $user->email || (auth()->user()->password && !Hash::check($data['password'], $user->password))) {
                return [
                    'status' => FALSE,
                    'message' => __('alert.all.wrong_credential')
                ];
            }

            if (isset($user->requestSupplier) && $user->requestSupplier->status == RequestSupplier::$requestSupplierStatus['pending']) {
                return [
                    'status' => FALSE,
                    'message' => __('alert.all.request-pending')
                ];
            }

            $this->requestSupplierRepository->updateOrCreate(
                [
                    'user_id' => auth()->id(),
                ], [
                    'status' => RequestSupplier::$requestSupplierStatus['pending']
                ]
            );

            return TRUE;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return FALSE;
        }
    }

    public function getByCondition()
    {
        $query = RequestSupplier::query();

        return $query
            ->where('status', RequestSupplier::$requestSupplierStatus['pending'])
            ->orderBy('created_at')
            ->paginate(config('const.per_page'));
    }

    public function accept($data, $requestSupplier)
    {
        DB::beginTransaction();
        try {
            $this->requestSupplierRepository->update($requestSupplier->id,
                ['status' => $data['status']]
            );
            if ($requestSupplier) {
                $user = $requestSupplier->user;
                $user->update([
                    'type' => User::$userTypes['supplier']
                ]);
            }
            DB::commit();
            return $requestSupplier;
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error($e->getMessage());
            return false;
        }
    }

    public function reject($data, $requestSupplier)
    {
        try {
            $this->requestSupplierRepository->update($requestSupplier->id,
                ['status' => $data['status']]
            );
            return $requestSupplier;
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return false;
        }
    }
}
