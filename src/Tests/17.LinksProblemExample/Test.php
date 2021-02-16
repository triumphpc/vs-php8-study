<?php
namespace Tests\LinksProblemExample;

use PHPUnit\Framework\TestCase;

class Test extends TestCase {

	public function testRun() {

		$a = ['zero','one','two', 'three', 'vvv'];

		foreach ($a as &$v) {
			// Последнему элементу массива присваивается ссылка на предыдущий элемент
			// Т.е. послдений элемент массива меняется на ссылку
		}

		foreach ($a as $v) {
			echo "$v ";
		}

		$this->expectOutputString("zero one two three three ");
	}

}