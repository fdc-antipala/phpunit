<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase {

	public function testReturnsFullName() {
		$user = new User;

		$user->first_name = "Teresa";
		$user->surname = "Green";

		$this->assertEquals('Teresa Green', $user->getFullName());
	}

	public function testFullNameIsEmptyByDefault() {
		$user = new User;

		$this->assertEquals('', $user->getFullName());
	}

	public function testNotificationIsSent() {
		$user = new User;

		$mock_mailer = $this->createMock(Mailer::class);

		$mock_mailer->expects($this->once())
			->method('sendMessage')
			->with($this->equalTo('dave@example.com'), $this->equalTo('Hello'))
			->willReturn(true);

		$user->setMailer($mock_mailer);

		$user->email = 'dave@example.com';

		$this->assertTrue($user->notify("Hello"));
	}

	/**
	* @test
	*/
	public function cannot_notify_user_withNoEmail() {
		$user = new User;

		$mock_mailer = $this->getMockBuilder(Mailer::class)
			->setMethods(null)
			->getMock();

		$user->setMailer($mock_mailer);
		
		$this->expectException(Exception::class);

		$user->notify("Hello");
	}

	public function testNotifyReturnTrue () {
		$user = new User('test@test.com');
		$mailer = new Mailer;
		$this->assertTrue($user->notify('Hello'));
	}
}
