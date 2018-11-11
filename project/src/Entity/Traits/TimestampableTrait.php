<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait TimestampableTrait
 */
trait TimestampableTrait
{
    use \Sylius\Component\Resource\Model\TimestampableTrait;

    /**
     * @var \DateTimeInterface|null
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $createdAt;

    /**
     * @var \DateTimeInterface|null
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $updatedAt;

    /**
     * @ORM\PrePersist()
     */
    public function setCreated()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     */
    public function setUpdated()
    {
        $this->updatedAt = new \DateTime();
    }
}