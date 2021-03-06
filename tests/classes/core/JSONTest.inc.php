<?php

/**
 * @file tests/classes/core/JSONTest.inc.php
 *
 * Copyright (c) 2000-2011 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class JSONTest
 * @ingroup tests_classes_core
 * @see JSON
 *
 * @brief Tests for the JSON class.
 */

import('lib.pkp.tests.PKPTestCase');
import('lib.pkp.classes.core.JSON');

class JSONTest extends PKPTestCase {
	/**
	 * @covers JSON
	 */
	public function testGetString() {
		// Create a test object.
		$testObject = new stdClass();
		$testObject->someInt = 5;
		$testObject->someFloat = 5.5;
		$json = new JSON($status = true, $content = 'test content',
				$isScript = false, $elementId = '0',
				$additionalAttributes = array('testObj' => $testObject));
		$json->setEvent('someEvent', array('eventDataKey' => array('item1', 'item2')));

		// Render the JSON message.
		$expectedString = '{"status":true,"content":"test content",'.
				'"isScript":false,"elementId":"0","testObj":{"someInt":5,"someFloat":5.5},'.
				'"event":{"name":"someEvent","data":{"eventDataKey":["item1","item2"]}}}';
		self::assertEquals($expectedString, $json->getString());

		// Try again but this time simulate a PHP4 environment.
		$json->setSimulatePhp4(true);
		self::assertEquals($expectedString, $json->getString());
	}
}
?>
