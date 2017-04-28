<?php

namespace Drupal\user_encrypt\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Class UserEncryptSettingsForm.
 *
 * @package Drupal\user_encrypt\Form
 */
class UserEncryptSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'user_encrypt.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'user_encrypt_settings_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('user_encrypt.settings');

    $encryption_options = \Drupal::service('encrypt.encryption_profile.manager')->getEncryptionProfileNamesAsOptions();

    if (count($encryption_options) > 0) {
      $form['element_encrypt']['user_encrypt'] = [
        '#type' => 'checkbox',
        '#title' => t("Encrypt user's data"),
        '#description' => '',
        '#default_value' => $config->get('user_encrypt'),
      ];

      $form['element_encrypt']['encrypt_profile'] = [
        '#type' => 'select',
        '#title' => t('Select Encryption Profile'),
        '#options' => $encryption_options,
        '#default_value' => $config->get('encrypt_profile'),
        '#states' => [
          'visible' => [
            [':input[name="properties[encrypt]"]' => ['checked' => TRUE]],
          ]
        ]
      ];
    }
    else {
      $form['element_encrypt']['message'] = array(
        '#markup' => t('Please configure the encryption profile to enable encryption for user data.'),
      );
    }

    $encrypt_config_url = Url::fromRoute('entity.encryption_profile.collection')->toString();
    $form['element_encrypt']['encrypt_config_markup'] = [
      '#markup' => t('<a href=":link">Click here</a> to edit encryption settings.', [':link' => $encrypt_config_url]),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $this->config('user_encrypt.settings')
      ->set('user_encrypt', $form_state->getValue('user_encrypt'))
      ->set('encrypt_profile', $form_state->getValue('encrypt_profile'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
