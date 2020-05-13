<?php

include 'DBconn.php';

class Sale extends DBconn{

    function checkConn()
    {
        $this->connect();
    }

    function getAll(){
        $result = $this->connect()->query('SELECT * FROM registre');

        return $result;
    }

    function getByName($name)
    {
      $result = $this->connect()->query('SELECT * FROM registre WHERE name_client LIKE \'%'.$name.'%\'');

      return $result;
    }
}
?>
