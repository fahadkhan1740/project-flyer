<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Flyer;

class FlyersController extends Controller
{
    public function create()
    {
        flash()->overlay('Welcome On board', 'Thank you for joining us');
        return view('pages.create');
    }

    public function store(Requests\FlyerFormRequest $request)
    {
        Flyer::create($request->all());

        // flash message
        flash()->success('Congrats', 'Flyer successfully created');

        return redirect()->back(); // temp
    }
}
