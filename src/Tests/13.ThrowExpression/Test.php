<?php
namespace Tests\ThrowExpression;

use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class Test extends TestCase {

	public function testRun() {
		// This was previously not possible since arrow functions only accept a single expression while throw was a statement.
		$callable = fn() => throw new Exception();

		$nullableValue = 123;
		// $value is non-nullable.
		$value = $nullableValue ?? $callable();

		$this->assertTrue($value === 123);


		$falsableValue = false;

		$this->expectException(Exception::class);
		// $value is truthy.
		$value = $falsableValue ?: throw new InvalidArgumentException();


		try {
			changeImportantData();
		} catch (Exception) { // The intention is clear: exception details are irrelevant
			echo "You don't have permission to do this";
		}


	}

}

function changeImportantData() {
	throw new Exception();
}

