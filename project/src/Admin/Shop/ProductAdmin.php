<?php
/** */
namespace App\Admin\Shop;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use App\Entity\Partner\Partner;
use App\Entity\Partner\PartnerAddress;
use App\Form\Type\Partner\PartnerAddressType;
use App\Form\Type\Shop\ProductImageType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\CollectionType;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\CoreBundle\Form\Type\DateRangePickerType;
use Sonata\DoctrineORMAdminBundle\Filter\BooleanFilter;
use Sonata\DoctrineORMAdminBundle\Filter\DateRangeFilter;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class ProductAdmin
 */
class ProductAdmin extends AbstractAdmin
{
    protected $searchResultActions = ['edit', 'show'];

    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->tab('General')
                ->with('General', ['class' => 'col-md-6'])
                    ->add('enabled', CheckboxType::class, ['required' => false])
                    ->add('category', ModelType::class, ['label' => 'admin.form.category'])
                    ->add('partner', ModelType::class, [
                        'label' => 'admin.form.product.partner',
                        'class' => Partner::class,
                        'btn_add' => false,
                    ])
                    ->add('slug', TextType::class, [
                        'label' => 'admin.form.slug',
                        'required' => false,
                    ])
                    ->add('code', TextType::class, [
                        'label' => 'admin.form.product.code',
                    ])
                ->end()
                ->with('Price And Stock', ['class' => 'col-md-6'])
                    ->add('price', MoneyType::class, [
                        'label' => 'admin.form.product.price',
                        'currency' => 'USD',
                    ])
                    ->add('partnerPrice', MoneyType::class, [
                        'label' => 'admin.form.product.partner_price',
                        'currency' => 'USD',
                    ])
                    ->add('storageCount', IntegerType::class, ['label' => 'admin.form.product.stock_count'])
                    ->add('storageLimited', CheckboxType::class, [
                        'label' => 'admin.form.product.stock_limited',
                        'required' => false,
                    ])
                ->end()
                ->with('Translatable Fields')
                    ->add('translations', TranslationsType::class, [
                        'fields' => [
                            'description' => [
                                'field_type' => CKEditorType::class,
                                'label' => 'admin.form.product.description',
                            ],
                        ],
                    ])
                ->end()
            ->end()
            ->with('Media', ['tab' => true])
                ->add('images', CollectionType::class, [
                    "allow_add" => true,
                    "allow_delete" => true,
                    "by_reference" => false,
                    "entry_type" => ProductImageType::class
                ])
            ->end()
            ->end()
            ->with('Partner Addresses', ['tab' => true])
                ->add('address', ModelType::class, [
                    'label' => 'admin.form.product.address',
                    'class' => PartnerAddress::class,
                ])
            ->end();

    }

    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('code')
            ->add('slug')
            ->add('url')
            ->add('name')
            ->add('partner')
            ->add('address')
            ->add('enabled', 'boolean', ['editable' => true])
            ->add('createdAt')
            ->add('updatedAt');
        $list
            ->add('_action', 'actions', [
            'actions' => [
                'view' => [],
                'edit' => [],
                'delete' => [],
            ]
        ]);
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('createdAt', DateRangeFilter::class,['field_type' => DateRangePickerType::class]);
        $filter->add('enabled', BooleanFilter::class);
    }

    protected function configureShowFields(ShowMapper $show)
    {
        $show
            ->add('id')
            ->add('code')
            ->add('enabled', 'boolean')
            ->add('name')
            ->add('description')
            ->add('shortDescription');
    }
}
