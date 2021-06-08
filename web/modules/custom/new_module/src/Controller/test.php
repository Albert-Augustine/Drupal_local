<?php

namespace Drupal\new_module\Controller;

use Drupal\Core\Controller\ControllerBase;

class test extends ControllerBase {
  
  public function hello() {
    return array(
      // '#markup' => 'Welcome all.'
    );
  }
}
