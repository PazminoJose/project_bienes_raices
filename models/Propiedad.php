<?php

declare(strict_types=1);

namespace Model;

class Propiedad extends ActiveRecord
{
    protected static $tabla = "propiedades";
    protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc', 'estacionamiento', 'creado', 'vendedorId'];
    
    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wc;
    public $estacionamiento;
    public $creado;
    public $vendedorId;

    
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->precio = $args['precio'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->descripcion = $args['descripcion'] ?? '';
        $this->habitaciones = $args['habitaciones'] ?? '';
        $this->wc = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado = date("Y/m/d");
        $this->vendedorId = $args['vendedorId'] ?? '';
    }

    public function validar(): array
    {
        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }
        if (!$this->precio) {
            self::$errores[] = "El precio es obligatorio";
        }
        if (strlen($this->descripcion) < 50) {
            self::$errores[] = "La descripción es Obligatoria y debe tener al menos 50 caracteres";
        }
        if (!$this->habitaciones) {
            self::$errores[] = "El número de habitaciónes el obligatorio";
        }
        if (!$this->wc) {
            self::$errores[] = "El número de baños el obligatorio";
        }
        if (!$this->estacionamiento) {
            self::$errores[] = "El número de lugares de estacionamiento es obligatorio";
        }
        if (!$this->vendedorId) {
            self::$errores[] = "Elige un vendedor";
        }
        if (!$this->imagen) {
            self::$errores[] = "La imagen de la propiedad es obligatoria";
        }

        // // Validar por tamaño (100 kb máximo)
        // $medida = 1000 * 100;
        // if ($this->imagen['size'] > $medida) {
        //     self::$errores[] = "La imagen es muy pesada";   *******No es necesaria ya que se usa intervention image*****
        // }

        return self::$errores;
    }
}
