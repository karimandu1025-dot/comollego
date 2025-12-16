<?php

class ExampleTest extends TestCase {

	/**
	 * Test home route returns successfully.
	 *
	 * @return void
	 */
	public function testHomeRoute()
	{
		$this->call('GET', '/');
		$this->assertResponseOk();
	}

	/**
	 * Test home view contains expected content.
	 *
	 * @return void
	 */
	public function testHomeView()
	{
		$this->call('GET', '/');
		$this->assertViewHas('hello');
	}

}
