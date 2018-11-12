<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Admin\Partner;

use App\Form\Type\Partner\PartnerAddressType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Form\FormMapper;

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
        $form->create('address', PartnerAddressType::class);
    }
}
