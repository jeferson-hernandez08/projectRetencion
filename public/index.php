<?php

require_once '../app/config/global.php';                // Se crea la ruta para ingresar a la app
require_once '../app/controllers/homeController.php';   // Se crea la ruta para ingresar a la app
require_once '../app/controllers/rolController.php';   // Se crea la ruta para ingresar a la app

// require_once '../app/controllers/loginController.php';


$url = $_SERVER['REQUEST_URI'];   // Detecta lo que se ingresa en la url
//echo $url;

$routes = include_once '../app/config/routes.php';

$matchedRoute = null;
foreach ($routes as $route => $routeConfig) {
    if (preg_match("#^$route$#", $url, $matches )) {            // preg_match: Es una funcion que permite buscar un parametro dentro de una string
        $matchedRoute = $routeConfig;        // Expresiones regulares
        break;
    }
}
if($matchedRoute) {
    $controllerName = $matchedRoute['controller'];
    $actionName = $matchedRoute['action'];
    if(class_exists($controllerName) && method_exists($controllerName, $actionName)) {
        // Ontener parmetros por URL
        $parameters = array_slice($matches,1 );
        //print_r($parameters);
        $controller = new $controllerName();
        $controller->$actionName(...$parameters);
        exit;

    }

}


if(array_key_exists($url, $routes)) {
    // $controller = new HomeController();            // Creamos un objeto de la clase  HomeController
    // $controller->saludar(); 
    $controllerName = $routes[$url]['controller'];
    $actionName = $routes[$url]['action'];
    $controller = new $controllerName();      //App/Controller/HomeController
    $controller -> $actionName();     //index()
} else {
    http_response_code(404);
    echo "Página no encontrada";
    exit();
}

