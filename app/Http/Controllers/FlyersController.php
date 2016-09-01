<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Flyer;
use App\Photo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

//use App\Http\Controllers\MyTraits\AuthorizesUsers;

class FlyersController extends Controller
{
    //use AuthorizesUsers;
    public $user;

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
        $this->user = Auth::user();
    }

    public function create()
    {
        //flash()->overlay('Welcome On board', 'Thank you for joining us');
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

    public function addPhoto($zip, $street, Requests\ChangeFlyerRequest $request)
    {
        $photo = $this->makePhoto($request->file('photo'));

        Flyer::locatedAt($zip, $street)->addPhoto($photo);

        return 'Done';
    }

    protected function userCreatedFlyer(Request $request)
    {
     /*   return Flyer::where([
            'zip' => $request->zip,
            'street' => $request->street,
            'user_id' => $this->user->id
        ])->exists();*/
    }

    protected function unauthorized(Request $request)
    {
        if($request->ajax())
        {
            return response(['message' => 'No way, Not at all'], 403);
        }

        flash('No way, Not at all');

        return redirect('/');
    }

    protected function makePhoto(UploadedFile $file)
    {
       //return Photo::fromForm($file)->store($file);

        return Photo::named($file->getClientOriginalName())->move($file);

    }
}
