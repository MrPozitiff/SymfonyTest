<?php

namespace App\Entity\Order;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Order\OrderDeliveryRepository")
 */
class OrderDelivery
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    private $deliveryService;

    private $price;


    private $state;

    public function getId(): ?int
    {
        return $this->id;
    }
}
