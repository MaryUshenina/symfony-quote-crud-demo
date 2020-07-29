<?php


namespace App\Repository;


use App\Entity\Quote;
use Doctrine\ORM\EntityRepository;

class QuoteRepository extends EntityRepository
{

    /**
     * @param  int  $page
     * @param  int  $perPage
     * @return Quote[]
     */
    public function getQuotes(int $page, int $perPage): array
    {
        $page -= $page >0 ? 1 : 0;

        $queryBuilder = $this->getEntityManager()->createQueryBuilder();
        $queryBuilder->select('t')
            ->from($this->getClassName(), 't')
            ->orderBy('t.createdAt', 'DESC')
            ->setFirstResult($perPage * $page)
            ->setMaxResults($perPage);

        return $queryBuilder->getQuery()->getResult();
    }


}