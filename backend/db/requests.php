<?php

class dbRequests {
  private $con;

  public function __construct() {

    $config = include('./../config/dev.php');

    $this->con = mysqli_connect(
      $config['dbHost'],
      $config['dbUser'],
      $config['dbPassword'],
      $config['dbName']
    );

    if (mysqli_connect_errno()) {
        printf("Connection failed: %s\n", mysqli_connect_error());
        exit();
    }
  }

  public function insertEmail($email) {

    $datetime = date('Y-m-d H:i:s');

//    $query = "INSERT INTO Products (SKU, Name, Price, Type) VALUES ('{$sku}','{$name}',{$price},'{$attribute}')";

    $query = "INSERT INTO email_list (`email`, `date_added`) VALUES ('" . $email . "','" . $datetime . "');";
    echo $query;


    if ($this->con->query($query)) {

      printf("%d Row successfully inserted into the database!\n ", $this->con->affected_rows);
    } else {

      printf("Error: %s\n", $this->con->error);
    }

    $this->con->close();
  }

  public function deleteEmail($id) {

    $query = "DELETE from email_list WHERE id = '" . $id . "';";
    echo $query;

    if ($this->con->query($query)) {

      printf("%d Row successfully deleted from the database!\n ", $this->con->affected_rows);
    } else {

      printf("Error: %s\n", $this->con->error);
    }

    $this->con->close();
  }

  public function getEmails() {

    $query = "SELECT * from email_list;";
    $result = $this->con->query($query);

    $rows = array();
    while($row = $result->fetch_assoc()) {
      $rows[] = array(
        'id' => $row['id'],
        'email' => $row['email'],
        'date_added' => $row['date_added']
      );
    }

    $this->con->close();

    return $rows;
  }
}

?>
