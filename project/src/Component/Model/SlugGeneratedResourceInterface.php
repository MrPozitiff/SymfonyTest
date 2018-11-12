<?php
/** */
namespace App\Component\Model;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\SlugAwareInterface;

/**
 * Interface SlugGeneratedResourceInterface
 */
interface SlugGeneratedResourceInterface extends ResourceInterface, SlugAwareInterface, DescriptiveInterface
{
}
