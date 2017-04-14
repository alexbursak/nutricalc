<?php

namespace NutriCalc\Component\Router;

use NutriCalc\Component\ArrayCollection\ArrayCollection;
use NutriCalc\Component\Router\Type\RouteType;

/**
 * Class Routes
 */
class Routes implements RoutesInterface
{
    /**
     * @var string
     */
    private $routesRawPath;

    /**
     * @var array
     */
    private $routesRaw;

    /**
     * @var ArrayCollection
     */
    private $routesCollection;

    public function __construct($routesRawPath)
    {
        $this->routesCollection = new ArrayCollection();
        $this->routesRawPath = $routesRawPath;

        $routesParser = new RoutesParser($routesRawPath);

        $this->routesRaw = $routesParser->parseRoutes()->getRoutes();

        $this->setupRoutes();
    }

    /**
     * Hydrates $routesCollection with RouteType object which are getting build from $routesRaw(simple array)
     */
    private function setupRoutes()
    {
        foreach ($this->routesRaw as $urlPattern => $innerPath) {
            $route = new RouteType($urlPattern, $innerPath);
            $this->routesCollection->addElement($route);
        }
    }

    /**
     * @return array
     */
    public function getRoutesCollection()
    {
        return $this->routesCollection->getElements();
    }
}