<?php
namespace Tests\NumberComparison;

use PHPUnit\Framework\TestCase;

class Test extends TestCase {

	public function testRun() {
		$validValues = ["foo", "bar", "baz"];
		$value = 0;
		$test1 = in_array($value, $validValues);

		$this->assertTrue($test1 === false);
	}
}