<?php

namespace Drupal\badger_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Block Form' Block.
 *
 * @Block(
 *   id = "badger_form",
 *   admin_label = @Translation("Badger Form"),
 *   category = @Translation("Our example Drupal block form"),
 * )
 */
class Newblock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\badger_module\Form\CreatebadgrForm');
    return $form;
  }
}