<?php

namespace Petruk\Framework;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Controller\HomeController;

class Core implements HttpKernelInterface {
    
    /** @var RouteCollection */
    protected $routes;

    public function __construct()
    {
        $this->routes = new RouteCollection();
    }

    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        // create a context using the current request
        $context = new RequestContext();
        $context->fromRequest($request);
        
        $matcher = new UrlMatcher($this->routes, $context);

        try {
            $attributes = $matcher->match($request->getPathInfo());
            $controller = $attributes['controller'];
            unset($attributes['controller']);
            
            if(is_string($controller)){
                $string = $controller;
                $method = substr($string, strpos($string, "@") + 1);    
                
                $arr = explode("@", $string, 2);
                $class = $arr[0];

                $ctrl = new $class;

                $response = call_user_func_array(array($ctrl, $method), $attributes);		
            } else {
                $response = call_user_func_array($controller, $attributes);		
            }            
        } catch (ResourceNotFoundException $e) {
            $response = new Response('Not found!', Response::HTTP_NOT_FOUND);
        } catch (MethodNotAllowedException $e) {
            $response = new Response('Method not allowed', Response::HTTP_METHOD_NOT_ALLOWED);
        }

        return $response;
    }

    public function map($method, $path, $controller) {
        
        $this->routes->add($path, new Route(
            $path, // path
            array('controller' => $controller), // default values
            array(), // requirement
            array(), // options
            null, // host
            array(), // schemes
            array($method) // methods
        ));
    }
}