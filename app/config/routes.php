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

    // Tabla rol
    '/rol/index' => [
        'controller' => 'App\Controllers\RolController',
        'action' => 'index'
    ], 
    '/rol/view' => [
        'controller' => 'App\Controllers\RolController',
        'action' => 'view'
    ], 
    '/rol/new' => [
        'controller' => 'App\Controllers\RolController',
        'action' => 'newRol'     // Nombre de la funcion 
    ], 
    '/rol/create'=> [
        'controller' =>'App\Controllers\RolController',
        'action' => 'createRol'
    ],
    '/rol/view/(\d+)'=> [
        'controller' =>'App\Controllers\RolController',
        'action' => 'viewRol'
    ],
    '/rol/edit/(\d+)'=> [
        'controller' =>'App\Controllers\RolController',
        'action' => 'editRol'
    ],
    '/rol/update'=> [
        'controller' =>'App\Controllers\RolController',
        'action' => 'updateRol'
    ],
    '/rol/delete/(\d+)'=> [
        'controller' =>'App\Controllers\RolController',
        'action' => 'deleteRol'
    ],

    

    

];