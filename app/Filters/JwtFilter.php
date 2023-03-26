<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\Config\Services;

use CodeIgniter\API\ResponseTrait;
use Exception;

class JwtFilter implements FilterInterface
{
    use ResponseTrait;

    public function before(RequestInterface $request, $arguments = null)
    {
        try
        {
            helper('jwt');
            $encodedToken = getJWT($request->getServer('HTTP_AUTHORIZATION'));
            if (validateJWT($encodedToken)) {
                return $request;
            }
            else {
                throw new Exception('Authentication Failed!');
            }
        }
        catch(Exception $e)
        {
            return Services::response()->setJSON(['error' => $e->getMessage()])->setStatusCode(ResponseInterface::HTTP_UNAUTHORIZED);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}