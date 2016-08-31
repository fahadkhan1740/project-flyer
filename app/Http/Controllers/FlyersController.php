<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Flyer;
use App\Photo;
use Illuminate\Http\UploadedFile;

class FlyersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

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

    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street);

        return view('flyers.show', compact('flyer'));
    }

    public function addPhoto($zip, $street, Request $request)
    {
        $this->validate($request,[
            'photo' => 'required|mimes:jpg,jpeg,png,bmp'
        ]);

        $photo = $this->makePhoto($request->file('photo'));

        Flyer::locatedAt($zip, $street)->addPhoto($photo);

        return 'Done';
    }

    protected function makePhoto(UploadedFile $file)
    {
       //return Photo::fromForm($file)->store($file);

        return Photo::named($file->getClientOriginalName())->move($file);

    }
}
