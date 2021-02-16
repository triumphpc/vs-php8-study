<?php
namespace Tests\StrFunction;

use PHPUnit\Framework\TestCase;

class Test extends TestCase {

	public function testRun() {
		$this->assertTrue(str_contains("abc", "a")); // true
		$this->assertFalse(str_contains("abc", "d")); // false
		$this->assertFalse(str_contains("abc", "B")); // false

// $needle is an empty string
		$this->assertTrue(str_contains("abc", ""));  // true
		$this->assertTrue(str_contains("", ""));     // true

		$str = "beginningMiddleEnd";
		$this->assertTrue(str_starts_with($str, "beg")); // true
		$this->assertFalse(str_starts_with($str, "Beg")); // false

		$str = "beginningMiddleEnd";
		$this->assertTrue(str_ends_with($str, "End")); // true
		$this->assertFalse(str_ends_with($str, "end")); // false
	}

}
