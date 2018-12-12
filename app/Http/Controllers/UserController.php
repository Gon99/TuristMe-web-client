<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Firebase\JWT\JWT;

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
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        if (strlen($request->password) > 8)
        {
            $user->password = $request->password;
        } else 
        {
            return response()->json([
                'ERROR' => 'The password must have more than eight characters'
            ]);
        }
        $user->role_id = 2;

        $user->save();
    }

    public function login()
    {
        $key = '7kvP3yy3b4SGpVz6uSeSBhBEDtGzPb2n';
        $user = User::where('email', $_POST['email'])->first();       //En vez de ->get podemos poner ->first ya que el email es único te devuelve ese objeto(user) con ese email

        // foreach ($user as $user) {
        //     echo $user->password;
        // }

        if ($user->password == $_POST['password'] && $user->name == $_POST['name']) 
        {
            $tokenParams = [        //Meter los datos que identifican al usuario
                'name' => $_POST['name'],
                'password' => $_POST['password'],
                'email' => $_POST['email'],
                'random' => time()
            ];
            $token = JWT::encode($tokenParams, $key);
            return response()->json([
                'token' => $token,
            ]);
        }else 
        {
            return response()->json([
                'ERROR' => 'Invalid username or password'
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
        /*var_dump("trace");        //Printamos trace dentro del método para ver si entra      
        exit;*/
        $user->delete();
    }
}
