<?php

namespace App\Context;

use App\Component\Model\CustomerInterface;
use App\Component\Model\ShopUserInterface;
use App\Component\Model\CustomerInterface as BaseCustomerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CustomerContext
{
    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @param TokenStorageInterface $tokenStorage
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(TokenStorageInterface $tokenStorage, AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->tokenStorage = $tokenStorage;
        $this->authorizationChecker = $authorizationChecker;
    }

    /**
     * {@inheritdoc}
     */
    public function getCustomer(): ?BaseCustomerInterface
    {
        if (null === $token = $this->tokenStorage->getToken()) {
            return null;
        }

        if ($this->authorizationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED') && $token->getUser() instanceof ShopUserInterface) {
            return $token->getUser()->getCustomer();
        }

        return null;
    }

    /**
     * @return BaseCustomerInterface
     */
    public function getCustomerSecure(): CustomerInterface
    {
        $customer = $this->getCustomer();
        if (null === $customer) {
            throw new AccessDeniedException();
        }

        return $customer;
    }
}
