<?php

namespace Drupal\floating_isi\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * @Block(
 *   id = "floating_isi",
 *   admin_label = @Translation("Floating ISI")
 * )
 */
class FloatingIsiConfigurable extends BlockBase {

  public function defaultConfiguration() {
    return array(
      'label_display' => FALSE,
      'block_floating_isi' => array(
        'value' => '<div class="container_main">
    <div class="section_cont isi-fix-content" id="isi-scroll">
        <div class="isi patient">
            <p>EXPAREL is indicated for administration into the surgical site to produce postsurgical analgesia.</p>

            <p><strong>Important Safety Information</strong></p>

            <p>EXPAREL should not be used in obstetrical paracervical block anesthesia.</p>

            <p>In studies with EXPAREL, the most common side effects were nausea, constipation, and vomiting.</p>

            <p>EXPAREL is not recommended for use in patients younger than 18 years of age or in pregnant women.</p>

            <p>Tell your healthcare professional if you have liver disease as this may affect how the active ingredient (bupivacaine) in EXPAREL is eliminated from your body.</p>

            <p>EXPAREL should not be injected into the spine, joints, or veins.</p>

            <p>Other local anesthetics should not be injected immediately after injecting EXPAREL; this may lead to an immediate release of the active ingredient in EXPAREL.</p>

            <p>The active ingredient in EXPAREL can affect your nervous and cardiovascular system, may cause an allergic reaction, and/or if injected into your joints may cause damage to the joints.</p>
        </div>

        <div class="isi-info" id="isi-tray" style="display: none;">
            <div class="isi-tray-wrapper">
                <div class="container_main">
                    <div class="ride-button"><a class="seeMore">See More</a></div>

                    <div class="isi-bloc">
                        <div class="isi-tray-content">
                            <div class="isi_main_cont">
                                <p>EXPAREL is indicated for administration into the surgical site to produce postsurgical analgesia.</p>

                                <div class="isi-title">
                                    <div class="body_bold_txt" id="imp_safety_information">Important Safety Infomation</div>
                                </div>

                                <p>EXPAREL should not be used in obstetrical paracervical block anesthesia.</p>

                                <p>In studies with EXPAREL, the most common side effects were nausea, constipation, and vomiting.</p>

                                <p>EXPAREL is not recommended for use in patients younger than 18 years of age or in pregnant women.</p>

                                <p>Tell your healthcare professional if you have liver disease as this may affect how the active ingredient (bupivacaine) in EXPAREL is eliminated from your body.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
',
        ),
    );
  }

  public function blockForm($form, FormStateInterface $form_state) {
    $form=array();
    $form['block_floating_isi'] = array(
      '#type' => 'text_format',
      '#title' => $this->t('Block contents'),
      '#description' => $this->t('ISI HTML'),
      '#default_value' => $this->configuration['block_floating_isi']['value'],
      '#format' => 'full_html'
    );
//    print("<pre>");print_r($form['block_floating_isi']);print("</pre>");
    return $form;
  }

  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['block_floating_isi']
      = $form_state->getValue('block_floating_isi');
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    return array(
      '#markup' => $this->configuration['block_floating_isi']['value'],
       '#attached' => array(
//        'library' => array(
//          'floating_isi/floating-isi-lib',
//        ),
    ),
  );    
  }

}
