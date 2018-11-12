<?php

namespace App\Component\Model;

use Sylius\Component\User\Model\UserInterface as BaseUserInterface;

interface ShopUserInterface extends BaseUserInterface, CustomerAwareInterface
{
}
