<?php
/**
 * @author Felipe <felipe@amsterdapp.nl>
 *
 * @version 1.0.0
 */

namespace App\Application\Exception;

use RuntimeException;

/**
 * Class InvalidAPIResponseException.
 */
class InvalidAPIResponseException extends RuntimeException implements ApplicationExceptionInterface
{
}
