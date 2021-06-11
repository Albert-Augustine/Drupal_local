<?php

namespace Drupal\service_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Form\FormStateInterface;

class Createbadgr extends FormBase {

  public function getFormId() {
    return 'createbadgr_form_api';
  }
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = array(
      '#type' => 'textfield',
      '#title' => t('name:'),
      '#required' => TRUE,
    );
    $form['image'] = array(
      '#title' => t('Image.'),
      '#type' => 'managed_file',
      '#description' => t('Tamaño máximo 3Mb y formato aceptado jpg,jpeg o png'),
      '#upload_location' => 'public://',
      '#upload_validators' => array(
        'file_validate_extensions' => array('png jpg jpeg'),
        'file_validate_size' => array(3*300*300),
      ),
    );
    $form['description'] = array(
      '#type' => 'textfield',
      '#title' => t('Description:'),
      '#required' => TRUE,
    );
    $form['criteriaUrl'] = array (
      '#type' => 'textfield',
      '#title' => t('CriteriaUrl'),
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
    $description = $form_state->getValue('description');
    $criteriaUrl = $form_state->getValue('criteriaUrl');
    $image1 = $form_state->getValue('image');
    $image2 = file_get_contents('image');
    $image = base64_encode($image2); 
    $badgr  = ['image' => $image, 'name' => $name, 'description' => $description, 'criteriaUrl' => '$criteriaUrl'];


    $service = \Drupal::service('service_module.say_hello');
    dsm($service->badgr_initiate($username, $password));
    $token = $service->badgr_initiate($username, $password);
    $access_token = $token['accesstoken']; 
    dsm($service->badgr_create_issuer_badges($access_token, $badgr));
    // ddl($access_token);
    //$service->badgr_create_issuer($access_token,$issuer);
  }
  // $service = \Drupal::service('service_module.say_hello');
  //   dsm($service->badgr_initiate($username,$password));
  // ddl($username);
}
  
                            