<?php


namespace App\Repository;


use App\Entity\Quote;
use Doctrine\ORM\EntityRepository;
use Knp\Component\Pager\PaginatorInterface;

class QuoteRepository extends EntityRepository
{

    /**
     * @param  int  $page
     * @param  int  $perPage
     * @param  PaginatorInterface  $paginator
     * @return iterable
     */
    public function getQuotes(int $page, int $perPage, PaginatorInterface $paginator): iterable
    {
        $queryBuilder = $this->getEntityManager()->createQueryBuilder();

        $queryBuilder->select('t')
            ->from($this->getClassName(), 't')
            ->orderBy('t.createdAt', 'DESC');

        return $paginator->paginate($queryBuilder, $page, $perPage)->getItems();
    }


}