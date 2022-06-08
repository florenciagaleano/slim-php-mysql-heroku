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

        public function __construct($tipo)
        {
            $this->activo = true;
            $this->setTipo($tipo);
        }

        public function setTipo($tipo){
            $tipo = strtolower($tipo);
            if($tipo != "bartender" &&
            $tipo != "cervecero" &&
            $tipo != "cocinero" &&
            $tipo != "socio" &&
            $tipo != "mozo")
            {
                $this->tipo = "mozo";
            }else{
                $this->$tipo = $tipo;
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

        public function SaveToDB()
        {
            $DBAccessObj = AccesoDatos::obtenerInstancia();
            $stringQuery = 'INSERT INTO Empleado (tipo, fecha_de_registro, activo) VALUES (:tipo, :fecha_de_registro, :activo)';
            $consulta = $DBAccessObj->PrepareQuery($stringQuery);
            $consulta->bindValue(':tipo', $this->tipo, PDO::PARAM_STR);
            $consulta->bindValue(':fecha_de_registro', (new DateTime('now'))->format('Y-m-d'), PDO::PARAM_STR);
            $consulta->bindValue(':activo', true, PDO::PARAM_BOOL);

            $consulta->execute();
    
            return $DBAccessObj->GetLastId();
        }
    }

?>