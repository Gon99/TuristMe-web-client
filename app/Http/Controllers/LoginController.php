<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Firebase\JWT\JWT;

class LoginController extends Controller
{
	public function loginApp()
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
            $user = User::where('email', $_POST['email'])->first();
            if (!empty($user)) 
            {
                if (decrypt($user->password) == $_POST['password']) 
                {
                    $tokenParams = [
                        'id' => $user->id,        
                        'password' => $_POST['password'],
                        'email' => $_POST['email']
                    ];

                    $token = JWT::encode($tokenParams, $key);
                    return response()->json([
                        'token' => $token, 200
                    ]);
                } else {
                    return response()->json([
                        'ERROR' => 'The specified password doesnt exist', 404
                    ]);
                }
            }else {
                return response([
                    'ERROR' => 'The specified email doesnt exist', 404
                ]);
            }
        }
    }
}
