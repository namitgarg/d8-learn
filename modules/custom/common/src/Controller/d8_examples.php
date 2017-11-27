<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Drupal\d8_examples\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Block\BlockBase;

//use Symfony\Component\HttpKernel\Client;

class d8_examples extends ControllerBase {

  public function content() {

    $build = array(
      '#type' => 'markup',
      '#markup' => t('Hello World!'),
    );

    return [
      '#theme' => 'd8_examples_template',
      '#variable1' => $build,
    ];
  }

  public function content2() {

    $build = array(
      '#type' => 'markup',
      '#markup' => t('Hello World!'),
    );

    return [
      '#theme' => 'd8_examples_template',
      '#variable1' => $build,
    ];
  }

  public function generate($paragraphs, $phrases) {

    $build = array(
      '#type' => 'markup',
      '#markup' => t('Hello World!'),
    );

    return [
      '#theme' => 'd8_examples_template',
      '#variable1' => $build,
    ];
  }

  public function deleteForm($cid) {
    //$cid = \Drupal::request()->query->get('cid');
    $query = \Drupal::database();
    $query->delete('mydata')
        ->condition('id', $cid)
        ->execute();
    drupal_set_message("succesfully deleted");

    $build = array(
      '#type' => 'markup',
      '#markup' => t('succesfully deleted'),
    );

    return $build;
  }

}
