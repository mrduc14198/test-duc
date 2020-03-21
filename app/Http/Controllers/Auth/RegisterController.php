<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\StoreCustomerRegisterRequest;
use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $userService;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserService $userService)
    {
        $this->middleware('guest');
        $this->userService = $userService;
    }


    public function index()
    {
        return view('frontend.pages.auth.customer_register');
    }

    public function customerRegister(StoreCustomerRegisterRequest $request)
    {
        $data = $request->only(['name', 'email', 'password']);
        $user = $this->userService->customerRegister($data);

        if (!$user) {
            return redirect()->back()->with('error', __('auth.register.error'));
        }
        return redirect()->route('auth.login.index')->with('success', __('auth.register.success'));

    }
}
