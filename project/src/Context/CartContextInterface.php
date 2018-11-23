<?php

namespace App\Context;

use App\Component\Model\OrderInterface;

interface CartContextInterface
{
    /**
     * @return OrderInterface
     *
     * @throws CartNotFoundException
     */
    public function getCart(): OrderInterface;
}
