<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\User as UserResource;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterSuccessfully;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        foreach ($users as $user) {
            $user->role;
            $user->profile;
        }

        return response()->json([
            'users' => $users
        ]);
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
            'email' => 'bail|required|unique:users|max:255',
            'name' => 'bail|required'
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                "error" => $validatedData->messages()
            ])->setStatusCode(422);
        }

        // $roleUser = Role::where('id', $request->roleId)->first();
        $password = str_random(8);

        $user = $this->createNewUser($request, $password);
        $profile =$this->createNewProfile($request, $user);

        Mail::to($request->email)->send(new RegisterSuccessfully($user->email, $password));

        return response()->json([
            'user' => new UserResource($user),
            'profile' => $profile
        ]);
    }

    private function createNewUser($request, $password) {
        $user = new User;

        $user->email = $request->email;
        $user->password = Hash::make($password);
        $user->roleId = 1;

        $user->save();

        return $user;
    }

    private function createNewProfile($request, $user) {
       $profile = new Profile;

        $profile->memberCode = str_random(10);
        $profile->userId = $user->id;
        $profile->name = $request->name;
        $profile->avatar = '';
        $profile->gender = $request->gender;
        $profile->birthday = new \DateTime($request->birthday);
        $profile->phone = $request->phone;
        $profile->nationality = $request->nationality;

        $profile->save();

        return $profile;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $r)
    {
        //

        $user = User::find($r->id);
        $profile = Profile::find($r->profileId);

        if (empty($user) && empty($profile)) {
          return "user not exits";
        }

        $user->status = $r->status;
        // $user->roleId = $r->roleId;
        $user->save();

        $profile->name = $r->name;
        $profile->gender = $r->gender;
        $profile->birthday = $r->birthday;
        $profile->save();

        return "succes";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $check_user = User::find($id);
        $check_profile = Profile::where('userId', '=', $id)->get();

        if ( empty($check_user) && $check_profile->isEmpty() ) {
          return "not found";
        }

        $profile = Profile::where('userId', '=', $id)->delete();
        $user = User::find($id)->delete();
        
        return "succes";
    }
}
