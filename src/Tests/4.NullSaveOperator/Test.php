<?php
declare(strict_types=1);

namespace Tests\NullSaveOperator;

use PHPUnit\Framework\TestCase;

class Test extends TestCase {
	public function testRun() {
		$session = null;
		$country = $session?->user?->getAddress()?->country;

		$this->assertTrue($country === null);

		$session = new Session(null);
		$country = $session?->user?->getAddress()?->country;
		$this->assertTrue($country === null);

		$session = new Session(new User(new Address("home")));
		$country = $session?->user?->getAddress()?->country;
		$this->assertTrue($country === "home");

		// Разница между Nullcoalescing оperator
		$array = [];
		$this->assertTrue(($array['key']->foo ?? null) == null);

//		warning
//		var_dump($array['key']?->foo);

		// Fatal
//		$country = &$session?->user?->getAddress()?->country;

	}
}

class Session {
	public ?User $user;

	public function __construct(?User $user) {
		$this->user =$user;
	}

}

class User {
	public Address $address;

	public function __construct(Address $address) {
		$this->address = $address;
	}

	public function getAddress() {
		return $this->address;
	}

}

class Address {
	public string $country;

	public function __construct(string $address) {
		$this->country = $address;
	}
}