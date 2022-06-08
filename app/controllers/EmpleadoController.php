<?php
require_once './models/Empleado.php';


    class EmpleadoController{
        
        public static function CargarUno($request, $response, $args)
        {
            $parametros = $request->getParsedBody();

            $tipo = $parametros['tipo'];

            $nuevoEmpleado = new Empleado($tipo);

            $payload = json_encode(array("mensaje" => "Empleado creado con exito"));

            $response->getBody()->write($payload);
            return $response
            ->withHeader('Content-Type', 'application/json');
        }
    }
    

?>