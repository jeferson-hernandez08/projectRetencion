<?php

require_once '../app/config/global.php';                                // Se crea la ruta para ingresar a la app
require_once '../app/controllers/loginController.php';
require_once '../app/controllers/homeController.php';                   // Se crea la ruta para ingresar a la app
require_once '../app/controllers/rolController.php';                    // Se crea la ruta para ingresar a la app
require_once '../app/controllers/usuarioController.php';                // Se crea la ruta para ingresar a la app
require_once '../app/controllers/programaFormacionController.php';
require_once '../app/controllers/grupoController.php';
require_once '../app/controllers/aprendizController.php';
require_once '../app/controllers/reporteController.php';
require_once '../app/controllers/estrategiasController.php';
require_once '../app/controllers/categoriaController.php';
require_once '../app/controllers/causaController.php';
require_once '../app/controllers/intervencionController.php';
require_once '../app/controllers/causaReporteController.php';
require_once '../app/controllers/mainController.php'; 


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

header('Location: /login/init');  // Si no se encuentra la ruta redirige al login

