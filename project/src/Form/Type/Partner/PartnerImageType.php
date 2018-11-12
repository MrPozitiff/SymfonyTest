<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Form\Type\Partner;

use App\Form\Type\ImageType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class PartnerImageType
 */
class PartnerImageType extends ImageType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        parent::buildForm($builder, $options);
        $builder->remove('position');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'app_partner_image';
    }
}
