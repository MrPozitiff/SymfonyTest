<?php

namespace App\EventListener;

use Doctrine\Common\Persistence\ObjectManager;
use Sylius\Bundle\UserBundle\Security\UserLoginInterface;
use Sylius\Bundle\UserBundle\UserEvents;
use App\Component\Model\CustomerInterface;
use App\Component\Model\ShopUserInterface;
use Sylius\Component\User\Security\Generator\GeneratorInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

final class UserRegistrationListener
{
    /**
     * @var ObjectManager
     */
    private $userManager;

    /**
     * @var GeneratorInterface
     */
    private $tokenGenerator;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @var UserLoginInterface
     */
    private $userLogin;

    /**
     * @var string
     */
    private $firewallContextName;

    /**
     * @param ObjectManager $userManager
     * @param GeneratorInterface $tokenGenerator
     * @param EventDispatcherInterface $eventDispatcher
     * @param UserLoginInterface $userLogin
     * @param string $firewallContextName
     */
    public function __construct(
        ObjectManager $userManager,
        GeneratorInterface $tokenGenerator,
        EventDispatcherInterface $eventDispatcher,
        UserLoginInterface $userLogin,
        $firewallContextName
    ) {
        $this->userManager = $userManager;
        $this->tokenGenerator = $tokenGenerator;
        $this->eventDispatcher = $eventDispatcher;
        $this->userLogin = $userLogin;
        $this->firewallContextName = $firewallContextName;
    }

    /**
     * @param GenericEvent $event
     */
    public function handleUserVerification(GenericEvent $event): void
    {
        $customer = $event->getSubject();
        Assert::isInstanceOf($customer, CustomerInterface::class);

        $user = $customer->getUser();
        Assert::notNull($user);

        if (!$this->isAccountVerificationRequired()) {
            $this->enableAndLogin($user);

            return;
        }

        $this->sendVerificationEmail($user);
    }

    /**
     * @param ShopUserInterface $user
     */
    private function sendVerificationEmail(ShopUserInterface $user): void
    {
        $token = $this->tokenGenerator->generate();
        $user->setEmailVerificationToken($token);

        $this->userManager->persist($user);
        $this->userManager->flush();

        $this->eventDispatcher->dispatch(UserEvents::REQUEST_VERIFICATION_TOKEN, new GenericEvent($user));
    }

    /**
     * @param ShopUserInterface $user
     */
    private function enableAndLogin(ShopUserInterface $user): void
    {
        $user->setEnabled(true);

        $this->userManager->persist($user);
        $this->userManager->flush();

        $this->userLogin->login($user, $this->firewallContextName);
    }

    /**
     * @return bool
     */
    private function isAccountVerificationRequired(): bool
    {
        return false;
    }
}
