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
        $user = User::where('email', $_POST['email'])->first();

        if (empty($_POST['email']) or empty($_POST['password'])) {
    		return response()->json([
    			'ERROR' => 'The fields are empty', 400
    		]);
    	}

        if ($user->password == $_POST['password'] && $user->email == $_POST['email']) 
        {
 
            $tokenParams = [        
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
                'ERROR' => 'Invalid email or password', 400
            ]);
        }
    }
}
