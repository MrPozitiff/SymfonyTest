<?php

namespace App\Form\EventSubscriber;

use App\Component\Model\CustomerInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Webmozart\Assert\Assert;

final class CustomerRegistrationFormSubscriber implements EventSubscriberInterface
{
    /**
     * @var RepositoryInterface
     */
    private $customerRepository;

    /**
     * @param RepositoryInterface $customerRepository
     */
    public function __construct(RepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::PRE_SUBMIT => 'preSubmit',
        ];
    }

    /**
     * {@inheritdoc}
     *
     * @throws \InvalidArgumentException
     */
    public function preSubmit(FormEvent $event): void
    {
        $rawData = $event->getData();
        $form = $event->getForm();
        $data = $form->getData();

        Assert::isInstanceOf($data, CustomerInterface::class);

        // if email is not filled in, go on
        if (!isset($rawData['email']) || empty($rawData['email'])) {
            return;
        }

        /** @var CustomerInterface|null $existingCustomer */
        $existingCustomer = $this->customerRepository->findOneBy(['email' => $rawData['email']]);
        if (null === $existingCustomer || null !== $existingCustomer->getUser()) {
            return;
        }

        $existingCustomer->setUser($data->getUser());
        $form->setData($existingCustomer);
    }
}
