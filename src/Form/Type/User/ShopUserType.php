<?php

namespace App\Form\Type\User;

use Sylius\Bundle\UserBundle\Form\Type\UserType;
use Symfony\Component\Form\FormBuilderInterface;

final class ShopUserType extends UserType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);

        $builder
            ->remove('username')
            ->remove('email')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'sylius_shop_user';
    }
}
