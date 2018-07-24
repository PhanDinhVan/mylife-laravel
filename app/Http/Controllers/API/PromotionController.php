<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Promotion;
use App\Http\Resources\Promotion as PromotionResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Promotion::where('status', 'in_progress')->get();

        foreach ($promotions as $promotion) {
            $promotion->user;
        }

        return PromotionResource::collection($promotions);
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
            'name'      => 'required',
            'url'       => 'required',
            'startDate' => 'date_format:d-m-Y',
            'endDate'   => 'date_format:d-m-Y'
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                "error" => $validatedData->messages()
            ])->setStatusCode(422);
        }

        $input = $request->all();

        $promotion = new Promotion();
        $validField = $promotion->fillable;

        foreach ($input as $key=>$data) {
            if (in_array($key, $validField)) {
                if ($key == 'startDate' || $key == 'endDate' ) {
                    $promotion[$key] = date("Y-m-d", strtotime($data));
                } else {
                    $promotion[$key] = $data;
                }
            }
        }
        $promotion->createdBy = auth()->user()->id;

        if ($request->hasFile('photo')) {
            $photo = $request->photo;

            $path = 'images/promotion';
            $filename = time() . '.' . $photo->extension();
            $photo->storeAs($path, $filename);

            $promotion->image = 'storage/app/public/' . $path . '/' . $filename;
        }

        $promotion->save();

        return response()->json([
            'promotion' => $promotion
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        //
    }
}
