<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Drupal\d8_examples\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class customBlockForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'customBlockForm';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Form constructor.
    $form = parent::buildForm($form, $form_state);
    // Default settings.
    $config = $this->config('d8_examples.settings');

    $form['page_title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Generator for page title:'),
      '#default_value' => $config->get('loremipsum.page_title'),
      '#description' => $this->t('Give your lorem ipsum generator page a title.'),
    );
    // Source text field.
    $form['source_text'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Source text for generation:'),
      '#default_value' => $config->get('loremipsum.source_text'),
      '#description' => $this->t('Write one sentence per line. Those sentences will be used to generate random text.'),
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('d8_examples.settings');
    $config->set('d8_examples.source_text', $form_state->getValue('source_text'));
    $config->set('d8_examples.page_title', $form_state->getValue('page_title'));
    $config->save();
    return parent::submitForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'd8_examples.settings',
    ];
  }

}
