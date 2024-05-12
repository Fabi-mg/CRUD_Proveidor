<?php

namespace App\Repository;

use App\Entity\Proveidors;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Proveidors>
 */
class ProveidorsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Proveidors::class);
    }

    public function findAllProveidors() {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT proveidors.id, proveidors.nom, proveidors.email, proveidors.telf, proveidors.tipus, proveidors.actiu, proveidors.incorporacio, proveidors.edicio 
                FROM App\Entity\Proveidors proveidors'
            )
            ->getResult();
    }

    //    /**
    //     * @return Proveidors[] Returns an array of Proveidors objects
    //     */   
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Proveidors
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
