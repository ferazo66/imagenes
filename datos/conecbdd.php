<?php
/**
 * Clase que envuelve una instancia de la clase PDO
 * para el manejo de la base de modelos
 */

require_once 'conect.php';


class ConexionBD
{

    /**
     * �nica instancia de la clase
     */
    private static $db = null;

    /**
     * Instancia de PDO
     */
    private static $pdo;

    final private function __construct()
    {
        try {
            // Crear nueva conexi�n PDO
            self::obtenerBD();
        } catch (PDOException $e) {
            // Manejo de excepciones
        }
    }

    /**
     * Retorna en la �nica instancia de la clase
     * @return ConexionBD|null
     */
    public static function obtenerInstancia()
    {
        if (self::$db === null) {
            self::$db = new self();
        }
        return self::$db;
    }

    /**
     * Crear una nueva conexi�n PDO basada
     * en las constantes de conexi�n
     * @return PDO Objeto PDO
     */
    public function obtenerBD()
    {
        if (self::$pdo == null) {
            self::$pdo = new PDO(
                'mysql:dbname=' . BASE_DE_DATOS .
                ';host=' . NOMBRE_HOST . ";",
                USUARIO,
                CONTRASENA,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
            // Habilitar excepciones
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
    /**
     * Evita la clonaci�n del objeto
     */
    final protected function __clone()
    {
    }

    function _destructor()
    {
        self::$pdo = null;
    }
}

?>