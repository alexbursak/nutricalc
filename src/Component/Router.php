<?php

namespace NutriCalc\Component;

class Router
{
    private $routes;
    private $uri;

    public function __construct($uri, $routes)
    {
        $this->routes = $routes;
        $this->uri = $this->cleanUpURI($uri);
    }

    public function run()
    {
        foreach ($this->routes as $uriPattern => $innerPath) {

            if (preg_match("~^$uriPattern$~", $this->uri)){

                $internalRoute = preg_replace("~$uriPattern~", $innerPath, $this->uri);

                $segments = explode('/', $internalRoute);

                $controllerName = ucfirst(array_shift($segments)) . 'Controller';
                $actionName = array_shift($segments) . 'Action';

                // generating Controller namespace path
                $controllerObjectPath = '\\' . PROJECT_NAME . '\Controller\\' . $controllerName;

                $controllerObject = new $controllerObjectPath();

                // calling controller action and passing parameters left in $segments
                call_user_func_array([$controllerObject, $actionName],$segments);

                break;
            }else{
                throw new \Exception('No routes found');
            }
        }
    }

    private function cleanUpURI($uri)
    {
        $uri = explode('?', $uri);
        $cleanURI = array_shift($uri);

        return $cleanURI;
    }
}