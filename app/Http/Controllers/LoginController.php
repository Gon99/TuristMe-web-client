<?php


namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \Firebase\JWT\JWT;

	/**
	 * 
	 */
class LoginController extends Controller
{

	public function login()
    {
    	//$token = $headers['Authorization'];
        $key = '7kvP3yy3b4SGpVz6uSeSBhBEDtGzPb2n';
        $user = User::where('email', $_POST['email'])->first();       //En vez de ->get podemos poner ->first ya que el email es único te devuelve ese objeto(user) con ese email

        // foreach ($user as $user) {
        //     echo $user->password;
        // }

        if ($user->password == $_POST['password']) 
        {
            $tokenParams = [        //Meter los datos que identifican al usuario
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

    public function userLogged() {
    	//$headers = getallheaders();


    }
}
	
	

?>