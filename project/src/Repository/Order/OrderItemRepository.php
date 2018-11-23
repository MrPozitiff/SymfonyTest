<?php

namespace App\Repository\Order;

use App\Entity\Order\Order;
use App\Entity\Order\OrderItem;
use App\Entity\Partner\Partner;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

/**
 * @method OrderItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderItem[]    findAll()
 * @method OrderItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderItemRepository extends EntityRepository
{
    /**
     * @param Partner $partner
     *
     * @return null|OrderItem[]
     */
    public function findAllForPartner(Partner $partner): ?array
    {
        return $this->createQueryBuilder('oi')
            ->join('oi.order', 'o')
            ->join('oi.product', 'p')
            ->where('p.partner = :partner')
            ->andWhere('o.state != :state')
            ->setParameter('partner', $partner)
            ->setParameter('state', Order::STATE_CART)
            ->getQuery()
            ->getResult();
    }
}
