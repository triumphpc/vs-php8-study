<?php
declare(strict_types=1);

namespace Tests\NamedArguments;

use Attribute;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
	public function testRun()
	{
		$object = new Foo(false, [], 2, "test");
		$this->assertTrue($object->var1 === false);
		$this->assertTrue($object->var2 === []);
		$this->assertTrue($object->var3 === 2);
		$this->assertTrue($object->var4 === "test");

		// Передача именованных аргументов
		$object = new Foo(var1: true, var4: "test2");
		$this->assertTrue($object->var1 === true);
		$this->assertTrue($object->var2 === []);
		$this->assertTrue($object->var3 === 1);
		$this->assertTrue($object->var4 === "test2");

		// Распаковка массива
		$object = new Foo(...[
			"var1" => true,
			"var4" => "test3"
		]);
		$this->assertTrue($object->var1 === true);
		$this->assertTrue($object->var2 === []);
		$this->assertTrue($object->var3 === 1);
		$this->assertTrue($object->var4 === "test3");

		// Именованные или упорядоченные аргументы
		$object = new Foo(true, var2: [1,2,3], var4: "test4");
		$this->assertTrue($object->var1 === true);
		$this->assertTrue($object->var2 === [1,2,3]);
		$this->assertTrue($object->var3 === 1);
		$this->assertTrue($object->var4 === "test4");

		// Именованные или упорядоченные аргументы можно передавать так же в массиве
		$vars = [
			false,
			"var2" => [4,5],
			"var4" => "test5",
		];
		$object = new Foo(...$vars);
		$this->assertTrue($object->var1 === false);
		$this->assertTrue($object->var2 === [4, 5]);
		$this->assertTrue($object->var3 === 1);
		$this->assertTrue($object->var4 === "test5");

		// Безымянные или упорядочные аргументы должны быть приоритетней именованных
//		$object = new Foo(var2: [1,2,3], true, var4: "test4");

		// Использование именованные аргументов в Атрибутах/Аннотациях
		$reflector = new \ReflectionMethod(Foo::class, "onProductCreated");
		$classAttributes = $reflector->getAttributes();
		$this->assertTrue($classAttributes[0]->newInstance()->getEvent() == "Tests\NamedArguments\ProductCreated");


	}
}

class Foo {

	public bool $var1;

	public array $var2;

	public int $var3;

	public string $var4;

	public function __construct(bool $var1, array $var2 = [], int $var3 = 1, string $var4 = "") {
		$this->var1 = $var1;
		$this->var2 = $var2;
		$this->var3 = $var3;
		$this->var4 = $var4;
	}

	#[ListensTo(event: ProductCreated::class)]
	public function onProductCreated(ProductCreated $event) { /* … */ }
}

#[Attribute]
class ListensTo
{
	public string $event;

	public function __construct(string $event) {
		$this->event = $event;
	}

	public function getEvent() {
		return $this->event;
	}
}

class ProductCreated {

}