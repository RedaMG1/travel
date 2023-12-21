<?php

namespace App\Repository;

use App\Entity\DayInfo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DayInfo>
 *
 * @method DayInfo|null find($id, $lockMode = null, $lockVersion = null)
 * @method DayInfo|null findOneBy(array $criteria, array $orderBy = null)
 * @method DayInfo[]    findAll()
 * @method DayInfo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DayInfoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DayInfo::class);
    }

//    /**
//     * @return DayInfo[] Returns an array of DayInfo objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DayInfo
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
