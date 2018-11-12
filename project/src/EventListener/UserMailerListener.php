<?php

namespace App\EventListener;

use App\Mailer\Emails;
use Sylius\Bundle\UserBundle\EventListener\MailerListener;
use App\Component\Model\CustomerInterface;
use App\Component\Model\ShopUserInterface;
use Sylius\Component\Mailer\Sender\SenderInterface;
use Sylius\Component\Resource\Exception\UnexpectedTypeException;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

final class UserMailerListener extends MailerListener
{
    /**
     * @param SenderInterface $emailSender
     */
    public function __construct(SenderInterface $emailSender)
    {
        parent::__construct($emailSender);
    }

    /**
     * @param GenericEvent $event
     *
     * @throws UnexpectedTypeException
     */
    public function sendUserRegistrationEmail(GenericEvent $event): void
    {
        $customer = $event->getSubject();

        Assert::isInstanceOf($customer, CustomerInterface::class);

        $user = $customer->getUser();
        if (null === $user) {
            return;
        }

        $email = $customer->getEmail();
        if (empty($email)) {
            return;
        }

        Assert::isInstanceOf($user, ShopUserInterface::class);

        $this->sendEmail($user, Emails::USER_REGISTRATION);
    }
}
