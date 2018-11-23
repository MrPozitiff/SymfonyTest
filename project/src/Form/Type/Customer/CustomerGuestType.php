<?php

namespace App\Form\Type\Customer;

use App\Form\Type\AbstractResourceType;
use App\Component\Model\CustomerInterface;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

final class CustomerGuestType extends AbstractResourceType
{
    /**
     * @var RepositoryInterface
     */
    private $customerRepository;

    /**
     * @var FactoryInterface
     */
    private $customerFactory;

    /**
     * @param string $dataClass
     * @param RepositoryInterface $customerRepository
     * @param FactoryInterface $customerFactory
     * @param null|array $validationGroups
     */
    public function __construct(
        string $dataClass,
        RepositoryInterface $customerRepository,
        FactoryInterface $customerFactory,
        ?array $validationGroups = []
    ) {
        parent::__construct($dataClass, $validationGroups);

        $this->customerRepository = $customerRepository;
        $this->customerFactory = $customerFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'sylius.form.customer.email',
            ])
            ->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event): void {
                $data = $event->getData();

                if (!isset($data['email'])) {
                    return;
                }

                /** @var CustomerInterface $customer */
                $customer = $this->customerRepository->findOneBy(['email' => $data['email']]);

                // assign existing customer or create a new one
                $form = $event->getForm();
                if (null !== $customer && null === $customer->getUser()) {
                    $form->setData($customer);

                    return;
                }

                /** @var CustomerInterface $customer */
                $customer = $this->customerFactory->createNew();
                $customer->setEmail($data['email']);

                $form->setData($customer);
            })
            ->setDataLocked(false)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'sylius_customer_guest';
    }
}
