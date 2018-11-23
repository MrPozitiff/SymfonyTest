<?php

namespace App\Repository\Order;

use App\Entity\Order\DeliveryService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DeliveryService|null find($id, $lockMode = null, $lockVersion = null)
 * @method DeliveryService|null findOneBy(array $criteria, array $orderBy = null)
 * @method DeliveryService[]    findAll()
 * @method DeliveryService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeliveryServiceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DeliveryService::class);
    }

    // /**
    //  * @return DeliveryService[] Returns an array of DeliveryService objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DeliveryService
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
