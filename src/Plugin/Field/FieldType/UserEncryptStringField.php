<?php

namespace Drupal\user_encrypt\Plugin\Field\FieldType;

use Drupal\Core\Field\Plugin\Field\FieldType\StringItem;

/**
 * Defines the 'user_encrypt_string' entity field type.
 *
 * @FieldType(
 *   id = "user_encrypt_string",
 *   label = @Translation("Encrypted Text (plain)"),
 *   description = @Translation("A field containing a plain encrypted string value."),
 *   category = @Translation("Text"),
 *   default_widget = "string_textfield",
 *   default_formatter = "string"
 * )
 */
class UserEncryptStringField extends StringItem {

  /**
   * {@inheritdoc}
   */
//  public function getValue() {
//    $value = parent::getValue();
//
//    $value = \Drupal::service('user_encrypt')->decrypt($value);
//
//    return $value;
//  }

//  /**
//   * {@inheritdoc}
//   */
//  public function get($property_name) {
//    echo "<pre>" . print_r('get', TRUE) . "</pre>";
//  }


//  public function set($property_name, $value, $notify = TRUE) {
//    $value = \Drupal::service('user_encrypt')->decrypt($value);
////
//    parent::set($property_name, $value, $notify);
//
//    return $this;
//  }

  /**
   * {@inheritdoc}
   */
  public function setValue($values, $notify = TRUE) {
    echo "<pre>" . print_r('setValue', TRUE) . "</pre>";

    if (isset($values) && !is_array($values)) {
      $keys = array_keys($this->definition->getPropertyDefinitions());
      $values = [$keys[0] => $values];
    }

    $decrypted_values = [];
    foreach ($values as $property_name => $property_value) {
      $decrypted_values[$property_name] = \Drupal::service('user_encrypt')->decrypt($property_value);
    }

    echo "<pre>" . print_r($decrypted_values, TRUE) . "</pre>";
    parent::setValue($decrypted_values, $notify);
  }

  /**
   * {@inheritdoc}
   */
  public function preSave() {
    parent::preSave();

    $this->value = \Drupal::service('user_encrypt')->encrypt($this->value);
  }

}
