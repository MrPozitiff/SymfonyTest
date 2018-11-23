<?php

namespace App\Context;

use App\Component\Model\OrderInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;

class NewCartContext implements CartContextInterface
{
    /**
     * @var FactoryInterface
     */
    private $cartFactory;

    /**
     * @param FactoryInterface $cartFactory
     */
    public function __construct(FactoryInterface $cartFactory)
    {
        $this->cartFactory = $cartFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getCart(): OrderInterface
    {
        return $this->cartFactory->createNew();
    }
}
