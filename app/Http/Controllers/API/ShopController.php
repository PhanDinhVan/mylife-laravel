<?php

namespace App\Http\Controllers\API;

use App\Shop;
use App\Company;
use App\Http\Resources\Shop as ShopResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->get('type', null);

        $shops = null;
        if ($type) {
            $company = Company::where('type', $type)->first();

            $shops = Shop::where('type', $company->id)->get();
        } else {
            $shops = Shop::all();
        }

        foreach ($shops as $shop) {
            $shop->company();
        }

        return response()->json([
            'shops' => ShopResource::collection($shops)
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
        //
        // Validate the request...
        $validatedData = Validator::make($request->all(), [
            'name' => 'bail|required|max:255',
            'address' => 'bail|required'
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                "error" => $validatedData->messages()
            ])->setStatusCode(422);
        }

        $shop = new Shop;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $id  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $shop = Shop::findOrFail($id);

        $shop->company();

        if ($request->hasFile('photo')) {
            $photo = $request->photo;

            $path = 'images/shops';
            $filename = $id . '.' . $photo->extension();
            $photo->storeAs($path, $filename);

            $shop->image = 'storage/app/public/' . $path . '/' . $filename;
        }

        $input = $request->all();

        $validField = $shop->fillable;

        foreach ($input as $key=>$data) {
            if (in_array($key, $validField)) {
                $shop[$key] = $data;
            }
        }

        $shop->save();

        return new ShopResource($shop);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shop  $shop
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shop $shop)
    {
        //
    }
}
