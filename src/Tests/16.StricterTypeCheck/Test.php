<?php
namespace Tests\StricterTypeCheck;

use PHPUnit\Framework\TestCase;

class Test extends TestCase {

	public function testRun() {

		$arr = [1,2,3];

		$arr2 = [4,5,6];

		$arr3 = $arr + $arr2;

		$this->expectException(\TypeError::class);
		$ar = $arr % $arr2;
	}

}