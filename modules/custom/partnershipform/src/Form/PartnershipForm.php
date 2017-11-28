<?php

namespace Drupal\partnershipform\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ChangedCommand;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use \Drupal\node\Entity\Node;
use Drupal\Core\Form;
//
use Drupal\Core\Form\FormBuilderInterface;
use Drupal\Core\Form\FormState;
use Drupal\Core\Form\FormBuilder;

use Drupal\webform\Entity\Webform;
use Drupal\webform\WebformSubmissionForm;

class PartnershipForm extends FormBase {

  public function getFormId() {
     $this->mycheck();
    return 'PartnershipForm_simple';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {

    $form['aoi'] = array(
      '#type' => 'textfield',
      '#title' => t("Area of Partnering Interest"),
      '#field_prefix' => '<div id="user-email-result"></div>',
      //'#suffix' => '</div>',
      '#ajax' => array(
        'callback' => 'Drupal\partnershipform\Form\PartnershipForm::checkUserEmailValidation',
        'effect' => 'none',
        'event' => 'change',
        'method' => 'replace',
        'progress' => array(
//          'type' => 'throbber',
          'message' => NULL,
        ),
      ),
    );
    $form['first_name'] = array(
      '#type' => 'textfield',
      '#title' => t("First Name"),
    );
    $form['country'] = array(
      '#type' => 'select',
      '#title' => t("Country"),
      '#options' => $this->countryoptions(),
    );

    $form['send'] = array(
      '#type' => 'button',
      '#value' => 'Send',

    );
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t("Sends"),
//            '#ajax' => array(
//        'callback' => 'Drupal\partnershipform\Form\PartnershipForm::checkFormValidation',
//        'event' => 'click',
//        'progress' => array(
//          'type' => 'throbber',
//          'message' => NULL,
//        ),
//      ),
    );
    $form['#attributes']['novalidate'] = 'novalidate';
   // $form['#attached']['library'][] = 'common/select2';
    $form['#attached']['library'][] = 'partnershipform/partner-lib';
    return $form;
  }

  public function mycheck() {
//$values['name'] = 'robo-user';
//     $values['mail'] = 'robouser@example.com';
//     $values['pass']['pass1'] = 'password';
//     $values['pass']['pass2'] = 'password';
//     $values['op'] = t('Create new account');
//     $form_state = (new FormState())->setValues($values);
//     \Drupal::formBuilder()->submitForm('user_register_form', $form_state);
//print("user created");
  }
 /*
  * get list of country
  */
  function countryoptions() {
    $countries = \Drupal\Core\Locale\CountryManager::getStandardList();
    foreach ($countries as $key => $value) {
      $country_list[$key] = (string) $value;
    }
    return ($country_list);
  }

  public function checkUserEmailValidation(array $form, FormStateInterface $form_state) {
    $ajax_response = new AjaxResponse();
    $connection = \Drupal::database();
     $email=$form_state->getValue('aoi');
    $query2 = $connection->query("SELECT value FROM {webform_submission_data} WHERE webform_id='partnership' and name ='email_address' and value = :value ", [
      ':value' => $email,
    ]);    
    $result2 = $query2->fetchAll();
    if(!$result2){
        $ajax_response->addCommand(new HtmlCommand('#user-email-result',''));
      return $ajax_response;
    }
    else {
      $options['email']='same';
      $ajax_response->addCommand(new HtmlCommand('#user-email-result','<label class="error">namit</label>'));
      return $ajax_response;
    }

  }

  public function checkFormValidation(array $form, FormStateInterface $form_state) {
$ajax_response = new AjaxResponse();
$ajax_response->addCommand(new HtmlCommand('#user-email-result','<label class="error">namit</label>'));
return $ajax_response;
   // print_r($form_state); 
   
//    submitForm($form,$form_state);
  }
/*
 * Form validation
 */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // @todo: Implement validateForm() method.
    $search = $form_state->getValue('aoi');
//    if (!ctype_alpha($search)) {
//      $form_state->setErrorByName('aoi', $this->t('only alphabets allowed'));
//    }
  }

  /**
   *  Form submit Function
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $output = $form_state->getValue('first_name');

 //Create node object with attached file.
    $node = Node::create([
        'type' => 'page',
        'title' => 'helllo1',
    ]);
    $node->save();
    drupal_set_message($this->t('You Searched  for @search', array('@search' => $output)));
    // $form_state->setRedirect('firstblock.content');
    // Get submission values and data.
$values = [
  'webform_id' => 'partnership',
  'entity_type' => NULL,
  'entity_id' => NULL,
  'in_draft' => FALSE,
  'uid' => '1',
  'langcode' => 'en',
  'token' => 'pgmJREX2l4geg2RGFp0p78Qdfm1ksLxe6IlZ-mN9GZI',
  'uri' => '/webform/partnership/api',
  'remote_addr' => '',
  'data' => [
    'first_name' => 'myemail@mydomain.com',
    'last_name' => 'last name',
  ],
];

// Check webform is open.
$webform = Webform::load($values['webform_id']);
$is_open = WebformSubmissionForm::isOpen($webform);

if ($is_open === TRUE) {
  // Validate submission.
  $errors = WebformSubmissionForm::validateValues($values);

  // Check there are no validation errors.
  if (!empty($errors)) {
     print_r($errors);
  }
  else {
    // Submit values and get submission ID.
    $webform_submission = WebformSubmissionForm::submitValues($values);
    print $webform_submission->id();
  }
}
    
    
    
    
  }

}
