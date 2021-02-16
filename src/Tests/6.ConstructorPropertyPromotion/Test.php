<?php
declare(strict_types=1);

namespace Tests\ConstructorPropertyPromotion;

use PHPUnit\Framework\TestCase;

class Test extends TestCase {
	/**
	 * A basic feature test example.
	 *
	 * @return void
	 */
	public function testExample()
	{
		$point = new Point();
		$this->assertTrue($point->x === 0.0);

		// Вариативные свойства нужно перечислять в конструкторе
		$test = new TestClass(123, new Bar(), 1,2,3,4);

		$this->assertTrue($test->bar instanceof Bar);
		$this->assertTrue($test->getIntegers() === [
				0 => [
					0 => 1,
					1 => 2,
					2 => 3,
					3 => 4,
				]
			]);
	}
}

class Point {
	private array $integers;

	public function __construct(
		public float $x = 0.0,
		public float $y = 0.0,
		public float $z = 0.0,
	) {}
}


class FooBar {
	private array $integers;
	public function __construct(Bar $bar, ...$integers) {
		$this->integers = $integers;

	}

	public function getIntegers() {
		return $this->integers;
	}
}

class TestClass extends FooBar {
	private array $integers;

	public function __construct(
		private int $promotedProp,
		public Bar $bar,
		int ...$integers,
	) {
		parent::__construct($bar, $integers);
		$this->integers = $integers;
	}
}

class Bar {

}
