<?php

namespace Model;

use mysqli;
use mysqli_sql_exception;

class ActiveRecord
{

    // Base de Datos
    protected static mysqli $db;
    protected static $columnasDB = [];
    protected static $tabla = "";

    // Errores (Validación)
    protected static $errores = [];

    // Definir la concexión a la BD
    public static function setDB($database): void
    {
        self::$db = $database;
    }
    public function guardar(): void
    {
        if (!is_null($this->id)) {
            // Actualizar
            $this->actualizar();
        } else {
            // Crear
            $this->crear();
        }
    }

    public function crear(): void
    {
        $atributos = $this->sanitizarDatos();

        // Insertar en la base de datos
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(", ", array_keys($atributos));
        $query .= " ) VALUES('";
        $query .= join("', '", array_values($atributos));
        $query .= "')";

        $resultado = self::$db->query($query);

        if ($resultado) {
            // Redireccionar al usuario
            header('Location: /admin?resultado=1');
        }
    }
    public function actualizar(): void
    {
        $atributos = $this->sanitizarDatos();

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }

        $query = "UPDATE  " . static::$tabla . " SET ";
        $query .= join(", ", $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1";

        $resultado = self::$db->query($query);

        if ($resultado) {
            // Redireccionar al usuario
            header('Location: /admin?resultado=2');
        }
    }

    public function atributos(): array
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarDatos(): array
    {
        $atributos = $this->atributos();
        $sanitizado = [];

        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }
        return $sanitizado;
    }

    // Subida de archivos
    public function setImagen($imagen): void
    {
        // Elimina la imagen previa
        if (!is_null($this->id)) {
            $this->borrarImagen();
        }

        // Asignar al atributo de imagen el nombre de la imagen

        $this->imagen = $imagen ?? '';
    }

    // Eliminar el archivo
    public function borrarImagen(): void
    {
        // Comprobar si existe el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    // Validación
    public static function getErrores(): array
    {

        return static::$errores;
    }

    public function validar(): array
    {
        static::$errores = [];
        return static::$errores;
    }

    // Listar todos los registros
    public static function all(): array
    {
        try {
            $query = "SELECT * FROM " . static::$tabla;
            $resultado = self::consultarSQL($query);

            return $resultado;
        } catch (mysqli_sql_exception $e) {
            echo "Operación no valida";
            exit;
        }
    }

    // Obtener determinado número de registros
    public static function get($cantidad): array
    {
        try {
            $query = "SELECT * FROM " . static::$tabla . " LIMIT {$cantidad}";

            $resultado = self::consultarSQL($query);

            return $resultado;
        } catch (mysqli_sql_exception $e) {
            echo "Operación no valida";
            exit;
        }
    }

    public static function consultarSQL($query): array
    {
        // Consultar la BD
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        // Liberar memoria
        $resultado->free();

        // Retornar resultados
        return $array;
    }

    protected static function crearObjeto($registro): static
    {
        $objeto = new static;
        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }

    // Buscar un registro por si id
    public static function find($id): static|null
    {
        try {
            $query = "SELECT * FROM " . static::$tabla . " WHERE id= ${id}";
            $resultado = self::consultarSQL($query);

            return array_shift($resultado);
        } catch (mysqli_sql_exception $e) {
            echo "Operación no valida";
            exit;
        }
    }

    // Sincorniza el objeto en memoria con los cambios realizados por el usuario
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }

    // Eliminar registro
    public function eliminar(): void
    {

        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        try {
            $resultado = self::$db->query($query);
        } catch (\mysqli_sql_exception $th) {
            $resultado = '';
        }

        if ($resultado) {
            $this->borrarImagen();
            header("Location: /admin?resultado=3");
        } else {
            header("Location: /admin");
        }
    }
}
