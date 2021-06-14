<?php

namespace Drupal\badger_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Form\FormStateInterface;

class CreateissuerForm extends FormBase {

  public function getFormId() {
    return 'codimth_simple_form_api';
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
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => t('name:'),
      // '#required' => TRUE,
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
    $form['email'] = [
      '#type' => 'email',
      '#title' => t('Email:'),
      // '#required' => TRUE,
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
    $form['url'] = [
      '#type' => 'textfield',
      '#title' => t('Url'),
      // '#required' => TRUE,
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
    $form['entityid'] = [
      '#type' => 'textfield',
      '#title' => t('Entity id'),
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
    ];
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
    //ddl($username);
    $name = $form_state->getValue('name');
    $email = $form_state->getValue('email');
    $url = $form_state->getValue('url');
    $entityid = $form_state->getValue('entityid');
    $type = $form_state->getValue('type');
    $issuer  = ['name' => $name, 'email' => $email, 'url' => $url];
    //$id = '3I2tDhQLQzCX4_LhMQ5V6A';
    $service = \Drupal::service('badger_module.say_hello');
    $token = $service->badgr_initiate($username, $password);
    $access_token = $token['accesstoken'];

    if ($type == 'Create') { 
      dsm($service->badgr_create_issuer($access_token,$issuer));
    }
    elseif ($type == 'Update') {
      $service->badgr_update_issuer($access_token , $issuer, $entityid);
    }
    elseif ($type == 'List') {
      dsm($service->badgr_list_issuer($access_token));
    }
  }
  // $service = \Drupal::service('service_module.say_hello');
  //   dsm($service->badgr_initiate($username,$password));
  // ddl($username);
}
  
                            