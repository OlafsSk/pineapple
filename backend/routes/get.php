<?php

  header('Access-Control-Allow-Origin: http://127.0.0.1:80');
  header("Access-Control-Allow-Methods: GET");
  header("Access-Control-Allow-Headers: Content-Type, Authorization");
  header("Content-type:application/json");

  include '../db/requests.php';

  $db = new dbRequests();

  $result = $db->getEmails(); // write this method in dbRequests()

  http_response_code(200);

  echo json_encode($result);

?>
