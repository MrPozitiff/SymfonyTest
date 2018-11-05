<?php
/** */
namespace App\Entity\Traits;

use Doctrine\ORM\Mapping as ORM;
use KunicMarko\SonataAnnotationBundle\Annotation as Admin;

/**
 * Trait SluggableTrait
 */
trait SluggableTrait
{
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     *
     * @Admin\ListField()
     * @Admin\FormField()
     */
    private $slug;

    /**
     * @return string
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }
}
