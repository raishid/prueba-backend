<?php

namespace App\http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;



class middleware implements MiddlewareInterface
{
    function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {   
        if($request->getMethod() === 'POST'){
            //verify if json data or from urlencoded form
            if($request->getHeader('Content-Type')[0] === 'application/json'){
                $data = json_decode($request->getBody(), true);
                $request->allData = $request->withParsedBody($data);
            }
            else{
                $data = $request->getParsedBody();
                $request->allData = $request->withParsedBody($data);
            }
        }

        return $handler->handle($request);
    }
}