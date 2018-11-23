<?php

namespace App\Entity\Order;

use App\Component\Model\OptionInterface;
use App\Component\Model\OrderInterface;
use App\Component\Model\OrderItemInterface;
use App\Component\Model\ProductInterface;
use App\Entity\Shop\Product;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Order\OrderItemRepository")
 * @ORM\Table(name="app_order_order_item")
 */
class OrderItem implements OrderItemInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $state;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=true)
     */
    private $unitPrice = 0;

    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    private $total = 0;

    /**
     * @var null|\DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $useBefore;

    /**
     * @var null|OrderInterface
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Order\Order", inversedBy="items",cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $order;

    /**
     * @var ProductInterface
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Shop\Product")
     */
    private $product;

    /**
     * @var Collection|OptionInterface[]
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Shop\Option")
     */
    private $options;

    /**  */
    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    /**
     * @inheritDoc
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @return Product|null
     */
    public function getProduct(): ProductInterface
    {
        return $this->product;
    }

    /**
     * @return float
     */
    public function getItemPrice(): float
    {
        return $this->unitPrice;
    }

    /**
     * @return Collection|OptionInterface[]
     */
    public function getOptions(): Collection
    {
        return $this->options;
    }

    /**
     * @param OptionInterface $option
     */
    public function addOption(OptionInterface $option): void
    {
        if (!$this->options->contains($option)) {
            $this->options[] = $option;
            $this->recalculateTotal();
        }
    }

    /**
     * @param OptionInterface $option
     */
    public function removeOption(OptionInterface $option): void
    {
        if ($this->options->contains($option)) {
            $this->options->removeElement($option);
            $this->recalculateTotal();
        }
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState(string $state): void
    {
        $this->state = $state;
    }

    /**
     * @inheritDoc
     */
    public function getOrder(): ?OrderInterface
    {
        return $this->order;
    }

    /**
     * @inheritDoc
     */
    public function setOrder(?OrderInterface $order): void
    {
        $this->order = $order;
    }

    /**
     * @param ProductInterface $product
     */
    public function setProduct(ProductInterface $product): void
    {
        $this->product = $product;
        $this->unitPrice = $product->getPrice();
        $this->recalculateTotal();
    }

    /**
     * @param \DateTime|null $useBefore
     */
    public function setUseBefore(?\DateTime $useBefore): void
    {
        $this->useBefore = $useBefore;
    }

    /**  */
    protected function recalculateTotal(): void
    {
        $optionPrice = 0;
        foreach ($this->options as $option) {
            $optionPrice += $option->getPrice();
        }
        $this->total = $this->unitPrice + $optionPrice;
    }
}
