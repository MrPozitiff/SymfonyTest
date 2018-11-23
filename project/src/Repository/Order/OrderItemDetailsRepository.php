<?php

namespace App\Repository\Order;

use App\Entity\Order\OrderItemDetails;
use Doctrine\ORM\EntityRepository;

/**
 * @method OrderItemDetails|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderItemDetails|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderItemDetails[]    findAll()
 * @method OrderItemDetails[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderItemDetailsRepository extends EntityRepository
{
}
