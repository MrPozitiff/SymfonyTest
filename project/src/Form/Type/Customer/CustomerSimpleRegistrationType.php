<?php

namespace App\Form\Type\Customer;

use App\Form\EventSubscriber\CustomerRegistrationFormSubscriber;
use App\Form\Type\User\ShopUserRegistrationType;
use App\Form\Type\AbstractResourceType;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Valid;

final class CustomerSimpleRegistrationType extends AbstractResourceType
{
    /**
     * @var RepositoryInterface
     */
    private $customerRepository;

    /**
     * @param string $dataClass
     * @param RepositoryInterface $customerRepository
     * @param null|array $validationGroups
     */
    public function __construct(string $dataClass, RepositoryInterface $customerRepository, ?array $validationGroups = [])
    {
        if (empty($validationGroups)) {
            $validationGroups = ['Default'];
        }
        parent::__construct($dataClass, $validationGroups);

        $this->customerRepository = $customerRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options = []): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'customer.email',
            ])
            ->add('user', ShopUserRegistrationType::class, [
                'label' => false,
                'constraints' => [new Valid()],
            ])
            ->addEventSubscriber(new CustomerRegistrationFormSubscriber($this->customerRepository))
            ->setDataLocked(false)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
//        parent::configureOptions($resolver);
        $resolver->setDefaults([
            'data_class' => $this->dataClass,
//            'validation_groups' => $this->validationGroups,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'customer_simple_registration';
    }
}
