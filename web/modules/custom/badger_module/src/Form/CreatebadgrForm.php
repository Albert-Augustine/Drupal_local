<?php

namespace Drupal\badger_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Form\FormStateInterface;

class CreatebadgrForm extends FormBase {

  public function getFormId() {
    return 'createbadgr_form_api';
  }
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['type_options'] = array(
    '#type' => 'value',
    '#value' => array('List' => t('List'),
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
      //'#required' => TRUE,
      '#states' => [
        'optional' => [
          ['select[name="type"]' => ['value' => 'List']],
          ['select[name="type"]' => ['value' => 'Create']],
          ['select[name="type"]' => ['value' => 'Update']],
        ],
        'invisible' => [
          ':input[name="type"]' => ['value' => 'List'], 
        ],
      ],
    );
    $form['image'] = [
      '#type' => 'managed_file',
      '#title' => t('Image'),
      '#upload_validators' => [
        'file_validate_extensions' => ['png'],
       // 'file_validate_size' => array(25600000),
      ],
      '#upload_location' => 'public://badge_image/',
      '#enctype' => 'multipart/form-data',
      '#states' => [
        'optional' => [
          ['select[name="type"]' => ['value' => 'List']],
          ['select[name="type"]' => ['value' => 'Create']],
          ['select[name="type"]' => ['value' => 'Update']],
        ],
        'invisible' => [
          ':input[name="type"]' => ['value' => 'List'], 
        ],
      ],
    ];
    $form['description'] = array(
      '#type' => 'textfield',
      '#title' => t('Description:'),
      //'#required' => TRUE,
      '#states' => [
        'optional' => [
          ['select[name="type"]' => ['value' => 'List']],
          ['select[name="type"]' => ['value' => 'Create']],
          ['select[name="type"]' => ['value' => 'Update']],
        ],
        'invisible' => [
          ':input[name="type"]' => ['value' => 'List'], 
        ],
      ],
    );
    $form['criteriaUrl'] = array (
      '#type' => 'textfield',
      '#title' => t('CriteriaUrl'),
      //'#required' => TRUE,
      '#states' => [
        'optional' => [
          ['select[name="type"]' => ['value' => 'List']],
          ['select[name="type"]' => ['value' => 'Create']],
          ['select[name="type"]' => ['value' => 'Update']],
        ],
        'invisible' => [
          ':input[name="type"]' => ['value' => 'List'], 
        ],
      ],
    );
    $form['entityid'] = array (
      '#type' => 'textfield',
      '#title' => t('Entity id'),
      //'#required' => TRUE,
      '#states' => [
        'optional' => [
          ['select[name="type"]' => ['value' => 'List']],
          ['select[name="type"]' => ['value' => 'Create']],
          ['select[name="type"]' => ['value' => 'Update']],
        ],
        'visible' => [
          ':input[name="type"]' => ['value' => 'Update'], 
        ],
      ],
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
    $config = $this->config('badger_module.settings');
    $username = $config->get('username');
    $password = $config->get('password');
    $name = $form_state->getValue('name');
    $description = $form_state->getValue('description');
    $criteriaUrl = $form_state->getValue('criteriaUrl');
    $entityid = $form_state->getValue('entityid');
    $type = $form_state->getValue('type');
    if($type == 'Create' || $type == 'Update') {
      $imagefield = $form_state->getValue('image');
      foreach ($imagefield as $value) {
       $imageid = $value;//The file ID
       //ddl($imageid);
      }
      $file = \Drupal\file\Entity\File::load($imageid);
      $path = $file->getFileUri();
      $img_file = file_get_contents($path);
      $ext = pathinfo($path, PATHINFO_EXTENSION);
      $base64img = base64_encode($img_file);
      $image = "data:image/{$ext};base64,{$base64img}";
    } 
    $badgr  = ['image' => $image, 'name' => $name, 'description' => $description, 'criteriaUrl' => $criteriaUrl];


    $service = \Drupal::service('badger_module.say_hello');
    $token = $service->badgr_initiate($username, $password);
    $access_token = $token['accesstoken']; 
    
    if ($type == 'Create') { 
      dsm($service->badgr_create_issuer_badges($access_token, $badgr));
    }
    elseif ($type == 'Update') {
      dsm($service->badgr_update_issuer_badges($access_token, $entityid, $badgr));
    }
    elseif ($type == 'List') {
      dsm($service->badgr_list_all_badges($access_token));
    }
    // ddl($access_token);
    //$service->badgr_create_issuer($access_token,$issuer);
  }
  // $service = \Drupal::service('service_module.say_hello');
  //   dsm($service->badgr_initiate($username,$password));
  // ddl($username);
}
  
                            