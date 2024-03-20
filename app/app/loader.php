<?php

namespace App\app;

use App\http\middleware;
use League\Route\Router;
use Laminas\Diactoros\ResponseFactory;
use League\Route\Strategy\JsonStrategy;
use Laminas\Diactoros\ServerRequestFactory;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;

class Loader extends database
{
    public $routes;

    public function __construct()
    {
        //connect DB
        $this->connect();
        //load router
        $this->_routes();
    }

    static function init()
    {
        $app = new self();
        $app->_addsRequire();
        return $app;
    }

    private function _addsRequire()
    {
        /** @var League\Route\Router */
        $router = $this->routes->router;
        /** @var \Psr\Http\Message\ServerRequestInterface $request */
        $request = $this->routes->request;

        //load routes Files

        require_once ROOT_DIR . '/routes/index.php';

        //

        $response = $router->dispatch($request);

        (new SapiEmitter)->emit($response);
    }

    function _routes()
    {
        $request = ServerRequestFactory::fromGlobals(
            $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
        );

        $responseFactory = new ResponseFactory();

        $strategy = new JsonStrategy($responseFactory);
        /**
         * @var League\Route\Router $router
         */
        $router   = (new Router)->setStrategy($strategy);

        $this->routes = (object) [
            'router' => $router,
            'request' => $request,
        ];

        return $this;
    }
}