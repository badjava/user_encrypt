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
    $email = parent::getEmail();

    // TODO: Decrypt the email.

    return $email;
  }

  /**
   * {@inheritdoc}
   */
  public function setEmail($mail) {
    // TODO: Encrypt the email.

    parent::setEmail($mail);
  }

  /**
   * {@inheritdoc}
   */
  public function getAccountName() {
    $account_name = parent::getAccountName();

    if ($account_name) {
      // TODO: Decrypt username;
    }

    return $account_name;
  }

  /**
   * {@inheritdoc}
   */
  public function setUsername($username) {
    // TODO: Encrypt username.

    parent::setUsername($username);
  }

}
