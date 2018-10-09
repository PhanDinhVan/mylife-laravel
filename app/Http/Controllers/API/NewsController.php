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
        $curent_date = date('Y-m-d', time());
        $news = News::where('status', 'publish')->whereDate('publishDate', '<=' ,$curent_date)->orderBy('publishDate', 'desc')->orderBy('id', 'desc')->get();

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
            'url'       => 'required',
            'publishDate' => 'date_format:Y-m-d',
        ]);

        if ($validatedData->fails()) {
            return response()->json([
                "error" => $validatedData->messages()
            ])->setStatusCode(422);
        }

        if ($request->hasFile('photo')) {
            $photo = $request->photo;

            $path = 'images/news';
            $filename = time() . '.' . $photo->extension();
            $photo->storeAs($path, $filename);

            $news->image = 'storage/app/public/' . $path . '/' . $filename;
        }

        $news = new News();

        try {

            $input = $request->all();

            
            $validField = $news->fillable;

            foreach ($input as $key=>$data) {
                if (in_array($key, $validField)) {
                    $news[$key] = $data;
                }
            }
            $news->createdBy = auth()->user()->id;

            $news->save();
        }
        catch (\Exception $e) {
            return $e->getMessage();
        }

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
    public function update(Request $request)
    {
        //
        $id = $request->id;
        $news = News::findOrFail($id);

        $news->user();

        if ($request->hasFile('photo')) {
            $photo = $request->photo;

            $path = 'images/shops';
            $filename = $id . '.' . $photo->extension();
            $photo->storeAs($path, $filename);

            $news->image = 'storage/app/public/' . $path . '/' . $filename;
        }

        $input = $request->all();

        $validField = $news->fillable;

        foreach ($input as $key=>$data) {
            if (in_array($key, $validField)) {
                $news[$key] = $data;
            }
        }

        $news->save();

        return new NewsResource($news);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $news = News::find($id);
        if(empty($news)) {
          return "not found";
        }
        $news->delete();

        return "success";
    }
}
