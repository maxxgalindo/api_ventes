<?php

require "vendor/autoload.php";
$faker = Faker\Factory::create();

require "dbConn.php";

$data = array();
$conn = openConn('api_ventes');

for ($i=0; $i < 1000; $i++) {

  $data[$i]["name"] = $faker->name;
  $data[$i]["phoneNumber"] = $faker->phoneNumber;
  $data[$i]["address"] = $faker->address;

  $data[$i]["date"] = $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = 'Europe/Paris')->format('Y-m-d');
  $data[$i]["qty"] = $faker->numberBetween($min=0, $max=10000);

  // var_dump($data[$i]);
  // echo "<br /><br />";

  $qry = "INSERT INTO registre (name_client, phone_client, address_client, date_sale, qty_sale) VALUES ('%s','%s','%s','%s',%d)";
  // $result = $conn->query(sprintf($qry, $data[$i]["name"], $data[$i]["phoneNumber"], $data[$i]["address"], $data[$i]["date"], $data[$i]["qty"]));

  if ($result != True) {
    $i--;
  }
}

closeConn($conn);

?>
