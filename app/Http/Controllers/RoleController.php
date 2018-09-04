<?php

namespace App\Http\Controllers;



use Validator;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Role as RoleResource;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return RoleResource::collection($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = Validator::make($request->all(), [
            'name' => 'bail|required',
            'description' => 'required'
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                "error" => $validatedData->messages()
            ])->setStatusCode(422);
        }

        $role = new Role();
        $role->name = $request->name;
        $role->description = $request->description;
        $role->save();

        return response()->json([
            'role' => $role
        ]);
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
    public function update(Request $request, $id)
    {
        //
        $role = Role::findOrFail($id);

        $input = $request->all();

        $validField = $role->fillable;

        foreach ($input as $key=>$data) {
            if (in_array($key, $validField)) {
                if ($key == 'date') {
                    $role[$key] = date("Y-m-d", strtotime($data));
                } else {
                    $role[$key] = $data;
                }
            }
        }

        $role->save();

        return $role;
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
        $role = Role::find($id);
        if(empty($role)) {
          return "not found";
        }
        $role->delete();

        return "success";
    }
}
