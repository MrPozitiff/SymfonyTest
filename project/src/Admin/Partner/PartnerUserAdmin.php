<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Admin\Partner;

use App\Entity\Partner\Partner;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class PartnerUserAdmin
 */
class PartnerUserAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form)
    {
        $form->add('enabled', CheckboxType::class, ['required' => false]);
        $form->add('partner', ModelType::class, [
            'class' => Partner::class,
            'btn_add' => false,
        ]);
        $form->add('firstName', TextType::class);
        $form->add('lastName', TextType::class);
        $form->add('phone', TextType::class);
        $form->add('email', EmailType::class);
        $form->add('plainPassword', TextType::class, [
            'required' => $this->getSubject()->getId() === null,
        ]);
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list->add('partner');
        $list->add('firstName');
        $list->add('lastName');
        $list->add('phone');
        $list->add('email');
        $list->add('enabled', 'boolean');
        $list->add('_action', 'actions', [
            'actions' => [
                'view' => [],
                'edit' => [],
                'delete' => [],
            ]
        ]);
    }

    protected function configureShowFields(ShowMapper $show)
    {
        $show->add('partner');
        $show->add('firstName');
        $show->add('lastName');
        $show->add('phone');
        $show->add('email');
        $show->add('enabled', 'boolean');
    }
}
