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
        return $this->translate()->getMetaTitle();
    }

    /**
     * @param null|string $metaTitle
     */
    public function setMetaTitle(?string $metaTitle): void
    {
        $this->translate()->setMetaTitle($metaTitle);
    }

    /**
     * @return null|string
     */
    public function getMetaKeywords(): ?string
    {
        return $this->translate()->getMetaKeywords();
    }

    /**
     * @param null|string $metaKeywords
     */
    public function setMetaKeywords(?string $metaKeywords): void
    {
        $this->translate()->setMetaKeywords($metaKeywords);
    }

    /**
     * @return null|string
     */
    public function getMetaDescription(): ?string
    {
        return $this->translate()->getMetaDescription();
    }

    /**
     * @param null|string $metaDescription
     */
    public function setMetaDescription(?string $metaDescription): void
    {
        $this->translate()->setMetaDescription($metaDescription);
    }
}
