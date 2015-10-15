<?php

namespace App\Http\Controllers\Traits;

use App\Flyer;
use Illuminate\Http\Request;

/**
 * AUTHORIZATION OPTION 1
 */
trait AuthorizesUsers {

    /**
     * Has this user created flyer.
     *
     * @param Request $request
     * @return bool
     */
    protected function userCreatedFlyer(Request $request)
    {
        return Flyer::where([
            'zip' => $request->zip,
            'street' => $request->street,
            'user_id' => $this->user->id
        ])->exists();
    }

    /**
     * Unauthorized photo adding.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function unauthorized(Request $request)
    {
        if ($request->ajax()) {
            return response(['message' => 'No way.'], 403);
        }

        flash('No way.');

        return redirect('/');
    }

}
