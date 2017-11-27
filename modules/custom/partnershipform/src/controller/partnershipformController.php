<?php

/**
 * @file
 * Contains \Drupal\partnershipform\Controller\partnershipformcontroller.
 */

namespace Drupal\partnershipform\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ChangedCommand;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use \Drupal\node\Entity\Node;
use Drupal\Core\Form;
//use Drupal\block\Entity\Block;
use Symfony\Component\HttpFoundation\JsonResponse;

class partnershipformController extends ControllerBase {

  public function emailCheck() {
    $connection = \Drupal::database();
    // db_select dynamic queries
    $query = $connection->select('node', 'n');
    $query->fields('n', ['nid']);
    $result = $query->execute()->fetchAll();
    foreach ($result as $keys => $values) {
//      print_r($values->nid);
//      print("\n");
    }

// Static queries using connect 
    $email='nam@gmail.com';
    $options=array('email'=>'same');
    $query2 = $connection->query("SELECT value FROM {webform_submission_data} WHERE webform_id='partnership' and name ='email_address' and value = :value ", [
      ':value' => $_POST['email'],
    ]);
    $result2 = $query2->fetchAll();
    if(!$result2){
      $options['email']='unique';
    }
    else {
      $options['email']='same';
    }
    return new JsonResponse($options);
    

//    print_r($result2);

// static queries
    $query3 = db_query("SELECT nid FROM node");
    $records3 = $query3->fetchAll();
    foreach ($records3 as $record) {
      // Do something.
//      print_r($record);
    }
    $options = array('name' => 'namit');
    return new JsonResponse($result2);
  }

}
