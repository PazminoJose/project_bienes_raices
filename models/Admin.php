<?php

namespace Model;

class Admin extends ActiveRecord
{
    // Base de Datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar(): array
    {
        if (!$this->email) {
            self::$errores[] = "El Email no es Valido";
        }
        if (!$this->password) {
            self::$errores[] = "La Contraseña es Obligatoria";
        }

        return self::$errores;
    }

    public function existeUsuario()
    {
        $atributos = $this->sanitizarDatos();

        // Revisar si un usuario existe o no
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $atributos['email'] . "' LIMIT 1";

        $resultado = self::$db->query($query);

        if (!$resultado->num_rows) {
            self::$errores[] = 'El Usuario no Existe';
            return;
        }

        return $this->crearObjeto($resultado->fetch_assoc());
    }

    public function comprobarPassword(Admin $resultado)
    {
        $usuario = $resultado;
        $autenticado = password_verify($this->password, $usuario->password);
        if (!$autenticado) {
            self::$errores[] = 'La Contraseña es Incorrecta';
        }
        return $autenticado;
    }

    public function autenticar()
    {
        session_start();

        // Llena arreglo de la sesión
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;
        
        header("Location: /admin");
    }
}
