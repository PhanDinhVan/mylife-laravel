<?php

namespace App\Http\Controllers\API;

use App\Staff;
use App\ProfileStaff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\Staff as StaffResource;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterSuccessfully;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $staffs = Staff::all();

        foreach ($staffs as $staff) {
            $staff->role;
            $staff->profile_staff;
        }

        return response()->json([
            'staffs' => $staffs
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
            'email' => 'bail|required|unique:staffs|max:255',
            'name' => 'bail|required'
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                "error" => $validatedData->messages()
            ])->setStatusCode(422);
        }

        // $roleUser = Role::where('id', $request->roleId)->first();
        $password = str_random(8);

        $staff = $this->createNewStaff($request, $password);
        $profile_staff =$this->createNewProfileStaff($request, $staff);

        Mail::to($request->email)->send(new RegisterSuccessfully($staff->email, $password));

        return response()->json([
            'staff' => new StaffResource($staff),
            'profile_staff' => $profile_staff
        ]);
    }

    private function createNewStaff($request, $password) {
        $staff = new Staff;

        $staff->email = $request->email;
        $staff->password = Hash::make($password);
        $staff->roleId = $request->roleId;

        $staff->save();

        return $staff;
    }

    private function createNewProfileStaff($request, $staff) {
       $profile_staff = new ProfileStaff;

        $profile_staff->memberCode = str_random(10);
        $profile_staff->staffId = $staff->id;
        $profile_staff->name = $request->name;
        $profile_staff->avatar = '';
        $profile_staff->gender = $request->gender;
        $profile_staff->birthday = new \DateTime($request->birthday);
        $profile_staff->phone = $request->phone;
        $profile_staff->nationality = $request->nationality;

        $profile_staff->save();

        return $profile_staff;
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
        $staff = Staff::findOrFail($r->id);
        $profile_staff = ProfileStaff::findOrFail($r->profileStaffId);

        if (empty($staff) && empty($profile_staff)) {
          return "staff not exits";
        }

        $staff->status = $r->status;
        $staff->roleId = $r->roleId;
        $staff->save();

        $profile_staff->name = $r->name;
        $profile_staff->gender = $r->gender;
        $profile_staff->birthday = $r->birthday;
        $profile_staff->save();

        $staff->role;
        $staff->profile_staff;

        return response()->json([
            'staff' => $staff
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
        $check_staff = Staff::find($id);
        $check_profile_staff = ProfileStaff::where('staffId', '=', $id)->get();

        if ( empty($check_staff) && $check_profile_staff->isEmpty() ) {
          return "not found";
        }

        $staff = Staff::find($id)->delete();
        $profile_staff = ProfileStaff::where('staffId', '=', $id)->delete();
        
        return "succes";
    }
}
