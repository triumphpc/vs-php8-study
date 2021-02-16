<?php

namespace Tests\StaticReturnType;

use PHPUnit\Framework\TestCase;

class Test extends TestCase {

	public function testRun() {

		$obj = B::test();
		$this->assertTrue($obj instanceof B);

		$obj = B::testTwo();
		$this->assertTrue($obj instanceof A);

		$obj = B::testThree();
		$this->assertTrue($obj instanceof A);
	}
}


class A {

	public int $prep;
	public static function who(): self {
		return new self();
	}
	public static function test(): static {
		return static::who(); // Здесь действует позднее статическое связывание
	}

	public static function testTwo(): self {
		return self::who();
	}

	public static function testThree(): self {
		return self::who();
	}
}

class B extends A {
	public static function who(): self {
		return new self();
	}
}
