<?php
/**
 * ZiGifts project
 *
 * @author Sehii Kovalov <mr.pozitiff7@gmail.com>
 */
namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ToggleableTrait
 */
trait ToggleableTrait
{
    /**
     * @var bool
     *
     * @ORM\Column(type="boolean", options={"default":"0"})
     */
    protected $enabled = false;

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(?bool $enabled): void
    {
        $this->enabled = (bool) $enabled;
    }

    public function enable(): void
    {
        $this->enabled = true;
    }

    public function disable(): void
    {
        $this->enabled = false;
    }
}
