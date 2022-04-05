<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{

    public static function index(Router $router)
    {
        $propiedades = Propiedad::get(3);
        $inicio = true;

        $router->render('/paginas/index', [
            'inicio' => $inicio,
            'propiedades' => $propiedades
        ]);
    }
    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros');
    }

    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::get(10);

        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router)
    {
        $id = validarIdORedireccionar('/');
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router)
    {
        $router->render('paginas/blog');
    }
    public static function entrada(Router $router)
    {
        $router->render('paginas/entrada');
    }

    public static function contacto(Router $router)
    {
        $mensaje = null;
        $alerta='';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuestas = $_POST['contacto'];

            // Crear una instancia de PHPMailer
            $mail = new PHPMailer();

            // Configurar SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = 'a367eb016a5306';
            $mail->Password = '05921492a84b90';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

            // Configurar contenido del email
            $mail->setFrom('pepe.paz0399@hotmail.com', 'Admin');
            $mail->addAddress('pepe.paz0399@hotmail.com', 'BienesRaices.com');
            $mail->Subject = 'Tienes un nuevo mensaje';

            // Habilitar html
            $mail->isHTML(true);
            $mail->CharSet = PHPMailer::CHARSET_UTF8;

            // Definir contenido
            $contenido = '<html>';
            $contenido .= '<p> Tienes un nuevo mensaje </p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . ' </p>';

            if ($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>Eligío ser contactado por teléfono</p>';
                $contenido .= '<p>Teléfono: ' . $respuestas['telefono'] . ' </p>';
                $contenido .= '<p>Fecha Contacto: ' . $respuestas['fecha'] . ' </p>';
                $contenido .= '<p>Hora: ' . $respuestas['hora'] . ' </p>';
            } else {
                $contenido .= '<p>Eligío ser contactado por email</p>';
                $contenido .= '<p>Correo: ' . $respuestas['email'] . ' </p>';
            }

            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje'] . ' </p>';
            $contenido .= '<p>Vende o Compra: ' . $respuestas['tipo'] . ' </p>';
            $contenido .= '<p>Precio o Presupuesto: $' . $respuestas['precio'] . ' </p>';
            $contenido .= '</html>';
            $mail->Body = $contenido;
            $mail->AltBody = 'contenido sin HTML';

            // Enviar el email
            if ($mail->send()) {
                $mensaje = 'Mensaje Enviado correctamente';
                $alerta = 'exito';
            } else {
                $mensaje = 'No se Pudo Enviar el Mensaje';
                $alerta = 'error';
            }
        }
        $router->render('paginas/contacto', [
            'mensaje' => $mensaje,
            'alerta' => $alerta
        ]);
    }
}
