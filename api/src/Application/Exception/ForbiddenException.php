<?php
/**
 * @author Felipe <felipe@amsterdapp.nl>
 *
 * @version 1.0.0
 */

namespace App\Application\Exception;

use Mockery\Exception\RuntimeException;

/**
 * Class ForbiddenException.
 */
class ForbiddenException extends RuntimeException implements ApplicationExceptionInterface
{
}
