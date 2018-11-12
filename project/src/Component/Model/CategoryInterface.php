<?php
/** */
namespace App\Component\Model;

use App\Entity\Shop\CategoryStatistics;
use App\Entity\Shop\CategoryTranslation;
use Doctrine\Common\Collections\Collection;
use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\SlugAwareInterface;
use Sylius\Component\Resource\Model\TimestampableInterface;
use Sylius\Component\Resource\Model\ToggleableInterface;

/**
 * Interface CategoryInterface
 * @method CategoryTranslation translate($locale = null, $fallbackToDefault = true)
 */
interface CategoryInterface extends
    SlugGeneratedResourceInterface,
    ToggleableInterface,
    TimestampableInterface,
    MetaInterface,
    ImagesAwareInterface,
    UrlInterface
{
    /**
     * @return self|null
     */
    public function getParent(): ?CategoryInterface;

    /**
     * @param null|self $parent
     */
    public function setParent(?CategoryInterface $parent): void;

    /**
     * @return Collection|CategoryInterface[]
     */
    public function getChildren(): Collection;

    /**
     * @param self $category
     *
     * @return bool
     */
    public function hasChild(CategoryInterface $category): bool;

    /**
     * @return bool
     */
    public function hasChildren(): bool;

    /**
     * @param self $category
     */
    public function addChild(CategoryInterface $category): void;

    /**
     * @param self $category
     */
    public function removeChild(CategoryInterface $category): void;

    /**
     * @return Collection|CategoryInterface[]
     */
    public function getAncestors(): Collection;

    /**
     * @return int|null
     */
    public function getPosition(): ?int;

    /**
     * @param int|null $position
     */
    public function setPosition(?int $position): void;

    /**
     * @return ProductInterface[]|Collection
     */
    public function getProducts(): Collection;

    /**
     * @return CategoryStatistics
     */
    public function getStatistics(): CategoryStatistics;
}
