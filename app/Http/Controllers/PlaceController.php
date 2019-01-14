<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;

class PlaceController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $header = getallheaders();
        $key = '7kvP3yy3b4SGpVz6uSeSBhBEDtGzPb2n';
        
        if ($header['Authorization'] != null) 
        {
            try {
                    $decodedToken = JWT::decode($header['Authorization'], $key, array('HS256'));
                    var_dump($decodedToken);
                    exit();
                } catch (Exception $e) {
                    
                }    
        } else {
            return response()->json([
                'ERROR' => 'Dont have enough permission'
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Place $place)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        //
    }
}
