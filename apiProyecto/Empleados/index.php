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
            actualizarEmpleado();
            break;

        case 'POST':            
            insertarEmpleado();
            break;
                
        case 'DELETE':
            http_response_code(200);
            borrarEmpleado();
            break;
                    
        case 'GET':
                if (!empty($_GET["id"])){
                    $id = intval($_GET["id"]);
                    obtenerEmpleado($id);
                }
                else{
                    obtenerEmpleados();
                }
            break;
                                            
        case 'OPTIONS':
            http_response_code(200);
            break;
                            
        default:
            http_response_code(200);
            break;


    }


    function obtenerEmpleados(){
        
        global $db;

            $query = "SELECT `IdEmpleado`, `Nombre`, `Apellido`, `Telefono`,`Direccion`, `HospitalResidencia`  FROM `EVM_Empleados`";
            $stm = $db->prepare($query);
            $stm->execute();
    
            $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
    
            echo json_encode($resultado);
        
    }

    function obtenerEmpleado($id){
        global $db;

            $query = "SELECT `IdEmpleado`, `Nombre`, `Apellido`, `Telefono`,`Direccion`, `HospitalResidencia` FROM `EVM_Empleados` where  `IdEmpleado`=?";
            $stm = $db->prepare($query);            
            $stm->bindParam(1, $id);
            $stm->execute();
    
            $resultado = $stm->fetchAll(PDO::FETCH_ASSOC);
    
            echo json_encode($resultado);
        
    
    }


    function insertarEmpleado(){
        global $db;
        $data = json_decode(file_get_contents("php://input"));
        
        $query = "INSERT INTO `EVM_Empleados` ( `Nombre`, `Apellido`, `Telefono`,`Direccion`, `HospitalResidencia`) values ( :nombre, :apellido, :telefono, :direccion, :hospitalResidencia)";
        $stm = $db->prepare($query);            
        $stm->bindParam(":nombre", $data->nombre);
        $stm->bindParam(":apellido", $data->apellido);
        $stm->bindParam(":telefono", $data->telefono);
        $stm->bindParam(":direccion", $data->direccion);
        $stm->bindParam(":hospitalResidencia", $data->hospitalResidencia);

   
        if($stm->execute()){
            
            echo json_encode(array("message" => "Datos ingresados correct", "code" => "success"));
        }else{
            
            echo json_encode(array("message" => "Datos ingresados incorrect", "code" => "danger"));
        }

    }


    function actualizarEmpleado(){
        global $db;
        $data = json_decode(file_get_contents("php://input"));
        
        $query = "UPDATE `EVM_Empleados` SET `Nombre`= :nombre, `Apellido`=:apellido, `Telefono`=:telefono, `Direccion`=:direccion, `HospitalResidencia`=:hospitalResidencia where `IdEmpleado`=:idEmpleado";
          
        $stm = $db->prepare($query);            
        $stm->bindParam(":idEmpleado", $data->idEmpleado);
        $stm->bindParam(":nombre", $data->nombre);
        $stm->bindParam(":apellido", $data->apellido);
        $stm->bindParam(":telefono", $data->telefono);
        $stm->bindParam(":direccion", $data->direccion);
        $stm->bindParam(":hospitalResidencia", $data->hospitalResidencia);

   
        if($stm->execute()){
            
            echo json_encode(array("message" => "Datos actualizados correct", "code" => "success"));
        }else{
            
            echo json_encode(array("message" => "Datos actualizados incorrect", "code" => "danger"));
        }

    }


    function borrarEmpleado(){
        global $db;
        $data = json_decode(file_get_contents("php://input"));
        
        $query = "DELETE FROM `EVM_Empleados` where `IdEmpleado`=:idEmpleado";
          
        $stm = $db->prepare($query);            
        $stm->bindParam(":idEmpleado", $data->idEmpleado);
   
        if($stm->execute()){
            
            echo json_encode(array("message" => "Datos eliminados correct", "code" => "success"));
        }else{
            
            echo json_encode(array("message" => "Datos eliminados incorrect", "code" => "danger"));
        }
    }



?>