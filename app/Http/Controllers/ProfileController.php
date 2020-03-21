<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        return view('frontend.pages.profile.index');
    }

    public function update(UpdateProfileRequest $request, User $user)
    {
        $data = $request->only(['name', 'phone_number', 'email', 'password']);
        $user = $this->userService->update($data, $user);
        if (!$user) {
            return redirect()->route('profile.index')->with('error', __('alert.all.error'));
        }
        return redirect()->route('profile.index')->with('success', __('alert.all.success'));
    }
}
