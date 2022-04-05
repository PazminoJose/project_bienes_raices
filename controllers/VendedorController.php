<?php

namespace Controllers;

use Model\Vendedor;
use MVC\Router;

class VendedorController
{

    public static function crear(Router $router)
    {
        $vendedor = new Vendedor();
        $errores = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $args = $_POST['vendedor'];
            $vendedor = new Vendedor($args);
            $errores = $vendedor->validar();

            if (empty($errores)) {

                $vendedor->guardar();
            }
        }
        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores

        ]);
    }

    public static function actualizar(Router $router)
    {
        $id = validarIdORedireccionar('/admin');
        $vendedor = Vendedor::find($id);
        if (is_null($vendedor)) {
            header("Location: /admin");
        }

        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $args = $_POST['vendedor'];
            $vendedor->sincronizar($args);
            $errores = $vendedor->validar();

            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = validarIdORedireccionar('/admin');

            $vendedor = Vendedor::find($id);
            if (is_null($vendedor)) {
                header("Location: /admin");
            }
            $vendedor->eliminar();
        }
    }
}
