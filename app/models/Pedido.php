<?php

class Pedido
{
    public $id;
    public $tiempo;
    public $mesaId;
    public $productoId; //mmmmmmmmmmmmmmmmmmmmmmmmmmmmm
    public $usuarioId;
    public $imagen;

    public function setUsuario($idUsuario){
        //echo Usuario::buscarPorId($idUsuario);
        if(Usuario::buscarPorId($idUsuario) != null){
            return 1;
        }
        return 0;
    }

    public function setMesa($idMesa){
        //echo Mesa::buscarPorId($idMesa);
        if(Mesa::buscarPorId($idMesa) != null){
            return 1;
        }
        return 0;
    }

    public function setProducto($idProducto){
        //echo Producto::buscarPorId($idProducto);
        if(Producto::buscarPorId($idProducto) != null){
            return 1;
        }
        return 0;
    }

    public function crearMesa()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("INSERT INTO mesas (codigo, estado) VALUES (:codigo, :estado)");
        $consulta->bindValue(':codigo', $this->codigo, PDO::PARAM_STR);
        $consulta->bindValue(':estado', $this->estado, PDO::PARAM_STR);

        $consulta->execute();

        return $objAccesoDatos->obtenerUltimoId();
    }

    public function setCodigo($codigo){
        if(strlen($codigo) != 5){
            return 0;
        }
        $this->codigo = $codigo;
        return 1;
    }

    public static function obtenerTodos()
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT * FROM pedidos");
        $consulta->execute();

        return $consulta->fetchAll(PDO::FETCH_CLASS, 'Mesa');
    }

    private function CrearDestino(){
        mkdir("ImagenesDelPedido");
        $mail = explode('@',$this->mail);
        $destino = "ImagenesDelPedido/" . $this->id . ".jpg";
        return $destino;
    }

    public function GuardarImagen(){
        if (move_uploaded_file($this->imagen, $this->CrearDestino())) {
            return true;
        }
        return false;
    }
}