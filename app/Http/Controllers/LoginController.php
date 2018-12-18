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
    	
        $key = '7kvP3yy3b4SGpVz6uSeSBhBEDtGzPb2n';
        $user = User::where('email', $_POST['email'])->first();       //En vez de ->get podemos poner ->first ya que el email es único te devuelve ese objeto(user) con ese email
        if (empty($_POST['email']) or empty($_POST['password'])) {
    		return response()->json([
    			'ERROR' => 'The fields are empty', 400
    		]);
    	}

        if ($user->password == $_POST['password'] && $user->email == $_POST['email']) 
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
                'ERROR' => 'Invalid email or password', 400
            ]);
        }
    }

    /*public function userToken()
    {

    	$key = '7kvP3yy3b4SGpVz6uSeSBhBEDtGzPb2n';
    	$header = getallheaders();

    	var_dump($header);
    	exit();

    	if (isset($header['Postman-Token'])) 
    	{
    		$token = $header['Postman-Token'];
			
			var_dump($token);
    		exit();

    		$decodedToken = JWT::decode($token, $key, array('HS256'));

    		var_dump($decodedToken);
    		exit();
    	} else
    	{
    		var_dump("en el else");
    		exit();
    	}
    	
    }

    public function userLogged() 
    {
    	$header = getallheaders();

    	foreach ($header as $headers => $value) {
    		return response()->json([
    			var_dump($headers)
    		]);
    	}

    	exit();
    }*/
}
