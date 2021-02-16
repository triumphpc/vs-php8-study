<?php
namespace Tests\ArrayUnpacking;


use PHPUnit\Framework\TestCase;

class Test extends TestCase {

	public function testRun() {
		$this->assertTrue(true);
		// Добавлена поддержка с 8.1
//		$array = ["a" => 1];
//		$array2 = ["b" => 2];
//		$arrayMerge = ["a" => 0, ...$array, ...$array2];
//
//		$this->assertTrue($arrayMerge === ["a" => 1, "b" => 2]);
	}
}
