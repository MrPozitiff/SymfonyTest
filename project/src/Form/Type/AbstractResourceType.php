<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Form\Type;

/**
 * Class AbstractResourceType
 */
class AbstractResourceType extends \Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType
{
    /**
     * AbstractResourceType constructor.
     *
     * @param string $dataClass
     * @param array  $validationGroups
     */
    public function __construct(string $dataClass, $validationGroups = ['Default'])
    {
        parent::__construct($dataClass, ['Default']);
    }
}
