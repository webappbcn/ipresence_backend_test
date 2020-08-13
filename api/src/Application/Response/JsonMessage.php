<?php
/**
 * @author Felipe <felipe@amsterdapp.nl>
 *
 * @version 1.0.0
 */

namespace App\Application\Response;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class JsonMessage.
 */
class JsonMessage
{
    /**
     * @param int|null $code
     * @param array    $data
     * @param null     $responseBody
     * @param null     $responseHeaders
     *
     * @return JsonResponse
     */
    public static function response(int $code = null, array $data = [], $responseBody = null, $responseHeaders = null): JsonResponse
    {
        $code = (null !== $code) && array_key_exists($code, Response::$statusTexts) ? $code : Response::HTTP_INTERNAL_SERVER_ERROR;
        $response = new JsonResponse(null, $code);
        $responseData = [
            'status' => $code,
            'response' => null,
        ];
        switch (true) {
            case $response->isRedirection():
            case $response->isClientError():
            case $response->isServerError():
                $responseData['response'] = ['message' => isset($data['message']) ? $data['message'] : Response::$statusTexts[$code]];
                break;
            default:
                //$response->isInformational()
                //$response->isSuccessful()
                $responseData['response'] = $data;
                break;
        }

        if (null !== $responseBody) {
            $responseData['response']['responseBody'] = $responseBody;
        }

        if (null !== $responseHeaders) {
            $responseData['response']['responseHeaders'] = $responseHeaders;
        }

        $response->setData($responseData);

        return $response;
    }
}
