<?php
namespace Tests\TypesUnion;

use PHPUnit\Framework\TestCase;

class Test extends TestCase {

	public function testRun() {

		$number = new Number();
		$this->assertTrue($number->getNumber() === null);
		$number->setNumber(0.1);
		$this->assertTrue($number->getNumber() === 0.1);
		$number->setNumber(1);
		$this->assertTrue($number->getNumber() === 1);

		$test1 = new Test222();
		$this->assertTrue(is_float($test1->return1()));
		$this->assertTrue(is_int($test1->return2()));

		$test2 = new Test2();
		$this->assertTrue(is_int($test2->return1()));
		$this->assertTrue(is_int($test2->return2()));

		$test3 = new BBB();
		$this->assertTrue(is_int($test3->bar()));

	}

}


class Number {
	private int|float|null $number;

	public function __construct() {
		$this->number = null;
	}


	public function setNumber(int|float $number): void {
		$this->number = $number;
	}

	public function getNumber(): int|float|null {
		return $this->number;
	}
}

class Test222 {
	public function param1(int $param) {}
	public function param2(int|float $param) {}

	public function return1(): int|float {
		return 0.0;
	}
	public function return2(): int {
		return 1;
	}
}

class Test2 extends Test222 {
	public function param1(int|float $param) {} // Allowed: Adding extra param type
//	public function param2(int $param) {} // FORBIDDEN: Removing param type

	public function return1(): int {
		return 1;
	} // Allowed: Removing return type
//	public function return2(): int|float {
//		return 0.1;
//	} // FORBIDDEN: Adding extra return type
}



class ABB
{
	public function bar(): mixed {}
}

class BBB extends ABB
{
	// return type was narrowed from mixed to int, this is allowed
	public function bar(): int {
		return 1;
	}
}


class CCC
{
	public function bar(): int {}
}

class DDD extends CCC
{
	// return type cannot be widened from int to mixed
	// Fatal error thrown
//    public function bar(): mixed {}
}


