<?php

namespace App\Repository;

use App\Entity\TourRequest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<TourRequest>
 *
 * @method TourRequest|null find($id, $lockMode = null, $lockVersion = null)
 * @method TourRequest|null findOneBy(array $criteria, array $orderBy = null)
 * @method TourRequest[]    findAll()
 * @method TourRequest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TourRequestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TourRequest::class);
    }

//    /**
//     * @return TourRequest[] Returns an array of TourRequest objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?TourRequest
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
