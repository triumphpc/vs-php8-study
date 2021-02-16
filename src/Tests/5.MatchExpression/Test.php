<?php
declare(strict_types=1);

namespace Tests\NullSaveOperator;

use PHPUnit\Framework\TestCase;

class Test extends TestCase {

	public function testRun() {
		$v = 1;
		$result = match ($v) {
			0 => 'Foo',
			1 => 'Bar',
			2 => 'Baz',
		};  // Bar

		$this->assertTrue($result === "Bar");

		switch ('foo') {
			case 0:
				$result = "Oh no!\n";
				break;
			case 'foo':
				$result = "This is what I expected\n";
				break;
		}

		// Потому что PHP приводит строку к инту в этом случае
		$this->assertTrue($result === "This is what I expected\n");

		echo match ('foo') {
			0 => "Oh no!\n",
			'foo' => "This is what I expected\n",
		};
		$this->assertTrue($result === "This is what I expected\n");

		function foo(): int {
			return 555;

		}

		$v = 555;
		$result =  match ($v) {
			'1' => 123,
			foo() => 666
		};

		$this->assertTrue($result === 666);

	}
}