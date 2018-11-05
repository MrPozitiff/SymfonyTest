<?php
/** */
namespace App\Entity\Traits;

/**
 * Trait NameDescriptionMethodsTrait
 * @method getTranslation()
 */
trait NameDescriptionTranslatableMethodsTrait
{
    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->getTranslation()->getName();
    }

    /**
     * @param null|string $name
     */
    public function setName(?string $name): void
    {
        $this->getTranslation()->setName($name);
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->getTranslation()->getDescription();
    }

    /**
     * @param null|string $description
     */
    public function setDescription(?string $description): void
    {
        $this->getTranslation()->setDescription($description);
    }
}
