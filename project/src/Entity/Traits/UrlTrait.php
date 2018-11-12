<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait UrlPrefixTrait
 */
trait UrlTrait
{
    /**
     * @var null|string
     *
     * @ORM\Column(type="string", nullable=true, unique=true)
     */
    private $url;

    /**
     * @return null|string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param null|string $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }
}
