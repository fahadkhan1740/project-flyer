<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Flyer;

class FlyersController extends Controller
{
    public function create()
    {
        return view('pages.create');
    }

    public function store(Requests\FlyerFormRequest $request)
    {
        Flyer::create($request->all());

        // flash message

        return redirect()->back();
    }
}
