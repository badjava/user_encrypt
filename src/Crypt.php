<?php

namespace Drupal\user_encrypt;

use Drupal\Core\Config\ConfigFactory;
use Drupal\encrypt\EncryptService;
use Drupal\encrypt\Entity\EncryptionProfile;

/**
 * Class Crypt.
 *
 * @package Drupal\user_encrypt
 */
class Crypt {

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

  protected $isEncryptionEnabled;

  /**
   * Crypt constructor.
   *
   * @param \Drupal\Core\Config\ConfigFactory $config_factory
   *   The Config Factory object.
   * @param \Drupal\encrypt\EncryptService $encrypt_service
   *   The EncryptService class object provided by the Encrypt module.
   */
  public function __construct(ConfigFactory $config_factory, EncryptService $encrypt_service) {
    $this->config = $config_factory->getEditable('user_encrypt.settings');
    $this->encryptService = $encrypt_service;

    $this->isEncryptionEnabled = (bool) $this->config->get('user_encrypt');
    $this->encryptionProfile = $this->loadEncryptionProfile($this->config->get('encrypt_profile'));
  }

  /**
   * Returns a given text encrypted.
   *
   * @param $text
   *   The plain text to encrypt.
   *
   * @return string
   *   The encrypted text.
   */
  public function encrypt($text) {
    if (!$this->isEncryptionEnabled) {
      return $text;
    }

    return $this->encryptService->encrypt($text, $this->encryptionProfile);
  }

  /**
   * Decrypts a encrypted text.
   *
   * @param $text
   *   The encrypted text to decrypt.
   *
   * @return string
   *   The decrypted the text.
   */
  public function decrypt($text) {
    if (!$this->isEncryptionEnabled) {
      return $text;
    }

    $decrypted_value = $this->encryptService->decrypt($text, $this->encryptionProfile);
    if ($decrypted_value === FALSE) {
      return $text;
    }

    return $decrypted_value;
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
