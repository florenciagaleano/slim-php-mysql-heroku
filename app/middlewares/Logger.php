<?php

use GuzzleHttp\Psr7\Response;


class Logger
{
    public static function VerificarCredenciales($request, $handler)
    {
        $method = $request->getMethod();
        $response = new Response();
        
        if($method == 'GET'){
            $response = $handler->handle($request);
            $response->getBody()->write("El metodo de la solicitud es " . $method);
        }else if($method == 'POST'){
            $response = $handler->handle($request);

            $data = $request->getParsedBody();
            $nombre = $data['nombre'];
            $perfil = $data['perfil'];
            var_dump($data['nombre']);
            if($perfil == "administrador"){
                $response = $handler->handle($request);

                $response->getBody()->write("Bienvenido " . $nombre);
            }else{
                $response->getBody()->write("No sos administrador");
            }
        }

        return $response;
    }

    public static function VerificarJson($request, $handler)
    {/*tengo que parsear al body y acceder al json y alas propiedades con el decode */
        $method = $request->getMethod();
        $response = new Response();
        
        if($method == 'GET'){
            $response = $handler->handle($request);
            $response->getBody()->write(json_encode(["API"=>$method]));

        }else if($method == 'POST'){
            $response = $handler->handle($request);

            $data = $request->getParsedBody();
            $nombre = $data['nombre'];
            $perfil = $data['perfil'];
            var_dump($data);
            if($perfil == "administrador"){
                $response = $handler->handle($request);

                $response->getBody()->write("Bienvenido " . $nombre);
            }else{
                $response->getBody()->write("No sos administrador");
            }
        }

        return $response;
    }
}