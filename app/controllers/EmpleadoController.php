<?php
require_once './models/Usuario.php';
require_once './models/Empleado.php';
require_once './interfaces/IApiUsable.php';

class EmpleadoController extends Empleado implements IApiUsable
{
    public function CargarUno($request, $response, $args)
    {
      $parametros = $request->getParsedBody();
      if(isset($_POST['tipo'])){
          $tipo = $parametros['tipo'];
          $usuario = $parametros['usuario'];
          $clave = $parametros['clave'];
          $nuevoEmpleado = new Empleado($tipo,$usuario,$clave);
          $nuevoEmpleado->GuardarEmpleado();

          $payload = json_encode(array("Empleado" => "Empleado creado con exito"));

          $response->getBody()->write($payload);
          return $response
          ->withHeader('Content-Type', 'application/json');
      }
    }

    public function TraerUno($request, $response, $args)
    {

    }

    public function TraerTodos($request, $response, $args)
    {
        $objAccesoDatos = AccesoDatos::obtenerInstancia();
        $consulta = $objAccesoDatos->prepararConsulta("SELECT id, tipo, fecha_de_registro FROM empleado");
        $consulta->execute();
  
        $array = $consulta->fetchAll();
        $payload = json_encode(array("mensaje" =>  $array));
  
            $response->getBody()->write($payload);
            return $response
            ->withHeader('Content-Type', 'application/json');
    }
    
    public function ModificarUno($request, $response, $args)
    {

    }

    public function BorrarUno($request, $response, $args)
    {

    }
}
