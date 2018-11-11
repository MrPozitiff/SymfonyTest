<?php
/** */
namespace App\Component\Model;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;

/**
 * Interface OptionInterface
 */
interface OptionInterface extends
    ResourceInterface,
    ToggleableInterface,
    TimestampableInterface
{

}
