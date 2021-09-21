<?php

// validation logic
include 'validate.php';

abstract class Route {

  // internal variables
  protected $validate;
  protected $validation;

  // create new validator
  public function __construct() {
    $this->validate = new Validate();
  }
}

// insert.php validation
class InsertValidation extends Route {

  // rules for user inputs
  private $rules = array(

    // required input fields
    'checkbox' => array(
      'checkbox_checked' => true
    ),
    'email' => array(
      'required' => true,
      'string' => true,
      'email_required' => true,
      'email_not_columbian' => true
    )
  );

  // validation method takes $_POST body
  public function check($source) {

    // perform check
    $this->validation = $this->validate->check($source,$this->rules);

    // return status
    if ($this->validation->passed()) {
      return True;
    } else {
      return False;
    }
  }

  // return errors
  public function getErrors() {
    return $this->validation->errors();
  }
}

// delete.php validation
class DeleteValidation extends Route {

  // rules for user inputs
  private $rules = array(

    // id list
    'id' => array(
      'required' => true,
      'number' => true
    )
  );

  // validation method takes $_POST body
  public function check($source) {

    // perform check
    $this->validation = $this->validate->check($source,$this->rules);

    // return status
    if ($this->validation->passed()) {
      return True;
    } else {
      return False;
    }
  }

  // return errors
  public function getErrors() {
    return $this->validation->errors();
  }
}


?>
