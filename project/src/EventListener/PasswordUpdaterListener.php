<?php

namespace App\EventListener;

use Sylius\Bundle\UserBundle\EventListener\PasswordUpdaterListener as BasePasswordUpdaterListener;
use App\Component\Model\CustomerInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

final class PasswordUpdaterListener extends BasePasswordUpdaterListener
{
    /**
     * @param GenericEvent $event
     *
     * @throws \InvalidArgumentException
     */
    public function customerUpdateEvent(GenericEvent $event): void
    {
        /** @var CustomerInterface $customer */
        $customer = $event->getSubject();

        Assert::isInstanceOf($customer, CustomerInterface::class);

        $user = $customer->getUser();
        if (null !== $user) {
            $this->updatePassword($user);
        }
    }
}
