<?php

namespace Setup;

use \Symfony\Component\Yaml\Yaml;
use App\SiteBundle\Services\AppFactory;

class Routes
{
    private $_routes;


    public function __construct()
    {
        $this->setRoutes();
    }

    public function setRoutes()
    {
        $this->_routes = Yaml::parseFile(__DIR__.'/../Config/Routes.yaml');
        $this->dispatcher();
    }

    public function dispatcher()
    {
        $dispatcher = \FastRoute\simpleDispatcher(function (\FastRoute\RouteCollector $routes) {
            foreach ($this->_routes as $value) {
                $routes->addRoute($value['method'], AppFactory::getPrefix().$value['url'], ['controller' => $value['controller'], 'action' => $value['action'], 'bundle' => $value['bundle'] ]);
            }
        });

        $request = \Zend\Diactoros\ServerRequestFactory::fromGlobals();

 
        $routeInfo = $dispatcher->dispatch(
            $request->getMethod(),
            $request->getUri()->getPath()
        );

         #var_dump($routeInfo);
        
        switch ($routeInfo[0]) {
            case \FastRoute\Dispatcher::NOT_FOUND:
                $controller = "ErrorController";
                $action = "notFound";
                $bundle = "SiteBundle";
                $vars = "";

                $this->initController($bundle, $controller, $action, $vars);
                break;

            case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $response = new \Zend\Diactoros\Response\TextResponse(
                    "Cette méthode n'est pas autorisée !",
                    405,
                    ['Allow' => implode(',', $routeInfo[1])]
                );
                break;

            case \FastRoute\Dispatcher::FOUND:
                $controller = ucwords($routeInfo[1]['controller']);
                $action = $routeInfo[1]['action'];
                $bundle = $routeInfo[1]['bundle'];
                $vars = $routeInfo[2];

                $this->initController($bundle, $controller, $action, $vars);

                break;
        }
    }

    public function initController($bundle, $controller, $action, $vars)
    {
        $class = "App\\".$bundle."\Controller\\".$controller;
        $cont = new $class;
        $cont->$action($vars);
    }
}
