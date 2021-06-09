<?php

/**
 * @file
 * Contains Drupal\service_module\Form\Serviceform.
 */

namespace Drupal\service_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class Serviceform.
 *
 * @package Drupal\service_module\Form
 */
class Serviceform extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'service_module.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('service_module.settings');
    $form['username'] = array(
      '#type' => 'email',
      '#title' => t('Username:'),
      '#required' => TRUE,
      '#default_value' => $config->get('username'),
    );
    $form['password'] = array (
      '#type' => 'textfield',
      '#title' => t('Password'),
      '#required' => TRUE,
      '#default_value' => $config->get('password'),
    );
    // $form['actions']['submit'] = array(
    //   '#type' => 'submit',
    //   '#value' => $this->t('Summit'),
    //   '#button_type' => 'primary',
    // );
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('service_module.settings')
      ->set('username', $form_state->getValue('username'))
      ->set('password', $form_state->getValue('password'))
      ->save();
    // $username = $form_state->getValue('username');
    // $password = $form_state->getValue('password');
    // $service = \Drupal::service('service_module.say_hello');
    // dsm($service->badgr_initiate($username, $password));
    // $token = $service->badgr_initiate($username, $password);
    // $astoken = $token['accesstoken']; 
    // ddl($astoken);
  }
}