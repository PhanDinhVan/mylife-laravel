<?php

namespace App\Http\Controllers\API;

use Validator;
use App\User;
use App\Profile;
use App\ShopUserReview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewBookingManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $review_bmanagers = ShopUserReview::orderBy('userId', 'desc')->get();
        foreach ($review_bmanagers as $item) {
            $item->shop;
            $item->profile;
        }
        return response()->json([
            'review_bmanagers' => $review_bmanagers
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
      $userId = $request->userId;
      $shopId = $request->shopId;
      $review_bmanagers = ShopUserReview::firstOrCreate(
            ['userId' => $userId, 'shopId' => $shopId]
      );

      return $review_bmanagers;
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
      $reviewManager = ShopUserReview::findOrFail($id);
      $check = ShopUserReview::where('userId', $request->userId)->where('shopId', $request->shopId)->get();

      if(count($check) > 0) {
        return "exits";
      } else {
        $reviewManager->userId = $request->userId;
        $reviewManager->shopId = $request->shopId;
        $reviewManager->save();

        return $reviewManager;
      }
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
        $check = ShopUserReview::find($id);
        if ( empty($check) ) {
          return "not found";
        }
        
        $review = ShopUserReview::find($id)->delete();
        
        return "succes";
    }
}
