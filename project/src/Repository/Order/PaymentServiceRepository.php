<?php

namespace App\Repository\Order;

use App\Entity\Order\PaymentService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PaymentService|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaymentService|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaymentService[]    findAll()
 * @method PaymentService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaymentServiceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PaymentService::class);
    }

    // /**
    //  * @return PaymentService[] Returns an array of PaymentService objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PaymentService
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
