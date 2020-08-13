<?php

namespace App\Application\Exception;

use UnexpectedValueException;

/**
 * Class InvalidParameterException.
 */
class InvalidParameterException extends UnexpectedValueException implements ApplicationExceptionInterface
{
}
