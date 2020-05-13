<?php

/*
 * (c) ANGEL GUIMERA I MAX GALINDO
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace maxxgalindo\api_ventes;

include 'ventes.php';

class ApiVentes{

    function check()
    {
      $venta = new Sale();
      $venta->checkConn();
    }

    function getAll()
    {
        $venta = new Sale();
        $ventes = array();
        $ventes['register'] = array();

        $result = $venta->getAll();

        if($result->rowCount()){
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $register = array(
                    'name_client' => $row['name_client'],
                    'phone_client' => $row['phone_client'],
                    'address_client' => $row['address_client'],
                    'date_sale' => $row['date_sale'],
                    'qty_sale' => $row['qty_sale'],
                );
                array_push($ventes['register'], $register);
            }
            http_response_code(200);
            echo json_encode($ventes, $options = JSON_PARTIAL_OUTPUT_ON_ERROR);
        }else{
            http_response_code(404);
            echo json_encode(array('message' => 'Element not found'));
        }
    }

    function getByName($name)
    {
        $venta = new Sale();
        $ventes = array();
        $ventes['register'] = array();

        $result = $venta->getByName($name);

        if($result->rowCount()){
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $register = array(
                    'name_client' => $row['name_client'],
                    'phone_client' => $row['phone_client'],
                    'address_client' => $row['address_client'],
                    'date_sale' => $row['date_sale'],
                    'qty_sale' => $row['qty_sale'],
                );
                array_push($ventes['register'], $register);
            }
            http_response_code(200);
            echo json_encode($ventes, $options = JSON_PARTIAL_OUTPUT_ON_ERROR);
        }else{
            http_response_code(404);
            echo json_encode(array('message' => 'Element not found'));
        }
    }

    function getByDate($date)
    {
        $venta = new Sale();
        $ventes = array();
        $ventes['register'] = array();

        $result = $venta->getAll();
        try{
            $input_parsed = strtotime($date);
        }catch(Exception $e){
            echo "Invalid date<br />";
            echo $e;
            return;
        }

        if($result->rowCount()){
            while($row = $result->fetch(PDO::FETCH_ASSOC)){

                $date_parsed = strtotime($row['date_sale']);
                if ($date_parsed >= $input_parsed) {

                    $register = array(
                        'name_client' => $row['name_client'],
                        'phone_client' => $row['phone_client'],
                        'address_client' => $row['address_client'],
                        'date_sale' => $row['date_sale'],
                        'qty_sale' => $row['qty_sale'],
                    );
                    array_push($ventes['register'], $register);

                }
            }
            http_response_code(200);
            echo json_encode($ventes, $options = JSON_PARTIAL_OUTPUT_ON_ERROR);
        }else{
            http_response_code(404);
            echo json_encode(array('message' => 'Element not found'));
        }
    }
}

$api = new ApiVentes();

if (isset($_GET['name'])) {
    $api->getByName($_GET['name']);
}elseif (isset($_GET['date'])) {
    $api->getByDate($_GET['date']);
}else {
    $api->getAll();
}

?>
