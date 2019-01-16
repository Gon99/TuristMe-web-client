<?php

namespace App\Http\Controllers;

use App\Place;
use App\User;
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

        $header = getallheaders();
        $key = '7kvP3yy3b4SGpVz6uSeSBhBEDtGzPb2n';

        if ($header['Authorization'] != null) 
        {
            $places = Place::all();
            if (count($places) != 0) {
                foreach ($places as $key => $place) {
                    return response()->json([
                        'places' => $place
                    ]);
                    //Lo hago con var_dump??
                }
            } else {
                return response()->json([
                    'ERROR' => 'There are no places created'
                ]);
            }
            var_dump(count($places));  
        }
        else {
            return response()->json([
                'ERROR' => 'Dont have enough permission', 403
            ]);
        }
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
            $userParams = JWT::decode($header['Authorization'], $key, array('HS256'));

            if ($user = User::where('email', $userParams->email)->first()) 
            {
                $place = new Place();
                if (empty($request->name) || empty($request->start_date) || empty($request->end_date)) 
                {
                    return response()->json([
                        'ERROR' => 'Some fields are empty'
                    ]);    
                }
                else {
                    $place->name = $request->name;
                    $place->description = $request->description;
                    $place->start_date = $request->start_date;
                    $place->end_date = $request->end_date;
                    $place->x_coordinate = $request->x_coordinate;
                    $place->y_coordinate = $request->y_coordinate;
                    $place->user_id = $user->id;
                    $place->save();  
                }   
            }else{
                return response()->json([
                    'ERROR' => 'Token corrupt'
                ]);
            } 
        }else {
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
