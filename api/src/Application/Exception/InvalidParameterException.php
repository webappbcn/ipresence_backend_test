<?php
/**
 * @author Felipe <felipe@amsterdapp.nl>
 *
 * @version 1.0.0
 */

namespace App\Application\Exception;

use UnexpectedValueException;

/**
 * Class InvalidParameterException.
 */
class InvalidParameterException extends UnexpectedValueException implements ApplicationExceptionInterface
{
}
