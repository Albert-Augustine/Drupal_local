<?php

namespace Drupal\custom_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Block Form' Block.
 *
 * @Block(
 *   id = "add_form",
 *   admin_label = @Translation("Add_form"),
 *   category = @Translation("Our example Drupal block form"),
 * )
 */
class Newblock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $node = \Drupal\node\Entity\Node::create(['type' => 'district']);
    $form = \Drupal::service('entity.form_builder')->getForm($node);
    return $form;
  } 
}