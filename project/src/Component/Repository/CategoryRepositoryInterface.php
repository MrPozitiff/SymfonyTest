<?php

namespace App\Component\Repository;

use App\Component\Model\CategoryInterface;
use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Pagerfanta;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string $parentSlug
     *
     * @return array|CategoryInterface[]
     */
    public function findChildren(string $parentSlug): array;

    /**
     * @return array|CategoryInterface[]
     */
    public function findRootNodes(): array;

    /**
     * @param string $slug
     *
     * @return CategoryInterface|null
     */
    public function findOneBySlug(string $slug): ?CategoryInterface;

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
     * @param string $url
     *
     * @param bool $withChilds
     *
     * @return CategoryInterface|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByUrl(string $url, bool $withChilds = false): ?CategoryInterface;

    /**
     * @param string $url
     *
     * @return null|Pagerfanta
     */
    public function findChildrenByUrl(string $url): ?Pagerfanta;

    /**
     * @param CategoryInterface $category
     * @param bool $flush
     */
    public function save(CategoryInterface $category, bool $flush = true): void;
}
