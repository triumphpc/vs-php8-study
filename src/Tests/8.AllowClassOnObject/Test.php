<?php
namespace Tests\AllowClassOnObject;

use PHPUnit\Framework\TestCase;
use stdClass;

class Test extends TestCase {

	public function testRun() {
		$object = new stdClass;
		$className = get_class($object); // "stdClass"

		$this->assertTrue($className == "stdClass");

		$object = new stdClass;
		$className = $object::class; // "stdClass"
		$this->assertTrue($className == "stdClass");

	}

}
