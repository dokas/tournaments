<?php

namespace App\Http\Controllers\Back;

use App\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{

    use Indexable;

    /**
     * Create a new UserController instance
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository) {
        $this->repository = $userRepository;

        $this->table = 'users';
    }

    /**
     * Update "new" field for user.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function updateSeen(User $user)
    {
        $user->ingoing->delete ();

        return response ()->json ();
    }

    /**
     * Update "valid" field for user.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function updateValid(User $user)
    {
        $user->valid = true;
        $user->save();

        return response ()->json ();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Role $role)
    {
        return view(env('THEME').'.back.users.edit', compact('user','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserUpdateRequest $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $this->repository->update($request, $user);

        return back()->with('user-updated', __('The user has been successfully updated'));
    }

    /**
     * Remove the user from storage.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete ();

        return response ()->json ();
    }
}
