<?php

namespace Drupal\custom_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Block Form' Block.
 *
 * @Block(
 *   id = "block_form",
 *   admin_label = @Translation("Block Form"),
 *   category = @Translation("Our example Drupal block form"),
 * )
 */
class Newblock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\form_module\Form\Newform');
    return $form;
  }
}