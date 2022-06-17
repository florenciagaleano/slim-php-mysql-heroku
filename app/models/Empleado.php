<?php

/* use tp_la_comanda;
create table Empleado(
	ID int auto_increment,
    TIPO varchar(50),
    FECHA_DE_REGISTRO date,
    ACTIVO boolean,
    primary key(ID)
); */

class Empleado
    {
        private $id; //mmmmmmmmmmmmmmm
        private $activo;
        private $tipo;
        private $usuario;
        private $clave;

        public function __construct($tipo,$usuario,$clave)
        {
            $this->activo = true;
            $this->setTipo($tipo);
            $this->$usuario = $usuario;
            $this->clave = $clave;
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
    
            $test = $consulta->fetchAll(PDO::FETCH_CLASS, 'Employee');
            return $test;
        }

        public function GuardarEmpleado()
        {
            $DBAccessObj = AccesoDatos::obtenerInstancia();
            $stringQuery = 'INSERT INTO Empleado (usuario, clave, tipo, fecha_de_registro, activo) VALUES (:usuario, :clave, :tipo, :fecha_de_registro, :activo)';
            $consulta = $DBAccessObj->prepararConsulta($stringQuery);
            echo $this->tipo;
            $consulta->bindValue(':usuario', $this->usuario, PDO::PARAM_STR);
            $consulta->bindValue(':clave', $this->clave, PDO::PARAM_STR);
            $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
            $consulta->bindValue(':fecha_de_registro', (new DateTime('now'))->format('Y-m-d'), PDO::PARAM_STR);
            $consulta->bindValue(':activo', $this->activo, PDO::PARAM_BOOL);

            $consulta->execute();
        }

        public static function IniciarSesion(){

        }
    }

?>