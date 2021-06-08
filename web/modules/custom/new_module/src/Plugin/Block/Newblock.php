<?php

namespace Drupal\new_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'New Block Form' Block.
 *
 * @Block(
 *   id = "add_form1",
 *   admin_label = @Translation("New_add_form"),
 *   category = @Translation("Our example Drupal block form"),
 * )
 */
class Newblock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $node = \Drupal\node\Entity\Node::create(['type' => 'user_page']);
    $form = \Drupal::service('entity.form_builder')->getForm($node);
    // $form['name'] = array(
    //   '#type' => 'textfield',
    //   '#title' => t('Candidate Name:'),
    //   '#required' => TRUE,
    // );
    return $form;
  }
  
}