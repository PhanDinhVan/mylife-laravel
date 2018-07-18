<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request...
        $validatedData = Validator::make($request->all(), [
            'shopId' => 'bail|required|exists:shop,id',
            'date' => 'required|date_format:d-m-Y',
            'time' => 'required|date_format:H:i',
            'numberPerson' => 'required|integer|min:1'
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                "error" => $validatedData->messages()
            ])->setStatusCode(422);
        }

        $input = $request->all();

        $booking = new Booking();
        $validField = $booking->fillable;

        foreach ($input as $key=>$data) {
            if (in_array($key, $validField)) {
                if ($key == 'date') {
                    $booking[$key] = date("Y-m-d", strtotime($data));
                } else {
                    $booking[$key] = $data;
                }
            }
        }
        $booking->userId = auth()->user()->id;

        $booking->save();

        return $booking;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
