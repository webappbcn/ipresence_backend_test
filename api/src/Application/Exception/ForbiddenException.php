<?php

namespace App\Application\Exception;

use Mockery\Exception\RuntimeException;

/**
 * Class ForbiddenException.
 */
class ForbiddenException extends RuntimeException implements ApplicationExceptionInterface
{
}
