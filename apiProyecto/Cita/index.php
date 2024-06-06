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
            actualizarCita();
            break;

        case 'POST':            
            insertarCita();
            break;
                
        case 'DELETE':
            http_response_code(200);
            borrarCita();
            break;
                    
        case 'GET':
                if (!empty($_GET["id"])){
                    $id = intval($_GET["id"]);
                    obtenerCita($id);
                }
                else{
                    obtenerCitas();
                }
            break;
                                            
        case 'OPTIONS':
            http_response_code(200);
            break;
                            
        default:
            http_response_code(200);
            break;


    }


    function obtenerCitas(){
        
        global $db;

            $query = "SELECT `IdCita`, `Fecha`, `Hospital`, `IdMedico`, `IdServicio`, `IdCliente`, `Estado` FROM `EVM_Citas`";
            $stm = $db->prepare($query);
            $stm->execute();
    
            $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
    
            echo json_encode($resultado);
        
    }

    function obtenerCita($id){
        global $db;

            $query = "SELECT `IdCita`, `Fecha`, `Hospital`, `IdMedico`, `IdServicio`, `IdCliente`, `Estado` FROM `EVM_Citas` where `id`=?";
            $stm = $db->prepare($query);            
            $stm->bindParam(1, $id);
            $stm->execute();
    
            $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
    
            echo json_encode($resultado);
        
    
    }


    function insertarCita(){
        global $db;
        $data = json_decode(file_get_contents("php://input"));
        
        $query = "INSERT INTO `EVM_Citas` ( `Fecha`, `Hospital`, `IdMedico`, `IdServicio`, `IdCliente`, `Estado` ) values ( :fecha, :hospital, :idMedico, :idServicio, :idCliente, :estado)";
        $stm = $db->prepare($query);            
        $stm->bindParam(":fecha", $data->Fecha);
        $stm->bindParam(":hospital", $data->Hospital);
        $stm->bindParam(":idMedico", $data->IdMedico);
        $stm->bindParam(":idServicio", $data->IdServicio);
        $stm->bindParam(":idCliente", $data->IdCliente);
        $stm->bindParam(":estado", $data->Estado);
        
   
        if($stm->execute()){
            
            echo json_encode(array("message" => "Datos ingresados correctamente", "code" => "success"));
        }else{
            
            echo json_encode(array("message" => "Ocurrió un error al insertar", "code" => "danger"));
        }

    }


    function actualizarCita(){
        global $db;
        $data = json_decode(file_get_contents("php://input"));
        
        $query = "UPDATE `EVM_Citas` SET `Fecha`= :fecha, `Hospital`=:hospital, `IdMedico`=:idMedico, `IdServicio`=:idServicio, `IdCliente`=:idCliente, `Estado`=:estado, where `IdCita`=:id";
          
        $stm = $db->prepare($query);            
        $stm->bindParam(":fecha", $data->Fecha);
        $stm->bindParam(":hospital", $data->Hospital);
        $stm->bindParam(":idMedico", $data->IdMedico);
        $stm->bindParam(":idServicio", $data->IdServicio);
        $stm->bindParam(":idCliente", $data->IdCliente);
        $stm->bindParam(":estado", $data->Estado);
   
        if($stm->execute()){
            
            echo json_encode(array("message" => "Datos actualizados correctamente", "code" => "success"));
        }else{
            
            echo json_encode(array("message" => "Ocurrió un error al actualizar", "code" => "danger"));
        }

    }


    function borrarCita(){
        global $db;
        $data = json_decode(file_get_contents("php://input"));
        
        $query = "DELETE FROM `EVM_Citas` where `IdCita`=:id";
          
        $stm = $db->prepare($query);            
        $stm->bindParam(":id", $data->IdCita);
   
        if($stm->execute()){
            
            echo json_encode(array("message" => "Datos eliminados correctamente", "code" => "success"));
        }else{
            
            echo json_encode(array("message" => "Ocurrió un error al eliminar", "code" => "danger"));
        }
    }



?>