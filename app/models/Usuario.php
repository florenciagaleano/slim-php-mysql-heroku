<?php

class Usuario
{
    private $id; //mmmmmmmmmmmmmmm
        private $activo;
        private $tipo;

        public function __construct($tipo)
        {
            $this->activo = true;
            $this->setTipo($tipo);
            //$this->tipo = $tipo; El problema esta en el setTipo aaaaaaaaaaaaaaa
        }

        public function setTipo($tipo){
            if(strtolower($tipo) != "bartender" &&
            strtolower($tipo) != "cervecero" &&
            strtolower($tipo) != "cocinero" &&
            strtolower($tipo) != "socio" &&
            strtolower($tipo) != "mozo")
            {
                $this->tipo = "mozo";
            }else{
                $this->tipo = $tipo;
            }
        }

        public static function GetEmployees()
        {
            $objDBAccess = AccesoDatos::obtenerInstancia();
            $consulta = $objDBAccess->PrepareQuery("SELECT * FROM employee");
            $consulta->execute();
    
            $test = $consulta->fetchAll(PDO::FETCH_CLASS, 'Emp');
            return $test;
        }

        public function GuardarEmpleado()
        {
            $DBAccessObj = AccesoDatos::obtenerInstancia();
            $stringQuery = 'INSERT INTO Empleado (tipo, fecha_de_registro, activo) VALUES (:tipo, :fecha_de_registro, :activo)';
            $consulta = $DBAccessObj->prepararConsulta($stringQuery);
            echo $this->tipo;
            $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
            $consulta->bindValue(':fecha_de_registro', (new DateTime('now'))->format('Y-m-d'), PDO::PARAM_STR);
            $consulta->bindValue(':activo', $this->activo, PDO::PARAM_BOOL);

            $consulta->execute();
        }
    
}

?>