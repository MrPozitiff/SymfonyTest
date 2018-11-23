<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Admin\Client;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class ShopUserAdmin
 */
class CustomerAdmin extends AbstractAdmin
{
    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('create');
        $collection->remove('delete');
    }

    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form)
    {
        $form->add('firstName', TextType::class);
        $form->add('lastName', TextType::class);
        $form->add('email', EmailType::class);
        $form->add('phoneNumber', TextType::class);
        $form->add('subscribedToNewsletter', CheckboxType::class);
        $form->add('plainPassword', TextType::class, [
            'required' => $this->getSubject()->getId() === null,
        ]);
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list->add('firstName');
        $list->add('lastName');
        $list->add('email');
        $list->add('hasUser', 'boolean');
        $list->add('_action', 'actions', [
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
        $show->add('enabled');
        $show->add('firstName');
        $show->add('lastName');
        $show->add('email');
        $show->add('hasUser', 'boolean');
    }
}
