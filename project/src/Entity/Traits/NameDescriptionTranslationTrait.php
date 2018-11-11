<?php
/** */
namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait NameDescriptionTranslationTrait
 */
trait NameDescriptionTranslationTrait
{
    /**
     * @var null|string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $name;

    /**
     * @var null|string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $shortDescription;

    /**
     * @var null|string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return null|string
     */
    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    /**
     * @param null|string $shortDescription
     */
    public function setShortDescription(?string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}
