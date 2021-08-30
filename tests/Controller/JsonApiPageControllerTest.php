<?php

namespace Drupal\axelerant_test\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the axelerant_test module.
 */
class JsonApiPageControllerTest extends WebTestBase {


  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return [
      'name' => "axelerant_test JsonApiPageController's controller functionality",
      'description' => 'Test Unit for module axelerant_test and controller JsonApiPageController.',
      'group' => 'Other',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests axelerant_test functionality.
   */
  public function testJsonApiPageController() {
    // Check that the basic functions of module axelerant_test.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
