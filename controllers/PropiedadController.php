<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;


class PropiedadController
{

    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();

        $resultado = $_GET['resultado'] ?? null;

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }

    public static function crear(Router $router)
    {
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Crear una nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']);

            /** SUBIDA DE ARCHIVOS */

            // Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";

            // Realizar un resize a la imagen con intervention
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);

                //Setear la imagen
                $propiedad->setImagen($nombreImagen);
            }

            $errores = $propiedad->validar();

            // $titulo = mysqli_real_escape_string($db, $_POST['titulo']); validar sin POO

            if (empty($errores)) {

                // Crear carpeta
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen); Subir la imagen al servidor sin usar composer(intervention image)

                // Guardar la imagen en el servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                // Guardar en la BD
                $propiedad->guardar();
            }else{
                $propiedad->setImagen('');           
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router)
    {

        $id = validarIdORedireccionar('/admin');

        $propiedad = Propiedad::find($id);
        if (is_null($propiedad)) {
            header("Location: /admin");
        }
        
        $vendedores = Vendedor::all();

        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $propiedad->sincronizar($_POST['propiedad']);

            $errores = $propiedad->validar();

            if (empty($errores)) {

                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';
                    $imagen = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);

                    $propiedad->setImagen($nombreImagen);

                    $imagen->save(CARPETA_IMAGENES . $nombreImagen);
                }

                $propiedad->guardar();
            }
        }
        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores

        ]);
    }


    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = validarIdORedireccionar('/admin');
        
            $propiedad = Propiedad::find($id);
            if (is_null($propiedad)) {
                header("Location: /admin");
            }
            
            $propiedad->eliminar();
        }
    }
}
