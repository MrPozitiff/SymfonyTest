<?php

namespace App\Repository\Shop;

use App\Component\Model\ProductInterface;
use Pagerfanta\Pagerfanta;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

/**
 * @method ProductInterface|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductInterface|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductInterface[]    findAll()
 * @method ProductInterface[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends EntityRepository
{
    /**
     * @param int $page
     * @param int $count
     *
     * @return array|null
     */
    public function findNewest(int $page, int $count): ?array
    {
        return $this->getQueryBuilder()
            ->addOrderBy('o.createdAt', 'DESC')
            ->setFirstResult(($page - 1) * $count)
            ->setMaxResults($count)
            ->getQuery()
            ->getResult()
            ;
    }

    /**
     * @param string $categoryUrl
     *
     * @return null|Pagerfanta
     */
    public function findByCategoryUrl(string $categoryUrl): ?Pagerfanta
    {
        $qb = $this->getQueryBuilder()
            ->addSelect('cat')
            ->join('o.category', 'cat')
            ->andWhere('cat.url = :categoryUrl')
            ->setParameter('categoryUrl', $categoryUrl);

        return $this->getPaginator($qb);
    }

    /**
     * @param string $url
     *
     * @return ProductInterface|null
     */
    public function findOneByUrl(string $url): ?ProductInterface
    {
        return $this->getQueryBuilder()
            ->andWhere('o.url = :url')
            ->setParameter('url', $url)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param bool $enabled
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    private function getQueryBuilder(bool $enabled = true)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.enabled = :enabled')
            ->setParameter('enabled', $enabled);
    }
}
