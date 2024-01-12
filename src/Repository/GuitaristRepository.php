<?php

namespace App\Repository;

use App\Entity\Guitarist;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Guitarist>
 *
 * @method Guitarist|null find($id, $lockMode = null, $lockVersion = null)
 * @method Guitarist|null findOneBy(array $criteria, array $orderBy = null)
 * @method Guitarist[]    findAll()
 * @method Guitarist[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GuitaristRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Guitarist::class);
    }

//    /**
//     * @return Guitarist[] Returns an array of Guitarist objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Guitarist
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
