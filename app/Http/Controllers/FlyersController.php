<?php

namespace App\Http\Controllers;

use App\Flyer;
use App\Photo;
use App\Http\Flash;
use Illuminate\Http\Request;
use App\Http\Requests\FlyerRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeFlyerRequest; //AUTHORIZATION OPTION 2
//use App\Http\Controllers\Traits\AuthorizesUsers; //AUTHORIZATION OPTION 1
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FlyersController extends Controller
{
//    use AuthorizesUsers; //AUTHORIZATION OPTION 1

    /**
     * Create a new FlyersController instance.
     */
    public function __construct()
    {
        parent::__construct();

        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('flyers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FlyerRequest $request
     * @param Flash $flash
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FlyerRequest $request, Flash $flash)
    {
        Flyer::create($request->all());

        flash()->success('Success!', 'Your flyer has been created.');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param string $zip
     * @param string $street
     * @return \Illuminate\View\View
     */
    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street);

        return view('flyers.show', compact('flyer'));
    }

    /**
     * AUTHORIZATION OPTION 1: Extract authorization process to trait
     *
     * Add a photo to the flyer.
     *
     * @param string $zip
     * @param string $street
     * @param Request $request
     * @return Flyer
     */
//    public function addPhoto($zip, $street, Request $request)
//    {
//        $this->validate($request, [
//            'photo' => 'required|mimes:jpg,jpeg,png,bmp'
//        ]);
//
//        if (!$this->userCreatedFlyer($request)) {
//            return $this->unauthorized($request);
//        }
//
//        $photo = $this->makePhoto($request->file('photo'));
//
//        Flyer::locatedAt($zip, $street)->addPhoto($photo);
//    }

    /**
     * AUTHORIZATION OPTION 2: Create a form request
     *
     * Add a photo to the flyer.
     *
     * @param string $zip
     * @param string $street
     * @param ChangeFlyerRequest $request
     */
    public function addPhoto($zip, $street, ChangeFlyerRequest $request)
    {
        $photo = $this->makePhoto($request->file('photo'));

        Flyer::locatedAt($zip, $street)->addPhoto($photo);
    }

    /**
     * Setup a new photo.
     *
     * @param UploadedFile $file
     * @return Photo
     */
    public function makePhoto(UploadedFile $file)
    {
        return Photo::named($file->getClientOriginalName())
            ->move($file);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
