<?php
/** */
namespace App\Component\Model;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\SlugAwareInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;

/**
 * Interface CategoryInterface
 */
interface CategoryInterface extends
    ResourceInterface,
    SlugAwareInterface,
    ToggleableInterface,
    TimestampableInterface,
    TranslatableInterface,
    MetaInterface,
    ImagesAwareInterface
{

}
