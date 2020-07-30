<?php


namespace App\Controller\Api\v1;


use App\Service\QuoteService;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations;

/**
 * @Annotations\Route("/api/v1/quotes")
 */
class QuoteController extends AbstractFOSRestController
{
    /** @var int */
    private const DEFAULT_FEED_SIZE = 200;

    /** @var QuoteService */
    private $quoteService;

    public function __construct(QuoteService $quoteService)
    {
        $this->quoteService = $quoteService;
    }


    /**
     * @Annotations\Get("")
     *
     * @Annotations\QueryParam(name="page", requirements="\d+", nullable=true)
     * @Annotations\QueryParam(name="perPage", requirements="\d+", nullable=true)
     *
     * @param  int|null  $page
     * @param  int|null  $perPage
     * @return View
     */

    public function getQuotesList(?int $page = null, ?int $perPage = null): View
    {
        $quotes = $this->quoteService->getQuotes($page ?? 1, $perPage ?? self::DEFAULT_FEED_SIZE);

        return View::create(['quotes' => $quotes], empty($quotes) ? 204 : 200);
    }

    /**
     * @Annotations\Get("/{quoteId}")
     *
     * @param  int  $quoteId
     * @return View
     */
    public function getQuote(int $quoteId): View
    {
        $quote = $this->quoteService->getQuoteById($quoteId);

        return View::create($quote, $quote ? 200 : 404);
    }

    /**
     * @Annotations\Post("")
     *
     * @Annotations\RequestParam(name="text")
     * @Annotations\RequestParam(name="type", requirements="\d+")
     * @Annotations\RequestParam(name="author", requirements=".{1,50}",  nullable=true)
     *
     * @param  string  $text
     * @param  string  $type
     * @param  string|null  $author
     * @return View
     */
    public function saveQuote(string $text, string $type, ?string $author = null): View
    {
        $quoteId = $this->quoteService->saveQuote($text, $type, $author);
        [$data, $code] = empty($quoteId) ?
            [['success' => false], 400] :
            [['success' => true, 'quoteId' => $quoteId], 200];

        return View::create($data, $code);
    }


    /**
     * @Annotations\Put("/{quoteId}")
     *
     * @Annotations\RequestParam(name="text")
     * @Annotations\RequestParam(name="type", requirements="\d+")
     * @Annotations\RequestParam(name="author", requirements=".{1,50}", nullable=true)
     *
     * @param  int  $quoteId
     * @param  string  $text
     * @param  string  $type
     * @param  string|null  $author
     * @return View
     */
    public function updateQuote(int $quoteId, string $text, string $type, ?string $author = null): View
    {
        $result = $this->quoteService->updateQuote($quoteId, $text, $type, $author);

        return View::create(['success' => $result], $result ? 200 : 404);
    }

    /**
     * @Annotations\Delete("/{quoteId}")
     *
     * @param  int  $quoteId
     * @return View
     */
    public function deleteQuote(int $quoteId): View
    {
        $result = $this->quoteService->deleteQuote($quoteId);

        return View::create(['success' => $result], $result ? 200 : 404);
    }
}