<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\ShopUser;
use App\User;
use App\Profile;

class BookingManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      $bookings = User::whereHas('shop_user')->get();

        foreach ($bookings as $booking) {
            $booking->shop_user;
            foreach ($booking->shop_user as $key => $value) {
              $value->shop;
            }
            $booking->profile;
        }

        foreach ($bookings as $key => $value) {
            if(count($value->shop_user) > 0) {

            }
        }

        return response()->json([
            'booking_manager' => $bookings
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
        $listRestaurant = $request->restaurants;
        $id = $request->userId;

        $listShopUser = array();

        foreach($listRestaurant as $item){

          $shop_user = ShopUser::firstOrCreate(
              ['userId' => $id, 'shopId' => $item]
          );
             
          array_push($listShopUser, $shop_user);
        }

        return response()->json([
            'listShopUser' => $listShopUser
        ]);
    }

    public function userBooking() {

      $user_booking = User::join('profile', function($query) {
            $query->on('users.id', '=', 'profile.userId')
            ->whereNull('profile.deleted_at');
        })
        ->join('roles', function($query) {
          $query->on('users.roleId', '=', 'roles.id')
          ->whereNull('users.deleted_at');
        })
        ->select('users.id as id', 'profile.name as username')
        ->where('roles.name','=','booking')->get();

        return response()->json([
            'user_booking' => $user_booking
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
        $listNewShop = $request->restaurants;
        $listOldShop = array();

        $listShopId = ShopUser::select('shopId')->where('userId', $id)->get();
        foreach($listShopId as $item){
          array_push($listOldShop, $item->shopId);
        }

        // $resultUpdate = array_intersect($listOldShop, $listNewShop);
        $resultDelete = array_diff($listOldShop, $listNewShop);
        $resultCreate = array_diff($listNewShop, $listOldShop);

        
        if ($resultDelete) {
          $listDelete = ShopUser::where('userId', $id)->whereIn('shopId', $resultDelete)->delete();
        }

        if ($resultCreate) {
          foreach ($resultCreate as $value) {
            $shop_user = ShopUser::firstOrCreate(
                  ['userId' => $id, 'shopId' => $value]
            );
            $shop_user->save();
          }
        }

        // if ($resultUpdate) {
        //   foreach ($resultUpdate as $value) {
        //     $shop_user = ShopUser::updateOrCreate(
        //           ['userId' => $id, 'shopId' => $value]
        //     );
        //     $shop_user->save();
        //   }
        // }

        return "success";
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
        $booking_manager = ShopUser::where('userId', $id)->get();
        if(empty($booking_manager)) {
          return "not found";
        }
        $booking_manager = ShopUser::where('userId', $id)->delete();

        return "success";
    }
}
