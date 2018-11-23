<?php
/** */
namespace App\Entity\Order;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class OrderItemDetails
 *
 * @ORM\Entity(repositoryClass="App\Repository\Order\OrderItemDetailsRepository")
 * @ORM\Table(name="app_order_order_item_details")
 */
class OrderItemDetails
{
    /**
     * @var string
     *
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(name="id", type="guid")
     */
    private $id;

    /**
     * @var null|\DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $useBefore;

    /**
     * @var null|string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $qrPng;

    /**
     * @var null|string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $qrJpg;

    /**
     * @var null|string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    private $qrPdf;

    /**
     * @var OrderItem
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Order\OrderItem")
     */
    private $orderItem;

    /**
     * @param OrderItem $orderItem
     * @param \DateTime $useBefore
     */
    public function __construct(OrderItem $orderItem, \DateTime $useBefore)
    {
        $this->useBefore = $useBefore;
        $this->orderItem = $orderItem;
    }

    /**
     * @return null|string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @return \DateTime|null
     */
    public function getUseBefore(): ?\DateTime
    {
        return $this->useBefore;
    }

    /**
     * @return null|string
     */
    public function getQrPng(): ?string
    {
        return $this->qrPng;
    }

    /**
     * @param null|string $qrPng
     */
    public function setQrPng(?string $qrPng): void
    {
        $this->qrPng = $qrPng;
    }

    /**
     * @return null|string
     */
    public function getQrJpg(): ?string
    {
        return $this->qrJpg;
    }

    /**
     * @param null|string $qrJpg
     */
    public function setQrJpg(?string $qrJpg): void
    {
        $this->qrJpg = $qrJpg;
    }

    /**
     * @return null|string
     */
    public function getQrPdf(): ?string
    {
        return $this->qrPdf;
    }

    /**
     * @param null|string $qrPdf
     */
    public function setQrPdf(?string $qrPdf): void
    {
        $this->qrPdf = $qrPdf;
    }
}
