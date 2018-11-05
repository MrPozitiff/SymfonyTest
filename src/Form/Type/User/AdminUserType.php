<?php

namespace App\Form\Type\User;

use Sylius\Bundle\UserBundle\Form\Type\UserType;
use Symfony\Component\Form\Extension\Core\Type\LocaleType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class AdminUserType extends UserType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('firstName', TextType::class, [
                'required' => false,
                'label' => 'sylius.form.user.first_name',
            ])
            ->add('lastName', TextType::class, [
                'required' => false,
                'label' => 'sylius.form.user.last_name',
            ])
            ->add('localeCode', LocaleType::class, [
                'label' => 'sylius.ui.locale',
                'placeholder' => null,
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'sylius_admin_user';
    }
}
