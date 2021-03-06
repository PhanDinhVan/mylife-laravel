<?php

namespace App\Http\Controllers\API;

use App\User;
use App\Role;
use App\Shop;
use App\Profile;
use App\ShopUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\User as UserResource;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterSuccessfully;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employees = User::where('roleId', '<>', 1)->orderBy('id', 'desc')->get();

        foreach ($employees as $employee) {
            $employee->role;
            $employee->profile;
        }

        return response()->json([
            'employees' => $employees
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

        $user = $this->createNewStaff($request, $password);
        $profile =$this->createNewProfile($request, $user);

        Mail::to($request->email)->send(new RegisterSuccessfully($user->email, $password));

        return response()->json([
            'user' => new UserResource($user),
            'profile' => $profile
        ]);
    }

    private function createNewStaff($request, $password) {
        $user = new User;

        $user->email = $request->email;
        $user->password = Hash::make($password);
        $user->roleId = $request->roleId;

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
    public function update(Request $r)
    {
        //
        $user = User::find($r->id);
        $profile = Profile::find($r->profileId);

        if (empty($user) && empty($profile)) {
          return "staff not exits";
        }

        $user->status = $r->status;
        $user->roleId = $r->roleId;
        $user->save();

        $profile->name = $r->name;
        $profile->gender = $r->gender;
        $profile->birthday = $r->birthday;
        $profile->save();

        $user->role;
        $user->profile;

        return response()->json([
            'staff' => $user
        ]);
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
        $check_user = User::find($id);
        $check_profile = Profile::where('userId', '=', $id)->get();
        $check_shopUser = ShopUser::where('userId', '=', $id)->get();

        if ( empty($check_user) && $check_profile->isEmpty() && $check_shopUser->isEmpty() ) {
          return "not found";
        }

        $shopUser = ShopUser::where('userId', '=', $id)->delete();
        $profile = Profile::where('userId', '=', $id)->delete();
        $user = User::find($id)->delete();
        
        return "succes";
    }
}
