<?php
/** */
namespace App\Admin\Shop;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use App\Entity\Shop\Product;
use App\Form\Type\Shop\CategoryImageType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\Type\Filter\NumberType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Form\Type\DateRangePickerType;
use Sonata\DoctrineORMAdminBundle\Filter\BooleanFilter;
use Sonata\DoctrineORMAdminBundle\Filter\DateRangeFilter;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class OptionAdmin
 */
class OptionAdmin extends AbstractAdmin
{
    protected $searchResultActions = ['edit', 'show'];

    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->with('General', ['class' => 'col-md-6'])
                ->add('enabled', CheckboxType::class)
                ->add('price', MoneyType::class, [
                    'label' => 'admin.form.price',
                    'currency' => 'USD',
                    ])
            ->end()
            ->with('Products', ['class' => 'col-md-6'])
                ->add('Products', ModelType::class, [
                    'label' => 'admin.form.option.product',
                    'class' => Product::class,
                    'btn_add' => false,
                    'multiple' => true,
                ])
            ->end()
            ->with('Translatable Fields', ['class' => 'col-md-6'])
                ->add('translations', TranslationsType::class, [
                    'fields' => [
                        'description' => [
                            'field_type' => CKEditorType::class,
                            'label' => 'admin.form.product.description',
                        ],
                    ],
                ])
            ->end();

    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('name')
            ->add('price')
            ->add('enabled', 'boolean', ['editable' => true])
            ->add('createdAt')
            ->add('updatedAt');
        $list
            ->add('_action', 'actions', [
            'actions' => [
                'view' => [],
                'edit' => [],
            ]
        ]);
    }

    /**
     * @param ShowMapper $show
     */
    protected function configureShowFields(ShowMapper $show)
    {
        $show
            ->add('id')
            ->add('enabled', 'boolean')
            ->add('name')
            ->add('description')
            ->add('shortDescription');
    }
}
