<?php

namespace Drupal\service_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Form\FormStateInterface;

class Newform extends FormBase {

  public function getFormId() {
    return 'codimth_simple_form_api';
  }
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('name:'),
      '#required' => TRUE,
    );
    $form['email'] = array(
      '#type' => 'email',
      '#title' => t('Email:'),
      '#required' => TRUE,
    );
    $form['url'] = array (
      '#type' => 'textfield',
      '#title' => t('Url'),
      '#required' => TRUE,
    );
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Summit'),
      '#button_type' => 'primary',
    );
    return $form;
  } 
  public function validateForm(array &$form, FormStateInterface $form_state) {
   /**
   *
   **/
  // $username = $form_state->getValue('username');
  // $password = $form_state->getValue('password');

  }
  /**
   *
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('service_module.settings');
    $username = $config->get('username');
    $password = $config->get('password');
    $name = $form_state->getValue('name');
    $email = $form_state->getValue('email');
    $url = $form_state->getValue('url');
    $issuer  = ['name' => $name, 'email' => $email, 'url' => $url];


    $service = \Drupal::service('service_module.say_hello');
    dsm($service->badgr_initiate($username, $password));
    $token = $service->badgr_initiate($username, $password);
    $access_token = $token['accesstoken']; 
    // ddl($access_token);
    dsm($service->badgr_create_issuer($access_token,$issuer));
  }
  // $service = \Drupal::service('service_module.say_hello');
  //   dsm($service->badgr_initiate($username,$password));
  // ddl($username);
}
  
                            