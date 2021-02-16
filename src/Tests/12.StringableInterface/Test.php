<?php
namespace Tests\Stringable;


use PHPUnit\Framework\TestCase;
use Stringable;

class Test extends TestCase {

	public function testRun() {
		$result = $this->acceptString(123.45); // string(6) "123.45"
		$this->assertTrue(is_string($result) && $result === "123.45");

		$result = $this->acceptString(new A2()); // string(5) "hello"
		$this->assertTrue(is_string($result) && $result === "hello");

//		$result = $this->acceptString2("123.45");
//		$this->assertTrue(is_string($result) && $result === "123.45");

		$result = $this->acceptString3(new A2());
		$this->assertTrue(is_string($result) && $result === "hello");

		$result = $this->acceptString2(new A2());
		$this->assertTrue($result instanceof Stringable);


	}


	function acceptString(string $whatever) {
		return $whatever;
	}

	function acceptString2(Stringable $whatever) {
		return $whatever;
	}

	function acceptString3(Stringable $whatever) {
		return (string)$whatever;
	}

}


class A2{
	public function __toString(): string
	{
		return 'hello';
	}
}

