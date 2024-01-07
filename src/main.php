<?php

/**
 * @throws Exception for empty input
 * @param string $input
 * @return bool
 */
function isParenthesisValid(string $input = ''): bool
{
	if ($input === '')
	{
		throw new EmptyStringException("String can not be empty");
	}

	$stack = new SplStack();

	$stringLength = strlen($input);

	for($i = 0; $i < $stringLength; $i++)
	{
		if ($input[$i] === '('
			|| $input[$i] === '['
			|| $input[$i] === '{')
		{
			$stack->push($input[$i]);
		}

		if ($input[$i] === ')'
			|| $input[$i] === ']'
			|| $input[$i] === '}')
		{
			try
			{
				$lastParenthesis = $stack->pop();
				if (!isSameTypeParenthesis($lastParenthesis, $input[$i]))
				{
					return false;
				}
			}
			catch (RuntimeException $exception)
			{
				return false;
			}
		}
	}

	return $stack->isEmpty();
}


function isSameTypeParenthesis(string $openParenthesis, string $closeParenthesis): bool
{
	switch ($openParenthesis)
	{
		case '(':
			return $closeParenthesis === ')';
		case '{':
			return $closeParenthesis === '}';
		case '[':
			return $closeParenthesis === ']';
		default:
			return false;
	}
}

class EmptyStringException extends RuntimeException{}
