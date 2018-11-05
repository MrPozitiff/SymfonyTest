<?php
/** */
namespace App\Entity\Traits;

/**
 * Trait MetaTranslatableMethodsTrait
 */
trait MetaTranslatableMethodsTrait
{
    /**
     * @return null|string
     */
    public function getMetaTitle(): ?string
    {
        return $this->getTranslation()->getMetaTitle();
    }

    /**
     * @param null|string $metaTitle
     */
    public function setMetaTitle(?string $metaTitle): void
    {
        $this->getTranslation()->setMetaTitle($metaTitle);
    }

    /**
     * @return null|string
     */
    public function getMetaKeywords(): ?string
    {
        return $this->getTranslation()->getMetaKeywords();
    }

    /**
     * @param null|string $metaKeywords
     */
    public function setMetaKeywords(?string $metaKeywords): void
    {
        $this->getTranslation()->setMetaKeywords($metaKeywords);
    }

    /**
     * @return null|string
     */
    public function getMetaDescription(): ?string
    {
        return $this->getTranslation()->getMetaDescription();
    }

    /**
     * @param null|string $metaDescription
     */
    public function setMetaDescription(?string $metaDescription): void
    {
        $this->getTranslation()->setMetaDescription($metaDescription);
    }
}
