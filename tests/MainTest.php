<?php


use PHPUnit\Framework\TestCase;

class MainTest extends TestCase
{
	/**
	 * @dataProvider oneTypeProvider
	 * @return void
	 */
	public function testOneType($expected, $string)
	{
		$this->assertEquals($expected, isParenthesisValid($string));
	}

	public function testWithoutParenthesis()
	{
		$this->assertEquals(true, isParenthesisValid("Hello there"));
	}

	public function testHandleEmptyString()
	{
		$this->expectException(EmptyStringException::class);
		isParenthesisValid();
	}


	/**
	 * @dataProvider twoTypeProvider
	 * @return void
	 */
	public function testTwoTypes($expected, $string)
	{
		$this->assertEquals($expected, isParenthesisValid($string));
	}


	/**
	 * @dataProvider threeTypeProvider
	 * @return void
	 */
	public function testThreeTypes($expected, $string)
	{
		$this->assertEquals($expected, isParenthesisValid($string));
	}



	public function oneTypeProvider(): array
	{
		return [
			[true, 'Hello (there)'],
			[false, 'Hello (there'],
			[false, 'Hello there)'],
			[false, 'Hello )there)'],
			[false, 'Hello )there('],
			];
	}

	public function twoTypeProvider(): array
	{
		return [
			[true, 'Hello (th[er]e)'],
			[false, 'Hello (th[ere)'],
			[false, 'Hello (th[er]e'],
			[false, 'Hello [(ther]e)'],
		];
	}

	public function threeTypeProvider(): array
	{
		return [
			[true, '{Hello (th[er]e)}'],
			[true, 'He{llo} (th[er]e)'],
			[false, 'Hello ({th[ere})'],
			[false, 'Hello (th[e{)re]}'],
		];
	}
}
