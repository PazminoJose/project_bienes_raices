<?php

namespace Controllers;

use Model\Admin;
use MVC\Router;

class LoginController
{
    public static function login(Router $router)
    {
        $errores = [];
        $admin = new Admin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['login'];
            $admin = new Admin($args);
            $errores = $admin->validar();

            if (empty($errores)) {
                // Verificar si el usuario existe
                $resultado = $admin->existeUsuario();

                if (!$resultado) {
                    $errores = Admin::getErrores();
                } else {
                    //Verificar password
                    $autenticado = $admin->comprobarPassword($resultado);
                    if ($autenticado) {
                        // Autenticar usuario
                        $admin->autenticar();
                    } else {
                        $errores = Admin::getErrores();
                    }
                }
            }
        }

        $router->render('autenticacion/login', [
            'admin' => $admin,
            'errores' => $errores
        ]);
    }
    public static function logout(Router $router)
    {
        session_start();
        $_SESSION = [];

        header("Location: /");
    }
}
