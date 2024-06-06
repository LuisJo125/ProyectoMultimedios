<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json; charset=utf-8');
    header('Access-Control-Allow-Methods: PUT, POST, DELETE, GET, OPTIONS');
    header('Access-Control-Max-Age: 3600');
    header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin, Authorization, X-Requested-With');

    include_once '../config/database.php';

    $database = new DatabasesConexion();
    $db = $database->obtenerConn();


    $request_method = $_SERVER["REQUEST_METHOD"];

    switch ($request_method){

        case 'PUT':
            http_response_code(200);
            actualizarCliente();
            break;

        case 'POST':            
            insertarCliente();
            break;
                
        case 'DELETE':
            http_response_code(200);
            borrarCliente();
            break;
                    
        case 'GET':
                if (!empty($_GET["id"])){
                    $id = intval($_GET["id"]);
                        obtenerCliente($id);
                }
                else{
                        obtenerClientes();
                }
            break;
                                            
        case 'OPTIONS':
            http_response_code(200);
            break;
                            
        default:
            http_response_code(200);
            break;


    }


    function obtenerClientes(){
        
        global $db;

            $query = "SELECT `IdCliente`, `Cedula`, `Nombre`, `Apellido`, `Telefono`, `Correo`, `Estado` FROM `EVM_Clientes`";
            $stm = $db->prepare($query);
            $stm->execute();
    
            $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
    
            echo json_encode($resultado);
        
    }

    function obtenerCliente($id){
        global $db;

            $query = "SELECT `IdCliente`, `Cedula`, `Nombre`, `Apellido`, `Telefono`, `Correo`, `Estado` FROM `EVM_Clientes` where  `IdCliente`=?";
            $stm = $db->prepare($query);            
            $stm->bindParam(1, $id);
            $stm->execute();
    
            $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
    
            echo json_encode($resultado);
        
    
    }


    function insertarCliente(){
        global $db;
        $data = json_decode(file_get_contents("php://input"));
        
        $query = "INSERT INTO `EVM_Clientes` ( `Cedula`, `Nombre`, `Apellido`, `Telefono`, `Correo`, `Estado` ) values ( :cedula, :nombre, :apellido, :telefono, :correo, :estado)";
        $stm = $db->prepare($query);
        $stm->bindParam(":cedula", $data->cedula);
        $stm->bindParam(":nombre", $data->nombre);            
        $stm->bindParam(":apellido", $data->apellido);
        $stm->bindParam(":telefono", $data->telefono);
        $stm->bindParam(":correo", $data->correo);  
        $stm->bindParam(":estado", $data->estado);
   
        if($stm->execute()){
            
            echo json_encode(array("message" => "Datos ingresados correct", "code" => "success"));
        }else{
            
            echo json_encode(array("message" => "Datos ingresados incorrect", "code" => "danger"));
        }

    }


    function actualizarCliente(){
        global $db;
        $data = json_decode(file_get_contents("php://input"));
        
        $query = "UPDATE `EVM_Clientes` SET `Cedula`= :cedula, `Nombre`=:nombre, `Apellido`=:apellido, `Telefono`=:telefono, `Correo`=:correo, `Estado`=:estado, where `IdCliente`=:idCliente";
          
        $stm = $db->prepare($query);            
        $stm->bindParam(":cedula", $data->cedula);
        $stm->bindParam(":nombre", $data->nombre);            
        $stm->bindParam(":apellido", $data->apellido);
        $stm->bindParam(":telefono", $data->telefono);
        $stm->bindParam(":correo", $data->correo);  
        $stm->bindParam(":estado", $data->estado);
   
        if($stm->execute()){
            
            echo json_encode(array("message" => "Datos actualizados correct", "code" => "success"));
        }else{
            
            echo json_encode(array("message" => "Datos actualizados incorrect", "code" => "danger"));
        }

    }


    function borrarCliente(){
        global $db;
        $data = json_decode(file_get_contents("php://input"));
        
        $query = "DELETE FROM `EVM_Clientes` where `IdCliente`=:idCliente";
          
        $stm = $db->prepare($query);            
        $stm->bindParam(":idCliente", $data->idCliente);
   
        if($stm->execute()){
            
            echo json_encode(array("message" => "Datos eliminados correct", "code" => "success"));
        }else{
            
            echo json_encode(array("message" => "Datos eliminados incorrect", "code" => "danger"));
        }
    }



?>