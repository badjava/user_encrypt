<?php

namespace Drupal\user_encrypt\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

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

    $form['field_encrypt_enforce'] = array(
      '#type' => 'checkbox',
      '#title' => $this->t('Enforce field encryption'),
      '#default_value' => $config->get('field_encrypt_enforce'),
      '#description' => $this->t('Enforces encryption on any fields created on a user entity.'),
    );

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    $this->config('user_encrypt.settings')
      ->set('field_encrypt_enforce', $form_state->getValue('field_encrypt_enforce'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
