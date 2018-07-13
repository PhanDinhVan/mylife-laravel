<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


use App\User;
use App\Profile;
use App\Role;
use App\Http\Resources\User as UserResource;
use App\Mail\RegisterSuccessfully;

class ProfileController extends Controller
{
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request...
        $validatedData = Validator::make($request->all(), [
            'email' => 'required|unique:users|max:255',
            'fullname' => 'required',
            'phone' => 'required'
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                "error" => $validatedData->messages()
            ])->setStatusCode(422);
        }

        $roleUser = Role::where('name', 'user')->first();
        $password = str_random(8);

        $user = $this->createNewUser($request, $roleUser, $password);
        $profile =$this->createNewProfile($request, $user);

        Mail::to($request->email)->send(new RegisterSuccessfully($user->email, $password));

        return response()->json([
            'user' => new UserResource($user),
            'profile' => $profile
        ]);
    }

    private function createNewUser($request, $role, $password) {
        $user = new User;

        $user->email = $request->email;
        $user->password = Hash::make($password);
        $user->roleId = $role->id;

        $user->save();

        return $user;
    }

    private function createNewProfile($request, $user) {
       $profile = new Profile;

        $profile->memberCode = str_random(10);
        $profile->userId = $user->id;
        $profile->name = $request->fullname;
        $profile->avatar = '';
        $profile->gender = $request->gender;
        $profile->birthday = new \DateTime($request->birthday);
        $profile->phone = $request->phone;
        $profile->nationality = $request->nationality;

        $profile->save();

        return $profile;
    }

    /**
     * . the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
