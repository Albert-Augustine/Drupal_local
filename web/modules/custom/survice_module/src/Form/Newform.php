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
    $form['type_options'] = array(
    '#type' => 'value',
    '#value' => array('None' => t('None'),
                      'Create' => t('Create'),
                      'Update' => t('Update'))
    );
    $form['type'] = array(
      '#title' => t('Project Type'),
      '#type' => 'select',
      '#description' => "Select the project count type.",
      '#options' => $form['type_options']['#value'],
    );
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
    //ddl($username);
    $name = $form_state->getValue('name');
    $email = $form_state->getValue('email');
    $url = $form_state->getValue('url');
    $type = $form_state->getValue('type');
    $issuer  = ['name' => $name, 'email' => $email, 'url' => $url];
    $id = '3I2tDhQLQzCX4_LhMQ5V6A';

    if ($type == 'Create') {
      $service = \Drupal::service('service_module.say_hello');
      $service->badgr_initiate($username, $password);
      $token = $service->badgr_initiate($username, $password);
      $access_token = $token['accesstoken'];
      //ddl($access_token); 
      $service->badgr_create_issuer($access_token,$issuer);
    }
    elseif ($type == 'Update') {
      $service = \Drupal::service('service_module.say_hello');
      $service->badgr_initiate($username, $password);
      $token = $service->badgr_initiate($username, $password);
      $access_token = $token['accesstoken']; 
      // ddl($access_token);
      $service->badgr_update_issuer($access_token , $issuer, $id);
    }
  }
  // $service = \Drupal::service('service_module.say_hello');
  //   dsm($service->badgr_initiate($username,$password));
  // ddl($username);
}
  
                            