<?php

namespace App\Repository\Shop;

use App\Component\Model\CategoryInterface;
use App\Component\Repository\CategoryRepositoryInterface;
use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Pagerfanta;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

/**
 * Class CategoryRepository
 * @method CategoryInterface|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryInterface|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryInterface[]    findAll()
 * @method CategoryInterface[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends EntityRepository implements CategoryRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findChildren(string $parentSlug): array
    {
        return $this->createQueryBuilder('o')
            ->addSelect('child')
            ->innerJoin('o.parent', 'parent')
            ->leftJoin('o.children', 'child')
            ->andWhere('parent.slug = :parentSlug')
            ->addOrderBy('o.position')
            ->setParameter('parentSlug', $parentSlug)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function findOneBySlug(string $slug): ?CategoryInterface
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.slug = :slug')
            ->setParameter('slug', $slug)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    /**
     * @param string $url
     *
     * @param bool $withChilds
     *
     * @return CategoryInterface|null
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByUrl(string $url, bool $withChilds = false): ?CategoryInterface
    {
        $qb = $this->createQueryBuilder('o')
            ->andWhere('o.url = :url')
            ->setParameter('url', $url);
        if ($withChilds) {
            $qb->join('o.children', 'children');
        }

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * @param string $url
     *
     * @return null|Pagerfanta
     */
    public function findChildrenByUrl(string $url): ?Pagerfanta
    {
        $qb = $this->createQueryBuilder('o')
            ->addSelect('child')
            ->innerJoin('o.parent', 'parent')
            ->leftJoin('o.children', 'child')
            ->andWhere('parent.url = :url')
            ->addOrderBy('o.position')
            ->setParameter('url', $url);

        return $this->getPaginator($qb);
    }

    /**
     * {@inheritdoc}
     */
    public function findByName(string $name, string $locale): array
    {
        return $this->createQueryBuilder('o')
            ->addSelect('translation')
            ->innerJoin('o.translations', 'translation')
            ->andWhere('translation.name = :name')
            ->andWhere('translation.locale = :locale')
            ->setParameter('name', $name)
            ->setParameter('locale', $locale)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function findRootNodes(): array
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.parent IS NULL')
            ->addOrderBy('o.position')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function findByNamePart(string $phrase, ?string $locale = null): array
    {
        return $this->createTranslationBasedQueryBuilder($locale)
            ->andWhere('translation.name LIKE :name')
            ->setParameter('name', '%' . $phrase . '%')
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function createListQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('o')->leftJoin('o.translations', 'translation');
    }

    /**
     * @param CategoryInterface $category
     * @param bool $flush
     */
    public function save(CategoryInterface $category, bool $flush = true): void
    {
        $this->getEntityManager()->persist($category);
        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param string|null $locale
     *
     * @return QueryBuilder
     */
    private function createTranslationBasedQueryBuilder(?string $locale): QueryBuilder
    {
        $queryBuilder = $this->createQueryBuilder('o')
            ->addSelect('translation')
            ->leftJoin('o.translations', 'translation')
        ;

        if (null !== $locale) {
            $queryBuilder
                ->andWhere('translation.locale = :locale')
                ->setParameter('locale', $locale)
            ;
        }

        return $queryBuilder;
    }
}
