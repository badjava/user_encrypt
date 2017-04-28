<?php

namespace Drupal\user_encrypt;

use Drupal\user\Entity\User;

/**
 * Class UserEncrypt
 *
 * @package Drupal\user_encrypt
 */
class UserEncrypt extends User {
  /**
   * {@inheritdoc}
   */
  public function getEmail() {
    $email = \Drupal::service('user_encrypt')->decrypt(parent::getEmail());

    return $email;
  }

  /**
   * {@inheritdoc}
   */
  public function setEmail($email) {
    $email = \Drupal::service('user_encrypt')->encrypt($email);

    return parent::setEmail($email);
  }

  /**
   * {@inheritdoc}
   */
  public function getAccountName() {
    $account_name = parent::getAccountName();

    if ($account_name) {
      $account_name = \Drupal::service('user_encrypt')->decrypt($account_name);
    }

    return $account_name;
  }

  /**
   * {@inheritdoc}
   */
  public function setUsername($username) {
    $username = \Drupal::service('user_encrypt')->encrypt($username);

    return parent::setUsername($username);
  }

  /**
   * {@inheritdoc}
   */
  public function get($field_name) {
    $field_value = parent::get($field_name);
    $field_value_decrypted = \Drupal::service('user_encrypt')->decrypt($field_value);

    return $field_value_decrypted;
  }

  /**
   * {@inheritdoc}
   */
  public function set($name, $value, $notify = TRUE) {
    $encrypted_value = \Drupal::service('user_encrypt')->encrypt($value);

    return parent::set($name, $encrypted_value, $notify);
  }

}
