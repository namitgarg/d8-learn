<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Drupal\footer_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\block\Entity\Block;

/**
 *
 * @Block(
 *   id = "footer_block",
 *   admin_label = @Translation("Footer block"),
 *   category = @Translation("Custom"),
 * )
 */
class footerBlockContent extends BlockBase implements BlockPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $config = $this->getConfiguration();

    if (!empty($config['footer_details'])) {
      $name = $config['footer_details']['value'];
    }
    if (!empty($config['footer_copy'])) {
      $names = $config['footer_copy']['value'];
    }

    return array(
      '#markup' => '<div class="footer_block">' . $name . '' . $names . '</div>',
//      '#attached' => array(
//        'library' => array(
//          'footer_block/footer_block_lib',
//        ),
//      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);
    $config = $this->getConfiguration();

    $form['footer_details'] = array(
      '#type' => 'text_format',
      '#format' => 'full_html',
      '#title' => $this->t('Footer Data'),
      '#description' => $this->t('Enter Footer Data'),
      '#default_value' => isset($config['footer_details']['value']) ? $config['footer_details']['value'] : '',
    );

    $form['footer_copy'] = array(
      '#type' => 'text_format',
      '#format' => 'full_html',
      '#title' => $this->t('Footer Copywrite'),
      '#description' => $this->t('Enter Footer Copywrite Details'),
      '#default_value' => isset($config['footer_copy']['value']) ? $config['footer_copy']['value'] : '',
    );

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $this->configuration['footer_details'] = $values['footer_details'];
    $this->configuration['footer_copy'] = $values['footer_copy'];
  }

}
