<?php

/**
 * Class Route
 */
class Route
{
    /**
     * @var array
     */
    public static $validRoutes = ['GET'=>[], 'POST'=>[]];

    /**
     * @param $route
     * @param $function
     */
    public static function get($route, $function)
    {
        return self::processRoutes($route, $function, 'GET');
    }

    /**
     * @param $route
     * @param $function
     */
    public static function post($route, $function)
    {
        return self::processRoutes($route, $function, 'POST');
    }

    /**
     * @param $route
     * @param $function
     * @param $method
     */
    public static function processRoutes($route, $function, $method)
    {
        $url = $_GET['url'];

        if ($_GET['url'] === 'index.php') {
            $url = '/';
        }

        self::$validRoutes[$method][] = $route;

        if ($url === $route && $_SERVER['REQUEST_METHOD'] === $method) {
            $function->__invoke();
        }
    }
}