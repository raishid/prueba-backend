<?php

namespace App\traits;

use Psr\Http\Message\ServerRequestInterface;


trait request_data
{
    function all(ServerRequestInterface $request)
    {
        $body = $request->getBody();
        $content = $request->getBody()->getContents();
        $data = json_decode($body, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            return $data;
        }

        parse_str($content, $data);

        return $data;
    }
}
