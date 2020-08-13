<?php

namespace App\Application\Controller;

use App\Application\Exception\InvalidParameterException;
use App\Domain\Assembler\QuoteAssembler;
use App\Infrastructure\Services\Cache\CacheService;
use App\Infrastructure\Services\External\Quotes\QuotesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route as Route;

/**
 * Class SiteConfigController
 * @package App\Application\Controller
 */
final class ShoutController extends AbstractController
{
    /**
     * @var QuotesRepository
     */
    private $qrepo;
    /**
     * @var QuoteAssembler
     */
    private $quoteAssembler;

    /**
     * @var CacheService
     */
    private $cacheService;

    public function __construct(CacheService $cacheService)
    {
        $this->qrepo =  new QuotesRepository();
        $this->quoteAssembler = new QuoteAssembler();
        $this->cacheService = $cacheService;
    }

    /**
     * @Route("/shout/{author}", name="getShout", methods={ "GET" }, requirements={"author"=".+"})
     *
     * @param Request $request
     * @param string  $author
     *
     * @return JsonResponse
     */
    public function getShout(Request $request, string $author): JsonResponse
    {
        $limit = $request->query->get('limit');

        if (null !== $limit && !is_numeric($limit)) {
            throw new InvalidParameterException();
        }

        $response = $this->cacheService->get('getShout'.$author.$limit);

        if (!$response || $this->cacheService->isExpired($response)) {
            $results = $this->qrepo->filter($author, $limit);
            $response['item'] = $this->quoteAssembler->convertQuote($results);
            $this->cacheService->set('getShout'.$author.$limit, $response['item']);
        }

        return new JsonResponse($response['item'], JsonResponse::HTTP_OK);
    }
}
