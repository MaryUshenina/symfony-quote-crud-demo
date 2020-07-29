<?php


namespace App\Service;


use App\Entity\Quote;
use App\Repository\QuoteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class QuoteService
{

    /** @var EntityManagerInterface */
    private $entityManager;


    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param  string|null  $className
     * @return ObjectRepository
     */
    private function getRepository(string $className = null): ObjectRepository
    {
        return $this->entityManager->getRepository($className ?? Quote::class);
    }

    /**
     * @param  int  $page
     * @param  int  $perPage
     * @return Quote[]
     */
    public function getQuotes(int $page, int $perPage): array
    {
        /** @var QuoteRepository $quoteRepository */
        $quoteRepository = $this->getRepository();

        return $quoteRepository->getQuotes($page, $perPage);
    }

    /**
     * @param  int  $quoteId
     * @return object|null - Quote or NULL
     */
    public function getQuoteById(int $quoteId): ?object
    {
        /** @var QuoteRepository $quoteRepository */
        $quoteRepository = $this->getRepository();

        return $quoteRepository->find($quoteId);
    }

    /**
     * @param  string  $text
     * @param  string  $type
     * @param  string|null  $author
     * @return int|null
     */
    public function saveQuote(string $text, string $type, ?string $author = null) : ?int
    {
        $quote = new Quote();
        $quote->setText($text);
        $quote->setType($type);
        $quote->setAuthor($author);
        $this->entityManager->persist($quote);
        $this->entityManager->flush();

        return $quote->getId();
    }

    /**
     * @param  int  $quoteId
     * @param  string  $text
     * @param  string  $type
     * @param  string|null  $author
     * @return bool
     */
    public function updateQuote(int $quoteId, string $text, string $type, ?string $author = null)
    {
        /** @var Quote $quote */
        $quote = $this->getQuoteById($quoteId);
        if($quote === null){
            return false;
        }

        $quote->setText($text);
        $quote->setType($type);
        $quote->setAuthor($author);
        $this->entityManager->flush();

        return true;
    }

    /**
     * @param  int  $quoteId
     * @return bool
     */
    public function deleteQuote(int $quoteId)
    {
        /** @var Quote $quote */
        $quote = $this->getQuoteById($quoteId);
        if($quote === null){
            return false;
        }

        $this->entityManager->remove($quote);
        $this->entityManager->flush();

        return true;
    }
}