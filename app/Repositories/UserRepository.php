<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Role;
use App\Http\Requests\UserSettingsUpdateRequest;

class UserRepository
{
    /**
     * Get users collection paginate.
     *
     * @param  int  $nbrPages
     * @param  array  $parameters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll($nbrPages, $parameters)
    {
        return User::with (['ingoing','roles'])
            ->orderBy ($parameters['order'], $parameters['direction'])
            ->when (($parameters['role'] !== 'all'), function ($query) use ($parameters) {
                $query->whereHas('roles', function($query) use($parameters) {
                    $query->where('name', $parameters['role']);
                });
            })->when ($parameters['valid'], function ($query) {
                $query->whereValid (true);
            })->when ($parameters['confirmed'], function ($query) {
                $query->whereConfirmed (true);
            })->when ($parameters['new'], function ($query) {
                $query->has ('ingoing');
            })->paginate ($nbrPages);
    }

    /**
     * Update a user.
     *
     * @param  \App\Http\Requests\UserUpdateRequest $request
     * @param  \App\Models\User $user
     * @return void
     */
    public function update($request, $user)
    {
        $inputs = $request->all();

        if (isset($inputs['confirmed'])) {
            $inputs['confirmed'] = true;
        }

        if (isset($inputs['valid'])) {
            $inputs['valid'] = true;
        }

        $user->update($inputs);

        if(!$request->has('new') && $user->ingoing) {
            $user->ingoing->delete ();
        }

        $user->roles()->sync($request->roles);
    }

    /**
     * Update a user from his settings page
     * @param \App\Http\Requests\UserSettingsUpdateRequest $request
     * @param \App\Models\User $user
     */
    public function updateSettings(UserSettingsUpdateRequest $request, User $user)
    {
        $data = $request->all();
        if(empty($request->password)) {
            $data = $request->except('password');
        } else {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);
    }
}

