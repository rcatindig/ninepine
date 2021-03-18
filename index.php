<?php

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

include 'Vehicle.model.php';
$vehicle = new Vehicle();


$request_method = $_SERVER["REQUEST_METHOD"];

switch($request_method)
{
    case 'GET':
        // Retrive Vehicles
        if(!empty($_GET["id"]))
        {
            echo json_encode($vehicle->get_data($_GET["id"]));
        }
        else
        {
            echo json_encode($vehicle->list());
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        
        echo json_encode($vehicle->insert_data($data));
        break;
    case 'PUT':

            $id=intval($_GET["id"]);
            $data = json_decode(file_get_contents('php://input'), true);

            header('Content-Type: application/json');
            
            echo json_encode($vehicle->update_data($id, $data));
            break;
    default:
        // Invalid Request Method
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

?>