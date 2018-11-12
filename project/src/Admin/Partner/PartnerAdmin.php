<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Admin\Partner;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use App\Form\Type\Partner\PartnerAddressType;
use App\Form\Type\Partner\PartnerImageType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\CollectionType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

/**
 * Class PartnerAdmin
 */
class PartnerAdmin extends AbstractAdmin
{
    protected $searchResultActions = ['edit', 'show'];

    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->with('General', ['tab' => true])
                ->add('enabled', CheckboxType::class)
                ->add('translations', TranslationsType::class, [
                    'fields' => [
                        'description' => [
                            'field_type' => CKEditorType::class,
                            'label' => 'admin.form.product.description',
                        ],
                    ],
                ])
            ->end()
            ->with('Media')
                ->add('images', CollectionType::class, [
                    "allow_add" => false,
                    "allow_delete" => false,
                    "by_reference" => false,
                    "entry_type" => PartnerImageType::class
                ])
            ->end()
            ->end();
        $form->with('Partner Addresses', ['tab' => true])
                ->add('addresses', CollectionType::class, [
                    "allow_add" => true,
                    "allow_delete" => true,
                    "by_reference" => false,
                    "entry_type" => PartnerAddressType::class,
                ])
            ->end();
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('slug')
            ->add('name')
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
