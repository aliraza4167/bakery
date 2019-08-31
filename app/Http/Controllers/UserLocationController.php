<?php

namespace App\Http\Controllers;

use App\UserLocation;
use Illuminate\Http\Request;
use Validator;

class UserLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('userlocations', [
            'userlocations' => auth()->user()->userlocations()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forms.createuserlocation');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VALIDATION OF THE DATA
        $validator = Validator::make($request->all(), [
            'location_name' => 'required|max:255',
            'street' => 'required|max:255',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'postal' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return redirect('userlocations/create')
                        ->withErrors($validator)
                        ->withInput();
        }

        $userlocation = new UserLocation;
        $userlocation->user_id = auth()->id();
        $userlocation->location_name = $request->location_name;
        $userlocation->street = $request->street;
        $userlocation->city = $request->city;
        $userlocation->country = $request->country;
        $userlocation->postal = $request->postal;

        $saved = $userlocation->save();

        if($saved) {
            return redirect('/userlocations');
        };
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserLocation  $userLocation
     * @return \Illuminate\Http\Response
     */
    public function show(UserLocation $userLocation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserLocation  $userLocation
     * @return \Illuminate\Http\Response
     */
    public function edit(UserLocation $userlocation)
    {
        return view('forms.edituserlocation', [
            'userlocation' => $userlocation
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserLocation  $userLocation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserLocation $userlocation)
    {
        // VALIDATION OF THE DATA
        $validator = Validator::make($request->all(), [
            'location_name' => 'required|max:255',
            'street' => 'required|max:255',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'postal' => 'required|max:255'
        ]);

        if ($validator->fails()) {
            return redirect('userlocations/'.$userlocation->id)
                        ->withErrors($validator)
                        ->withInput();
        }

        $userlocation->user_id = auth()->id();
        $userlocation->location_name = $request->location_name;
        $userlocation->street = $request->street;
        $userlocation->city = $request->city;
        $userlocation->country = $request->country;
        $userlocation->postal = $request->postal;

        $saved = $userlocation->save();

        if($saved) {
            return redirect('/userlocations');
        };
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserLocation  $userLocation
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserLocation $userlocation)
    {
        $userlocation->delete();

        return redirect('/userlocations');
    }
}
