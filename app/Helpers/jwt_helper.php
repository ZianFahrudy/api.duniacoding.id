<?php 

use Firebase\JWT\JWT;
Use Firebase\JWT\Key;

use App\Models\MemberModel;
use App\Models\TokenModel;

function getJWT($authenticationHeader)
{
	if (is_null($authenticationHeader))
		throw new Exception('Authentication Failed!');

	return explode(" ", $authenticationHeader)[1];
}

function validateJWT($encodedToken)
{
    try {
	    $decodedToken = JWT::decode($encodedToken, new key (getenv('JWT_SECRET_KEY'), 'HS256'));
	    $MemberModel = new MemberModel();
	    return ($MemberModel->getEmail($decodedToken->email)) ? true : false;
    } 
    catch(Exception $e) {
        return false;
    }	
}

function createJWT($email)
{
	$payload = ['email' => $email, 'iat' => time(), 'exp' => time() + getenv('JWT_TIME_TO_LIVE')];
	return JWT::encode($payload, getenv('JWT_SECRET_KEY'), 'HS256');
}

function restapi_access($method, $url, $data = [])
{
	$client 	= \Config\Services::curlrequest();

	if (session()->has('token'))
	{
		$token 	= session('token');
		$info	= json_decode(base64_decode(explode('.', $token)[1]), true);

		if (session('isLoggedIn') && $info['exp'] < time())
		{
			$token = createJWT($info['email']);
			session()->set('token', $token);
		}
		
		$headers 	= ['Authorization' => 'Bearer '.$token];
		$response 	= $client->request($method, $url, ['headers' => $headers, 'http_errors' => false, 'form_params' => $data]);
		return $response->getBody();
	}
}