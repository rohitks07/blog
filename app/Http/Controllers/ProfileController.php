<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;
use App\User;
use App\Country;
use App\State;
use App\City;
use App\Http\Requests\StoreUserProfile;
use App\Role;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('role','profile')->paginate(5);
        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users="";
        $roles = Role::all();
        $countries = Country::all();
        return view('admin.users.create',compact('users','countries','roles'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserProfile $request)
    {
        // dd($request->all());
        // $path = 'images/profiles/no-thumbnail.jpeg';
        if($request->hasFile('thumbnail')){
            $location = 'public/images/profiles/';
            $extension = '.'.$request->thumbnail->getClientOriginalExtension();
            $name = basename($request->thumbnail->getClientOriginalName(),$extension).time();
            $name = $name.$extension;
            $name = $location.$name;
            $path = $request->thumbnail->move($location,$name);
        }
        $user = User::create([
            'email' => $request->email,
            'password' =>bcrypt($request->password),
            'status' => $request->status,
            'role_id' =>$request->role_id,
        ]);
        if($user){
            $profile = Profile:: create([
                'name' => $request->name,
                'user_id' => $user->id,
                'country_id' => $request->country_id,
                'state_id' => $request->state_id,
                'city_id' => $request->city_id,
                'phone' => $request->phone,
                'thumbnail' => $name,
            ]);
        }
        if($user && $profile){
            return redirect(route('admin.profile.index'))->with('message','New User Inserted');
        }
        else{
            return back()->with('message','Error While Adding User');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        // return $profile;
        $roles = Role::all();
        $countries = Country::all();
        return view('admin.users.edit',compact('profile','countries','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }


    public function getStates(Request $request,$id){
        // return $id;
        if($request->ajax()){
            return State::where('country_id',$id)->get();
        }
        // else{
        //     return State::where('country_id',$id)->get();
        // }

    }

    public function getCities(Request $request,$id)
    {
        if($request->ajax()){
            return City::where('state_id',$id)->get();
        }
    }
}
