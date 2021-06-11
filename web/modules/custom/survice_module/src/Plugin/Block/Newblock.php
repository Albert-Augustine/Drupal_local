<?php

namespace Drupal\service_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Block Form' Block.
 *
 * @Block(
 *   id = "badgr_form",
 *   admin_label = @Translation("Badgr Form"),
 *   category = @Translation("Our example Drupal block form"),
 * )
 */
class Newblock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $form = \Drupal::formBuilder()->getForm('Drupal\service_module\Form\Createbadgr');
    return $form;
  }
}