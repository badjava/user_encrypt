<?php

namespace Drupal\user_encrypt;

use Drupal\encrypt\EncryptService;
use Drupal\encrypt\Entity\EncryptionProfile;

/**
 * Class Encrypt.
 *
 * @package Drupal\user_encrypt
 */
class Encrypt {

  /**
   * The EncryptService object.
   *
   * @var \Drupal\encrypt\EncryptService
   */
  protected $encryptService;

  /**
   * Config object.
   *
   * @var \Drupal\user_encrypt\config
   */
  protected $config;


  protected $encryptionProfile;

  /**
   * Encrypt constructor.
   *
   * @param \Drupal\user_encrypt\ConfigFactory $config_factory
   *   The Config Factory object.
   * @param \Drupal\encrypt\EncryptService $encrypt_service
   *   The EncryptService class object provided by the Encrypt module.
   */
  public function __construct(ConfigFactory $config_factory, EncryptService $encrypt_service) {
    $this->config = $config_factory->getEditable('user_entity.settings');
    $this->encryptService = $encrypt_service;

//    $this->config->get($config_key);
  }

  /**
   * Returns a given text encrypted.
   *
   * @param $text
   *   The plain text to encrypt.
   */
  public function encrypt($text) {

  }

  /**
   * Decrypts a encrypted text.
   *
   * @param $text
   *   The encrypted text to decrypt.
   */
  public function decrypt($text) {

  }

  /**
   * Loads an Encryption Profile.
   *
   * @param $encryption_profile_name
   *   The encryption profile name.
   *
   * @return \Drupal\Core\Entity\EntityInterface
   *   Returns the Encryption Profile entity.
   */
  protected function loadEncryptionProfile($encryption_profile_name) {
    return EncryptionProfile::load($encryption_profile_name);
  }
}
