<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $headers = getallheaders();
        var_dump($headers);
        exit();
        $token = $headers['Authorization'];

        if (!empty($_POST('Authorization')))
        {
            $key = '7kvP3yy3b4SGpVz6uSeSBhBEDtGzPb2n';
            $decodedToken = JWT::decode($token, $key, array('HS256'));

            $category = new Category();

            $category->name = $request->name;
            $category->user_id = $request->user_id;

            $category->save();
        } else
        {
            return response()->json([
                'ERROR' => 'Invalid Token', 401
            ]);
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GPASS  $gPASS
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $categories = DB::table('categories')->where('user_id', $category->user_id)->get();

        foreach ($categories as $categories => $category) {
            var_dump($value->name);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\GPASS  $gPASS
     * @return \Illuminate\Http\Response
     */
    public function edit(GPASS $gPASS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\GPASS  $gPASS
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GPASS $gPASS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\GPASS  $gPASS
     * @return \Illuminate\Http\Response
     */
    public function destroy(GPASS $gPASS)
    {
        //
    }
}
