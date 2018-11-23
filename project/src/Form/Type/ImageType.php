<?php

namespace App\Form\Type;

use App\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;

abstract class ImageType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('position', NumberType::class, [
                'label' => 'admin.form.image.position',
                'required' => false,
            ])
            ->add('file', VichImageType::class, [
                'label' => 'admin.form.image.file',
                'allow_delete' => false,
                'download_uri' => false,
                'imagine_pattern' => 'admin_thumbnail',
                'required' => false,
                'attr' => ['class' => 'col-md-6'],
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return 'app_image';
    }
}
