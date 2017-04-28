<?php

namespace Drupal\Tests\user_encrypt\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Tests the settings page.
 *
 * @package Drupal\Tests\user_encrypt\Functional
 *
 * @group user_encrypt
 */
class UserEncrypt extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  public static $modules = [
    'user_encrypt',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp() {
    parent::setUp();

    $permissions = [
      'administer account settings',
    ];

    $web_user = $this->drupalCreateUser($permissions);
    $this->drupalLogin($web_user);
  }

  /**
   * Test the settings page.
   */
  public function testSettingsPage() {
    // Load settings page.
    $settings = 'admin/config/people/encrypt';
    $this->drupalGet($settings);
    $this->assertSession()->statusCodeEquals(200);

    // Check field encrypt enforce setting.
    $this->assertSession()->pageTextContains('Enforce field encryption');
    $this->assertSession()->checkboxChecked('edit-field-encrypt-enforce');

    // Save settings form.
    $this->submitForm([], 'Save configuration');
    $this->assertSession()->pageTextContains('The configuration options have been saved.');
  }

}
