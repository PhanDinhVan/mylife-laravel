<?php

namespace App\Http\Controllers\API;

use Validator;
use App\News;
use App\Http\Resources\News as NewsResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::where('status', 'publish')->get();

        foreach ($news as $item) {
            $item->user;
        }

        return NewsResource::collection($news);
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
            'url'       => 'required'
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                "error" => $validatedData->messages()
            ])->setStatusCode(422);
        }

        $input = $request->all();

        $news = new News();
        $validField = $news->fillable;

        foreach ($input as $key=>$data) {
            if (in_array($key, $validField)) {
                $news[$key] = $data;
            }
        }
        $news->createdBy = auth()->user()->id;

        if ($request->hasFile('photo')) {
            $photo = $request->photo;

            $path = 'images/news';
            $filename = time() . '.' . $photo->extension();
            $photo->storeAs($path, $filename);

            $news->image = 'storage/app/public/' . $path . '/' . $filename;
        }

        $news->save();

        return response()->json([
            'news' => $news
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }
}