<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Firebase\JWT\JWT;

class LoginController extends Controller
{
	public function login()
    {
        $key = '7kvP3yy3b4SGpVz6uSeSBhBEDtGzPb2n';

        if (empty($_POST['email']) or empty($_POST['password'])) 
        {
    		return response()->json([
    			'ERROR' => 'Some fields are empty', 400
    		]);
    	} 
        else 
        {
            $users = User::all();
            foreach ($users as $key => $user)
            {
                if ($user->password == $_POST['password'] && $user->email == $_POST['email']) 
                {
                    $tokenParams = [
                        'id' => $user->id,        
                        'password' => $_POST['password'],
                        'email' => $_POST['email']
                    ];

                    $token = JWT::encode($tokenParams, $key);
                    return response()->json([
                        'token' => $token
                    ]);
                }
            }
            return response()->json([
                'ERROR' => 'The user specified doesnt exist', 404
            ]);
        }
    }
}
