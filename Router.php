<?php

namespace MVC;

class Router
{

    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas()
    {
        // Arreglo rutas protegidas
        $rutas_protegidas = [
            '/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar',
            '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'
        ];

        $urlActual = $_SERVER['REQUEST_URI'] === '' ? '/' : $_SERVER['REQUEST_URI'];

        debugear($urlActual);

        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }
        // Proteger rutas
        if (in_array($urlActual, $rutas_protegidas)) {
            session_start();
            $autenticado = $_SESSION['login'] ?? false;

            if (!$autenticado) {
                header('Location: /');
            }
        }

        if ($fn) {
            // La URL existe y hay una funcion asociada
            call_user_func($fn, $this);
        } else {
            echo '<h1> Página no disponible </h1>';
        }
    }

    // Mostrar/Renderizar vistas
    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value;
        }
        ob_start(); // Empieza a almacenar datos en memoria (String)

        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); // Limpia los datos en memoria y los devuelve

        include __DIR__ . '/views/layout.php';
    }
}
