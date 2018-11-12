<?php
/** */
namespace App\Admin\Shop;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use App\Form\Type\Shop\CategoryImageType;
use App\Repository\Shop\CategoryRepository;
use Doctrine\ORM\EntityRepository;
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
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Expression;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class CategoryImage
 */
class CategoryAdmin extends AbstractAdmin
{
    /**
     * @var string[]
     */
    protected $searchResultActions = ['edit', 'show'];

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * CategoryAdmin constructor.
     *
     * @param string $code
     * @param string $class
     * @param string $baseControllerName
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(string $code, string $class, string $baseControllerName, CategoryRepository $categoryRepository)
    {
        parent::__construct($code, $class, $baseControllerName);
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form)
    {
        if (!$this->isRootCategory()) {
            $form
                    ->with('General')
                    ->add('enabled', CheckboxType::class)
                    ->add('parent', EntityType::class, [
                        'label' => 'admin.form.parent',
                        'class' => $this->getClass(),
                        'choices' => $this->getChoices(),
                    ])
                    ->add('slug', TextType::class, [
                        'label' => 'admin.form.slug',
                        'required' => false,
                    ])
                ->end();
        }
        $form->with('Translatable Fields')
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
                    "allow_add" => true,
                    "allow_delete" => true,
                    "by_reference" => false,
                    "entry_type" => CategoryImageType::class
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
            ->add('url')
            ->add('name')
            ->add('parent')
            ->add('enabled', 'boolean', ['editable' => true])
            ->add('statistics.minProductPrice')
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
     * @param DatagridMapper $filter
     */
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('createdAt', DateRangeFilter::class,['field_type' => DateRangePickerType::class]);
        $filter->add('enabled', BooleanFilter::class);
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

    /**
     * @return bool
     */
    private function isRootCategory()
    {
        return $this->getSubject()->getSlug() === 'root';
    }

    /**
     * @return array
     */
    private function getChoices()
    {
        $categories = $this->categoryRepository->findAll();
        $choices = [];
        $id = null !== $this->getSubject()? $this->getSubject()->getId() : null;
        foreach ($categories as $category) {
            if (null !== $id && $category->getId() === $id) {
                continue;
            }
            if (null === $category->getParent() || null === $category->getParent()->getParent()) {
                $choices[$category->getId()] = $category;
            }
        }

        return $choices;
    }
}
