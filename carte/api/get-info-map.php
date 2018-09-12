<?php

header('Access-Control-Allow-Origin: *');

$fakeData = [
  [46.6835956, -0.4137665],
  [46.6935956, -0.4137665],
  [46.6885956, -0.4187665]
];

print_r(json_encode(['data' => $fakeData]));

// include_once 'auth.log.bdd.php';
// $sql = 'SELECT * FROM ma_table';
// $connection = getConnection();
// $data = execSql($connection, $sql);
// return json_encode($data);
