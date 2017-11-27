<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Drupal\d8_examples\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Url;
use Drupal\Core\Render\Element;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\HtmlCommand;

/**
 * Class MydataForm.
 *
 * @package Drupal\mydata\Form
 */
class d8examplesForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'd8_examples_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $conn = Database::getConnection();

    $record = array();
    if (isset($_GET['num'])) {
      $query = $conn->select('mydata', 'm')
          ->condition('id', $_GET['num'])
          ->fields('m');
      $record = $query->execute()->fetchAssoc();
    }
    $form['candidate_name'] = array(
      '#type' => 'textfield',
      '#title' => t('Candidate Name:'),
      '#required' => TRUE,
      //'#default_values' => array(array('id')),
      '#default_value' => (isset($record['name']) && $_GET['num']) ? $record['name'] : '',
    );
    $form['mobile_number'] = array(
      '#type' => 'textfield',
      '#title' => t('Mobile Number:'),
      '#default_value' => (isset($record['mobilenumber']) && $_GET['num']) ? $record['mobilenumber'] : '',
    );

    $form['user_email'] = array(
      '#type' => 'textfield',
      '#title' => 'User or Email',
      '#description' => 'Please enter in a user or email',
      '#prefix' => '<div id="user-email-result"></div>',
      '#ajax' => array(
        'callback' => "::checkUserEmailValidation",
        'effect' => 'fade',
        'event' => 'change',
        'progress' => array(
          'type' => 'throbber',
          'message' => NULL,
        ),
      ),
    );


    $form['candidate_mail'] = array(
      '#type' => 'email',
      '#title' => t('Email ID:'),
      '#required' => TRUE,
      '#default_value' => (isset($record['email']) && $_GET['num']) ? $record['email'] : '',
    );
    $form['candidate_age'] = array(
      '#type' => 'textfield',
      '#title' => t('AGE'),
      '#required' => TRUE,
      '#default_value' => (isset($record['age']) && $_GET['num']) ? $record['age'] : '',
    );
    $form['candidate_gender'] = array(
      '#type' => 'select',
      '#title' => ('Gender'),
      '#options' => array(
        'Female' => t('Female'),
        'male' => t('Male'),
        '#default_value' => (isset($record['gender']) && $_GET['num']) ? $record['gender'] : '',
      ),
    );
    $form['web_site'] = array(
      '#type' => 'textfield',
      '#title' => t('web site'),
      '#default_value' => (isset($record['website']) && $_GET['num']) ? $record['website'] : '',
    );
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => 'save',
        //'#value' => t('Submit'),
    ];

//create table header
    $header_table = array(
      'id' => t('SrNo'),
      'name' => t('Name'),
      'mobilenumber' => t('MobileNumber'),
      'email' => t('Email'),
      'age' => t('Age'),
      'gender' => t('Gender'),
      'website' => t('Web site'),
      'opt' => t('operations'),
        //'opt1' => t('operations'),
    );

//select records from table

    $query = \Drupal::database()->select('mydata', 'm');
    $query->fields('m', ['id', 'name', 'mobilenumber', 'email', 'age', 'gender', 'website']);
    $pager = $query->extend('Drupal\Core\Database\Query\PagerSelectExtender')->limit(10);
    $results = $query->execute()->fetchAll();
    $rows = array();
    foreach ($results as $data) {
      $delete = Url::fromUserInput('/d8_examples/form/cf/delete/' . $data->id);
      $edit = Url::fromUserInput('/d8_examples/form/cf?num=' . $data->id);
//print the data from table
      $rows[] = array(
        'id' => $data->id,
        'name' => $data->name,
        'mobilenumber' => $data->mobilenumber,
        'email' => $data->email,
        'age' => $data->age,
        'gender' => $data->gender,
        'website' => $data->website,
        \Drupal::l('Delete', $delete),
        \Drupal::l('Edit', $edit),
      );
    }
//display data in site
    $form['table'] = [
      '#type' => 'table',
      '#header' => $header_table,
      '#rows' => $rows,
      '#empty' => t('No data found'),
    ];

// Finally add the pager.
    $form['pager'] = array(
      '#type' => 'pager'
    );
    return $form;
  }

  public function checkUserEmailValidation(array $form, FormStateInterface $form_state) {
    $ajax_response = new AjaxResponse();

// Check if User or email exists or not
    if (user_load_by_name($form_state->getValue(user_email)) || user_load_by_mail($form_state->getValue(user_email))) {
      $text = "User or Email already exists";
    }
    else {
      $text = "User or Email is good";
    }
    $ajax_response->addCommand(new HtmlCommand("#user-email-result", $text));
    return $ajax_response;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $name = $form_state->getValue('candidate_name');
    if (preg_match('/[^A-Za-z]/', $name)) {
      $form_state->setErrorByName('candidate_name', $this->t('your name must in characters without space'));
    }
    if (!intval($form_state->getValue('candidate_age'))) {
      $form_state->setErrorByName('candidate_age', $this->t('Age needs to be a number'));
    }
    /* $number = $form_state->getValue('candidate_age');
      if(!preg_match('/[^A-Za-z]/', $number)) {
      $form_state->setErrorByName('candidate_age', $this->t('your age must in numbers'));
      } */
    if (strlen($form_state->getValue('mobile_number')) < 10) {
      $form_state->setErrorByName('mobile_number', $this->t('your mobile number must in 10 digits'));
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $field = $form_state->getValues();
    $name = $field['candidate_name'];
//echo "$name";
    $number = $field['mobile_number'];
    $email = $field['candidate_mail'];
    $age = $field['candidate_age'];
    $gender = $field['candidate_gender'];
    $website = $field['web_site'];
    if (isset($_GET['num'])) {
      $field = array(
        'name' => $name,
        'mobilenumber' => $number,
        'email' => $email,
        'age' => $age,
        'gender' => $gender,
        'website' => $website,
      );
      $query = \Drupal::database();
      $query->update('mydata')
          ->fields($field)
          ->condition('id', $_GET['num'])
          ->execute();
      drupal_set_message("succesfully updated");
//$form_state->setRedirect('mydata.display_table_controller_display');
    }
    else {
      $field = array(
        'name' => $name,
        'mobilenumber' => $number,
        'email' => $email,
        'age' => $age,
        'gender' => $gender,
        'website' => $website,
      );
      $query = \Drupal::database();
      $query->insert('mydata')
          ->fields($field)
          ->execute();
      drupal_set_message("succesfully saved");
      $response = new RedirectResponse("/d8/d8_examples/form/cf");
      $response->send();
    }
  }

}
