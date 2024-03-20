<?php

namespace App\traits;

use Psr\Http\Message\ServerRequestInterface;


trait request_data
{
    function all(ServerRequestInterface $request)
    {
        if($request->getMethod() === 'POST' || $request->getMethod() === 'PATCH' || $request->getMethod() === 'PUT' || $request->getMethod() === 'DELETE'){
            if($request->getHeader('Content-Type')[0] === 'application/json'){
                $data = json_decode($request->getBody(), true);
            }
            else{
                $data = $request->getParsedBody();
            }
        }

        return $data;
    }
}