<?php

namespace Drupal\user_encrypt;

use Drupal\user_encrypt\Plugin\Field\FieldType\UserEncryptStringField;

/**
 * Class UserEncryptNameItem.
 *
 * @package Drupal\user_encrypt
 */
class UserEncryptNameItem extends UserEncryptStringField {

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();

    // Take into account that the name of the anonymous user is an empty string.
    if ($this->getEntity()->isAnonymous()) {
      return $value === NULL;
    }

    return $value === NULL || $value === '';
  }

}