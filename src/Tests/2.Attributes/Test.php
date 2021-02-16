<?php
declare(strict_types=1);

namespace Tests\Attributes;

use Attribute;
use PHPUnit\Framework\TestCase;
use ReflectionAttribute;

class Test extends TestCase
{

	/**
	 *
	 */
	public function testAttribute()
	{
		$reflector = new \ReflectionClass(Foo::class);
		$attrs = $reflector->getAttributes();

		/** @var ReflectionAttribute $attribute */
		foreach ($attrs as $attribute) {
			$this->assertTrue($attribute->getName() == "Tests\Attributes\ExampleAttribute");
			$this->assertTrue($attribute->getArguments() == ["Hello world", 42]);
			$this->assertTrue($attribute->newInstance() instanceof ExampleAttribute );
		}

	}


	/**
	 * Пример, как можно задавать скоуп использования атрибутов только рефлекшене класса
	 */
	public function testOnlyClassAttribute() {
		$reflection = new \ReflectionMethod(FooTwo::class, 'index');
		$methodAttributes = $reflection->getAttributes();

		try {
			$methodAttributes[0]->newInstance();
		} catch (\Throwable $throwable) {
			$this->assertTrue($throwable->getMessage() == 'Attribute "Tests\Attributes\ExampleAttributeTwo" cannot target method (allowed targets: class)');
		}
	}
}


class FooTwo {

	#[ExampleAttributeTwo("one", 123)]
	public function index() {

	}

}

#[ExampleAttribute('Hello world', 42)]
class Foo {
	#[ExampleAttribute("",1)]
	public const FOO = 'foo';

	#[ExampleAttribute("",1)]
	public $x;

	#[ExampleAttribute("",1)]
	public function foo(#[ExampleAttribute("",1)] $bar) { }

}

/**
 * Пример выставления атрибута для использования только в Reflection класса
 *
 * Class ExampleAttributeTwo
 * @package Tests\Attributes
 */
#[\Attribute(Attribute::TARGET_CLASS)]
class ExampleAttributeTwo {
	private string $message;
	private int $answer;

	public function __construct(string $message, int $answer) {
		$this->message = $message;
		$this->answer = $answer;
	}

	public function getMessage() {
		return $this->message;
	}
}


#[\Attribute]
class ExampleAttribute {
	private string $message;
	private int $answer;

	public function __construct(string $message, int $answer) {
		$this->message = $message;
		$this->answer = $answer;
	}

	public function getMessage() {
		return $this->message;
	}
}

// Пример, как можно примерять в случае слушателя
#[Attribute(Attribute::TARGET_FUNCTION | Attribute::TARGET_METHOD)]
class Listener implements ListenerAttribute
{
	public function __construct(
		public ?string $id = null,
		public ?string $type = null,
	) {}
}

interface ListenerAttribute {

}

