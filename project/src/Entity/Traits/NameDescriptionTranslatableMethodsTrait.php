<?php
/** */
namespace App\Entity\Traits;

/**
 * Trait NameDescriptionMethodsTrait
 */
trait NameDescriptionTranslatableMethodsTrait
{
    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->translate()->getName();
    }

    /**
     * @param null|string $name
     */
    public function setName(?string $name): void
    {
        $this->translate()->setName($name);
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->translate()->getDescription();
    }

    /**
     * @param null|string $description
     */
    public function setDescription(?string $description): void
    {
        $this->translate()->setDescription($description);
    }
}
