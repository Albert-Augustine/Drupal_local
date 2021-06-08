<?php

namespace Drupal\new_module\Controller;

use Drupal\Core\Controller\ControllerBase;

class Newpage extends ControllerBase {
  
  public function good() {
    return array(
      // '#markup' => 'Welcome all.'
    );
  }
}

