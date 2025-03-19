<?php
return [         // Prueba cimmit | base contrller , programa formacion controller | genera un código css para un reset 
    "/" => [
        'controller' => 'App\Controllers\HomeController',
        'action' => 'index'
    ],
    '/home'  => [
        'controller' => 'App\Controllers\HomeController',
        'action' => 'index'
    ],
    '/hello' => [
        'controller' => 'App\Controllers\HomeController',
        'action' => 'index'
    ], 

    // reporte
    '/reporte/index' => [
        'controller' => 'App\Controllers\reporteController',
        'action' => 'index'
    ], 
    '/reporte/view' => [
        'controller' => 'App\Controllers\reporteController',
        'action' => 'view'
    ], 
    '/reporte/new' => [
        'controller' => 'App\Controllers\reporteController',
        'action' => 'newReporte'     // Nombre de la funcion 
    ], 
    '/reporte/create'=> [
        'controller' =>'App\Controllers\reporteController',
        'action' => 'createReporte'
    ],
    '/reporte/view/(\d+)'=> [
        'controller' =>'App\Controllers\reporteController',
        'action' => 'viewReporte'
    ],
    '/reporte/edit/(\d+)'=> [
        'controller' =>'App\Controllers\reporteController',
        'action' => 'editReporte'
    ],
    '/reporte/update'=> [
        'controller' =>'App\Controllers\reporteController',
        'action' => 'updateReporte'
    ],
    '/reporte/delete/(\d+)'=> [
        'controller' =>'App\Controllers\reporteController',
        'action' => 'deleteReporte'
    ],

    // Rutas para Gestor
    '/gestor/index' => [
        "controller" => 'App\Controllers\gestorController',
        "action" => 'index'
    ],
    '/gestor/view' => [
        "controller" => 'App\Controllers\gestorController',
        "action" => 'view'
    ],
    '/gestor/new' => [
        "controller" => 'App\Controllers\gestorController',
        "action" => 'newGestor'
    ],
    '/gestor/create' => [
        "controller" => 'App\Controllers\gestorController',
        "action" => 'createGestor'
    ],
    '/gestor/view/(\d+)' => [
        "controller" => 'App\Controllers\gestorController',
        "action" => 'viewGestor'
    ],
    '/gestor/edit/(\d+)' => [
        "controller" => 'App\Controllers\gestorController',
        "action" => 'editGestor'
    ],
    '/gestor/update' => [
        "controller" => 'App\Controllers\gestorController',
        "action" => 'updateGestor'
    ],
    '/gestor/delete/(\d+)' => [
        "controller" => 'App\Controllers\gestorController',
        "action" => 'deleteGestor'
    ],

    

];