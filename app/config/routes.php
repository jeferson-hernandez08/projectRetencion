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
        'controller' =>'App\Controllers\rolController',
        'action' => 'viewRol'
    ],
    '/rol/edit/(\d+)'=> [
        'controller' =>'App\Controllers\rolController',
        'action' => 'editRol'
    ],
    '/rol/update'=> [
        'controller' =>'App\Controllers\rolController',
        'action' => 'updateRol'
    ],
    '/rol/delete/(\d+)'=> [
        'controller' =>'App\Controllers\rolController',
        'action' => 'deleteRol'
    ],

    // Tabla usuario
    '/usuario/index' => [
        'controller' => 'App\Controllers\usuarioController',
        'action' => 'index'
    ], 
    '/usuario/view' => [
        'controller' => 'App\Controllers\usuarioController',
        'action' => 'view'
    ], 
    '/usuario/new' => [
        'controller' => 'App\Controllers\usuarioController',
        'action' => 'newUsuario'     // Nombre de la funcion 
    ], 
    '/usuario/create'=> [
        'controller' =>'App\Controllers\usuarioController',
        'action' => 'createUsuario'
    ],
    '/usuario/view/(\d+)'=> [
        'controller' =>'App\Controllers\usuarioController',
        'action' => 'viewUsuario'
    ],
    '/usuario/edit/(\d+)'=> [
        'controller' =>'App\Controllers\usuarioController',
        'action' => 'editUsuario'
    ],
    '/usuario/update'=> [
        'controller' =>'App\Controllers\usuarioController',
        'action' => 'updateUsuario'
    ],
    '/usuario/delete/(\d+)'=> [
        'controller' =>'App\Controllers\usuarioController',
        'action' => 'deleteUsuario'
    ],

    // Tabla programaFormacion
    '/programaFormacion/index'=> [
        'controller' =>'App\Controllers\programaFormacionController',
        'action' => 'index'
    ],
    '/programaFormacion/view'=> [
        'controller' =>'App\Controllers\programaFormacionController',
        'action' => 'view'
    ],
    '/programaFormacion/new' => [
        'controller' => 'App\Controllers\programaFormacionController',
        'action' => 'newProgramaFormacion'     // Nombre de la funcion 
    ], 
    '/programaFormacion/create'=> [
        'controller' =>'App\Controllers\programaFormacionController',
        'action' => 'createProgramaFormacion'
    ],
    '/programaFormacion/view/(\d+)'=> [
        'controller' =>'App\Controllers\programaFormacionController',
        'action' => 'viewProgramaFormacion'
    ],
    '/programaFormacion/edit/(\d+)'=> [
        'controller' =>'App\Controllers\programaFormacionController',
        'action' => 'editProgramaFormacion'
    ],
    '/programaFormacion/update'=> [
        'controller' =>'App\Controllers\programaFormacionController',
        'action' => 'updateProgramaFormacion'
    ],
    '/programaFormacion/delete/(\d+)'=> [
        'controller' =>'App\Controllers\programaFormacionController',
        'action' => 'deleteProgramaFormacion'                          // Llama a la funcion deleteProgramaFormacion del programaFormacionModel
    ],

    // Tabla Grupo
    '/grupo/index'=> [
        'controller' =>'App\Controllers\grupoController',
        'action' => 'index'
    ],
    '/grupo/view'=> [
        'controller' =>'App\Controllers\grupoController',
        'action' => 'view'
    ],
    '/grupo/new' => [
        'controller' => 'App\Controllers\grupoController',
        'action' => 'newGrupo'     // Nombre de la funcion 
    ], 
    '/grupo/create'=> [
        'controller' =>'App\Controllers\grupoController',
        'action' => 'createGrupo'
    ],
    '/grupo/view/(\d+)'=> [
        'controller' =>'App\Controllers\grupoController',
        'action' => 'viewGrupo'
    ],
    '/grupo/edit/(\d+)'=> [
        'controller' =>'App\Controllers\grupoController',
        'action' => 'editGrupo'
    ],
    '/grupo/update'=> [
        'controller' =>'App\Controllers\grupoController',
        'action' => 'updateGrupo'
    ],
    '/grupo/delete/(\d+)'=> [
        'controller' =>'App\Controllers\grupoController',
        'action' => 'deleteGrupo'                          // Llama a la funcion deleteProgramaFormacion del programaFormacionModel
    ],

    // Tabla aprendiz
    '/aprendiz/index'=> [
        'controller' =>'App\Controllers\aprendizController',
        'action' => 'index'
    ],
    '/aprendiz/view'=> [
        'controller' =>'App\Controllers\aprendizController',
        'action' => 'view'
    ],
    '/aprendiz/new' => [
        'controller' => 'App\Controllers\aprendizController',
        'action' => 'newAprendiz'     // Nombre de la funcion 
    ], 
    '/aprendiz/create'=> [
        'controller' =>'App\Controllers\aprendizController',
        'action' => 'createAprendiz'
    ],
    '/aprendiz/view/(\d+)'=> [
        'controller' =>'App\Controllers\aprendizController',
        'action' => 'viewAprendiz'
    ],
    '/aprendiz/edit/(\d+)'=> [
        'controller' =>'App\Controllers\aprendizController',
        'action' => 'editAprendiz'
    ],
    '/aprendiz/update'=> [
        'controller' =>'App\Controllers\aprendizController',
        'action' => 'updateAprendiz'
    ],
    '/aprendiz/delete/(\d+)'=> [
        'controller' =>'App\Controllers\aprendizController',
        'action' => 'deleteAprendiz'                          // Llama a la funcion deleteProgramaFormacion del programaFormacionModel
    ],

    // Tabla reporte
    '/reporte/index'=> [
        'controller' =>'App\Controllers\reporteController',
        'action' => 'index'
    ],
    '/reporte/view'=> [
        'controller' =>'App\Controllers\reporteController',
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
        'action' => 'deleteReporte'                          // Llama a la funcion deleteProgramaFormacion del programaFormacionModel
    ],

    

    

];