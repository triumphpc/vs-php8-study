<?php

namespace Tests\ConcatenationOperatorTest;

use PHPUnit\Framework\TestCase;

class Test extends TestCase {

	public function testRun() {
		$a = 1;
		$b = 2;

		// Before 8.0
		// echo ("sum: " . $a) + $b;
		$result =  "sum: " . $a + $b;
		$this->assertTrue($result == "sum: 3");

	}
}
