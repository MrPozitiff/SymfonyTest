<?php

namespace App\Entity\Order;

use App\Component\Model\CustomerInterface;
use App\Component\Model\OrderInterface;
use App\Component\Model\OrderItemInterface;
use App\Entity\Traits\TimestampableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\Order\OrderRepository")
 * @ORM\Table(name="app_order_order")
 * @ORM\HasLifecycleCallbacks()
 */
class Order implements OrderInterface
{
    use TimestampableTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \DateTimeInterface|null
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $checkoutCompletedAt;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $notes;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $state;

    /**
     * @var float
     *
     * @ORM\Column(type="float", nullable=true)
     */
    private $total = 0;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     */
    private $itemsTotal = 0;

    /**
     * @var null|CustomerInterface
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Client\Customer")
     * @ORM\JoinColumn(nullable=true)
     */
    private $customer;

//    /**
//     * @ORM\Column(type="string", length=255)
//     */
//    private $orderDelivery;
//
//    /**
//     * @ORM\Column(type="string", length=255)
//     */
//    private $orderPayment;

    /**
     * @var Collection|OrderItem[]
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Order\OrderItem", mappedBy="order", cascade={"persist"})
     */
    private $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();

        $this->state = OrderInterface::STATE_CART;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return CustomerInterface|null
     */
    public function getCustomer(): ?CustomerInterface
    {
        return $this->customer;
    }

    /**
     * @param CustomerInterface|null $customer
     */
    public function setCustomer(?CustomerInterface $customer): void
    {
        $this->customer = $customer;
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
     * @return int
     */
    public function getItemsTotal(): int
    {
        return $this->itemsTotal;
    }

    /**
     * {@inheritdoc}
     */
    public function recalculateItemsTotal(): void
    {
        $this->itemsTotal = $this->items->count();
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCheckoutCompletedAt(): ?\DateTimeInterface
    {
        return $this->checkoutCompletedAt;
    }

    /**
     * @param \DateTimeInterface|null $checkoutCompletedAt
     */
    public function setCheckoutCompletedAt(?\DateTimeInterface $checkoutCompletedAt): void
    {
        $this->checkoutCompletedAt = $checkoutCompletedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function isCheckoutCompleted(): bool
    {
        return null !== $this->checkoutCompletedAt;
    }

    /**
     * {@inheritdoc}
     */
    public function completeCheckout(): void
    {
        $this->checkoutCompletedAt = new \DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function getNotes(): ?string
    {
        return $this->notes;
    }

    /**
     * {@inheritdoc}
     */
    public function setNotes(?string $notes): void
    {
        $this->notes = $notes;
    }

    /**
     * {@inheritdoc}
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    /**
     * {@inheritdoc}
     */
    public function clearItems(): void
    {
        $this->items->clear();

        $this->recalculateItemsTotal();
    }

    /**
     * {@inheritdoc}
     */
    public function countItems(): int
    {
        return $this->items->count();
    }

    /**
     * {@inheritdoc}
     */
    public function addItem(OrderItemInterface $item): void
    {
        if ($this->hasItem($item)) {
            return;
        }

        $this->itemsTotal++;
        $this->total += $item->getTotal();
        $this->items->add($item);
        $item->setOrder($this);

        $this->recalculateItemsTotal();
    }

    /**
     * {@inheritdoc}
     */
    public function removeItem(OrderItemInterface $item): void
    {
        if ($this->hasItem($item)) {
            $this->items->removeElement($item);
            $this->total -= $item->getTotal();
            $this->recalculateItemsTotal();
            $item->setOrder(null);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function hasItem(OrderItemInterface $item): bool
    {
        return $this->items->contains($item);
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }
}
