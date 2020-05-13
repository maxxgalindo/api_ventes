<?php

function openConn($db)
{
  $server = "localhost";
  $username = "root";
  $pass = "";

  $conn = new mysqli($server, $username, $pass, $db);
  if ($conn->connect_error) {
    echo "ERROR";
  }

  $conn->set_charset('utf8') or die("Error setting charset: ".$conn->error);

  return($conn);
}

function closeConn($conn){
  $conn->close();
}

?>
