<?php

namespace App\Http\Controllers\MyTraits;

use App\Flyer;
use Illuminate\Http\Request;

trait AuthorizesUsers {
    /*protected function userCreatedFlyer(Request $request)
    {
        return Flyer::where([
            'zip' => $request->zip,
            'street' => $request->street,
            'user_id' => Auth::user()->getId()
        ])->exists();
    }

    protected function unauthorized(Request $request)
    {
        if($request->ajax())
        {
            return response(['message' => 'No way, Not at all'], 403);
        }

        flash('No way, Not at all');

        return redirect('/');
    }*/

}
