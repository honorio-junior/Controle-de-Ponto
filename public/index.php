<?php

require_once dirname(__DIR__) . '/autoload.php';
date_default_timezone_set('America/Manaus');
$route = $_SERVER['REQUEST_URI'];
$route = trim($route, '/');
$route = empty($route) ? '/' : '/' . $route;
$DIR_VIEWS = dirname(__DIR__) . '/Views/';
$DIR_CONTROLLERS = dirname(__DIR__) . '/Controllers/';
$routes = require_once dirname(__DIR__) . '/routes.php';

class Router
{   

    static function route(): void
    {
        global $DIR_CONTROLLERS, $DIR_VIEWS, $route, $routes;

        $controller = '';
        $function = '';

        $route = rtrim(parse_url($route)['path'], '/');
        $route = empty($route) ? '/' : $route ;

        // Lógica que extrai o Controller, Função, Método
        foreach($routes as $r)
        {
            if(isset($r[$route]))
            {
                [$c, $action] = explode('@', $r[$route]);
                [$f, $m] = explode('?', $action);
                
                if($_SERVER['REQUEST_METHOD'] == $m){
                    $controller = $c;
                    $function = $f;
                }
            }
        }

        // Chama o controller na função específica
        // Se não exister, exibe a página de erro
        if(file_exists($DIR_CONTROLLERS . $controller . '.php')){

            require_once $DIR_CONTROLLERS . $controller . '.php';
            $classController = '\\Controllers\\' . $controller;
    
            $instance = new $classController();
            $instance->$function();

        }else{
            header("HTTP/1.0 404 Not Found");
            require_once $DIR_VIEWS . '404.php';
        }
    }
}

Router::route();

exit;
