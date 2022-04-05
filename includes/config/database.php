<?php

declare(strict_types=1);
function conectarDB(): mysqli
{
    try {
        $db = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASSWORD'], $_ENV['DB_BD']);
        return $db;
    } catch (mysqli_sql_exception $e) {
        echo "Error no se pudo conectar " . $e;
        exit;
    }
  
}
