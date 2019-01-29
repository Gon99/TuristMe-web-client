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
    			'MESSAGE' => 'Some fields are empty', 401
    		]);
    	} 
        else 
        {
            $user = User::where('email', $_POST['email'])->first();
            if (!empty($user)) 
            {
                if ($user->password == $_POST['password']) 
                {
                    $tokenParams = [
                        'id' => $user->id,        
                        'password' => $_POST['password'],
                        'email' => $_POST['email']
                    ];

                    $token = JWT::encode($tokenParams, $key);
                    return response()->json([
                        'MESSAGE' => $token, 200
                    ]);
                } else {
                    return response()->json([
                        'MESSAGE' => 'The specified password doesnt exist', 401
                    ]);
                }
            }else {
                return response([
                    'MESSAGE' => 'The specified email doesnt exist', 401
                ]);
            }
        }
    }
}
