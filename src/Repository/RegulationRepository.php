<?php

namespace App\Repository;

use App\Entity\Regulation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Regulation>
 *
 * @method Regulation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Regulation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Regulation[]    findAll()
 * @method Regulation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegulationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Regulation::class);
    }

//    /**
//     * @return Regulation[] Returns an array of Regulation objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Regulation
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
