<?php
namespace App\Controllers;

// Se inicia la sesión
session_start();

class BaseController {
    protected string $layout = "main_layout";

    public function __construct() 
    {
        // Validar el tiempo de inactividad de un usuario
        // El tiempo no debe superar lo configurado en INACTIVE_TIME
        if(isset($_SESSION['timeout'])) {
            # Se calcula tiempo de sesión transcurrido
            $tiempoSesion = time() - $_SESSION['timeout'];      // REcORDEDEMOS EL TIME STAND QUE ESTA EN SEGUNDOS DESDE 1960
            if($tiempoSesion > INACTIVE_TIME*60) {           // 1 * 60 PARA SACAR LOS SEGUNDOS el tiempo es en segundos
                // Se destruye la sesión por inactividad.
                session_destroy();
                header('Location: /login/init');
            } else {
                // Se actualiza el tiempo de sesión
                $_SESSION['timeout'] = time();
            }

        }

    }

    public function render(string $view, array $arrayData = null) {
        
        if(isset($arrayData) && is_array($arrayData)) {
            foreach ($arrayData as $key => $value) {
                // Ejemplo 2 
                // echo "<br>Key ".$key;  // roles
                // echo "<hr>";
                // print_r($value);
                // Se extraen todos los datos que llegan en arrayData
                // Se crean variables de acuerdo las keys
                $$key = $value;
            }
        }
        $content = MAIN_APP_ROUTE. "../views/$view";
        $layout = MAIN_APP_ROUTE. "../views/layouts/{$this->layout}.php";
        include_once $layout;   // rols/viewRol.php
        //echo "<br>Renderiza la página con datos";
    }
    public function formatNumber(){
        echo "<br>Formatea un número";
    }
    public function redirectTo($view){
        echo "<br>Reenvía la pagina";
        header("location: /$view");
    }
}