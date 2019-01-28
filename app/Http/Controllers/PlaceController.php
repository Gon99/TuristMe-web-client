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
            $userParams = JWT::decode($header['Authorization'], $key, array('HS256'));
            $places = Place::all();

            foreach ($places as $key => $place) {
                if (count($places) != 0 && $place->user_id == $userParams->id) {
                    return $places;
                }else
                {
                    return response()->json([
                        'ERROR' => 'Dont have any place created yet'
                    ]);
                }
            }
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
                    return response()->json([
                        'SUCCESS' => 'The place has been created correctly', 200
                    ]); 
                }   
            }else{
                return response()->json([
                    'ERROR' => 'Dont have enough permission', 403
                ]);
            } 
        }else {
            return response()->json([
                'ERROR' => 'The user is not logged', 403
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
        $header = getallheaders();
        $key = '7kvP3yy3b4SGpVz6uSeSBhBEDtGzPb2n';

        if ($header['Authorization'] != null) 
        {
            $userParams = JWT::decode($header['Authorization'], $key, array('HS256'));
            if ($userParams->id == $place->user_id) {
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
                    $place->save();
                    return response()->json([
                        'SUCCESS' => 'The place has been updated correctly', 200
                    ]); 
                }
            }else {
                return response()->json([
                    'ERROR' => 'Dont have enough permission', 403
                ]);
            }
        }else {
            return response()->json([
                'ERROR' => 'The user is not logged', 403
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        $header = getallheaders();
        $key = '7kvP3yy3b4SGpVz6uSeSBhBEDtGzPb2n';

        if ($header['Authorization'] != null) 
        {
            $userParams = JWT::decode($header['Authorization'], $key, array('HS256'));
            $places = Place::all();

            if ($user = User::where('email', $userParams->email)->first()) 
            {
                foreach ($places as $key => $place) {
                    if ($place->user_id == $userParams->id) {
                        $place->delete();
                        return response()->json([
                            'SUCCESS' => 'The place has been deleted correctly', 200
                        ]);
                    } else {
                        return response()->json([
                            'ERROR' => 'Dont have enough permission', 403 
                        ]);
                    }
                }
            }
        }else {
            return response()->json([
                'ERROR' => 'The user is not logged', 403
            ]);
        }
    }
}
