<?php

namespace App\Repository;

use App\Entity\Investment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Investment>
 */
class InvestmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Investment::class);
    }

    /**
     * @return Investment[] Returns an array of Investment objects which contains investment projects after year 2005
     */
    public function findByFilters(?string $ville, ?string $etatAvancement): array
    {
       $qb = $this->createQueryBuilder('i');
       if ($ville) {
           $qb->andWhere('LOWER(i.ville) LIKE LOWER(:ville)')
               ->setParameter('ville', "%$ville%");
       }

        if ($etatAvancement) {
            $qb->andWhere('LOWER(i.etatAvancement) LIKE LOWER(:etatAvancement)')
                ->setParameter('etatAvancement', "%$etatAvancement%");
        }

        return $qb
            ->orderBy('i.annee', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
