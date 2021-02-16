<?php
namespace Tests\Stringable;


use PHPUnit\Framework\TestCase;
use Stringable;

class Test extends TestCase {

	public function testRun() {
		$str =  <<<'EOD'
string(6) "123.45"
string(5) "hello"
object(Tests\Stringable\A2)#315 (0) {
}
string(5) "hello"

EOD;
		$this->expectOutputString($str);


		acceptString(123.45); // string(6) "123.45"
		acceptString(new A2()); // string(5) "hello"

//        acceptString2("123.45");
		acceptString2(new A2());
	}

}


class A2{
	public function __toString(): string
	{
		return 'hello';
	}
}

function acceptString(string $whatever) {
	var_dump($whatever);
}

function acceptString2(Stringable $whatever) {
	var_dump($whatever);
	var_dump((string)$whatever);
}
