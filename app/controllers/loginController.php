<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

require_once MAIN_APP_ROUTE . '../controllers/baseController.php';
require_once MAIN_APP_ROUTE . '../models/UsuarioModel.php';

class LoginController extends BaseController {
    
    public function __construct() {
        // Se define la plantilla para este controlador
        $this->layout = "login_layout";
        // Llamamos al constructor del padre
        parent::__construct();
    }

    public function initLogin() {
        if (isset($_POST['txtEmailUser']) && isset($_POST['txtPasswordUser'])) {
            $user = trim($_POST['txtEmailUser']) ?? null;
            $password = trim($_POST['txtPasswordUser']) ?? null;
            if ($user != "" && $password != "") {
                // Se valida la existencia del usuario y constraseña en al BD
                $loginObj = new UsuarioModel();
                $resp = $loginObj->validarLogin($user, $password);      // Llamamos al método validarLogin del modelo UsuarioModel
                if ($resp) {
                    $_SESSION['timeout'] = time(); // Añadir esta línea
                    $this->redirectTo('main');
                } else {
                    $errors = "El usuario y/o contraseña incorrectos";
                }
            } else {
                $errors = "El usuario y/o contraseña no pueden ser vacíos";
            }
            $data = [
                'errors' => $errors
            ];
            $this->render('login/login.php', $data);
        } else {
            $this->render('login/login.php');
        }
    }

    public function logoutLogin(){
        session_destroy();
        header('Location: /login/init');
    }
    
}
