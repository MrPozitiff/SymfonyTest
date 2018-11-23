<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class AdminUserAdmin
 */
class AdminUserAdmin extends AbstractAdmin
{
    protected function configureListFields(ListMapper $list)
    {
        $list->add('firstName');
        $list->add('lastName');
        $list->add('email');
        $list->add('enabled');
        $list->add('_action', 'actions', [
            'actions' => [
                'view' => [],
                'edit' => [],
                'delete' => [],
            ]
        ]);
    }

    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form)
    {
        $form->add('enabled', CheckboxType::class, ['required' => false]);
        $form->add('firstName', TextType::class);
        $form->add('lastName', TextType::class);
        $form->add('email', EmailType::class);
        $form->add('plainPassword', TextType::class, [
            'required' => $this->getSubject()->getId() === null,
        ]);
    }
}
