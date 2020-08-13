<?php
/**
 * @author Felipe <felipe@amsterdapp.nl>
 *
 * @version 1.0.0
 */

namespace App\Application\EventListener;

use App\Application\Response\JsonMessage;
use App\Application\Exception\NotFoundException;
use App\Application\Exception\ForbiddenException;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Application\Exception\UnauthorizedException;
use App\Application\Exception\InvalidParameterException;
use App\Application\Exception\InvalidAPIResponseException;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

/**
 * Class ExceptionListener.
 */
class ExceptionListener
{
    /**
     * @param ExceptionEvent $event
     */
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getException();
        $message = $exception->getMessage();
        $response = null;

        switch (true) {
            case $exception instanceof NotFoundHttpException:
            case $exception instanceof MethodNotAllowedHttpException:
                $response = JsonMessage::response(JsonResponse::HTTP_BAD_REQUEST, ['message' => ('' !== $message) ? $message : 'Invalid path or HTTP verb']);
                break;
            case $exception instanceof InvalidParameterException:
                $response = JsonMessage::response(JsonResponse::HTTP_BAD_REQUEST, ['message' => ('' !== $message) ? $message : 'Invalid parameters sent']);
                break;
            case $exception instanceof NotFoundException:
            case JsonResponse::HTTP_NOT_FOUND === $exception->getCode():
                $response = JsonMessage::response(JsonResponse::HTTP_NOT_FOUND, ['message' => ('' !== $message) ? $message : 'Resource does not exist']);
                break;
            case $exception instanceof ForbiddenException:
                $response = JsonMessage::response(JsonResponse::HTTP_FORBIDDEN, ['message' => ('' !== $message) ? $message : 'Forbidden']);
                break;
            case $exception instanceof InvalidAPIResponseException:
                $response = JsonMessage::response(JsonResponse::HTTP_SERVICE_UNAVAILABLE, ['message' => ('' !== $message) ? $message : 'Service unavailable']);
                break;
            case $exception instanceof UnauthorizedException:
                $response = JsonMessage::response(JsonResponse::HTTP_UNAUTHORIZED, ['message' => ('' !== $message) ? $message : 'Unauthorized']);
                break;
        }

        if (null === $response) {
            $message = 'Unexpected error. Please contact with API developer';
            if ($this->isDev()) {
                $message = $exception->getMessage().' in '.$exception->getFile().' line '.$exception->getLine().'. Exception type: '.get_class($exception);
            }
            $response = JsonMessage::response(JsonResponse::HTTP_INTERNAL_SERVER_ERROR, ['message' => $message]);
        }

        $event->setResponse($response);
    }

    /**
     * @return bool
     */
    private function isDev()
    {
        return isset($_ENV['APP_ENV']) and (('dev' === $_ENV['APP_ENV']) or ('test' === $_ENV['APP_ENV']));
    }
}
