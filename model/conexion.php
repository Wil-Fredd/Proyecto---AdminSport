<?php

class conexion
{
    public static function conectar()
    {


        $con = null;

        try {

            // Conexión
            $con = new PDO('mysql:host=localhost; dbname=admin_sport', 'root', '');

            // Errores
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Caracteres utf8
            $con->exec("SET CHARACTER SET utf8");

        } catch (Exception $e) {

            $con = "ERROR";

        } finally {

            return $con;

        }
    }

}

?>