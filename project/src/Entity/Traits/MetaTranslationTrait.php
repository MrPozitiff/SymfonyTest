<?php
/** */

namespace App\Entity\Traits;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait MetaTranslationTrait
 */
trait MetaTranslationTrait
{
    /**
     * @var null|string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $metaTitle;

    /**
     * @var null|string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $metaKeywords;

    /**
     * @var null|string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $metaDescription;

    /**
     * @return null|string
     */
    public function getMetaTitle(): ?string
    {
        return $this->metaTitle;
    }

    /**
     * @param null|string $metaTitle
     *
     * @return self
     */
    public function setMetaTitle(?string $metaTitle): self
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getMetaKeywords(): ?string
    {
        return $this->metaKeywords;
    }

    /**
     * @param null|string $metaKeywords
     *
     * @return self
     */
    public function setMetaKeywords(?string $metaKeywords): self
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getMetaDescription(): ?string
    {
        return $this->metaDescription;
    }

    /**
     * @param null|string $metaDescription
     *
     * @return self
     */
    public function setMetaDescription(?string $metaDescription): self
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }
}
