<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Component\Model;

/**
 * Interface UrlInterface
 */
interface UrlInterface
{
    /**
     * @return null|string
     */
    public function getUrl(): ?string;

    /**
     * @param null|string $url
     */
    public function setUrl(?string $url): void;
}
