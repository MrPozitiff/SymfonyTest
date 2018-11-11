<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Entity\Shop;

use App\Component\Model\CategoryInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class CategoryStatistics
 *
 * @ORM\Entity()
 * @ORM\Table(name="app_shop_category_statistics")
 */
class CategoryStatistics
{
    /**
     * @var int|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var Category
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Shop\Category", mappedBy="statistics")
     */
    private $category;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $totalProductsCount = 0;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=true)
     */
    private $minProductPrice;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=true)
     */
    private $maxProductPrice;

    /**
     * CategoryStatistics constructor.
     *
     * @param CategoryInterface $category
     */
    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }

    /**
     * @return int
     */
    public function getTotalProductsCount(): int
    {
        return $this->totalProductsCount;
    }

    /**
     * @param int $totalProductsCount
     *
     * @return CategoryStatistics
     */
    public function setTotalProductsCount(int $totalProductsCount): CategoryStatistics
    {
        $this->totalProductsCount = $totalProductsCount;

        return $this;
    }

    /**
     * @return float
     */
    public function getMinProductPrice(): ?float
    {
        return $this->minProductPrice;
    }

    /**
     * @param float $minProductPrice
     *
     * @return CategoryStatistics
     */
    public function setMinProductPrice(?float $minProductPrice): CategoryStatistics
    {
        $this->minProductPrice = $minProductPrice;

        return $this;
    }

    /**
     * @return float
     */
    public function getMaxProductPrice(): ?float
    {
        return $this->maxProductPrice;
    }

    /**
     * @param float $maxProductPrice
     *
     * @return CategoryStatistics
     */
    public function setMaxProductPrice(?float $maxProductPrice): CategoryStatistics
    {
        $this->maxProductPrice = $maxProductPrice;

        return $this;
    }
}
