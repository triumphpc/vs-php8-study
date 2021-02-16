<?php
namespace Tests\TrailingComma;

use PHPUnit\Framework\TestCase;

class Test extends TestCase {

	public function testRun() {

		$f = function(
			string $s,
			float $f, // Allowed
		) {
			$this->assertTrue($f === 0.0);
		};
		$f("str", 0.0);
	}

}