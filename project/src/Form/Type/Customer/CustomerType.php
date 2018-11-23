<?php

namespace App\Form\Type\Customer;

use App\Form\EventSubscriber\AddUserFormSubscriber;
use App\Form\Type\User\ShopUserType;
use App\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class CustomerType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'customer.first_name',
            ])
            ->add('lastName', TextType::class, [
                'label' => 'customer.last_name',
            ])
            ->add('email', EmailType::class, [
                'label' => 'customer.email',
            ])
            ->add('birthday', BirthdayType::class, [
                'label' => 'customer.birthday',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('phoneNumber', TextType::class, [
                'required' => false,
                'label' => 'customer.phone_number',
            ])
            ->add('subscribedToNewsletter', CheckboxType::class, [
                'required' => false,
                'label' => 'customer.subscribed_to_newsletter',
            ]);
        $builder->addEventSubscriber(new AddUserFormSubscriber(ShopUserType::class));
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translation_domain', 'form');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'customer_profile';
    }
}
