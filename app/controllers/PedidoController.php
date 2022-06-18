<?php
require_once './models/Pedido.php';
require_once './interfaces/IApiUsable.php';

class PedidoController extends Pedido implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
        $parametros = $request->getParsedBody();
        
        $pedido = new Pedido();
        $tiempo = $parametros['tiempo'];
        $mesaId = $parametros['mesaId'];
        $productoId = $parametros['productoId'];
        $usuarioId = $parametros['usuarioId'];

        $payload="";

        if($pedido->setUsuario($usuarioId) && $pedido->setMesa($mesaId) && $pedido->setProducto($productoId)){
            if(isset($_FILES['imagen'])){
                $pedido->imagen = $_FILES["imagen"]["tmp_name"];
                $pedido->GuardarImagen();
            }

            $payload = json_encode(array("mensaje" => "Pedido creado con exito"));

        }else{
            $payload = json_encode(array("mensaje" => "Uno de los id ingresados es inexistente"));
        }

        


        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }

    public function TraerUno($request, $response, $args)
    {
        // Buscamos usuario por nombre
        /* $usr = $args['usuario'];
        $usuario = Usuario::obtenerUsuario($usr);
        $payload = json_encode($usuario);

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json'); */
    }

    public function TraerTodos($request, $response, $args)
    {
        $lista = Pedido::obtenerTodos();
        $payload = json_encode(array("listaPedidos" => $lista));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json');
    }
    
    public function ModificarUno($request, $response, $args)
    {
        /* $parametros = $request->getParsedBody();

        $nombre = $parametros['nombre'];
        Usuario::modificarUsuario($nombre);

        $payload = json_encode(array("mensaje" => "Usuario modificado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json'); */
    }

    public function BorrarUno($request, $response, $args)
    {
        /* $parametros = $request->getParsedBody();

        $usuarioId = $parametros['usuarioId'];
        Usuario::borrarUsuario($usuarioId);

        $payload = json_encode(array("mensaje" => "Usuario borrado con exito"));

        $response->getBody()->write($payload);
        return $response
          ->withHeader('Content-Type', 'application/json'); */
    }
}
