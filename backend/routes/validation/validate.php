<?php

class Validate {

  // private variables for validation verification
  private $_passed = false,
          $_errors = array(),
          $_db = null;

  // validates incoming parameters
  public function check($source, $items = array()) {

    var_dump($items);

    // each parameter has rules
    foreach($items as $item => $rules) {

      // check each rule
      foreach($rules as $rule => $rule_value) {

        // user input value
        $value = $source[$item];

        // field required
        if ($rule === 'required' && empty($value)) {

          $this->addError("{$item} is required");

        } else if (!empty($value)){

          // handle rules
          switch ($rule) {

            case 'includes_one':

              $defined = [];

              foreach ($rule_value as $field) {
                if (!empty($source[$value])) {
                  $defined[] = True;
                }
              }

              if (!(count($defined) > 0)) {
                $this->addError("One of {$rule_value} must be sent in the body.");
              }

              break;

            case 'min':

              if (strlen($value) < $rule_value) {

                $this->addError("{$item} must be a minimum of {$rule_value} characters.");
              }

              break;

            case 'max':

              if (strlen($value) > $rule_value) {

                $this->addError("{$item} must be a maximum of {$rule_value} characters.");
              }

              break;

            case 'in':

              if (!in_array($value, $rule_value)) {

                $list = implode(", ", $rule_value);
                $this->addError("{$item} must be one of the following: {$list}.");
              }

              break;

            case 'array':

              if (!is_array($value)) {

                $this->addError("{$item} must be an array.");
              }

              break;

            case 'string':

              if (!is_string($value)) {

                $this->addError("{$item} must be a string.");
              }

              break;

            case 'number':

              if (!is_numeric($value)) {

                $this->addError("{$item} must be a number");
              }

              break;

            case 'email':

              if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {

                $this->addError("Please provide a valid e-mail address");
              }

              break;

            case 'email_not_columbian':

              if (substr($value, -3) == '.co') {

                $this->addError("We are not accepting subscriptions from Colombia emails");
              }

              break;

            case 'checkbox_checked':

              if ($value == 'false') {

                $this->addError("You must accept the terms and conditions");
              }

              break;

           case 'email_req':

              if ($value == '') {

                $this->addError("Email address is required");
              }

              break;

            case 'matches':

              if ($value != $source[$rule_value]) {

                $this->addError("{$rule_value} must match {$item}");
              }

              break;

            case 'greater_than':

              if ($value < $rule_value) {

                $this->addError("{$item} must be greater than {$rule_value}");
              }

              break;

            case 'lesser_than':

              if ($value > $rule_value) {

                $this->addError("{$item} must be lesser than {$rule_value}");
              }

              break;

            case 'not_empty':

              if (empty($value)) {

                $this->addError("{$item} must not be empty");
              }

              break;

            case 'array_unique':

              if (!array_unique($value)) {

                $this->addError("Array {$item} must have unique values");
              }

              break;

            case 'elem_type':

                foreach ($value as $element) {

                  switch($rule_value){
                    case 'number':

                      if (!is_numeric($element)) {
                        $this->addError("Array elements must be numbers, instead received {$element}.");
                      }

                      break;

                    case 'string':

                      if (!is_string($element)) {
                        $this->addError("Array elements must be strings, instead received {$element}.");
                      }

                      break;

                    case 'array':

                      if (!is_array($element)) {
                        $this->addError("Array elements must be arrays, instead received {$element}.");
                      }

                      break;

                    case 'boolean':

                      if (!is_bool($element)) {
                        $this->addError("Array elements must be arrays, instead received {$element}.");
                      }

                      break;
                  }
                }

              case 'array_unique':
              if (!array_unique($value)) {

                $this->addError("Array {$item} must have unique values");
              }

              break;
          }
        }
      }
    }
    // check if no errors
    if (empty($this->_errors)) {
      $this->_passed = true;
    }

    return $this;
  }

  // add errors to the error list
  private function addError($error) {
    $this->_errors[] = $error;
  }

  // returns the error list
  public function errors() {
    return $this->_errors;
  }

  // return if validation passed
  public function passed() {
    return $this->_passed;
  }
}

 ?>
