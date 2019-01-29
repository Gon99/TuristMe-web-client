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
        if (empty($_POST['email']) or empty($_POST['password'])) 
        {
    		return response()->json([
<<<<<<< HEAD
    			'MESSAGE' => 'Some fields are empty', 401
=======
    			'MESSAGE' => 'Some fields are empty', 411
>>>>>>> c154ab62a1e2f237291fabb49afa6ae7f1b8e303
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

                    $token = JWT::encode($tokenParams, $this->key);
                    return response()->json([
                        'MESSAGE' => $token, 200
                    ]);
                } else {
                    return response()->json([
<<<<<<< HEAD
                        'MESSAGE' => 'The specified password doesnt exist', 401
=======
                        'MESSAGE' => 'The specified password doesnt exist', 403
>>>>>>> c154ab62a1e2f237291fabb49afa6ae7f1b8e303
                    ]);
                }
            }else {
                return response([
<<<<<<< HEAD
                    'MESSAGE' => 'The specified email doesnt exist', 401
=======
                    'MESSAGE' => 'The specified email doesnt exist', 403
>>>>>>> c154ab62a1e2f237291fabb49afa6ae7f1b8e303
                ]);
            }
        }
    }
}
