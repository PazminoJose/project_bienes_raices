<?php

declare(strict_types=1);
define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function incluirTemplate(string $nombre, bool $inicio = false): void
{
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado(): void
{
    session_start();

    if (!$_SESSION['login']) {
        header('Location: /');
    }
}

function debugear($variable): void
{
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapar / Sanitizar el HTML
function s($html): string
{
    if (!is_null($html)) {
        $s = htmlspecialchars($html);
        return $s;
    }
    return '';
}

// Validad tipo de Contenido
function validaTipoContenido($tipo): bool
{
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos);
}

// Muestra los mensajes de notificacion
function mostrarNotificacion($codigo): string|bool
{
    $mensaje = '';
    switch ($codigo) {
        case 1:
            $mensaje = "Creado correctamente";
            break;
        case 2:
            $mensaje = "Actualizado correctamente";
            break;
        case 3:
            $mensaje = "Eliminado correctamente";
            break;
        default:
            $mensaje = false;
    }

    return $mensaje;
}

function validarIdORedireccionar($url): int
{

    $id = (isset($_POST['id']) || isset($_GET['id'])) ? $_POST['id'] ?? $_GET['id'] : '';


    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: $url");
    }

    return $id;
}
// function validarIdORedireccionarPOST($url): int
// {
//     $id = $_POST['id'];

//     $id = filter_var($id, FILTER_VALIDATE_INT);

//     if (!$id) {
//         header("Location: $url");
//     }

//     return $id;
// }
