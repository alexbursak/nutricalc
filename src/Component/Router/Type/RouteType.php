<?php

namespace NutriCalc\Component\Router\Type;

/**
 * Class RouteType
 */
class RouteType
{
    /**
     * @var string
     */
    public $urlPattern;

    /**
     * @var string
     */
    public $innerPath;

    public function __construct($urlPattern, $innerPath)
    {
        $this->urlPattern = $urlPattern;;
        $this->innerPath = $innerPath;
    }
}