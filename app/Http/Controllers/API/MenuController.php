<?php

namespace App\Http\Controllers\API;

use App\Menu;
use Validator;
use App\News;
use App\Http\Resources\News as NewsResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::query()->get();

        foreach ($menus as $item) {
            $item->Company;
            $item->MenuCategory;
        }
        return response()->json([
            'menus' => $menus
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
        try{
            $input = $request->all();

            $menu = new Menu();

            foreach ($input as $key=>$data) {
                $menu[$key] = $data;
            }

            if ($request->hasFile('image')) {
                $image = $request->image;

                $path = 'images/news';
                $filename = time() . '.' . $image->extension();
                $image->storeAs($path, $filename);

                $menu->image = 'storage/app/public/' . $path . '/' . $filename;
            }
            $menu->save();
            $menu->MenuCategory;
            $menu->Company;

            return response()->json([
                'menu' => $menu
            ]);
        }catch (\Exception $ex){
            \Log::info($ex);
        }
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
