<?php

namespace App\Http\Controllers\API;

use Validator;
use App\User;
use App\Booking;
use App\ShopUser;
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
    public function index(Request $request)
    {
        $userId = auth()->user()->id;

        $checkSuperAdmin = User::join('roles', 'roles.id', '=', 'users.roleId')
                                ->where('users.id', $userId)->get();
        foreach ($checkSuperAdmin as $key => $value) {

          if($value->name == "super admin") {
            $booking = Booking::orderBy('date', 'desc')->orderBy('time', 'desc')->get();

          } else if($value->name == "booking") {

            $shop_user = ShopUser::select('shopId')->where('userId', $userId)->get();
            $array_shopId = array();
            foreach ($shop_user as $key => $item) {
              array_push($array_shopId, $item->shopId);
            }

            $booking = Booking::whereIn('shopId', $array_shopId)
                                ->orderBy('date', 'desc')->orderBy('time', 'desc')->get();
          }

          foreach ($booking as $book) {
              $book->user;
              $book->shop;
              $book->profile;
          }
          return response()->json([
              'booking' => $booking
          ]);
        }

        // Use table company
        $type = $request->get('type', null);
        $shopId = $request->get('shopId', null);

        $booking = [];

        if ($userId) {
            $query = Booking::query();

            $query = $query->where('userId', $userId);
            
            if ($shopId) {
                $query->whereHas('shop', function ($query) use ($shopId) {
                    $query->where('shopId', $shopId);
                });
            }
            // Have use table company
            if ($type) {
                $query->whereHas('shop', function ($query) use ($type) {
                    $query->whereHas('company', function ($query) use ($type) {
                        $query->where('type', $type);
                    });
                });
            }

            $booking = $query->orderBy('date', 'desc')->orderBy('time', 'desc')->get();

        } else {
            $booking = Booking::all();
        }

        foreach ($booking as $book) {
            $book->user;
            $book->shop;
        }

        return response()->json([
            'booking' => $booking
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
            'shopId' => 'bail|required|exists:shop,id',
            'date' => 'required',
            'time' => 'required|date_format:H:i',
            'seats' => 'required|integer|min:1'
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
        $booking->state = $request->status;
        $booking->userId = auth()->user()->id;

        $booking->save();

        return response()->json([
            'booking' => $booking
        ]);
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
    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);

        $input = $request->all();

        $validField = $booking->fillable;

        $booking->state = $request->status;
        $booking->time = $request->time;

        foreach ($input as $key=>$data) {
            if (in_array($key, $validField)) {
                if ($key == 'date') {
                    $booking[$key] = date("Y-m-d", strtotime($data));
                } else {
                    $booking[$key] = $data;
                }
            }
        }

        $booking->save();

        return $booking;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $booking = Booking::find($id);
        if(empty($booking)) {
          return "not found".$id;
        }
        $booking->delete();

        return "success";
    }
}
