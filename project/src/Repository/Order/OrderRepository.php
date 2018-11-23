<?php

namespace App\Repository\Order;

use App\Component\Model\CustomerInterface;
use App\Component\Model\OrderInterface;
use App\Utils\AssociationHydrator;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

/**
 * @method OrderInterface|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderInterface|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderInterface[]    findAll()
 * @method OrderInterface[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderRepository extends EntityRepository
{
    /**
     * @var AssociationHydrator
     */
    private $associationHydrator;

    /**
     * OrderRepository constructor.
     *
     * @param EntityManagerInterface $em
     * @param Mapping\ClassMetadata  $class
     */
    public function __construct(EntityManagerInterface $em, Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);

        $this->associationHydrator = new AssociationHydrator($em, $class);
    }

    /**
     * @param CustomerInterface $customer
     *
     * @return null|OrderInterface
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findLatestCartByCustomer(CustomerInterface $customer)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.state = :state')
            ->andWhere('o.customer = :customer')
            ->setParameter('state', OrderInterface::STATE_CART)
            ->setParameter('customer', $customer)
            ->addOrderBy('o.createdAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param null|int $id
     *
     * @return OrderInterface|null
     */
    public function findCartForSummary(?int $id): ?OrderInterface
    {
        /** @var OrderInterface $order */
        $order = $this->createQueryBuilder('o')
            ->andWhere('o.id = :id')
            ->andWhere('o.state = :state')
            ->setParameter('id', $id)
            ->setParameter('state', OrderInterface::STATE_CART)
            ->getQuery()
            ->getOneOrNullResult()
        ;

        $this->associationHydrator->hydrateAssociations($order, [
            'adjustments',
            'items',
            'items.adjustments',
            'items.units',
            'items.units.adjustments',
            'items.variant',
            'items.variant.optionValues',
            'items.variant.optionValues.translations',
            'items.variant.product',
            'items.variant.product.translations',
            'items.variant.product.images',
            'items.variant.product.options',
            'items.variant.product.options.translations',
        ]);

        return $order;
    }

    /**
     * @param OrderInterface $order
     * @param bool $flush
     */
    public function save(OrderInterface $order, bool $flush = true)
    {
        $em = $this->getEntityManager();
        $em->persist($order);
        if ($flush) {
            $em->flush();
        }
    }
}
