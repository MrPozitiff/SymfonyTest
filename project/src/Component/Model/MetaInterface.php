<?php
/** */

namespace App\Component\Model;

/**
 * Interface MetaInterface
 */
interface MetaInterface
{
    /**
     * @return null|string
     */
    public function getName(): ?string;

    /**
     * @param null|string $name
     */
    public function setName(?string $name): void;

    /**
     * @return null|string
     */
    public function getDescription(): ?string;

    /**
     * @param null|string $description
     */
    public function setDescription(?string $description): void;
}
