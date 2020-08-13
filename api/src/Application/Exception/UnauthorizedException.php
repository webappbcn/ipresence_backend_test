<?php
/**
 * @author Felipe <felipe@amsterdapp.nl>
 *
 * @version 1.0.0
 */

namespace App\Application\Exception;

use RuntimeException;

/**
 * Class UnauthorizedException.
 */
class UnauthorizedException extends RuntimeException implements ApplicationExceptionInterface
{
}
