<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostLoginRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $userService;
    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
        $this->userService = $userService;
    }

    public function index()
    {
        return view('frontend.pages.auth.login');
    }

    public function login(PostLoginRequest $request)
    {
        $data = $request->only(['email', 'password']);
        if ($this->userService->login($data)){
            return redirect()->route('home');
        }
        return redirect()->back()->withErrors(__('alert.all.wrong_credential'));
    }

    public function logout()
    {
        try {
            if (auth()->check()) {
                auth()->logout();
                return redirect()->route('home');
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
    }

    public function redirectToProvider($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        $createdUser = $this->userService->createSocialUser($user, $provider);
        if ($createdUser) {
            Auth::login($createdUser);
        }

        return redirect()->route('home');
    }
}
