<?php

namespace App\Http\Controllers\API;

use Validator;
use App\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $r)
    {
        //
        $shopId = $r->shopId;
        $userId = $r->userId;

        if ( !empty($shopId) && !empty($userId) ) {
          $reviews = Review::where('shopId', $shopId)
                            ->where('userId', $userId)
                            ->orderBy('review_date', 'desc')->get();

        } elseif ( !empty($shopId) ) {
          $reviews = Review::where('shopId', $shopId)
                            ->orderBy('review_date', 'desc')->get();
        } else {
          $reviews = Review::orderBy('review_date', 'desc')->get();
        }

        foreach ($reviews as $review) {
            $review->user;
            $review->profile;
            $review->shop;
        }
        
        return response()->json([
            'reviews' => $reviews
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
            'comments' => 'required',
            'review_date' => 'required',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                "error" => $validatedData->messages()
            ])->setStatusCode(422);
        }

        $input = $request->all();

        $userId = auth()->user()->id;

        $review = new Review();
        $validField = $review->fillable;

        foreach ($input as $key=>$data) {
            if (in_array($key, $validField)) {
                if ($key == 'date') {
                    $review[$key] = date("Y-m-d", strtotime($data));
                } else {
                    $review[$key] = $data;
                }
            }
        }
        $review->userId = $userId;

        $review->save();

        return response()->json([
            'review' => $review
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
        $check_review = Review::find($id);
        if ( empty($check_review) ) {
          return "not found";
        }
        $review = Review::find($id)->delete();
        
        return "succes";
    }
}
