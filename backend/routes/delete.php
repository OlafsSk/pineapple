<?php

  header('Access-Control-Allow-Origin: http://127.0.0.1:80');
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Allow-Headers: Content-Type, Authorization");
  header("Content-type:application/json");

  include '../db/requests.php';
  include 'validation/routes.php';

  $db = new dbRequests();

  $data = json_decode(file_get_contents("php://input"), true);

  $validate = new DeleteValidation();

  if (!$validate->check($data)) {

    http_response_code(400);

    echo json_encode($validate->getErrors());
    
    return ;
  }

  $db->deleteEmail($data['id']);

  http_response_code(200);

  return;

?>
