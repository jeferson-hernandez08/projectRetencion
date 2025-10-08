<?php
return [         // Prueba cimmit | base contrller , programa formacion controller | genera un código css para un reset | COMMIT
    //Login
    '/login/init' => [
        "controller" => 'App\Controllers\loginController',
        "action" => 'initLogin'
    ],
    '/login/logout' => [
        "controller" => 'App\Controllers\loginController',
        "action" => 'logoutLogin'
    ],

    // Tablas 
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
        'controller' => 'App\Controllers\rolController',
        'action' => 'index'
    ], 
    '/rol/view' => [
        'controller' => 'App\Controllers\rolController',
        'action' => 'view'
    ], 
    '/rol/new' => [
        'controller' => 'App\Controllers\rolController',
        'action' => 'newRol'     // Nombre de la funcion 
    ], 
    '/rol/create'=> [
        'controller' =>'App\Controllers\rolController',
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
    "/rol/remove" => [
        "controller" => "App\Controllers\RolController",
        "action" => "removeRol"
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
    "/usuario/remove" => [
        "controller" => "App\Controllers\usuarioController",
        "action" => "removeUsuario"
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
    "/programaFormacion/remove" => [
        "controller" => "App\Controllers\programaFormacionController",
        "action" => "removeProgramaFormacion"
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
    "/grupo/remove" => [
        "controller" => "App\Controllers\grupoController",
        "action" => "removeGrupo"
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
    "/aprendiz/remove" => [
        "controller" => "App\Controllers\aprendizController",
        "action" => "removeAprendiz"
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
    "/reporte/remove" => [
        "controller" => "App\Controllers\ReporteController",   // Error de r en minuscula
        "action" => "removeReporte"
    ],
    // Nueva ruta para actualización de estado AJAX
    '/reporte/updateEstado/(\d+)' => [
        'controller' => 'App\Controllers\ReporteController',
        'action' => 'updateEstado'
    ],

    // Tabla estrategias
    '/estrategias/index'=> [
        'controller' =>'App\Controllers\estrategiasController',
        'action' => 'index'
    ],
    '/estrategias/view'=> [
        'controller' =>'App\Controllers\estrategiasController',
        'action' => 'view'
    ],
    '/estrategias/new' => [
        'controller' => 'App\Controllers\estrategiasController',
        'action' => 'newEstrategias'     // Nombre de la funcion 
    ], 
    '/estrategias/create'=> [
        'controller' =>'App\Controllers\estrategiasController',
        'action' => 'createEstrategias'
    ],
    '/estrategias/view/(\d+)'=> [
        'controller' =>'App\Controllers\estrategiasController',
        'action' => 'viewEstrategias'
    ],
    '/estrategias/edit/(\d+)'=> [
        'controller' =>'App\Controllers\estrategiasController',
        'action' => 'editEstrategias'
    ],
    '/estrategias/update'=> [
        'controller' =>'App\Controllers\estrategiasController',
        'action' => 'updateEstrategias'
    ],
    '/estrategias/delete/(\d+)'=> [
        'controller' =>'App\Controllers\estrategiasController',
        'action' => 'deleteEstrategias'                          // Llama a la funcion deleteProgramaFormacion del programaFormacionModel
    ],
    "/estrategias/remove" => [
        "controller" => "App\Controllers\EstrategiasController",   // Error de r en minuscula
        "action" => "removeEstrategias"
    ],

    // Tabla Categoria
    '/categoria/index'=> [
        'controller' =>'App\Controllers\categoriaController',
        'action' => 'index'
    ],
    '/categoria/view' => [
        'controller' => 'App\Controllers\categoriaController',
        'action' => 'view'
    ],
    '/categoria/new' => [
        'controller' => 'App\Controllers\categoriaController',
        'action' => 'newCategoria'     // Nombre de la funcion 
    ], 
    '/categoria/create'=> [
        'controller' =>'App\Controllers\categoriaController',
        'action' => 'createCategoria'
    ],
    '/categoria/view/(\d+)'=> [
        'controller' =>'App\Controllers\categoriaController',
        'action' => 'viewCategoria'
    ],
    '/categoria/edit/(\d+)'=> [
        'controller' =>'App\Controllers\categoriaController',
        'action' => 'editCategoria'
    ],
    '/categoria/update'=> [
        'controller' =>'App\Controllers\categoriaController',
        'action' => 'updateCategoria'
    ],
    '/categoria/delete/(\d+)'=> [
        'controller' =>'App\Controllers\categoriaController',
        'action' => 'deleteCategoria'                          // Llama a la funcion deleteProgramaFormacion del programaFormacionModel
    ],
    "/categoria/remove" => [
        "controller" => "App\Controllers\categoriaController",  
        "action" => "removeCategoria"
    ],

    // Tabla Causa 
    '/causa/index'=> [
        'controller' =>'App\Controllers\causaController',
        'action' => 'index'
    ],
    '/causa/view'=> [
        'controller' =>'App\Controllers\causaController',
        'action' => 'view'
    ],
    '/causa/new' => [
        'controller' => 'App\Controllers\causaController',
        'action' => 'newCausa'     // Nombre de la funcion 
    ], 
    '/causa/create'=> [
        'controller' =>'App\Controllers\causaController',
        'action' => 'createCausa'
    ],
    '/causa/view/(\d+)'=> [
        'controller' =>'App\Controllers\causaController',
        'action' => 'viewCausa'
    ],
    '/causa/edit/(\d+)'=> [
        'controller' =>'App\Controllers\causaController',
        'action' => 'editCausa'
    ],
    '/causa/update'=> [
        'controller' =>'App\Controllers\causaController',
        'action' => 'updateCausa'
    ],
    '/causa/delete/(\d+)'=> [
        'controller' =>'App\Controllers\causaController',
        'action' => 'deleteCausa'                          // Llama a la funcion deleteProgramaFormacion del programaFormacionModel
    ],
    "/causa/remove" => [
        "controller" => "App\Controllers\causaController",  
        "action" => "removeCausa"
    ],

    // Tabla Intervencion 
    '/intervencion/index'=> [
        'controller' =>'App\Controllers\intervencionController',
        'action' => 'index'
    ],
    '/intervencion/view'=> [
        'controller' =>'App\Controllers\intervencionController',
        'action' => 'view'
    ],
    '/intervencion/new' => [
        'controller' => 'App\Controllers\intervencionController',
        'action' => 'newIntervencion'     // Nombre de la funcion 
    ], 
    '/intervencion/create'=> [
        'controller' =>'App\Controllers\intervencionController',
        'action' => 'createIntervencion'
    ],
    '/intervencion/view/(\d+)'=> [
        'controller' =>'App\Controllers\intervencionController',
        'action' => 'viewIntervencion'
    ],
    '/intervencion/edit/(\d+)'=> [
        'controller' =>'App\Controllers\intervencionController',
        'action' => 'editIntervencion'
    ],
    '/intervencion/update'=> [
        'controller' =>'App\Controllers\intervencionController',
        'action' => 'updateIntervencion'
    ],
    '/intervencion/delete/(\d+)'=> [
        'controller' =>'App\Controllers\intervencionController',
        'action' => 'deleteIntervencion'                          // Llama a la funcion deleteProgramaFormacion del programaFormacionModel
    ],
    "/intervencion/remove" => [
        "controller" => "App\Controllers\intervencionController",  
        "action" => "removeIntervencion"
    ],
    '/reporte/intervenciones/(\d+)' => [
    'controller' => 'App\Controllers\ReporteController',
    'action' => 'intervenciones'
    ],

    // Tabla causa_reporte 
    '/causaReporte/index'=> [
        'controller' =>'App\Controllers\causaReporteController',
        'action' => 'index'
    ],
    '/causaReporte/view'=> [
        'controller' =>'App\Controllers\causaReporteController',
        'action' => 'view'
    ],
    '/causaReporte/new' => [
        'controller' => 'App\Controllers\causaReporteController',
        'action' => 'newCausaReporte'     // Nombre de la funcion 
    ], 
    '/causaReporte/create'=> [
        'controller' =>'App\Controllers\causaReporteController',
        'action' => 'createCausaReporte'
    ],
    '/causaReporte/view/(\d+)'=> [
        'controller' =>'App\Controllers\causaReporteController',
        'action' => 'viewCausaReporte'
    ],
    '/causaReporte/edit/(\d+)'=> [
        'controller' =>'App\Controllers\causaReporteController',
        'action' => 'editCausaReporte'
    ],
    '/causaReporte/update'=> [
        'controller' =>'App\Controllers\causaReporteController',
        'action' => 'updateCausaReporte'
    ],
    '/causaReporte/delete/(\d+)/(\d+)'=> [       // Problema de la Ruta: (\d+)/(\d+)
        'controller' =>'App\Controllers\causaReporteController',
        'action' => 'deleteCausaReporte'                          // Llama a la funcion deleteProgramaFormacion del programaFormacionModel
    ],

    // Página Principal
    "/main" => [
        "controller" => "App\Controllers\MainController",
        "action" => "view"
    ],


];