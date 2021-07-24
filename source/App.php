<?php

namespace Source;

use Source\Http\Request;
use Source\Http\Route;

class App
{   
    private $controller, $action, $params, $middleware;

    public function __construct()
    {
        $this->checkRoute();
        $this->render();
    }

    public function checkRoute()
    {
        global $route;

        $request = new Request;
        $route   = new Route;
        
        $request_url  = $request->server('QUERY_STRING');
        $request_method = $request->server('REQUEST_METHOD');

        $route = $route->getRoutingTable();

        foreach ($route as $url => $info) {
            if(preg_match($url, $request_url, $matches)) {
                if($request_method==$info['method']){
                    $this->controller = $info['controller'];
                    $this->action = $info['action'];
                    $this->middleware= $info['middleware'];
                    $this->params = array_slice($matches,1);
                    return true;
                }else{
                    die('Error 405 Method Not Found');
                }
            }
        }
        die("Error 404 Not Found");
    }

    public function render()
    {
        
        if($this->middleware) {

            $middleware_name = "App\Http\Middlewares\\".$this->middleware;

            if(class_exists($middleware_name)) {
                $middleware_name::handle(new Http\Request);
            }
        }
        
        $add_controller_namespace = "App\Http\Controllers\\".$this->controller;

        if(class_exists($add_controller_namespace)) {
            $controller_obj = new $add_controller_namespace;
            if(method_exists($controller_obj,$this->action)) {
                call_user_func_array([$controller_obj, $this->action],$this->params);
            }else {
                die("$this->action not found");
            }
        }else {
            die("$this->controller not found");   
        }
    }
}