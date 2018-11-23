<?php

namespace App\Repository\Partner;

use Sylius\Bundle\UserBundle\Doctrine\ORM\UserRepository as BaseUserRepository;
use Sylius\Component\User\Model\UserInterface;
use Sylius\Component\User\Repository\UserRepositoryInterface;

class PartnerUserRepository extends BaseUserRepository implements UserRepositoryInterface
{
}
