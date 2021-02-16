<?php

namespace Tests\WeekMap;

use PHPUnit\Framework\TestCase;
use WeakMap;

class Test extends TestCase {

	public function testRun() {
		$fooBar = new FooBar2();
		$someObj = new SomeObject();
		$someObj->i = 123;

		$this->assertTrue(isset($fooBar->cache[$someObj]) == false);
		$retArr1 = $fooBar->getSomethingWithCaching($someObj);

		$this->assertTrue($retArr1 == [1,2,3]);
		$this->assertTrue($fooBar->cache[$someObj] === [1,2,3]);

	}
}



class AB {
	public function __destruct() {
		echo "Dead!\n";
	}
}

class FooBar2 {
	public WeakMap $cache;

	public function __construct() {
		$this->cache = new WeakMap();
	}

	public function getSomethingWithCaching(object $obj) {
		return $this->cache[$obj] ??= [1,2,3];
	}

	// ...
}

class SomeObject {
	public int $i;

}
