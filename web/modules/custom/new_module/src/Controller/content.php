<?php

namespace Drupal\new_module\Controller;

use Drupal\Core\Controller\ControllerBase;

class content extends ControllerBase {
  
  public function good() {
    $currentAccount = \Drupal::currentUser()->id();
    $nids = \Drupal::entityQuery('node')
      ->condition('type', 'user_page')
      ->condition('uid', $currentAccount)
      ->execute();
    $nodes = \Drupal\node\Entity\Node::loadMultiple($nids);
    foreach ($nodes as $node) {
    	$title .= $node->getTitle();
    }
    return [
    	'#markup' => $title,
    ];
  }
}