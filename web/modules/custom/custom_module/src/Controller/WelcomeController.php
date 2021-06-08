<?php

namespace Drupal\custom_module\Controller;

use Drupal\Core\Controller\ControllerBase;

class WelcomeController extends ControllerBase {
  
  public function welcome() {
    return array(
      // '#markup' => 'Welcome to My site.'
    );
  }
}

