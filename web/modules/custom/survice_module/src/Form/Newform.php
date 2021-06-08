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
    $form['username'] = array(
      '#type' => 'email',
      '#title' => t('Username:'),
      '#required' => TRUE,
    );
    $form['password'] = array (
      '#type' => 'textfield',
      '#title' => t('Password'),
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
    // \Drupal::database()->insert('service_module')
    //   ->fields([
    //     'username' => $form_state->getValue('username'),
    //     'password' => $form_state->getValue('password'),
    //   ])
    //   ->execute();
    $username = $form_state->getValue('username');
    $password = $form_state->getValue('password');
  }
  // $service = \Drupal::service('service_module.say_hello');
  //   dsm($service->badgr_initiate($username,$password));
  // ddl($username);
}
  
                            