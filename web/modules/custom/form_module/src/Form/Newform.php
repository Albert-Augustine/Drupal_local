<?php

namespace Drupal\form_module\Form;

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
      '#title' => t('Candidate Name:'),
      '#required' => TRUE,
    );
    $form['email'] = array(
      '#type' => 'email',
      '#title' => t('Email ID:'),
      '#required' => TRUE,
    );
    $form['phone_number'] = array (
      '#type' => 'tel',
      '#title' => t('Mobile no'),
    );
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Save'),
      '#button_type' => 'primary',
    );
    return $form;
  }
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $email = $form_state->getValue('email');
    $name = $form_state->getValue('name');
    $phone_number = $form_state->getValue('phone_number');
    // $pno=strlen($phone_number);
    $db = \Drupal::database();
    $nname = $db->select('form_module', 'mm')
    ->fields('mm', ['name'])
    ->condition('mm.name', $name, '=')
    ->execute()
    ->fetchAll();
    foreach ($nname as $value) {
      $mname = $value->name;
    }
    $memail = $db->select('form_module', 'mm')
    ->fields('mm', ['email'])
    ->condition('mm.email', $email, '=')
    ->execute()
    ->fetchAll();
    //ddl($name);
    foreach ($memail as $value) {
      $nmail = $value->email;
    }
    $phonenumber = $db->select('form_module', 'mm')
    ->fields('mm', ['phone_number'])
    ->condition('mm.phone_number', $phone_number, '=')
    ->execute()
    ->fetchAll();
    //ddl($name);
    foreach ($phonenumber as $value) {
      $pphonenumber = $value->phone_number;
    }
    if ((!empty($mname)) && (!empty($nmail)) && (!empty($pphonenumber))){
      $form_state->setErrorByName('name', 'name already exists!');
      $form_state->setErrorByName('mail', 'mail already exists!');
      $form_state->setErrorByName('Mobile no', ' Mobile no already exists!');
    }
    elseif ((!empty($mname)) && (!empty($nmail))) {
      $form_state->setErrorByName('name', 'name already exists!');
      $form_state->setErrorByName('mail', 'mail already exists!');
    }
    elseif ((!empty($nmail)) && (!empty($pphonenumber))) {
      $form_state->setErrorByName('mail', 'mail already exists!');
      $form_state->setErrorByName('Mobile no', ' Mobile no already exists!');
    }
    elseif ((!empty($pphonenumber)) && (!empty($nmail))) {
      $form_state->setErrorByName('Mobile no', ' Mobile no already exists!');
      $form_state->setErrorByName('mail', 'mail already exists!');
    }
    elseif (!empty($mname)) {
      $form_state->setErrorByName('name', 'name already exists!');
    }
    elseif (!empty($nmail)) {
      $form_state->setErrorByName('mail', 'mail already exists!');
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $form_state->setErrorByName('email', 'Invalid email id');
    }
    elseif (!empty($pphonenumber)) {
      $form_state->setErrorByName('Mobile no', ' Mobile no already exists!');
    }
    // elseif (($pno>10) || ($pno<10)) {
    //   $form_state->setErrorByName('Mobile no', ' Mobile number not exists!');
    // }
    elseif(!preg_match('/^[0-9]{10}+$/', $phone_number)) {
       $form_state->setErrorByName('Mobile no', ' Invalid Phone number');
    }
  }

  /**
   *
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // ddl($form_state->getValue('phone_number'));
    \Drupal::database()->insert('form_module')
      ->fields([
        'name' => $form_state->getValue('name'),
        'email' => $form_state->getValue('email'),
        'phone_number' => $form_state->getValue('phone_number'),
      ])
      ->execute();
  }
}
                              









