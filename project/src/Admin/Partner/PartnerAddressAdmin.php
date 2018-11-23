<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Admin\Partner;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use App\Form\Type\Partner\PartnerAddressType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class PartnerAddressAdmin
 */
class PartnerAddressAdmin extends AbstractAdmin
{
    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form)
    {
        $form->add('postcode', TextType::class);
        $form->add('translations', TranslationsType::class);
    }

    protected function configureListFields(ListMapper $list)
    {
        $list->add('getCity');
        $list->add('postcode');
    }
}
