<?php

namespace App\Component\Repository;

use App\Component\Model\CategoryInterface;
use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string $parentSlug
     * @param string|null $locale
     *
     * @return array|CategoryInterface[]
     */
    public function findChildren(string $parentSlug, ?string $locale = null): array;

    /**
     * @return array|CategoryInterface[]
     */
    public function findRootNodes(): array;

    /**
     * @param string $slug
     * @param string $locale
     *
     * @return CategoryInterface|null
     */
    public function findOneBySlug(string $slug, string $locale): ?CategoryInterface;

    /**
     * @param string $name
     * @param string $locale
     *
     * @return array|CategoryInterface[]
     */
    public function findByName(string $name, string $locale): array;

    /**
     * @param string $phrase
     * @param string|null $locale
     *
     * @return array|CategoryInterface[]
     */
    public function findByNamePart(string $phrase, ?string $locale = null): array;

    /**
     * @return QueryBuilder
     */
    public function createListQueryBuilder(): QueryBuilder;

    /**
     * @param CategoryInterface $category
     * @param bool $flush
     */
    public function save(CategoryInterface $category, bool $flush = true): void;
}
