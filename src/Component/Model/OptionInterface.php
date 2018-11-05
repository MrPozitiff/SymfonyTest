<?php
/** */
namespace App\Component\Model;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;
use Sylius\Component\Resource\Model\TranslatableInterface;

/**
 * Interface OptionInterface
 */
interface OptionInterface extends
    ResourceInterface,
    ToggleableInterface,
    TimestampableInterface,
    TranslatableInterface
{

}
