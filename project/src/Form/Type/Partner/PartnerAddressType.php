<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Form\Type\Partner;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use App\Entity\Partner\PartnerAddress;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PartnerAddressType
 */
class PartnerAddressType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('postcode');
        $builder->add('translations', TranslationsType::class);
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PartnerAddress::class,
            'attr' => ['class' => 'col-md-6'],
        ]);
    }


    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'app_partner_address';
    }
}
