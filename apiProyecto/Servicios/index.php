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
            actualizarServicio();
            break;

        case 'POST':            
            insertarServicio();
            break;
                
        case 'DELETE':
            http_response_code(200);
            borrarServicio();
            break;
                    
        case 'GET':
                if (!empty($_GET["id"])){
                    $id = intval($_GET["id"]);
                    obtenerSerivicio($id);
                }
                else{
                    obtenerServicios();
                }
            break;
                                            
        case 'OPTIONS':
            http_response_code(200);
            break;
                            
        default:
            http_response_code(200);
            break;


    }


    function obtenerServicios(){
        
        global $db;

            $query = "SELECT `IdServicio`, `IdEmpleado`, `Descripcion`, `Hospital`, `Precio` FROM `EVM_Servicios`";
            $stm = $db->prepare($query);
            $stm->execute();
    
            $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
    
            echo json_encode($resultado);
        
    }

    function obtenerSerivicio($id){
        global $db;

            $query = "SELECT `IdServicio`, `IdEmpleado`, `Descripcion`, `Hospital`, `Precio` FROM `EVM_Servicios` where  `IdServicio`=?";
            $stm = $db->prepare($query);            
            $stm->bindParam(1, $id);
            $stm->execute();
    
            $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
    
            echo json_encode($resultado);
        
    
    }


    function insertarServicio(){
        global $db;
        $data = json_decode(file_get_contents("php://input"));
        
        $query = "INSERT INTO `EVM_Servicios` ( `IdEmpleado`, `Descripcion`, `Hospital`, `Precio` ) values ( :idEmpleado, :descripcion, :hospital, :precio)";
        $stm = $db->prepare($query);            
        $stm->bindParam(":idEmpleado", $data->idEmplado);
        $stm->bindParam(":descripcion", $data->descripcion);
        $stm->bindParam(":hospital", $data->hospital);
        $stm->bindParam(":precio", $data->precio);
   
        if($stm->execute()){
            
            echo json_encode(array("message" => "Datos ingresados correct", "code" => "success"));
        }else{
            
            echo json_encode(array("message" => "Datos ingresados incorrect", "code" => "danger"));
        }

    }


    function actualizarServicio(){
        global $db;
        $data = json_decode(file_get_contents("php://input"));
        
        $query = "UPDATE `EVM_Servicios` SET `IdEmpleado`= :idEmpleado, `Descripcion`=:descripcion, `Hospital`=:hospital, `Precio`=:precio where `IdServicio`=:id";
          
        $stm = $db->prepare($query); 
        $stm->bindParam(":id", $data->id);           
        $stm->bindParam(":idEmpleado", $data->idEmplado);
        $stm->bindParam(":descripcion", $data->descripcion);
        $stm->bindParam(":hospital", $data->hospital);
        $stm->bindParam(":precio", $data->precio);
   
        if($stm->execute()){
            
            echo json_encode(array("message" => "Datos actualizados correct", "code" => "success"));
        }else{
            
            echo json_encode(array("message" => "Datos actualizados incorrect", "code" => "danger"));
        }

    }


    function borrarServicio(){
        global $db;
        $data = json_decode(file_get_contents("php://input"));
        
        $query = "DELETE FROM `EVM_Servicios` where `IdServicio`=:id";
          
        $stm = $db->prepare($query);            
        $stm->bindParam(":id", $data->id);
   
        if($stm->execute()){
            
            echo json_encode(array("message" => "Datos eliminados correct", "code" => "success"));
        }else{
            
            echo json_encode(array("message" => "Datos eliminados incorrect", "code" => "danger"));
        }
    }



?>