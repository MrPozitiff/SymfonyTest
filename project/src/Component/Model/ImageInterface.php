<?php

namespace App\Component\Model;

use Sylius\Component\Resource\Model\ResourceInterface;

interface ImageInterface extends ResourceInterface
{
    /**
     * @return string
     */
    public function getPosition(): ?string;

    /**
     * @param string|null $type
     */
    public function setPosition(?string $type): void;

    /**
     * @return \SplFileInfo|null
     */
    public function getFile(): ?\SplFileInfo;

    /**
     * @param \SplFileInfo|null $file
     */
    public function setFile(?\SplFileInfo $file): void;

    /**
     * @return bool
     */
    public function hasFile(): bool;

    /**
     * @return string|null
     */
    public function getPath(): ?string;

    /**
     * @param string|null $path
     */
    public function setPath(?string $path): void;

    /**
     * @return object
     */
    public function getOwner();

    /**
     * @param object|null $owner
     */
    public function setOwner($owner): void;
}
