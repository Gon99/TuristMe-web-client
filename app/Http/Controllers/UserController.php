<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
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
        
        if (empty($request->name) || empty($request->password) || empty($request->email)) {
            return response()->json([
                'ERROR' => 'Some fields are null'
            ]);
        } else {
            $user = new User();

            $user->name = str_replace(' ', '', $request->name);
            $user->email = $request->email;
        
            if (strlen($request->password) > 7)
            {
                $user->password = $request->password;
            } else 
            {
                return response()->json([
                    'ERROR' => 'The password must have more than seven characters', 400.7
                ]);
            }
            $user->role_id = 2;

            $user->save();
            return response()->json([
                'CORRECT' => 'The user has been register correctly', 200
            ]);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\GPASS  $gPASS
     * @return \Illuminate\Http\Response
     */
    public function show(UserController $user)
    {
        //
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
    public function destroy(User $user)     //$user es el usuario que pasamos por parametro en POSTMAN, {en las rutas} entre corchetes pasamos el id del usuario que queremos borrar
    {
        $user->delete();
    }
}
