<?php

namespace App\Entity\Shop;

use App\Component\Model\ImageInterface;
use App\Entity\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Image
 */
abstract class Image implements ImageInterface
{
    use TimestampableTrait;

    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var null|string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $position;

    /**
     * @var \SplFileInfo
     */
    protected $file;

    /**
     * @var null|string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $path;

    /**
     * @var object
     */
    protected $owner;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getPosition(): ?string
    {
        return $this->position;
    }

    /**
     * {@inheritdoc}
     */
    public function setPosition(?string $position): void
    {
        $this->position = $position;
    }

    /**
     * {@inheritdoc}
     */
    public function getFile(): ?\SplFileInfo
    {
        return $this->file;
    }

    /**
     * {@inheritdoc}
     */
    public function setFile(?\SplFileInfo $file): void
    {
        $this->file = $file;
        if (null !== $file) {
            $this->setUpdated();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasFile(): bool
    {
        return null !== $this->file;
    }

    /**
     * {@inheritdoc}
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * {@inheritdoc}
     */
    public function setPath(?string $path): void
    {
        $this->path = $path;
    }

    /**
     * {@inheritdoc}
     */
    public function hasPath(): bool
    {
        return null !== $this->path;
    }

    /**
     * {@inheritdoc}
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * {@inheritdoc}
     */
    public function setOwner($owner): void
    {
        $this->owner = $owner;
    }
}
