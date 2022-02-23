<?php

namespace App\Repository;

use App\Entity\Gato3;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Gato3|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gato3|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gato3[]    findAll()
 * @method Gato3[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Gato3Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gato3::class);
    }

    // /**
    //  * @return Gato3[] Returns an array of Gato3 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gato3
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
