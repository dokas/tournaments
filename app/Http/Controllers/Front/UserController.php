<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserSettingsUpdateRequest;
use App\Repositories\UserRepository;

class UserController extends Controller
{

    /**
     * @var \App\Models\User
     */
    protected $user;

    /**
     * @var \App\Repositories\UserRepository
     */
    protected $userRepository;

    /**
     * Create a new UserController instance
     * @param \App\Repositories\UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->middleware(function ($request, $next) {
            $this->user= Auth::user();

            return $next($request);
        });
        $this->userRepository = $userRepository;
    }

    /**
     * User profile page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        $user = $this->user;
        return view(env('THEME').'.front.user.profile', compact('user'));
    }

    /**
     * User profile page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settings()
    {
        $user =  $this->user;
        return view(env('THEME').'.front.user.settings', compact('user'));
    }

    /**
     * Update user's profile
     * @param  \App\Http\Requests\UserSettingsUpdateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UserSettingsUpdateRequest $request)
    {
        $this->userRepository->updateSettings($request, $this->user);
        return back()->with('user-updated', __('Profile has been successfully updated'));
    }
}
