<?php

namespace App\Context;

use App\Component\Model\PartnerInterface;
use App\Entity\Partner\PartnerUser;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class PartnerContext
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
    public function getPartner(): ?PartnerInterface
    {
        if (null === $token = $this->tokenStorage->getToken()) {
            return null;
        }

        if ($this->authorizationChecker->isGranted('IS_AUTHENTICATED_REMEMBERED') && $token->getUser() instanceof PartnerUser) {
            return $token->getUser()->getPartner();
        }

        return null;
    }

    /**
     * @return PartnerInterface
     */
    public function getPartnerSecure(): PartnerInterface
    {
        $partner = $this->getPartner();
        if (null === $partner) {
            throw new AccessDeniedException();
        }

        return $partner;
    }
}
